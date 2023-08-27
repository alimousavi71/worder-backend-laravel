<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcfConnect;
use App\Models\AcfTemplate;
use App\Models\Page;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcfBuilderController extends Controller
{
    private function makeModel($modelName): Model
    {
        $modelClassName = 'App\Models\\'.ucfirst($modelName);

        return app($modelClassName);
    }

    public function index($model, $id)
    {
        try {
            $modelInstance = $this->makeModel($model);

            return $modelInstance::query()->findOrFail($id);
        } catch (ModelNotFoundException|Exception $exception) {
            return $exception->getMessage();
        }

        /*$page->load('acfTemplates.fields', 'acfStores');

        $oldsTemplate = [];
        if ($page->acfTemplates->isNotEmpty()) {
            $oldsTemplate = $page->acfTemplates->pluck('id')->toArray();
        }
        $title = trans('panel.page.edit');
        $routeUpdate = route('admin.page.update', $page->id);
        $routeDestroy = route('admin.page.destroy', $page->id);
        $acfTemplates = AcfTemplate::query()->get();

        return view('admin.page.builder', compact('title', 'routeUpdate', 'routeDestroy', 'page', 'acfTemplates', 'oldsTemplate'));*/
    }

    public function save()
    {
        try {
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_store'),
            ], 500);
        }
    }

    public function manage(AcfTemplate $acfTemplate)
    {

        $acfTemplate->load('fields');

        $title = trans('panel.acf-template.builder');
        $routeUpdate = route('admin.acf-template.store-fields', $acfTemplate->id);

        return view('admin.acf-template.manage', compact('title', 'routeUpdate', 'acfTemplate'));
    }

    public function addTemplate(Page $page, AcfTemplate $acfTemplate)
    {
        $checkConnected = AcfConnect::query()
            ->where('acf_template_id', $acfTemplate->id)
            ->where('target_id', $page->id)
            ->where('target_type', Page::class)
            ->exists();
        if ($checkConnected) {
            return redirect()->route('admin.page.builder', $page->id)->with('warning', trans('panel.page.template.exist'));
        }

        $page->acfConnects()->create([
            'acf_template_id' => $acfTemplate->id,
        ]);

        return redirect()->route('admin.page.builder', $page->id)->with('success', trans('panel.page.template.connected'));

    }

    public function removeTemplate(Page $page, AcfTemplate $acfTemplate)
    {
        $checkConnected = AcfConnect::query()
            ->where('acf_template_id', $acfTemplate->id)
            ->where('target_id', $page->id)
            ->where('target_type', Page::class)
            ->exists();
        if (! $checkConnected) {
            return redirect()->route('admin.page.builder', $page->id)->with('warning', trans('panel.page.template.not_exist'));
        }

        $page->acfConnects()->where('acf_template_id', $acfTemplate->id)->delete();
        $page->acfStores()->where('acf_template_id', $acfTemplate->id)->delete();

        return redirect()->route('admin.page.builder', $page->id)->with('success', trans('panel.page.template.removed'));

    }
}
