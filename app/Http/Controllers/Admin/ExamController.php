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
        $title = trans('panel.exam.index');
        $routeData = route('admin.exam.data');
        $selects = ['id','title','user.email','type','grade', 'created_at'];
        return view('admin.exam.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        try {
            $exams = Exam::query()
                ->with('user')
                ->has('user');

            return DataTables::of($exams)
                ->editColumn('type', function ($exam) {
                    return Helper::renderExamType($exam->type) ;
                })
                ->editColumn('created_at', function ($exam) {
                    return $exam->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($exam) {
                    return Helper::btnMaker(BtnType::Info, route('admin.exam.show', $exam->id), trans('panel.action.info'));
                })
                ->rawColumns(['action','type'])
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function show(Exam $exam)
    {
        $title = trans('panel.exam.show');

        $totalUse = 0;
        $totalRepeat = 0;
        $totalWrong = 0;
        $totalCorrect = 0;
        $totalIKnow = 0;

        $exam->load(['words','user']);

        if ($exam->words->isNotEmpty()){
            $usages = $exam->words;
            $totalUse = $usages->count();
            $totalWrong = $usages->where('pivot.answer',false)->count();
            $totalCorrect =$usages->where('pivot.answer',true)->count();
        }

        return view('admin.exam.show', compact('title', 'exam','totalUse','totalRepeat','totalWrong','totalCorrect','totalIKnow'));
    }

    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            return redirect(route('admin.exam.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);
            return redirect(route('admin.exam.index'))->with('danger', trans('panel.error_delete'));
        }
    }
}
