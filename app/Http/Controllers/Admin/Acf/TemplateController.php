<?php

namespace App\Http\Controllers\Admin\Acf;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acf\Template\StoreRequest;
use App\Http\Requests\Admin\Acf\Template\UpdateRequest;
use App\Models\AcfTemplate;
use function collect;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function redirect;
use function report;
use function resource_path;
use function response;
use function route;
use function trans;
use function view;
use Yajra\DataTables\Facades\DataTables;

class TemplateController extends Controller
{
    public function index()
    {
        $title = trans('panel.acf.template.index');
        $routeData = route('admin.acf.template.data');
        $selects = ['id', 'title', 'created_at'];

        return view('admin.acf.template.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $template = AcfTemplate::query();

            return DataTables::of($template)
                ->editColumn('created_at', function ($template) {
                    return $template->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($template) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.acf.template.edit', $template->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.acf.template.manage', $template->id), trans('panel.action.manage'));

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
        $title = trans('panel.acf.template.create');
        $routeStore = route('admin.acf.template.store');
        $availableTemplates = $this->getAvailableTemplates();

        return view('admin.acf.template.create', compact('title', 'routeStore', 'availableTemplates'));
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

    public function edit(int $templateId)
    {
        $template = AcfTemplate::query()->findOrFail($templateId);

        $availableTemplates = $this->getAvailableTemplates();
        $title = trans('panel.acf.template.edit');
        $routeUpdate = route('admin.acf.template.update', $template->id);
        $routeDestroy = route('admin.acf.template.destroy', $template->id);

        return view('admin.acf.template.edit', compact('title', 'routeUpdate', 'routeDestroy', 'template', 'availableTemplates'));
    }

    public function manage(int $templateId)
    {
        $template = AcfTemplate::query()
            ->with('fields')
            ->findOrFail($templateId);

        $availableTemplates = $this->getAvailableTemplates();
        $title = trans('panel.acf.template.builder');
        $routeUpdate = route('admin.acf.field.attach', $template->id);

        return view('admin.acf.template.manage', compact('title', 'routeUpdate', 'template', 'availableTemplates'));
    }

    public function update(UpdateRequest $request, int $templateId)
    {
        try {
            $template = AcfTemplate::query()
                ->findOrFail($templateId);

            $item = $this->itemProvider($request);
            $template->update($item);

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

    public function destroy(int $templateId)
    {
        try {

            $template = AcfTemplate::query()
                ->findOrFail($templateId);

            $template->delete();

            return redirect(route('admin.acf.template.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.acf.template.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request): array
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

    public function getAvailableTemplates(): Collection
    {
        $availableTemplates = [];
        $files = File::allFiles(resource_path('/views/admin/acf/template/template'));
        foreach ($files as $file) {
            $availableTemplates[] = [
                'key' => $file->getFilename(),
                'value' => $file->getFilename(),
            ];
        }

        return collect($availableTemplates);
    }
}
