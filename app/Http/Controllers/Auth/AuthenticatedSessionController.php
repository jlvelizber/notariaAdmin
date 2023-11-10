<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function storeApi(LoginRequest $request): JsonResponse
    {
        $tokenName = config('sanctum.token_name');

        $inWebPage = true;

        $request->authenticate($inWebPage);

        return response()->json(['token' => $request->user()->createToken($tokenName)]);
    }



    public function updateUserApi(Request $request)
    {
        $dataUpdate = $request->except(['password', 'email']);
        $userInSession = $request->user();

        $userInSession->fill($dataUpdate);
        $userInSession->update();

        $tokenName = config('sanctum.token_name');

        return response()->json(['token' => $request->user()->createToken($tokenName)]);
    }

    /**
     * Verifica la cuenta de usuario que llega desde la pagina web
     * actualiza el campo verified_at en la tabla de ususarios y envia notificacion
     * @param Request $request
     * @return void
     */
    public function verifyApiAccount(Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response()->json(['successMessage' => 'Su cuenta ya ha sido verificada']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return response()->json(['successMessage' => 'Su cuenta ha sido verificada exitosamente']);
        }

        return response()->json(['message' => 'La cuenta no pudo ser verificada'], 422);
    }
}
