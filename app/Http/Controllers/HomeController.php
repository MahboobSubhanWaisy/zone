<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    protected function changePassword()
    {
        return view('changePassword');
    }

    protected function updatePassword(Request $request)
    {
        $validate = $request->validate(
            [
                'old-pass' => ['required', 'min:8'],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'old-pass.min' => 'رمز گذشته کمتر از ۸ نباشد',
                'old-pass.required' => 'رمز گذشته را وارد نماید',
                'password.min' => 'رمز جدید کمتر از ۸ نباشد',
                'password.required' => 'رمز جدید را وارد نماید',
                'password.confirmed' => 'رمز جدید با تایید رمز یکسان نمی باشد',
            ]
        );

        if (Hash::check($request->input('old-pass'), Auth::user()->password)) {
            $update = User::findOrFail(Auth::user()->id);
            $update->password = Hash::make($request->password);
            $update->save();
            return back()->with('password-updated', 'تغییرات موفقانه اجرا گردید!');
        } else {
            echo 'check password';
        }
    }
}
