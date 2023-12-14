<?php

namespace App\Http\Controllers;

use App\Models\UserFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserFormRequestLogController extends Controller
{
    /**
     * Show logs from UserFormRequestForm
     *
     * @return void
     */
    public function index(UserFormRequest $userFormRequest): Response
    {


        $history = $userFormRequest->logs()->with('user')->get();
        return Inertia::render('Requests/HistoryLog', ['history' => $history, 'docName' => $userFormRequest->doc->name, 'routeName' => $userFormRequest->doc->category->route_name]);
    }
}
