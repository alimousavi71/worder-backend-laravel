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
            $builds = AcfBuild::query();

            return DataTables::of($builds)
                ->editColumn('created_at', function ($build) {
                    return $build->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($build) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.acf.build.edit', $build->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Success, route('admin.acf.builder', $build->id), trans('panel.action.builder'));

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
            $build = AcfBuild::query()->create($item);
            $this->syncTemplate($request, $build);

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

    public function edit(AcfBuild $build)
    {
        $title = trans('panel.acf.build.edit');
        $routeUpdate = route('admin.acf.build.update', $build->id);
        $routeDestroy = route('admin.acf.build.destroy', $build->id);

        return view('admin.acf.build.edit', compact('title', 'routeUpdate', 'routeDestroy', 'build'));
    }

    public function update(UpdateRequest $request, AcfBuild $build)
    {
        try {
            $item = $this->itemProvider($request);
            $build->update($item);
            $this->syncTemplate($request, $build);

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

    public function destroy(AcfBuild $build)
    {
        try {
            $build->delete();

            return redirect(route('admin.acf.build.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.acf.build.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request): array
    {
        $item['title'] = $request->get('title');
        $item['type'] = $request->get('type');
        $item['icon'] = $request->get('icon');

        return $item;
    }

    public function syncTemplate(Request $request, AcfBuild $build): void
    {
        if (count($request->get('templates', []))) {
            $build->acfConnects()->delete();
            foreach ($request->get('templates') as $templateId) {
                $template = new AcfConnect([
                    'acf_template_id' => $templateId,
                ]);
                $build->acfConnects()->save($template);
            }
        }
    }
}
