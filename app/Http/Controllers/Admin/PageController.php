<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StoreRequest;
use App\Http\Requests\Admin\Page\UpdateRequest;
use App\Models\AcfConnect;
use App\Models\AcfTemplate;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {
        $title = trans('panel.page.index');
        $routeData = route('admin.page.data');
        $selects = ['id', 'title', 'created_at'];

        return view('admin.page.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $pages = Page::query();

            return DataTables::of($pages)
                ->editColumn('created_at', function ($page) {
                    return $page->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($page) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.page.edit', $page->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.page.show', $page->id), trans('panel.action.info'));

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
        $title = trans('panel.page.create');
        $routeStore = route('admin.page.store');

        $acfTemplates = AcfTemplate::query()->get();

        return view('admin.page.create', compact('title', 'routeStore', 'acfTemplates'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            $page = Page::create($item);
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

    public function edit(Page $page)
    {
        $page->load('acfTemplates');
        $oldsTemplate = [];
        if ($page->acfTemplates->isNotEmpty()) {
            $oldsTemplate = $page->acfTemplates->pluck('id')->toArray();
        }
        $title = trans('panel.page.edit');
        $routeUpdate = route('admin.page.update', $page->id);
        $routeDestroy = route('admin.page.destroy', $page->id);
        $acfTemplates = AcfTemplate::query()->get();

        return view('admin.page.edit', compact('title', 'routeUpdate', 'routeDestroy', 'page', 'acfTemplates', 'oldsTemplate'));
    }

    public function update(UpdateRequest $request, Page $page)
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

    public function destroy(Page $page)
    {
        try {
            $page->delete();

            return redirect(route('admin.page.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.page.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    public function show(Page $page)
    {
        $title = trans('panel.page.show');

        return view('admin.page.show', compact('title', 'page'));
    }

    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['title'] = $request->get('title');
        $item['description'] = $request->get('description');
        $item['type'] = $request->get('type');
        $item['icon'] = $request->get('icon');

        return $item;
    }

    public function syncTemplate(Request $request, Page $page): void
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
