<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Exam\StoreRequest;
use App\Http\Requests\Admin\Exam\UpdateRequest;
use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    public function index()
    {
        $title = 'Worder - Exam - List';
        $routeData = route('admin.exam.data');
        $selects = ['id', 'created_at'];
        return view('admin.exam.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $exams = Exam::query();
            return DataTables::of($exams)
                ->editColumn('created_at', function ($exam) {
                    return $exam->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($exam) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.exam.edit', $exam->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.exam.show', $exam->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'Worder - Exam - Create';
        $routeStore = route('admin.exam.store');
        return view('admin.exam.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $exam = new Exam();
            $this->setData($request, $exam);
            $exam->save();
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

    public function edit(Exam $exam)
    {
        $title = 'Worder - Exam - Edit';
        $routeUpdate = route('admin.exam.update', $exam->id);
        $routeDestroy = route('admin.exam.destroy', $exam->id);
        return view('admin.exam.edit', compact('title', 'routeUpdate','routeDestroy', 'exam'));
    }

    public function show(Exam $exam)
    {
        $title = 'Worder - Exam - Show';
        return view('admin.exam.show', compact('title', 'exam'));
    }

    public function update(UpdateRequest $request, Exam $exam)
    {
        try {
            $this->setData($request, $exam);

            $exam->update();
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

    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            return redirect(route('admin.exam.index'))->with('success', 'با موفقیت حذف شد.');
        } catch (Exception $e) {
            return redirect(route('admin.exam.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }

    /**
     * @param Request $request
     * @param Exam $exam
     */
    protected function setData(Request $request, Exam $exam): void
    {
        $exam->title = $request->get('title');
    }
}
