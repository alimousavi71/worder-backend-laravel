<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sentence\StoreRequest;
use App\Http\Requests\Admin\Sentence\UpdateRequest;
use App\Models\Sentence;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SentenceController extends Controller
{
    public function index()
    {
        $title = 'Worder - Sentence - List';
        $routeData = route('admin.sentence.data');
        $selects = ['id', 'created_at'];
        return view('admin.sentence.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $sentences = Sentence::query();
            return DataTables::of($sentences)
                ->editColumn('created_at', function ($sentence) {
                    return $sentence->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($sentence) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.sentence.edit', $sentence->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.sentence.show', $sentence->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'Worder - Sentence - Create';
        $routeStore = route('admin.sentence.store');
        return view('admin.sentence.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $sentence = new Sentence();
            $this->setData($request, $sentence);
            $sentence->save();
            return response()->json([
                'result' => 'success',
                'message' => 'با موفقیت ایجاد شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit(Sentence $sentence)
    {
        $title = 'Worder - Sentence - Edit';
        $routeUpdate = route('admin.sentence.update', $sentence->id);
        $routeDestroy = route('admin.sentence.destroy', $sentence->id);
        return view('admin.sentence.edit', compact('title', 'routeUpdate','routeDestroy', 'sentence'));
    }

    public function show(Sentence $sentence)
    {
        $title = 'Worder - Sentence - Show';
        return view('admin.sentence.show', compact('title', 'sentence'));
    }

    public function update(UpdateRequest $request, Sentence $sentence)
    {
        try {
            $this->setData($request, $sentence);

            $sentence->update();
            return response()->json([
                'result' => 'success',
                'message' => 'با موفقیت به روز رسانی شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function destroy(Sentence $sentence)
    {
        try {
            $sentence->delete();
            return redirect(route('admin.sentence.index'))->with('success', 'با موفقیت حذف شد.');
        } catch (Exception $e) {
            return redirect(route('admin.sentence.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }

    /**
     * @param Request $request
     * @param Sentence $sentence
     */
    protected function setData(Request $request, Sentence $sentence): void
    {
        $sentence->title = $request->get('title');
    }
}
