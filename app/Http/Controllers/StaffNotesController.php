<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
use App\StudentNotes;
use App\Notes;
use Redirect;
use DB;
use Hash;

class StaffNotesController extends Controller
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
        $data = DB::table("notes")
                ->join("semesters","semesters.id","notes.semId")
                ->join("subjects","subjects.id","notes.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","notes.*")
                ->where("staffId",Auth::user()->id)
                ->get(); 
        return view("staff.notes.viewNotes")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $subjects = DB::table("subjects")->get();
        return view("staff.notes.addNotes")->with("subjects", $subjects);      ;
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
            'file' => ['required'], 
        ]);  
        $semester = Semester::find($data['subject']);
        $file = $request->file('file');
        $fileName = time().'.'.$data['file']->getClientOriginalExtension();
        $file->move('files/', $fileName); 
        Notes::create([
            'name' => $data['name'],
            'file' =>  'files/'.$fileName, 
            'subId' => $data['subject'],
            'semId' => $semester->id,
            'staffId' => Auth::user()->id
        ]);
        return Redirect::route('notes.index')->with('message', 'Notes Added Succesfully');
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
        $data = DB::table("notes")
                ->join("semesters","semesters.id","notes.semId")
                ->join("subjects","subjects.id","notes.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","notes.*")
                ->where("notes.id",$id)
                ->get(); 
        $subjects = DB::table("subjects")->get();
        return view("staff.notes.editNotes")->with("notes",$data)->with("subjects", $subjects);      ;;
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
        ]);   
         
        if($request['file'] != null) { 
            $request->validate([ 
                'file' => ['required']
            ]);
            $files = $request->file('file');
            $filesName = time().'.'.$data['file']->getClientOriginalExtension();
            $files->move('files/', $filesName);

            DB::table('notes')
                ->where('id' ,'=', $id)
                ->update(['file' => 'files/'.$filesName]);
        } 
        $semester = Semester::find($data['subject']);
        DB::table("notes")
            ->where("id",$id)
            ->update(['name' => $data['name'], 
            'subId' => $data['subject'],
            'semId' => $semester->id]);
        return Redirect::route('notes.index')->with('message', 'Notes Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $notes = Notes::find($id);
        $notes->delete();

        return Redirect::route('notes.index')->with('message', 'Notes Deleted Succesfully');
    }
    public function viewSentNotes() {
        $data = DB::table("student_notes")
            ->join("staff","student_notes.staffId","staff.id")
            ->join("users","student_notes.studentId","users.id")
            ->join("subjects","student_notes.subjectId","subjects.id")
            ->select("subjects.name as subName","users.name as sName","student_notes.*")
            ->where("staffId",Auth::user()->id)->get();

        return view("staff.viewSentNotes")->with('data',$data);
    }
    public function approve($id){
        $data = StudentNotes::find($id);
        $semester = Semester::find($data->studentId);
        Notes::create([
            'name' => $data->name,
            'file' => $data->file,
            'staffId' => Auth::user()->id,
            'semId' => $semester->id,
            'subId' => $data->subjectId
        ]);
        DB::table("student_notes")->where("id",$id)->update(["status"=>"approved"]);
        return Redirect::route('viewSentNotes')->with('message', 'Notes Approved Succesfully');
    }
    public function reject($id) {
        DB::table("student_notes")->where("id",$id)->update(["status"=>"rejected"]);
        return Redirect::route('viewSentNotes')->with('message', 'Notes Rejected Succesfully');
    }
}
