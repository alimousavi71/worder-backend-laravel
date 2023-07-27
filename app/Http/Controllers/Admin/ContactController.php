<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        $title = trans('panel.contact.index');
        $routeData = route('admin.contact.data');
        $selects = ['id','user.email','rate','is_seen','is_public', 'created_at'];
        return view('admin.contact.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        try {
            $contacts = Contact::query()
                ->has('user')
                ->with('user');

            return DataTables::of($contacts)
                ->editColumn('created_at', function ($contact) {
                    return $contact->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($contact) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.contact.edit', $contact->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.contact.show', $contact->id), trans('panel.action.info'));
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Contact $contact)
    {
        $title = trans('panel.contact.edit');
        $routeUpdate = route('admin.contact.update', $contact->id);
        $routeDestroy = route('admin.contact.destroy', $contact->id);
        return view('admin.contact.edit', compact('title', 'routeUpdate', 'routeDestroy', 'contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        try {
            $contact->update([
                'is_public' => $request->has('is_public')
            ]);
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update')
            ]);
        } catch (Exception $e) {
            report($e);
            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_update')
            ], 500);
        }
    }

    public function show(Contact $contact)
    {
        $title = trans('panel.contact.show');
        $contact->update([
            'is_seen' => true
        ]);
        $routeDestroy = route('admin.contact.destroy',$contact->id);
        return view('admin.contact.show', compact('title', 'contact','routeDestroy'));
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            return redirect(route('admin.contact.index'))->with('success', 'با موفقیت حذف شد.');
        } catch (Exception $e) {
            report($e);
            return redirect(route('admin.contact.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }
}
