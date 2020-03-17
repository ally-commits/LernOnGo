<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
use App\StudentNotes;
use App\MCQ;
use Redirect;
use DB;
use Hash;

class MCQController extends Controller
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
        $data = DB::table("m_c_q_s")
                ->join("semesters","semesters.id","m_c_q_s.semId")
                ->join("subjects","subjects.id","m_c_q_s.subjectId")
                ->select("semesters.sem_name","subjects.name as sub_name","m_c_q_s.*")
                ->where("staffId",Auth::user()->id)
                ->get(); 
        return view("staff.mcq.viewMcq")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $subjects = DB::table("subjects")->get();
        return view("staff.mcq.addMcq")->with("subjects", $subjects);      ;
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
            'subject' => ['required', 'string'],  
            'name' => ['required','string'], 
        ]);  
        $semester = Semester::find($data['subject']); 
        MCQ::create([
            'id' => uniqid(),
            'name' => $data['name'], 
            'subjectId' => $data['subject'],
            'semId' => $semester->id,
            'staffId' => Auth::user()->id
        ]);
        return Redirect::route('mcq.index')->with('message', 'MCQ Added Succesfully');
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
        $data = DB::table("m_c_q_s")
                ->join("semesters","semesters.id","m_c_q_s.semId")
                ->join("subjects","subjects.id","m_c_q_s.subjectId")
                ->select("semesters.sem_name","subjects.name as sub_name","m_c_q_s.*")
                ->where("m_c_q_s.id",$id)
                ->get(); 
        $subjects = DB::table("subjects")->get();
        return view("staff.mcq.editMcq")->with("data",$data)->with("subjects", $subjects);      ;;
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
            'subject' => ['required','string'] 
        ]); 
        $semester = Semester::find($data['subject']);
        DB::table("m_c_q_s")
            ->where("id",$id)
            ->update(['name' => $data['name'], 
            'subjectId' => $data['subject'],
            'semId' => $semester->id]);
        return Redirect::route('mcq.index')->with('message', 'MCQ Updated Succesfully');
    }
    public function publish($id) {
        DB::table("m_c_q_s")->where("id", $id)->update(['publish' => true]);
        return Redirect::route('mcq.index')->with('message', 'MCQ Deleted Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $notes = MCQ::find($id);
        $notes->delete();

        return Redirect::route('mcq.index')->with('message', 'MCQ Deleted Succesfully');
    } 
    public function showResult($mcqId) {
        $data = DB::table("student_answers")
                ->join("users","users.id","student_answers.studentId")
                ->select("users.email","users.name","student_answers.*")
                ->where("student_answers.mcqId",$mcqId)
                ->get();
        $mcq = MCQ::find($mcqId);
        return view("staff.mcq.viewResult")->with("data",$data)->with("mcq",$mcq);
    }
}

