<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Eventprize;
use Illuminate\Http\Request;

class EventprizesController extends Controller
{
    //
    public function index()
    {
        $eventprizes=Eventprize::paginate(5);
        return view('eventprizes/index',compact('eventprizes'));
    }

    public function create(Eventprize $eventprize)
    {
        $events=Event::all();
        return view('eventprizes/create',compact('eventprize','events'));
    }

    public function store(Request $request)
    {
       Eventprize::create([
           'event_id'=>$request->event_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
        ]);
        return redirect()->route('eventprizes.index')->with('success','添加成功');
    }

    public function edit(Eventprize $eventprize)
    {
        $events=Event::all();
        return view('eventprizes/edit',compact('eventprize','events'));
    }

    public function update(Request $request,Eventprize $eventprize){
        //dd($eventprize->name);
        $eventprize->update([
            'event_id'=>$request->event_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
        ]);
        return redirect()->route('eventprizes.index')->with('success','修改成功');
    }

    public function destroy(Eventprize $eventprize)
    {
        $eventprize->delete();
        return redirect()->route('eventprizes.index')->with('success','删除成功');
    }
}
