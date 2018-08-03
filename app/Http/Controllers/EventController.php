<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
       // echo'1';
        $events=Event::all();
        return view('events/index',compact('events'));
    }

    public function create()
    {
        return view('events/create');
    }
    public function store(Request $request)
    {
        //dd($request->title,$request->content,$request->start_time,$request->end_time);
        $this->validate($request,[
            'title'=>'required|max:15',
            'content'=>'required|min:4',
            'signup_start'=>'required',
            'signup_end'=>'required',
        ],[
            'title.required'=>'活动名必填',
            'title.max'=>'名称不能超过15个字',
            'content.required'=>'活动必填',
            'content.min'=>'活动内容字符不能小于6个字符',
            'signup_start.required'=>'报名开始时间必填',
            'signup_end.required'=>'报名结束时间必填'
        ]);
        $signup_start=strtotime($request->signup_start);
        $signup_end=strtotime($request->signup_end);
        $prize_date=strtotime($request->prize_date);
      Event::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_num'=>$request->signup_num,
            'prize_date'=>$prize_date,
            'signup_start'=>$signup_start,
            'signup_end'=>$signup_end,
        ]);
        return  redirect()->route('events.index')->with('success','添加成功');
    }

    public function edit(Event $event)
    {
        return view('events/edit',compact('event'));
    }

    public function update(Request $request,Event $event)
    {
        $this->validate($request,[
            'title'=>'required|max:15',
            'content'=>'required|min:4',
            'signup_start'=>'required',
            'signup_end'=>'required',
        ],[
            'title.required'=>'活动名必填',
            'title.max'=>'名称不能超过15个字',
            'content.required'=>'活动必填',
            'content.min'=>'活动内容字符不能小于6个字符',
            'signup_start.required'=>'报名开始时间必填',
            'signup_end.required'=>'报名结束时间必填'
        ]);
        $signup_start=strtotime($request->signup_start);
        $signup_end=strtotime($request->signup_end);
        $prize_date=strtotime($request->prize_date);
     $event->update([
         'title'=>$request->title,
         'content'=>$request->content,
         'signup_num'=>$request->signup_num,
         'prize_date'=>$prize_date,
         'signup_start'=>$signup_start,
         'signup_end'=>$signup_end,
         'is_prize'=>$request->is_prize,
     ]);
   return  redirect()->route('events.index')->with('success','修改成功');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success','删除成功!');
    }
}
