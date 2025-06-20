<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Ecommerce\Customer;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function showSetPasswordForm()
    {
        return view('auth.passwords.set');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'  => 'required',
            'password'      => 'required|confirmed|min:6',
        ]);

        if (!$validator->fails()) {
            $user = Customer::findOrFail(auth()->user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                if ($user->save()) {
                    return redirect()->route('profile')->with('success-notify', 'Your password has been updated.');
                }

                return redirect()->back()->with('error-notify', 'Sorry, could not updated your password at this time. Please try again later.');
            }
            $validator->getMessageBag()->add('old_password', 'Invalid Password.');
        }

        return redirect()->back()->withErrors($validator);
    }


    public function storePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'      => 'required|confirmed|min:6',
        ]);

        if (!$validator->fails()) {
            $user = Customer::findOrFail(auth()->user()->id);
            $user->password = Hash::make($request->password);
            $user->is_social_only = 0;
            if ($user->save()) {
                return redirect()->route('profile')->with('success-notify', 'Your password has been updated.');
            }

            return redirect()->back()->with('error-notify', 'Sorry, could not save your password at this time. Please try again later.');
        }

        return redirect()->back()->withErrors($validator);
    }
}
