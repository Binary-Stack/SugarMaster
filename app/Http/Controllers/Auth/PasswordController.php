<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
   
    
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' =>   'required|confirmed|min:8',
        ]);
    
        $user = \App\Models\User::find(Auth::id());
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }
    
        $user->password = Hash::make($request->password);
        $user->save(); 
    
        return back()->with('success', 'تم تحديث كلمة المرور بنجاح!');
    }
    
}
