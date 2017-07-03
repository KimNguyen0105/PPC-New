<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;

class ContactController extends Controller
{
    //
    public function Home()
    {
        if (Auth::check()) {
            $contact = Contact::where('status', '<>', -1)->orderBy('updated_at', 'desc')->get();
            return view('admin.contact.home', ['contact' => $contact]);
        } else {
            return redirect('admin/log-in');
        }

    }

    public function GetContact($id)
    {
        if (Auth::check()) {
            $contact = Contact::find($id);
            return view('admin.contact.detail', ['contact' => $contact]);
        } else {
            return redirect('admin/log-in');
        }
    }
    public function DeleteContact($id)
    {
        if (Auth::check()) {
            try {
                $contact = Contact::find($id);
                $contact->status = -1;
                    if ($contact->save()) {
                        return redirect('admin/contact')->with('thongbao', 'Cập nhật thành công!');
                    } else {
                        return redirect('admin/contact')->with('thatbai', 'Cập nhật thất bại!');
                    }

            } catch (\Exception $e) {
                return redirect('admin/contact')->with('thatbai', 'Cập nhật thất bại!');
            }
        } else {
            return redirect('admin/log-in');
        }
    }

}