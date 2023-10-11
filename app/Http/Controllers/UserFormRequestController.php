<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFormRequestResource;
use App\Models\UserFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFormRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = UserFormRequest::with(
            [
                'customer',
                'doc',
                'status'
            ]
        )->get();

        return Inertia::render('Requests/index', ['requests' => $requests]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserFormRequest $userFormRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserFormRequest $userFormRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserFormRequest $userFormRequest)
    {
        //
    }

    /**
     * API
     */

    public function getMyRequests(Request $request)
    {
        $userId = $request->user()->id;

        $userRequests = UserFormRequest::where('user_id', $userId)->orderBy('id', 'desc')->get();

        return UserFormRequestResource::collection($userRequests);
    }
}
