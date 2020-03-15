<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Semester;
use Auth;
use Redirect;
use DB;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = DB::table("semesters")
        ->join("subjects",'semesters.id',"subjects.sem_id")
        ->select("subjects.*","semesters.sem_name")        
        ->get(); 
        return view("admin.subjects.viewSubject")->with("data",$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sem = DB::table("semesters")->get();

        return view("admin.subjects.addSubject")->with("sem",$sem);
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
            'sem' => ['required', 'integer'], 
        ]);  

        Subjects::create([
            'name' => $data['name'], 
            'sem_id' => $data['sem'],  
        ]); 
        return Redirect::route('subject.index')->with('message', 'Subject Added Succesfully');
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
        $data = DB::table("semesters")
            ->join("subjects",'semesters.id',"subjects.sem_id")
            ->where('subjects.id',"=", $id)
            ->select("subjects.*","semesters.sem_name")        
            ->get(); 
        return view("admin.subjects.editSubject")->with("sem",$data);
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
            'sem' => ['required', 'integer'], 
        ]); 
        DB::table("subjects")
        ->where('id',"=",$id)
        ->update(['name'=> $data['name'], "sem_id" => $data['sem']]);
            
        return Redirect::route('subject.index')->with('message', 'Subject Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $sub = Subjects::find($id);
        $sub->delete();

        return Redirect::route('subject.index')->with('message', 'Subject Deleted Succesfully');
    }
}
