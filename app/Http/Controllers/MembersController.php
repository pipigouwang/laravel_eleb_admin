<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
//    //测试
//    public function test(Request $request)
//    {
//        Members::create([
//            'username'=>'2',
//            'password'=>bcrypt('123123')
//        ]);
//    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $members=Members::paginate(5);
        return view('Members/index',compact('members'));
    }
    public function able(Members $member){
        $member->update([
            'status'=>request()->status
        ]);
        return redirect()->route('members')->with('success','处理成功');
    }
}
