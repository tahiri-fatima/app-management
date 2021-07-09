<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function traitement()
    {
       // dd($request);
        request()->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        $personnel = Personnel::where('code_personne', request('username'))->first();
        if (!Hash::check(request('password'), $personnel->password)) {
            return back()-> withInput()-> withErrors([
                'password' => 'Vos identifiants sont incorrects.'
            ]);
        }
     //   dd($personnel);
        // success and login manually;
       // auth()->login($personnel);
    
    
    //   flash("Vous êtes maintenant connecté") ->success();

    //Auth()::attempt($request->only('email', 'password'));
    
        return redirect('home');
    
    }

    public function authenticate()
    {
        request()->validate([
            'code_personne' => 'required|string',
            'password' => 'required'
        ]);

    $personnel = Personnel::where('code_personne', request('code_personne'))->first();
    if($personnel !== null){
        if (!Hash::check(request('password'), $personnel->password)) {
            return back()-> withInput()-> withErrors([
                'password' => 'Votre mot de passe est incorrect.'
            ]);
        }

    }else{
        return back()-> withInput()-> withErrors([
            'code_personne' => 'Votre nom d\'utilisateur est incorrect.'
        ]);
    }
        
     
        // success and login manually;
       Auth::login($personnel);
    
     return redirect('home')->withSuccess("Vous êtes maintenant connecté");
    
    }

    
}
