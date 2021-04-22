<?php

namespace App\Http\Controllers;

use App\Models\Bubble;
use Illuminate\Http\Request;
use App\Http\Requests\BubbleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\GoogleCalendar\Event;

class BubbleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */


    public function index()
    {   $rows = DB::select('select ab,b,c from bubbles');
        
        // $rows = json_decode(json_encode($rows), true);
        // $rows = $this->buildTree($rows);
        $json=json_encode($rows);
        // $XYZ=[];
        view('layouts.app', ['json' => $json, 'rows'=>$rows]);
        // return view('Topics', ['json' => $json, 'rows'=>$rows]);
        return view('Topics',['json' => $json, 'rows'=>$rows]);
    }



    public function showEvents()
    {
        $Topic = Bubble::with('events')->get(); 
        // dd($Topic);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BubbleRequest $request)
    {

        Bubble::create($request->all());
        return redirect('/Topics');
    }

    public function addItem(BubbleRequest $request, Bubble $item) ///Logik zur Erstellung eines childrenteils
    {
        $item->children()->create($request->all());
        return redirect('/Topics');
    }

    public function delItem( Bubble $item)
    {
        // dd($item->id);
        $interests = Bubble::whereId($item->id);
        $interests->delete();
        return redirect('/Topics');
    }

    public function change(Request $request, Bubble $item) ///Logik zur Erstellung eines childrenteils    //BubbleRequest $request,
    {
        $interests = Bubble::whereId($item->id)->get()->first();
        $interests->name = $request->name2;
        $interests->save();
        return redirect('/Topics');
    }

    // public function NestedArray(){ //delivers adequat data to ReservoirTopics.blade

    //     $rows = DB::select('select id, name, v from bubbles');
    //     // $XYZ=[];
    //     // $rows = json_decode(json_encode($rows), true);
    //     // $rows = $this->buildTree($rows);
    //     $json=json_encode($rows);
    //     return view('ReservoirTopics', ['json' => $json, 'rows'=>$rows]);
    //     // return json_encode($rows);

    // }

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
