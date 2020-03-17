<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\MCQ;
use DB;
use Redirect;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    public function index($id) {
        $data = DB::table("questions")->where("mcqId",$id)->get();
        $mcq = MCQ::find($id); 
        return view("staff.question.viewQuestion")->with("data",$data)->with("mcq",$mcq)->with("id",$id);
    }
    public function addData($id) {
        return view("staff.question.addQuestion")->with("id",$id);
    }
    public function store(Request $request, $id) {
        $data = $request->all();
        $request->validate([
            'question' => ['required', 'string'],  
            'op1' => ['required','string'],
            'op2' => ['required','string'],
            'op3' => ['required','string'], 
            'op4' => ['required','string'],
            'answer' => ['required','string'],
        ]); 

        Questions::create([
            'question' => $data['question'],
            'op1' => $data['op1'],
            'op2' => $data['op2'],
            'op3' => $data['op3'],
            'op4' => $data['op4'],
            'answer' => $data['answer'],
            'mcqId' => $id
        ]);

        return Redirect::action('QuestionController@index',$id)->with('message', 'Question Added Succesfully');
    }
    public function edit($mcqId,$id) {
        $data = Questions::find($id);

        return view("staff.question.editQuestion")->with("data",$data)->with("id",$mcqId);
    }
    public function update(Request $request, $mcqId, $id) {
        $data = $request->all();
        $request->validate([
            'question' => ['required', 'string'],  
            'op1' => ['required','string'],
            'op2' => ['required','string'],
            'op3' => ['required','string'], 
            'op4' => ['required','string'],
            'answer' => ['required','string'],
        ]); 

        DB::table("questions")
        ->where("id",$id)
        ->update([
            'question' => $data['question'],
            'op1' => $data['op1'],
            'op2' => $data['op2'],
            'op3' => $data['op3'],
            'op4' => $data['op4'],
            'answer' => $data['answer'], 
        ]);

        return Redirect::action('QuestionController@index',$mcqId)->with('message', 'Question Update Succesfully');
    }
    public function delete($mcqId, $id) {
        $question = Questions::find($id);
        $question->delete();

        return Redirect::action('QuestionController@index',$mcqId)->with('message', 'Question Deleted Succesfully');
    }
}
