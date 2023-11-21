<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserFormRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $totalCustomer =  $this->getTotalCustomers();
        $totalUsers = $this->getTotalUsers();
        $totalRequests = $this->totalRequests();
        return Inertia::render('Dashboard', compact('totalCustomer','totalUsers', 'totalRequests'));
    }

    /**
     * Get total customers
     *
     * @return integer
     */
    private function getTotalCustomers(): int
    {
        $customerRole = Role::where('name', Role::DEFAULT_ROLE)->first()->id;

        $countCustomers = User::whereRelation('roles', 'role_id', $customerRole)->count();
        return $countCustomers;
    }
    /**
     * Get total users indistict customers
     *
     * @return integer
     */
    private function getTotalUsers(): int
    {
        $userRole = Role::where('name', '!=', Role::DEFAULT_ROLE)->first()->id;

        $countUsers = User::whereRelation('roles', 'role_id', $userRole)->count();
        return $countUsers;
    }

    private function totalRequests(): int
    {
        $begindMonthDate = (new Carbon())->startOfMonth();
        $endMonthDate = (new Carbon())->endOfMonth();
        return UserFormRequest::where('created_at','>=',$begindMonthDate)->where('created_at','<=', $endMonthDate)->count();
    }
}
