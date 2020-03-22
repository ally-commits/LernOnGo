<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
use App\Assignment;
use App\AssignmentAnswer;
use App\User;
use App\Subjects;
use Redirect;
use DB;
use Hash;

class StaffAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    public function index()
    {
        $data = DB::table("assignments")
                ->join("semesters","semesters.id","assignments.semId")
                ->join("subjects","subjects.id","assignments.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","assignments.*")
                ->where("staffId",Auth::user()->id)
                ->get(); 
        return view("staff.assignment.viewAssignment")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubmissions($id) {
        $data = DB::table("assignment_answers")
            ->join("users","assignment_answers.studentId","users.id")
            ->select("users.name",'users.email','assignment_answers.*')
            ->where('assignmentId',$id)
            ->get();
        $assign = Assignment::find($id);
        return view("staff.assignment.viewAssignmentSubmission")->with("data", $data)->with("assign", $assign);
    }
    public function getAnswer($id) {
        $data = AssignmentAnswer::find($id);
        $user = User::find($data->studentId);

        return view("staff.assignment.viewAnswer")->with("data", $data)->with("user", $user);
    }
    public function create()
    { 
        $subjectId = DB::table("subject_managers")
            ->where("staffId","=",Auth::user()->id)
            ->pluck("subjectId")
            ->all(); 
        $subjects = Subjects::whereIn("id", $subjectId)->get();  
        return view("staff.assignment.addAssignment")->with("subjects", $subjects);      ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string'],  
            'question' => ['required','string'], 
        ]);  
        $subject = Subjects::find($data['subject']); 
        $semester = Semester::find($subject->sem_id);

        Assignment::create([
            'name' => $data['name'],
            'question' =>  $data['question'],
            'subId' => $data['subject'],
            'semId' => $semester->id,
            'staffId' => Auth::user()->id
        ]);
        return Redirect::route('assignment.index')->with('message', 'Assignment Added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $data = DB::table("assignments")
                ->join("semesters","semesters.id","assignments.semId")
                ->join("subjects","subjects.id","assignments.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","assignments.*")
                ->where("assignments.id",$id)
                ->get(); 
        $subjectId = DB::table("subject_managers")
            ->where("staffId","=",Auth::user()->id)
            ->pluck("subjectId")
            ->all(); 
        $subjects = Subjects::whereIn("id", $subjectId)->get();  
        return view("staff.assignment.editAssignment")->with("assignment",$data)->with("subjects", $subjects);      ;;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string'],  
            'question' => ['required','string'] 
        ]); 
        $subject = Subjects::find($data['subject']); 
        $semester = Semester::find($subject->sem_id);
        DB::table("assignments")
            ->where("id",$id)
            ->update(['name' => $data['name'], 'question' => $data['question'],
            'subId' => $data['subject'],
            'semId' => $semester->id]);
        return Redirect::route('assignment.index')->with('message', 'Assignment Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $assignment = Assignment::find($id);
        $assignment->delete();

        return Redirect::route('assignment.index')->with('message', 'Assignment Deleted Succesfully');
    }
}
