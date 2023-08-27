<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcfTemplate\StoreRequest;
use App\Http\Requests\Admin\AcfTemplate\UpdateRequest;
use App\Models\AcfTemplate;
use Exception;
use File;
use Illuminate\Http\Request;
use View;
use Yajra\DataTables\Facades\DataTables;

class AcfTemplateController extends Controller
{
    public function index()
    {
        $title = trans('panel.acf-template.index');
        $routeData = route('admin.acf-template.data');
        $selects = ['id', 'title', 'created_at'];

        return view('admin.acf-template.index', compact('title', 'routeData', 'selects'));
    }

    public function render($type)
    {
        $share = [
            'index' => null,
        ];

        return match ($type) {
            'Text' => View::make('admin.acf-template.field.text', ['type' => 'متنی', ...$share]),
            'Textarea' => View::make('admin.acf-template.field.textarea', ['type' => 'متنی بزرگ', ...$share]),
            'Email' => View::make('admin.acf-template.field.email', ['type' => 'پست الکترونیکی', ...$share]),
            'Url' => View::make('admin.acf-template.field.url', ['type' => 'لینک', ...$share]),
            'Range' => View::make('admin.acf-template.field.range', ['type' => 'بازه عددی', ...$share]),
            'Select' => View::make('admin.acf-template.field.select', ['type' => 'انتخابی', ...$share]),
            'Image' => View::make('admin.acf-template.field.image', ['type' => 'تصویر', ...$share]),
            default => '',
        };

    }

    public function data()
    {

        try {
            $acfTemplate = AcfTemplate::query();

            return DataTables::of($acfTemplate)
                ->editColumn('created_at', function ($acfTemplate) {
                    return $acfTemplate->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($acfTemplate) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.acf-template.edit', $acfTemplate->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.acf-template.manage', $acfTemplate->id), trans('panel.action.manage'));

                    return $actions;

                })
                ->rawColumns(['action', 'type'])
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.acf-template.create');
        $routeStore = route('admin.acf-template.store');
        $availableTemplates = $this->getAvailableTemplates();

        return view('admin.acf-template.create', compact('title', 'routeStore', 'availableTemplates'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            AcfTemplate::create($item);

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

    public function edit(AcfTemplate $acfTemplate)
    {

        $availableTemplates = $this->getAvailableTemplates();
        $title = trans('panel.acf-template.edit');
        $routeUpdate = route('admin.acf-template.update', $acfTemplate->id);
        $routeDestroy = route('admin.acf-template.destroy', $acfTemplate->id);

        return view('admin.acf-template.edit', compact('title', 'routeUpdate', 'routeDestroy', 'acfTemplate', 'availableTemplates'));
    }

    public function manage(AcfTemplate $acfTemplate)
    {

        $acfTemplate->load('fields');
        $availableTemplates = $this->getAvailableTemplates();
        $title = trans('panel.acf-template.builder');
        $routeUpdate = route('admin.acf-template.store-fields', $acfTemplate->id);

        return view('admin.acf-template.manage', compact('title', 'routeUpdate', 'acfTemplate', 'availableTemplates'));
    }

    public function update(UpdateRequest $request, AcfTemplate $acfTemplate)
    {
        try {
            $item = $this->itemProvider($request);
            $acfTemplate->update($item);

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_update'),
            ], 500);
        }
    }

    public function destroy(AcfTemplate $acfTemplate)
    {
        try {
            $acfTemplate->delete();

            return redirect(route('admin.acf-template.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.acf-template.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['title'] = $request->get('title');
        $item['template'] = $request->get('template');
        $item['description'] = $request->get('description');

        if ($request->hasFile('photo')) {
            $provider = (new Uploader())
                ->path('acf')
                ->field('photo')
                ->upload();

            $item['photo'] = $provider['photo'];
        }

        return $item;
    }

    public function getAvailableTemplates(): \Illuminate\Support\Collection
    {
        $availableTemplates = [];
        $files = File::allFiles(resource_path('/views/admin/acf-template/template'));
        foreach ($files as $file) {
            $availableTemplates[] = [
                'key' => $file->getFilename(),
                'value' => $file->getFilename(),
            ];
        }

        $availableTemplates = collect($availableTemplates);

        return $availableTemplates;
    }
}
