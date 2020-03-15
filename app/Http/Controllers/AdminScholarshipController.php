<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scholarship;
use Auth;
use Redirect;
use DB;
class AdminScholarshipController extends Controller
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
        $data = DB::table("scholarships")->get(); 
        return view("admin.scholarship.viewScholarship")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = DB::table("scholarships")->get();

        return view("admin.scholarship.addScholarship")->with("scholarship",$event);
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
            'lastDate' => ['required', 'date'],  
            'desc' => ['required', 'string'], 
        ]);   

        Scholarship::create([
            'name' => $data['name'],   
            'lastDate' => $data['lastDate'], 
            'desc' => $data['desc'],  
        ]); 
        return Redirect::route('scholarship.index')->with('message', 'Scholarship Added Succesfully');
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
        $data = DB::table("scholarships") 
            ->where('scholarships.id',"=", $id) 
            ->get(); 

        return view("admin.scholarship.editScholarship")->with("scholarship",$data);
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
            'lastDate' => ['required', 'date'],  
            'desc' => ['required', 'string'], 
        ]);  
        DB::table("scholarships")
        ->where('id',"=",$id)
        ->update(['name' => $data['name'],   
                'lastDate' => $data['lastDate'], 
                'desc' => $data['desc']]);
            
        return Redirect::route('scholarship.index')->with('message', 'Scholarship Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $s = Scholarship::find($id);
        $s->delete();

        return Redirect::route('scholarship.index')->with('message', 'Scholarship Deleted Succesfully');
    }
}
