<?php

namespace App\Http\Controllers;

use App\Models\Bubble;
use App\Models\LocalEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Spatie\GoogleCalendar\GoogleCalendar;

use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Organizer

    {   //Find all localEvents
        $localEvents = LocalEvent::get();
        $events=[];
        $deleteables=[];

        // find Corresponding Googleevents from Spatie that are still in the local DB
        foreach($localEvents as $localEvent ){
            $event = Event::find($localEvent->eventId);
            array_push($events,$event);
        };

        //get all GoogleEvents in the Google Calendar
        $ev=Event::get();

        //Find Google Events that exist in the local DB but not in the GoogleCalendar
        foreach($events as $event ){
            $indicator=false;
            foreach($ev as $e){
                if($event->id==$e->id){
                    $indicator=true;
                }
            }
            if( $indicator==false){
                array_push($deleteables,$event->id);
            }
        };
        //delete what you found
        foreach($deleteables as $delteable){
            var_dump($deleteables);
            $even = LocalEvent::where('eventId',$delteable);
            $even->delete();
        }

        //display localEvents
        $events = LocalEvent::get();
        $rows = DB::select('select id, name, Kind as children from bubbles');
        $rows = json_decode(json_encode($rows), true);
        $rows = $this->buildTree($rows);
        $json=json_encode($rows);
        // return view('ReservoirTopics', ['json' => $json, 'rows'=>$rows]);

        return view('Organizer',['events' => $events, 'json' => $json, 'rows'=>$rows]);

    }







    public function EventListIndex() //EventList page
    {   echo 2;
        // $events = Event::get();
        $events=[];
        $localEvents = LocalEvent::get();//->first()->id
        $deleteables=[];
        foreach($localEvents as $localEvent ){
            // var_dump($localEvent->eventId);

            $event = Event::find($localEvent->eventId);
            array_push($events,$event);
            // if($event->isEmpty()){
                // var_dump($event);//->id;
            // }
        };

        // dd(count($events));
        $ev=Event::get();

        foreach($events as $event ){
            $indicator=false;
            foreach($ev as $e){
                if($event->id==$e->id){
                    $indicator=true;

                }
            }
            if( $indicator==false){
                array_push($deleteables,$event->id);
            }
        };

        foreach($deleteables as $delteable){

            $even = LocalEvent::where('eventId',$delteable);
            $even->delete();
        }

        $events=Event::get();
        return view('EventList',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $startTime = Carbon::parse($request->input('meeting_date'). ' ' . $request->input('meeting_time'));
        var_dump($startTime);
        $endTime = (clone $startTime)->addHour();
        Event::create([
            'name' => $request->input('name'),
            'startDateTime' => $startTime,
            'endDateTime' => $endTime
        ]);

        return redirect()->back()->withMessage('booked');
    }

    public function EventListStore(Request $request)
    {

        $startTime = Carbon::parse($request->input('meeting_date'). ' ' . $request->input('meeting_time'));

        $endTime = (clone $startTime)->addHour();
        $googleEvent=Event::create([
            'name' => $request->input('name'),
            'startDateTime' => $startTime,
            'endDateTime' => $endTime
        ]);

        $localEvent=LocalEvent::create([
            'name' => $request->input('name'),
            'startDateTime' => $startTime,
            'endDateTime' => $endTime,
            'bubbleId' => 'not classified',
            'eventId' => $googleEvent->id,
        ]
        );
        return redirect()->back()->withMessage('booked');
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
        //
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
        $event = Event::find($id);
        $event->name = $request->name;
        $event->startDateTime = Carbon::parse($request->meeting_date . ' ' . $request->meeting_time);
        $event->endDateTime = $event->startDateTime->addHour();
        $event->save();
        $events = Event::get();
        return view('Organizer',compact('events'));
    }

    public function EventListUpdate(Request $request, $id)
    {
        $googleEvent=Event::find($id);
        $googleEvent->name = $request->name;
        $googleEvent->startDateTime = Carbon::parse($request->meeting_date . ' ' . $request->meeting_time);
        $googleEvent->endDateTime = $googleEvent->startDateTime->addHour();
        $googleEvent->save();

        $event = LocalEvent::where('eventId',$id)->first();
        $event->name = $request->name;
        $event->startDateTime = Carbon::parse($request->meeting_date . ' ' . $request->meeting_time);
        $event->endDateTime = $event->startDateTime->addHour();
        $event->save();

        // $events = Event::get();
        // return view('EventList',compact('events'));
        return redirect()->back()->withMessage('booked');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $event = Event::find($id);
        $event->delete();
        $events = Event::get();
        return view('Organizer',compact('events'));
    }

    public function EventListDestroy($id)

    {   echo '1';
        $googleEvent=Event::find($id);
        echo '1';
        $googleEvent->delete();
        echo '1';
        $event = LocalEvent::where('eventId',$id);
        echo '1';
        if($event){
            echo '1';
            $event->delete();
            echo '6';
        }
        // $events = Event::get();
        // echo '1';
        // return view('EventList',compact('events'));
        return redirect()->back()->withMessage('booked');
    }

    public function getItem(Request $request){
        $itemId=$request->id;
        $item=Bubble::whereId($itemId)->get()->first();
        $itemName = $item->name;

        $startTime = Carbon::parse($request->input('meeting_date'). ' ' . $request->input('meeting_time'));
        $endTime = (clone $startTime)->addHour();

        $event=Event::create([
            'name' => $itemName,
            'startDateTime' => $startTime,
            'endDateTime' => $endTime
        ]);

        $localEvent=localEvent::create([
            'name' => $itemName,
            'startDateTime' => $startTime,
            'endDateTime' => $endTime,
            'bubbleId' => $itemId,
            'eventId' => $event->id,
        ]
        );
        $item->localEventId=$localEvent->id;
        $item->save();

        return redirect()->back()->withMessage('booked');

    }

    public function NestedArray(){ //delivers adequat datato ReservoirTopics.blade

        $rows = DB::select('select id, name, Kind as children from bubbles');

        $rows = json_decode(json_encode($rows), true);
        $rows = $this->buildTree($rows);
        $json=json_encode($rows);
        return view('ReservoirTopics', ['json' => $json, 'rows'=>$rows]);
        // return json_encode($rows);

    }

    public function buildTree($Topic, $Kind = 0) {
        $branch = array();

        foreach ($Topic as $item) {
            $item["size"] = 1;
            if ($item["children"] == $Kind) {

                $children = $this->buildTree($Topic, $item["id"]);
                if ($children) {
                    $item["children"] = $children;
                } else {
                    $item["children"] = [];
                }

                $branch[] = $item;
            }
        }

        return $branch;
    }


}
