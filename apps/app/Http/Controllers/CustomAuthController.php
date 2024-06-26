<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            if($user->role == 'customer') {
                return redirect()->intended('/')->withSuccess('Signed in');
            }

            return redirect()->intended('/dashboard')->withSuccess('Signed in');
        }
  
        return redirect("login")->with('error','Incorrect credentials');
    }

    public function registration()
    {
        return view('auth.register');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        // dd($check);
         
        return redirect("/login")->withSuccess('Success register');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role'  => 'customer',
        'phone' => $data['phone']
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('/');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function notFound()
    {
        return view('auth.404');
    }

    public function notFoundAdmin()
    {
        return view('admin.404');
    }
}
