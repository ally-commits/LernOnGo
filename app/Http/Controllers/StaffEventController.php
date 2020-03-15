<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use Auth;
use Redirect;
use DB;

class StaffEventController extends Controller
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
        $data = DB::table("events")->latest()->get(); 
        return view("staff.events.viewEvents")->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = DB::table("events")->get();

        return view("staff.events.addEvent")->with("event",$event);
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
            'image' => ['required', 'image','mimes:jpeg,png,jpg'], 
            'venue' => ['required', 'string'], 
            'date' => ['required', 'date'], 
        ]);  
        $image = $request->file('image');
        $imageName = time().'.'.$data['image']->getClientOriginalExtension();
        $image->move('images/events', $imageName);

        Events::create([
            'name' => $data['name'], 
            'image' => 'images/events/'.$imageName, 
            'venue' => $data['venue'], 
            'date' => $data['date'],  
        ]); 
        return Redirect::route('staffEvents.index')->with('message', 'Event Added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registred($id)
    {
        $data = DB::table("register_events")
            ->join("users","register_events.studentId","users.id") 
            ->where("register_events.eventId", $id)
            ->get();
        $count = DB::table("register_events")
            ->join("users","register_events.studentId","users.id") 
            ->where("register_events.eventId", $id)
            ->count();
        $event = Events::find($id);
        return view("staff.events.registred")->with("data",$data)->with("event",$event)
                ->with("count", $count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table("events") 
            ->where('events.id',"=", $id) 
            ->get(); 

        return view("staff.events.editEvent")->with("event",$data);
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
            'venue' => ['required', 'string'], 
            'date' => ['required', 'date'], 
        ]); 
        if($request['image'] != null) { 
            $request->validate([ 
                'image' => ['required','image','mimes:jpeg,png,jpg'],
            ]);
            $image = $request->file('image');
            $imageName = time().'.'.$data['image']->getClientOriginalExtension();
            $image->move('images/events', $imageName);

            DB::table('events')
                ->where('id' ,'=', $id)
                ->update(['image' => 'images/events/'.$imageName]);
        }
        DB::table("events")
        ->where('id',"=",$id)
        ->update(['name' => $data['name'],  
                'venue' => $data['venue'], 
                'date' => $data['date']]);
            
        return Redirect::route('staffEvents.index')->with('message', 'Event Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $event = Events::find($id);
        $event->delete();

        return Redirect::route('staffEvents.index')->with('message', 'Event Deleted Succesfully');
    }
}
