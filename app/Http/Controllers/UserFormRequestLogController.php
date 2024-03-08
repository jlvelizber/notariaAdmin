<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFormRequestLogResource;
use App\Models\UserFormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFormRequestLogController extends Controller
{
    /**
     * Show logs from UserFormRequestForm
     *
     * @return void
     */
    public function index(UserFormRequest $userFormRequest): JsonResource
    {


        $history = $userFormRequest->logs()->with('user')->orderBy('created_at','desc')->get();
        return UserFormRequestLogResource::collection($history);
    }
}
