<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'identification_num' => 'required|string|unique:' . User::class,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'midle_name' => 'string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }


    private function createUser(Request $request): Model
    {
        return User::create([
            'identification_type' => $request->identification_type,
            'identification_num' => $request->identification_num,
            'name' => $request->name,
            'midle_name' => $request->midle_name,
            'first_last_name' => $request->first_last_name,
            'second_last_name' => $request->second_last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country_id
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $this->validateRequest($request);

        $user = $this->createUser($request);

      
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * Handle an incoming registration request from API
     */
    function registerApi(Request $request): JsonResponse
    {

        $tokenName = config('sanctum.token_name');

        $this->validateRequest($request);

        $user = $this->createUser($request);

          // Le da el rol d clinte 
          $user->roles()->sync([getDefaultRole()]);


        event(new Registered($user));

        Auth::login($user);

        return response()->json(['token' => $user->createToken($tokenName)]);
    }
}
