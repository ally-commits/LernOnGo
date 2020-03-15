<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\RegisterEvent;
use Auth;
use Redirect;
use App\StudentNotes;

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

        return view("student.notes.viewSemester")->with("semesters", $semester);
    }
    public function getSubjects($sem_id) {
        $subjects = DB::table("subjects")
            ->where('sem_id',$sem_id)->get();

        return view("student.notes.viewSubjects")->with("subjects",$subjects);
    }
    
    public function getNotes($sem_id, $sub_id) {
        $notes = DB::table("notes")
            ->join("subjects","subjects.id","notes.subId")
            ->join("staff","staff.id","notes.staffId")
            ->where('subId',$sub_id)
            ->select("subjects.name as subName","notes.*","staff.name as staffName")
            ->get();

        return view("student.notes.viewNotes")->with("notes",$notes);
    }
    public function viewSemVideos() {
        $semester = DB::table("semesters")->get();

        return view("student.videos.viewSemester")->with("semesters", $semester);
    }
    public function viewSubVideos($sem_id) {
        $subjects = DB::table("subjects")
            ->where('sem_id',$sem_id)->get();

        return view("student.videos.viewSubjects")->with("subjects",$subjects);
    }
    
    public function getVideos($sem_id, $sub_id) {
        $videos = DB::table("videos")
            ->join("subjects","subjects.id","videos.subId")
            ->join("staff","staff.id","videos.staffId")
            ->where('subId',$sub_id)
            ->select("subjects.name as subName","videos.*","staff.name as staffName")
            ->get();

        return view("student.videos.viewVideos")->with("videos",$videos);
    }
    public function viewSemAssignment() {
        $semester = DB::table("semesters")->get();

        return view("student.assignment.viewSemester")->with("semesters", $semester);
    }
    public function viewSubAssignment($sem_id) {
        $subjects = DB::table("subjects")
            ->where('sem_id',$sem_id)->get();

        return view("student.assignment.viewSubjects")->with("subjects",$subjects);
    }
    
    public function getAssignment($sem_id, $sub_id) {
        $assignments = DB::table("assignments")
            ->join("subjects","subjects.id","assignments.subId")
            ->join("staff","staff.id","assignments.staffId")
            ->where('subId',$sub_id)
            ->select("subjects.name as subName","assignments.*","staff.name as staffName")
            ->get(); 
        foreach($assignments as $d) {
            $attended = DB::table("assignment_answers")->where('assignmentId',$d->id)
                        ->where("studentId", Auth::user()->id)->get();
            if(count($attended) == 0)
                $d->active = true;
            else 
                $d->active = false;
        } 
        return view("student.assignment.viewAssignment")->with("assignments",$assignments);
    }
    public function viewScholarship() {
        $data = DB::table("scholarships")->latest()->get();

        return view("student.scholarship")->with("data",$data);
    }
    public function viewEvents() {
        $data = DB::table("events")->latest()->get();
        $present = DB::table("register_events")->where("studentId", Auth::user()->id)->get();
        foreach($data as $d) {
            $register = DB::table("register_events")->where('eventId',$d->id)
                        ->where("studentId", Auth::user()->id)->get();
            if(count($register) == 0)
                $d->active = true;
            else 
                $d->active = false;
        } 
        return view("student.events")->with("data",$data);
    }

    public function registerEvent($id) {
        RegisterEvent::create([
            'studentId' => Auth::user()->id,
            'eventId' => $id
        ]);
        return Redirect::route('viewEvents')->with('message', 'Registred Succesfully');
    }

    public function sendNotes() {
        $staff = DB::table("staff")->get();
        $subject = DB::table("subjects")->get();

        return view("student.sendData")->with("staff",$staff)->with('subject',$subject);
    }
    public function uploadNotes(Request $request) {
        $data = $request->all();
        $request->validate([  
            'name' => ['required', 'string'],
            'file' => ['required'], 
        ]);  
        $file = $request->file('file');
        $fileName = time().'.'.$data['file']->getClientOriginalExtension();
        $file->move('files/', $fileName); 

        StudentNotes::create([
            'studentId' => Auth::user()->id,
            'name' => $data['name'],
            'staffId' => $data['staffId'],
            'subjectId' => $data['subId'],
            'file' =>  'files/'.$fileName,
        ]);

        return Redirect::route("viewSentNote")->with("message", "Notes Added Succesfully");
    }
    public function viewSentNotes() {
        $data = DB::table("student_notes")
            ->join("staff","student_notes.staffId","staff.id")
            ->join("subjects","student_notes.subjectId","subjects.id")
            ->select("subjects.name as subName","staff.name as sName","student_notes.*")
            ->where("studentId",Auth::user()->id)->get();

        return view("student.viewData")->with('data',$data);
    }
    public function delNotes($id) {
        $data = StudentNotes::find($id);
        $data->delete();

        return Redirect::route("viewSentNotes")->with("message", "Notes Deleted Succesfully");
    }
}

