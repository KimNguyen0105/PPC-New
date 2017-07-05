<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Contacts_form;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    public function Home()
    {
        if (session('user_admin')) {
            $contact = Contact::where('status', '<>', -1)->orderBy('updated_at', 'desc')->paginate(10);;
            return view('admin.contact.home', ['contact' => $contact]);
        } else {
            return redirect('admin/log-in');
        }

    }

    public function GetContact($id)
    {
        if (session('user_admin')) {
            $contact = Contact::find($id);
            return view('admin.contact.detail', ['contact' => $contact]);
        } else {
            return redirect('admin/log-in');
        }
    }
    public function SaveContact(Request $request)
    {
        if (session('user_admin')) {
            try {
                $id=$request->txtid;
                $status=$request->status;
                $contact = Contact::find($id);
                $contact->status = $status;
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
    public function DeleteContact($id)
    {
        if (session('user_admin')) {
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
    public function ContactForm($type)
    {
        if (session('user_admin')) {
            $contact=DB::table('news')
                ->join('news_lang','news.id','=','news_lang.new_id')
                ->join('contacts_form','news.id','=','contacts_form.id_type')
                ->where('contacts_form.status','<>',-1)
                ->where('contacts_form.type',$type)
                ->where('news_lang.lang','vi')
                ->select('contacts_form.*','news_lang.title')
                ->orderBy('contacts_form.updated_at', 'desc')
                ->paginate(10);
            return view('admin.contact.contact_news', ['contact' => $contact,'type'=>$type]);
        } else {
            return redirect('admin/log-in');
        }

    }

    public function GetContactForm($type,$id)
    {
        if (session('user_admin')) {
            $contact = $contact=DB::table('news')
                ->join('news_lang','news.id','=','news_lang.new_id')
                ->join('contacts_form','news.id','=','contacts_form.id_type')
                ->where('contacts_form.status','<>',-1)
                ->where('contacts_form.type',$type)
                ->where('news_lang.lang','vi')
                ->where('contacts_form.id',$id)
                ->select('contacts_form.*','news_lang.title')->first();
            return view('admin.contact.detail_news', ['contact' => $contact]);
        } else {
            return redirect('admin/log-in');
        }
    }
    public function SaveContactForm($type,Request $request)
    {
        if (session('user_admin')) {
            try {
                $id=$request->txtid;
                $status=$request->status;
                $contact = Contacts_form::find($id);
                $contact->status = $status;
                if ($contact->save()) {
                    return redirect('admin/contact-form/'.$type)->with('thongbao', 'Cập nhật thành công!');
                } else {
                    return redirect('admin/contact-form/'.$type)->with('thatbai', 'Cập nhật thất bại!');
                }

            } catch (\Exception $e) {
                return redirect('admin/contact-form/'.$type)->with('thatbai', 'Cập nhật thất bại!');
            }
        } else {
            return redirect('admin/log-in');
        }
    }
    public function DeleteContactForm($type,$id)
    {
        if (session('user_admin')) {
            try {
                $contact = Contacts_form::find($id);
                $contact->status = -1;
                if ($contact->save()) {
                    return redirect('admin/contact-form/'.$type)->with('thongbao', 'Cập nhật thành công!');
                } else {
                    return redirect('admin/contact-form/'.$type)->with('thatbai', 'Cập nhật thất bại!');
                }

            } catch (\Exception $e) {
                return redirect('admin/contact-form/'.$type)->with('thatbai', 'Cập nhật thất bại!');
            }
        } else {
            return redirect('admin/log-in');
        }
    }
}