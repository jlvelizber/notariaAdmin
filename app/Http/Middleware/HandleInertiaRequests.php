<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use App\Models\FormDocType;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'permissions' => [
                    'can_access_roles' => $request->user()?->can('access.roles'),
                    'can_access_users' => $request->user()?->can('access.users'),
                    'can_access_requests' => $request->user()?->can('access.requests'),
                    'can_access_settings' => $request->user()?->can('access.settings'),
                ],
            ],
            'form_types' => FormDocType::select('display_name', 'route_name')->get(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'top_configurations' => Configuration::select('id', 'key', 'label')->whereNull('parent_id')->get(),
        ]);
    }
}
