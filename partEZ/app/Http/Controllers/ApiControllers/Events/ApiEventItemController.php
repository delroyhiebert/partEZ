<?php

namespace App\Http\Controllers\ApiControllers\Events;

use App\EventListItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;

class ApiEventItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public static function submitItems( Request $request, $eid )
    {
        $itemlist = json_decode(json_encode($request->itemlist), true);
        $uid = Auth::User()->uid;
        
        foreach( $itemlist as $item )
        {
            $newItem = new EventListItem();
            $newItem->uid = 0;
            $newItem->eid = $eid;
            $newItem->description = $item;
            $newItem->save();
        }
    }

    public static function getEventItems( Request $request )
    {
        $items = Event::getEventItems( $request['eid'] );
        return response()->json(compact('items'));
    }

    public static function assignUser( Request $request )
    {
        EventListItem::assignUser($request->iid, $request->eid, Auth::user()['uid']);
    }
}
