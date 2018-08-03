<?php

namespace App\Http\Controllers;

use App\Models\Eventuser;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventusersController extends Controller
{
    //
    public function index()
    {
       $eventusers= Eventuser::paginate(5);
        return  view('eventusers/index',compact('eventusers'));
   }



    public function store(Eventuser $eventuser,Request $request)
    {
        $users=Auth::id();
        $event_id=$request->id;
        Eventuser::create([
           'events_id'=>$event_id,
            'user_id'=>$users,
        ]);


   }
}
