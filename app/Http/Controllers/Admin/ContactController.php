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
        $title = 'لیست تماس ها';
        $routeData = route('admin.contact.data');
        $selects = ['id','email','is_seen', 'created_at'];
        return view('admin.contact.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $contacts = Contact::query();
            return DataTables::of($contacts)
                ->editColumn('created_at', function ($contact) {
                    return $contact->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($contact) {
                    return Helper::btnMaker(BtnType::Info, route('admin.contact.show', $contact->id), 'اطلاعات');
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Contact $contact)
    {
        $title = 'نمایش تماس';
        $contact->update([
            'is_seen' => true
        ]);
        return view('admin.contact.show', compact('title', 'contact'));
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
