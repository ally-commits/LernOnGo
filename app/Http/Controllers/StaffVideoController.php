<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\Semester;
use App\Video;
use Redirect;
use DB;
use Hash;

class StaffVideoController extends Controller
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
        $data = DB::table("videos")
                ->join("semesters","semesters.id","videos.semId")
                ->join("subjects","subjects.id","videos.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","videos.*")
                ->where("staffId",Auth::user()->id)
                ->get(); 
        return view("staff.videos.viewVideos")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $subjects = DB::table("subjects")->get();
        return view("staff.videos.addVideos")->with("subjects", $subjects);      ;
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
            'link' => ['string'], 
        ]);  
        $semester = Semester::find($data['subject']); 
        Video::create([
            'name' => $data['name'],
            'link' =>  $data['link'],
            'subId' => $data['subject'],
            'semId' => $semester->id,
            'staffId' => Auth::user()->id
        ]);
        return Redirect::route('videos.index')->with('message', 'Videos Added Succesfully');
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
        $data = DB::table("videos")
                ->join("semesters","semesters.id","videos.semId")
                ->join("subjects","subjects.id","videos.subId")
                ->select("semesters.sem_name","subjects.name as sub_name","videos.*")
                ->where("videos.id",$id)
                ->get(); 
        $subjects = DB::table("subjects")->get();
        return view("staff.videos.editVideos")->with("video",$data)->with("subjects", $subjects);      ;;
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
            'link' => ['required','string'] 
        ]); 
        $semester = Semester::find($data['subject']);
        DB::table("videos")
            ->where("id",$id)
            ->update(['name' => $data['name'], 'link' => $data['link'],
            'subId' => $data['subject'],
            'semId' => $semester->id]);
        return Redirect::route('videos.index')->with('message', 'Videos Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $videos = Video::find($id);
        $videos->delete();

        return Redirect::route('videos.index')->with('message', 'Videos Deleted Succesfully');
    }
}
