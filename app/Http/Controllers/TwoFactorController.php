<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Notifications\SendTwoFactorCode;

class TwoFactorController extends Controller
{
    public function index(): View
    {
        return view('auth.twoFactor');
    }

    public function store(Request $request): ValidationException|RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['integer', 'required'],
        ]);   

        $user = auth()->user();

        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            throw ValidationException::withMessages([
                'two_factor_code' => __('The two factor code you have entered does not match'),
            ]);
        }

        $user->resetTwoFactorCode();

        return redirect()->intended(route('dashboard', absolute: false));

    }

    public function resend(): RedirectResponse
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode());
 
        return redirect()->back()->withStatus(__('The two factor code has been sent again'));
    }
}
