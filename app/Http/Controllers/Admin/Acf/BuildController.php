<?php

namespace App\Http\Controllers\Admin\Acf;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acf\Build\StoreRequest;
use App\Http\Requests\Admin\Acf\Build\UpdateRequest;
use App\Models\AcfBuild;
use App\Models\AcfConnect;
use App\Models\AcfTemplate;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BuildController extends Controller
{
    public function index()
    {
        $title = trans('panel.acf.build.index');
        $routeData = route('admin.acf.build.data');
        $selects = ['id', 'title', 'created_at'];

        return view('admin.acf.build.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $pages = AcfBuild::query();

            return DataTables::of($pages)
                ->editColumn('created_at', function ($page) {
                    return $page->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($page) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.acf.build.edit', $page->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Success, route('admin.builder', ['page', $page->id]), trans('panel.action.builder'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.acf.build.show', $page->id), trans('panel.action.show'));

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
        $title = trans('panel.acf.build.create');
        $routeStore = route('admin.acf.build.store');

        $acfTemplates = AcfTemplate::query()->get();

        return view('admin.acf.build.create', compact('title', 'routeStore', 'acfTemplates'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            $page = AcfBuild::query()->create($item);
            $this->syncTemplate($request, $page);

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_store'),
                'err' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(AcfBuild $page)
    {
        $title = trans('panel.acf.build.edit');
        $routeUpdate = route('admin.acf.build.update', $page->id);
        $routeDestroy = route('admin.acf.build.destroy', $page->id);

        return view('admin.acf.build.edit', compact('title', 'routeUpdate', 'routeDestroy', 'page'));
    }

    public function update(UpdateRequest $request, AcfBuild $page)
    {
        try {
            $item = $this->itemProvider($request);
            $page->update($item);
            $this->syncTemplate($request, $page);

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

    public function destroy(AcfBuild $page)
    {
        try {
            $page->delete();

            return redirect(route('admin.acf.build.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.acf.build.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['title'] = $request->get('title');
        $item['description'] = $request->get('description');
        $item['type'] = $request->get('type');
        $item['icon'] = $request->get('icon');

        return $item;
    }

    public function syncTemplate(Request $request, AcfBuild $page): void
    {
        if (count($request->get('templates', []))) {
            $page->acfConnects()->delete();
            foreach ($request->get('templates') as $templateId) {
                $template = new AcfConnect([
                    'acf_template_id' => $templateId,
                ]);
                $page->acfConnects()->save($template);
            }
        }
    }
}
