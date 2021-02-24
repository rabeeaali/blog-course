<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();

        Auth::login(User::firstOrCreate(
            ['facebook_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ));

        return redirect('/#');
    }
}
