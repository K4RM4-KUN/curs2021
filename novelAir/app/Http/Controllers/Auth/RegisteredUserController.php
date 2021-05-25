<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\User_Role;
use App\Models\Author;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'accept' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user = auth()->user();

        $newProfile = new Profile;
        $newProfile->SetAttribute('user_id',$user->id);
        $newProfile->save();

        $newRole = new User_Role;
        $newRole->SetAttribute('user_id',$user->id);
        $newRole->SetAttribute('role_id',1);
        $newRole->save();

        $newAuthor = new Author;
        $newAuthor->SetAttribute('user_id',$user->id);
        $newAuthor->SetAttribute('subscriptions',1);
        $newAuthor->SetAttribute('donations',0); 
        $newAuthor->save();

        $path = public_path() ."/users/". $user->id;
        File::makeDirectory($path , $mode = 0775, true);
        File::makeDirectory($path."/novels" , $mode = 0775, true);
        File::makeDirectory($path."/profile" , $mode = 0775, true);
        return redirect(RouteServiceProvider::HOME);
    }
}
