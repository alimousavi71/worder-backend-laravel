<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcfConnect;
use App\Models\AcfStore;
use App\Models\AcfTemplate;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Validator;

class AcfBuilderController extends Controller
{
    private function makeModel($modelName): Model
    {
        $modelClassName = 'App\Models\\'.ucfirst($modelName);

        return app($modelClassName);
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function index(string $model, int $id)
    {
        try {
            $modelMake = $this->makeModel($model);
            $modelInstance = $modelMake::query()
                ->with(['acfTemplates.fields', 'acfStores'])
                ->findOrFail($id);

            $oldsTemplates = [];
            if ($modelInstance->acfTemplates->isNotEmpty()) {
                $oldsTemplates = $modelInstance->acfTemplates->pluck('id')->toArray();
            }
            $title = trans('panel.builder.index');
            $templates = AcfTemplate::query()->get();

            return view('admin.acf-builder.builder', compact('title', 'model', 'modelInstance', 'templates', 'oldsTemplates'));

        } catch (ModelNotFoundException|Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function addTemplate(string $model, int $id, int $templateId)
    {
        try {
            $template = AcfTemplate::query()->findOrFail($templateId);
            $modelMake = $this->makeModel($model);
            $modelInstance = $modelMake::query()
                ->with(['acfTemplates.fields', 'acfStores'])
                ->findOrFail($id);

            $checkConnected = AcfConnect::query()
                ->where('acf_template_id', $template->id)
                ->where('target_id', $id)
                ->where('target_type', $modelInstance::class)
                ->exists();

            if ($checkConnected) {
                return back()->with('warning', trans('panel.builder.template.exist'));
            }

            $modelInstance->acfConnects()->create([
                'acf_template_id' => $template->id,
            ]);

            return back()->with('success', trans('panel.builder.template.connected'));
        } catch (ModelNotFoundException|Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

    }

    public function removeTemplate(string $model, int $id, int $templateId)
    {
        try {

            $modelMake = $this->makeModel($model);
            $modelInstance = $modelMake::query()
                ->with(['acfTemplates.fields', 'acfStores'])
                ->findOrFail($id);

            $template = AcfTemplate::query()->findOrFail($templateId);

            $checkConnected = AcfConnect::query()
                ->where('acf_template_id', $template->id)
                ->where('target_id', $id)
                ->where('target_type', $modelInstance::class)
                ->exists();
            if (! $checkConnected) {
                return back()->with('warning', trans('panel.builder.template.not_exist'));
            }

            $modelInstance->acfConnects()->where('acf_template_id', $template->id)->delete();
            $modelInstance->acfStores()->where('acf_template_id', $template->id)->delete();

            return back()->with('success', trans('panel.builder.template.removed'));
        } catch (ModelNotFoundException|Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

    }

    public function save(string $model, int $id)
    {
        try {

            $modelMake = $this->makeModel($model);
            $modelInstance = $modelMake::query()
                ->findOrFail($id);

            if (! count(request('template', []))) {
                return response()->json([
                    'result' => 'success',
                    'message' => trans('panel.success_no_change'),
                ]);
            }

            $modelInstance->acfStores()->delete();

            foreach (request('template') as $parentIndex => $item) {

                $templateId = $item['template_id'];
                $sortPosition = $item['sort_position'];

                foreach ($item['fields'] as $index => $field) {
                    $validationDecode = json_decode($field['validation']);
                    if (count($validationDecode)) {
                        if (in_array($field['type'], ['Text', 'Email', 'Url', 'Textarea'])) {
                            $rules[sprintf('template.%d.fields.%d.value', $parentIndex, $index)] = $validationDecode;
                        } else {
                            $rules[sprintf('template.%d.fields.%d.minimum', $parentIndex, $index)] = $validationDecode;
                            $rules[sprintf('template.%d.fields.%d.maximum', $parentIndex, $index)] = $validationDecode;
                        }

                        $validator = Validator::make(request()->all(), $rules);
                        if ($validator->fails()) {
                            throw new ValidationException($validator);
                        }
                    }

                    if (in_array($field['type'], ['Text', 'Email', 'Url', 'Textarea'])) {
                        $value = $field['value'];
                    } else {
                        $value = $field['minimum'].'|'.$field['maximum'];
                    }

                    AcfStore::create([
                        'target_type' => $modelInstance::class,
                        'target_id' => $modelInstance->id,
                        'acf_template_id' => $templateId,
                        'acf_field_id' => $field['id'],
                        'value' => $value,
                        'sort_position' => $sortPosition,
                    ]);
                }
            }

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                '_message' => trans('panel.error_store'),
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
