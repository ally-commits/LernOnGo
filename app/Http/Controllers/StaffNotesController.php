<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
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
    public function index()
    {
        $data = DB::table("notes")->where("staffId",Auth::user()->id)->get(); 
        $subjects = DB::table("subjects")
        ->join("semesters","semesters.id",'subjects.id')    
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
        return view("staff.notes.addNotes");
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
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);  

        Staff::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return Redirect::route('staff.index')->with('message', 'Staff Added Succesfully');
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
        $subjects = DB::table("notes")
        ->join("semesters","semesters.id",'notes.semId')
        ->join("subjects","semester.id",'notes.semId')    
        ->get();
        return view("admin.staff.editStaff")->with("staff",$data);
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
            'email' => ['required', 'string', 'max:255', 'unique:users'], 
        ]);  
        if($request->password != '') {
            $request->validate([
                'password' => ['required','min:8','confirmed']
            ]);
            DB::table("staff")
                ->where("id", '=', $data['id'])
                ->update(['password' => Hash::make($data['password'])]);
        }
        DB::table("staff")
        ->where('id',"=",$id)
            ->update(['name'=> $data['name'], "email" => $data['email']]);
            
        return Redirect::route('staff.index')->with('message', 'Staff Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $staff = Staff::find($id);
        $staff->delete();

        return Redirect::route('staff.index')->with('message', 'Staff Deleted Succesfully');
    }
}
