<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('student.dashboard');
    }
    public function viewNotes() {
        $semester = DB::table("semesters")->get();

        return view("student.viewSemester")->with("semesters", $semester);
    }
    public function getSubjects($sem_id) {
        $subjects = DB::table("subjects")
            ->where('sem_id',$sem_id)->get();

        return view("student.viewSubjects")->with("subjects",$subjects);
    }
    
    public function getNotes($sem_id, $sub_id) {
        $notes = DB::table("notes")
            ->join("subjects","subjects.id","notes.subId")
            ->join("staff","staff.id","notes.staffId")
            ->where('subId',$sub_id)
            ->select("subjects.name as subName","notes.*","staff.name as staffName")
            ->get();

        return view("student.viewNotes")->with("notes",$notes);
    }
}
