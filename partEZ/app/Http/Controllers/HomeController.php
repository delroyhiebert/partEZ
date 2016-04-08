<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllers\Views\ApiHomeController;
use App\Invite;
use Auth;
use DB;
use Mail;
use App\Event;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class HomeController extends ApiHomeController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($local_events_only = false, $local_city = null)
    {
        if($local_events_only) 
        {
            $input = Request::all();
            $response =  ApiHomeController::index($local_events_only, $input['city']);
        }
        else
        {
            $response =  ApiHomeController::index($local_events_only);
        }
        
        
        return view('home')->with('data', $response->getData());
    }

}
