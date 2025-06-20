<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Auth\PasswordRequest;

class AuthController extends Controller
{
    public function locked()
    {
        return view('auth.lockscreen');
    }

    public function lock(Request $request)
    {
        session(['lockscreen-status' => 'YES', 'lockscreen-url' => url()->previous()]);
        
        return $request->ajax() 
            ? response()->json(['status' => 'success']) 
            : back();
    }

    public function unlock(PasswordRequest $request)
    { 
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->withErrors(['password' => 'Your credentials do not match.']);
        }

        $url = session()->get('lockscreen-url');
        session()->forget(['lockscreen-status', 'lockscreen-url']);
        session()->flash('info-circle', ['title' => 'Welcome back, '.ucwords(strtok(auth()->user()->name, ' ')), 'msg' => 'You are now logged in.', 'icon' => "<i class='pg-icon'>user</i>"]);
        
        return $url != null 
            ? redirect($url) 
            : redirect()->route('dash.index');
    }

    public function secretLogout()
    {     
        session()->forget(['lockscreen-status', 'lockscreen-url']);
        Auth::logout();
        
        return redirect()->route('login');
    }
}
