<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use Exception;
use App\Event;
use App\User;
use App\Invite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
    public function index()
    {
        return view('events/create_event');
    }

    public function create()
    {
        return view('events.create');
    }


    public function store()
    {
        $input = Request::all();

        $event = new Event;

        $event->name = $input['name'];
        $event->location = $input['location'];
        $event->description = $input['description'];
        $event->date = $input['date'];
        $event->stime = $input['stime'];
        $event->etime = $input['etime'];
        $event->uid = Auth::user()['uid'];

        try
        {
            $saveflag = $event->save();
        }
        catch(Exception $e)
        {
            print '<script type="text/javascript">';
            print 'alert("The system has encountered an error please try again later")';
            print '</script>';
            return view('errors.error_event');
        }

        if($saveflag)
        {
            return view('events/success_event');
        }
    }


    public function inviteUsers()
    {
        $input = Request::all();


        $eventID = $input['eid'];
        $emails = $input['emails'];
        $users = [];

        foreach($emails as $email)
        {
            array_push($users, User::getByEmail($email));
        }

        $invites = self::getInvites($eid);

        foreach ($users as $user)
        {

            if (!in_array($user->uid, $invites))
            {
                Invite::createInviteLog($eid, $user->uid);
                self::sendInvitation($eid, $user->email);
            }

        }

        return view('success');
    }

    private function getInvites($eid)
    {
        $inviteDB = DB::table('invites')->select('uid')->where('eid', $eid)->get();
        $invites = [];

        foreach ($inviteDB as $entry)
        {
            array_push($invites, $entry->uid);
        }

        return $invites;
    }


    public function sendInvitation($eid, $email)
    {
        $event = Event::getById($eid);
        $data = array(
            'eventname' => $event->name,
            'date' => $event->date,
            'stime' => $event->stime,
            'etime' => $event->etime,
            'location' => $event->location,
            'description' => $event->description,
        );

        Mail::send('emails.invitation', $data, function ($message) use ($email) {
            $message->from(env('MAIL_USERNAME'), 'partEz');
            $message->to($email)->subject('Event Invitation');

        });

    }

}
