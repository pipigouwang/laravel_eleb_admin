<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //显示
    public function index(Request $request)
    {
        //echo'1';
        // dd(time());
        $time =time();
        $status=$request->status;
        //$start_time=strtotime($request->start_time);
        //$end_time=strtotime($request->end_time);
        if(empty($status)){
            $activities= Activities::paginate(6);

        } elseif($status==1){
            $activities= Activities::where('end_time','<',$time)->paginate(6);//已过期

        } elseif($status==2){
            $activities= Activities::where('end_time','>',$time)->where('start_time','<',$time)->paginate(6);//进行中
        }elseif($status==3){
            $activities= Activities::where('start_time','>',$time)->paginate(6);//未开始
        }
        return  view('activities/index',compact('activities'));
    }

    public function show(Activities $activity ,Request $request)
    {
        return  view('activities/show',compact('activity'));
    }
    //添加

    public function create()
    {
        return view('activities/create');
    }

    public function store(Request $request)
    {
        //dd($request->title,$request->content,$request->start_time,$request->end_time);
        $this->validate($request,[
            'title'=>'required|max:15',
            'content'=>'required|min:6',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名必填',
            'title.max'=>'名称不能超过15个字',
            'content.required'=>'活动必填',
            'content.min'=>'活动内容字符不能小于6个字符',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填'
        ]);
        $start_time=strtotime($request->start_time);
        $end_time=strtotime($request->end_time);
        Activities::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
        ]);
        return  redirect()->route('activities.index')->with('success','添加成功');
    }

    public function edit(Activities $activity)
    {
        return view('activities/edit',compact('activity'));
    }

    public function update(Request $request ,Activities $activity)
    {
        $this->validate($request,[
            'title'=>'required|max:15',
            'content'=>'required|min:6',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名必填',
            'title.max'=>'名称不能超过15个字',
            'content.required'=>'活动必填',
            'content.min'=>'活动内容字符不能小于6个字符',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填'
        ]);
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return  redirect()->route('activities.index')->with('success','修改成功');
    }
    public function destroy(Activities $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success','删除成功!');
    }
}
