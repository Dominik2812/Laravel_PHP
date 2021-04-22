<?php

namespace App\Http\Controllers;
use App\Models\Item;
// use App\Models\Bubble;
use Illuminate\Http\Request;
use App\Http\Requests\BubbleRequest;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function index()
    {   $rows = DB::select('select id, name, childOf as children from items');
        $x=$rows;
        $rows = json_decode(json_encode($rows), true);
        $rows = $this->buildTree($rows);
        $json=json_encode($rows);
        view('layouts.app', ['json' => $json, 'rows'=>$rows, 'x'=>$x ]);
        return view('Topics', ['json' => $json, 'rows'=>$rows, 'x'=>$x ]);
    }



    public function showEvents()
    {
        $Topic = Item::with('events')->get(); 
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

        Item::create($request->all());
        return redirect('/Topics');
    }

    public function addItem(Request $request, Item $item) ///Logik zur Erstellung eines childrenteils
    {
        $item->children()->create($request->all());
        return redirect('/Topics');
    }

    public function delItem( Item $item)
    {
        // dd($item->id);
        $interests = Item::whereId($item->id);
        $interests->delete();
        return redirect('/Topics');
    }

    public function change(Request $request, Item $item) ///Logik zur Erstellung eines childrenteils    //ItemRequest $request,
    {
        $interests = Item::whereId($item->id)->get()->first();
        $interests->name = $request->name2;
        $interests->save();
        return redirect('/Topics');
    }

    public function NestedArray(){ //delivers adequat datato ReservoirTopics.blade

        $rows = DB::select('select id, name, Kind as children from items');
        var_dump($rows);
        $rows = json_decode(json_encode($rows), true);
        $rows = $this->buildTree($rows);
        $json=json_encode($rows);
        return view('ReservoirTopics', ['json' => $json, 'rows'=>$rows]);
        // return json_encode($rows);

    }

    public function buildTree($allData, $mother = null) {
        $branch = array();

        foreach ($allData as $item) {
            $item["size"] = 1;
            if ($item["children"] == $mother) {
                $children = $this->buildTree($allData, $item["id"]);
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
