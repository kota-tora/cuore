<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    protected $contact;
    public function __construct()
    {
        $this->contact = app()->make(Contact::class);
    }

    /**
     * 一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $lists = $this->contact::all()->sortByDesc('contact_id');
        return view('admin.contact.list.index', compact(['lists']));
    }

    /**
     * 詳細
     * @param $contact_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function show($contact_id)
    {
        $contact = $this->contact::find($contact_id);

        if (!$contact) {
            return redirect()->route('admin.contact');
        }

        return view('admin.contact.detail.index', compact(['contact']));
    }

    /**
     * @param $contact_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($contact_id)
    {
        $contact = Contact::find($contact_id);
        if (!$contact) {
            return back()->with(['type' => 'error', 'message' => '問い合わせを削除できませんでした。']);
        }
        $contact->delete();

        return back()->with(['type' => 'success', 'message' => '問い合わせを削除しました。']);
    }
}