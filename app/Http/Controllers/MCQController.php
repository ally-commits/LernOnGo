<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
use App\StudentNotes;
use App\MCQ;
use App\Subjects;
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
                ->select("semesters.sem_name","subjects.name as sub_name","subjects.id as subId","m_c_q_s.*")
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
        $subjectId = DB::table("subject_managers")
            ->where("staffId","=",Auth::user()->id)
            ->pluck("subjectId")
            ->all(); 
        $subjects = Subjects::whereIn("id", $subjectId)->get();  

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
        $mcq = DB::table("m_c_q_s")->where("subjectId", $data['subject'])->get();
        $subject = Subjects::find($data['subject']); 
        if(count($mcq) == 2) {
            return Redirect::route('mcq.index')->with('message', $subject->name . ' Subject already has 2 MCQS');
        } else {
            $semester = Semester::find($subject->sem_id);
                
            MCQ::create([
                'id' => uniqid(),
                'name' => $data['name'], 
                'subjectId' => $data['subject'],
                'semId' => $semester->id,
                'staffId' => Auth::user()->id
            ]);
            return Redirect::route('mcq.index')->with('message', 'MCQ Added Succesfully');
        }
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
        $subjectId = DB::table("subject_managers")
            ->where("staffId","=",Auth::user()->id)
            ->pluck("subjectId")
            ->all(); 
        $subjects = Subjects::whereIn("id", $subjectId)->get();  

        return view("staff.mcq.editMcq")->with("data",$data)->with("subjects", $subjects);
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
        $subject = Subjects::find($data['subject']); 
        $semester = Semester::find($subject->sem_id);
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
                ->select("users.email","users.name","users.id as userId","student_answers.*")
                ->where("student_answers.mcqId",$mcqId)
                ->get();
        $mcq = MCQ::find($mcqId);
        return view("staff.mcq.viewResult")->with("data",$data)->with("mcq",$mcq)->with("mcqId",$mcqId);
    }
    public function showAnswer($mcqId, $userId) {
        $data = DB::table("submitted_answers")
                ->join("questions","questions.id","submitted_answers.questionId")
                ->join("users","users.id","submitted_answers.studentId")
                ->where("submitted_answers.mcqId",$mcqId)
                ->where("submitted_answers.studentId",$userId)
                ->select("submitted_answers.answer as ans","submitted_answers.correct","users.*",'questions.*')
                ->get();
        $mcq = MCQ::find($mcqId);   
        return view("staff.mcq.viewAnswer")->with("data",$data)->with("mcq",$mcq)->with("mcqId",$mcqId);
    }
    public function calculate($subId) {
        $data = DB::table("m_c_q_s")
            ->join("semesters","semesters.id","m_c_q_s.semId")
            ->join("subjects","subjects.id","m_c_q_s.subjectId")
            ->select("semesters.sem_name","subjects.name as sub_name","subjects.id as subId","m_c_q_s.*")
            ->where("m_c_q_s.staffId",Auth::user()->id)
            ->where("m_c_q_s.subjectId", $subId)
            ->get(); 
        $mcqId = DB::table("m_c_q_s") 
            ->where("m_c_q_s.staffId",Auth::user()->id)
            ->where("m_c_q_s.subjectId", $subId)
            ->pluck("m_c_q_s.id")
            ->all();   
        
        $regno = DB::table("student_answers") 
            ->whereIn("mcqId",$mcqId) 
            ->select("studentId")
            ->groupBy("studentId")
            ->get(); 
        foreach($regno as $key=>$reg) {
            $studentData[$key] = DB::table("student_answers")
                        ->join("users","users.id","student_answers.studentId")
                        ->join("m_c_q_s","student_answers.mcqId","m_c_q_s.id")
                        ->select("users.email","users.name","users.id as userId","student_answers.*")
                        ->whereIn("student_answers.mcqId",$mcqId)
                        ->where("student_answers.studentId", $reg->studentId)
                        ->orderBy("m_c_q_s.created_at")
                        ->get();
        } 
        foreach($studentData as $d) {
            $total = 0;
            $quest = 0;
            foreach($d as $a) {
                $total += $a->answer;
                $quest += $a->count;
            }
            $d->total = $total;
            $d->quest = $quest;
        }  
        $count = count($mcqId);  
        return view("staff.mcq.viewCalculate")
            ->with("data",$data)->with("studentData", $studentData)->with("count",$count)
            ->with("mcq", $mcqId);
    }
}

