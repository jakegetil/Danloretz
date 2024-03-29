<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $users = User::leftjoin('storebranch','storebranch.id','=','users.store')
                            ->where('users.email',$request->email)
                            ->select('users.*','storebranch.storename')
                            ->first();

            session([
                'user_id' => $users->id,
                'name' => $users->firstname.' '.$users->lastname,
                'email' => $users->email,
                'role' => $users->role,
                'store' => $users->store,
                'storename' => $users->storename,
            ]);
            // dd(session('name'));

            return redirect()->intended('dashboard');
        }
        

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    
}
