<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Subjects;
use App\subjectManager;
use DB;
use Auth;
use Redirect;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    public function index()
    {
        $data = DB::table("subject_managers")
                ->join("subjects",'subjects.id','subject_managers.subjectId')
                ->select("subjects.name","subject_managers.*")
                ->where("staffId",Auth::user()->id)
                ->get();
        $subjectId = subjectManager::pluck("subjectId")->all();
        $subject = Subjects::whereNotIn("id", $subjectId)->get();

        if(count($data) == 0) {
            return view("staff.addSubject")->with("subject",$subject);
        } else {
            return view('staff.dashboard')->with("data", $data);
        }
    }
    public function delete($id) {
        $m = subjectManager::find($id);
        $m->delete();
        return Redirect::action("StaffController@index")->with("message","Staff Subject Deleted Succesfully");
    }
    public function create() {
        $subjectId = subjectManager::pluck("subjectId")->all();
        $subject = Subjects::whereNotIn("id", $subjectId)->get();

        return view("staff.addSubject")->with("subject",$subject);
    }
    public function addSubject(Request $request) {
        $data = $request->all();
        subjectManager::create([
            'subjectId' => $data['subject'],
            'staffId' => Auth::user()->id
        ]);
        return Redirect::action("StaffController@index")->with("message","Staff Subject Added Succesfully");
    }
}
