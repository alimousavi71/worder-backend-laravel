<?php

namespace App\Http\Controllers\Admin\Acf;

use App\Http\Controllers\Controller;
use App\Models\AcfBuild;
use App\Models\AcfConnect;
use App\Models\AcfStore;
use App\Models\AcfTemplate;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Validator;

class BuilderController extends Controller
{
    public function index(int $buildId)
    {
        try {
            $build = AcfBuild::query()
                ->with('connects')
                ->findOrFail($buildId);
            $title = trans('panel.builder.index');

            $in = $build->connects->pluck('acf_template_id')->toArray();

            $connectTemplates = AcfTemplate::query()
                ->with(['fields', 'connected'])
                ->whereIntegerInRaw('id', $in)
                ->when(count($in), function ($q) use ($in) {
                    $q->orderByRaw(sprintf('FIELD(%s, %s)', 'id', implode(',', $in)));
                })
                ->get();

            $selectTemplate = $connectTemplates->pluck('id')->toArray();

            $allTemplates = AcfTemplate::query()->get();

            return view('admin.acf.builder.builder', compact('title', 'build', 'connectTemplates', 'allTemplates', 'selectTemplate'));

        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

    }

    public function addTemplate(int $buildId, int $templateId)
    {
        try {
            $template = AcfTemplate::query()->findOrFail($templateId);

            $build = AcfBuild::query()
                ->with('connects')
                ->findOrFail($buildId);

            $checkConnected = AcfConnect::query()
                ->where('acf_build_id', $build->id)
                ->where('acf_template_id', $template->id)
                ->exists();

            if ($checkConnected) {
                return back()->with('warning', trans('panel.acf.builder.template_exist'));
            }

            $build->connects()->create([
                'acf_template_id' => $template->id,
            ]);

            return back()->with('success', trans('panel.acf.builder.template_connected'));
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

    }

    public function removeTemplate(int $buildId, int $templateId)
    {
        try {

            $build = AcfBuild::query()
                ->with('connects')
                ->findOrFail($buildId);

            $template = AcfTemplate::query()
                ->findOrFail($templateId);

            $checkConnected = AcfConnect::query()
                ->where('acf_template_id', $template->id)
                ->where('acf_build_id', $buildId)
                ->exists();
            if (! $checkConnected) {
                return back()->with('warning', trans('panel.acf.builder.template_404'));
            }

            $build->connects()->where('acf_template_id', $template->id)->delete();
            $build->stores()->where('acf_template_id', $template->id)->delete();

            return back()->with('success', trans('panel.acf.builder.template_removed'));
        } catch (ModelNotFoundException|Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

    }

    public function save(int $buildId)
    {
        try {

            $build = AcfBuild::query()
                ->findOrFail($buildId);

            if (! count(request('template', []))) {
                return response()->json([
                    'result' => 'success',
                    'message' => trans('panel.success_no_change'),
                ]);
            }

            foreach (request('template') as $parentIndex => $item) {
                $templateId = $item['template_id'];

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

                    AcfStore::updateOrCreate([
                        'acf_build_id' => $build->id,
                        'acf_template_id' => $templateId,
                        'acf_field_id' => $field['id'],
                    ], [
                        'acf_build_id' => $build->id,
                        'acf_template_id' => $templateId,
                        'acf_field_id' => $field['id'],
                        'value' => $value,
                    ]);
                }

                AcfConnect::query()
                    ->where('id', $item['connected_id'])
                    ->update([
                        'sort_position' => $item['sort_position'],
                    ]);
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
