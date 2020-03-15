<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Assignment;
use App\AssignmentAnswer;
use Auth;
use Redirect;

class StudentAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function answerAssignment($assign_id) {
        $data = Assignment::find($assign_id);
         
        return view("student.assignment.answerAssignment")->with("data",$data);
    }
    public function submitAssignment(Request $request) {
        $data = $request->all();
        $request->validate([
            'answer' => ['required', 'string'], 
        ]);  
        AssignmentAnswer::create([
            'answer' => $data['answer'],
            'assignmentId' => $data['id'],
            'studentId' => Auth::user()->id
        ]);
        return Redirect::action('HomeController@viewSemAssignment')->with('message', 'Assignment Submitted  Added Succesfully');
    }
}
