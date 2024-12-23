<?php

namespace App\Http\Controllers\Admin;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $administrator;
    public function __construct()
    {
        $this->administrator = app()->make(Administrator::class);
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['administrator_id', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        //ログインページにリダイレクト
        return redirect()->route('admin.login')->with([
            'logout_msg' => 'ログアウトしました',
        ]);
    }
}