<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

 
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = DB::table("staff")->count();
        $student = DB::table("users")->count();
        $notes = DB::table("notes")->count();
        $videos = DB::table("videos")->count();
        $subjects = DB::table("subjects")->count();

        return view('admin.dashboard')->with("staff",$staff)->with("student",$student)
            ->with("notes",$notes)->with('videos',$videos)->with('subjects',$subjects);
    }
}
