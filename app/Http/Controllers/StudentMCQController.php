<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\MCQ;
use App\StudentAnswer;
use Auth;
use Redirect;

class StudentMCQController extends Controller
{
    public function viewSem() {
        $semester = DB::table("semesters")->get();

        return view("student.mcq.viewSemester")->with("semesters", $semester);
    }
    public function viewSub($sem_id) {
        $subjects = DB::table("subjects")
            ->where('sem_id',$sem_id)->get();

        return view("student.mcq.viewSubjects")->with("subjects",$subjects);
    }
    
    public function viewMcqs($sem_id, $sub_id) {
        $mcq = DB::table("m_c_q_s")
            ->join("subjects","subjects.id","m_c_q_s.subjectId")
            ->join("staff","staff.id","m_c_q_s.staffId")
            ->where('subjectId',$sub_id)
            ->where("publish",true)
            ->select("subjects.name as subName","m_c_q_s.*","staff.name as staffName")
            ->get(); 
        foreach($mcq as $d) {
            $data = DB::table("student_answers")->where("mcqId",$d->id)->where("studentId",Auth::user()->id)->get();
            if(count($data) == 0) {
                $d->active = true;
            } else {
                $d->active = false;
            }
        }
        return view("student.mcq.viewMcq")->with("mcq",$mcq);
    }
    public function answer($id) {
        $data = DB::table("questions")->where("mcqId",$id)->get();
        $i = 1;
        foreach($data as $d) {
            $d->quest = "Question".$i++;
        }
        $mcq = MCQ::find($id); 
        return view("student.mcq.answer")->with("data",$data)->with("mcq", $mcq)->with("id",$id);
    }
    public function submit(Request $request, $mcqId) {
        $data = $request->all();  
        $mcq = DB::table("questions")->where("mcqId",$mcqId)->get();
        $count = DB::table("questions")->where("mcqId",$mcqId)->count();
        $i = 1; 
        $validate = [];
        foreach($mcq as $d) {
            $validate["Question".$i++] = ['required'];
        }
        $request->validate($validate);
        $answer = 0;
        $i = 1; 
        foreach($mcq as $d) {
            $val = $data["Question".$i++];
            if($d->answer == $val) {
                $answer++;
            }
        } 
        StudentAnswer::create([
            'studentId' => Auth::user()->id,
            'mcqId' => $mcqId,
            'answer' => $answer,
            'count' => $count
        ]);
        return Redirect::action('StudentMCQController@viewSem')->with('message', 'MCQ Attended Succesfully');
    }
}
