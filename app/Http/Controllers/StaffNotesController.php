<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
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
}
