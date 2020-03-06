<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class StaffLoginController extends Controller
{
    public function showLoginForm()
    {
        return view("staff.login");
    }
    protected function guard(){
        return Auth::guard('staff');
    }
    use AuthenticatesUsers;
    protected $redirectTo = '/staff/dashboard';

    public function __construct()
    {
        $this->middleware('guest:staff')->except('logout');
    }
}
