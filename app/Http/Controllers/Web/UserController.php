<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\CompanySeeder;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['department', 'company'])->paginate(50);
        $departments = Department::all();
        $companies = Company::all();
        return view('dashboard.users.index', compact('users','departments','companies'));
    }
}
