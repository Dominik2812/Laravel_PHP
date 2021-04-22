<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;




Route::resource('/Topics',App\Http\Controllers\ItemController::class);
Route::put('addItem/{item}', [App\Http\Controllers\ItemController::class, 'addItem'])->name('addItemRoute');
Route::get('/ReservoirTopics',[App\Http\Controllers\ItemController::class,'NestedArray']);
Route::put('delItem/{item}', [App\Http\Controllers\ItemController::class, 'delItem'])->name('deleteItemWithId');
Route::put('change/{item}',[App\Http\Controllers\ItemController::class, 'change'])->name('updateItemWithID');
Route::get('/detail', function() {
    $id=$_GET['id'];
    $rows = Item::whereId($id)->get()->first();
    $rowsArray=[];
    $rowschildren=[];
    foreach($rows->children as $child){
        array_push($rowschildren,['id' => $child->id,
                                'name' => $child->name,
                                'children' => [],
                                'size'=>1,
                                ]);
        };
    array_push($rowsArray,['id' => $rows->id,
                            'name' => $rows->name,
                            'children' => $rowschildren,
                            'size'=>1,
    ]);

    $json = json_encode($rowsArray);

    return view('DetailTopic', ['json' => $json, 'rows'=>$rows]);
})->name('showItemsWithId');


Route::resource('/', App\Http\Controllers\LocalEventController::class);
Route::get('/getItem',[App\Http\Controllers\LocalEventController::class,'getItem'])->name('getItem');
Route::get('EventList',[App\Http\Controllers\LocalEventController::class,'EventListIndex'])->name('EventList');
Route::post('EventList/destroy/{id}',[App\Http\Controllers\LocalEventController::class,'EventListDestroy'])->name('EventList.destroy');
Route::put('EventList/update/{id}',[App\Http\Controllers\LocalEventController::class,'EventListUpdate'])->name('EventList.update');
Route::put('EventList/',[App\Http\Controllers\LocalEventController::class,'EventListStore'])->name('EventList.store');


// Route::resource('/Topics',App\Http\Controllers\BubbleController::class);
// Route::put('addItem/{item}', [App\Http\Controllers\BubbleController::class, 'addItem'])->name('addItemRoute');
// Route::get('/ReservoirTopics',[App\Http\Controllers\BubbleController::class,'NestedArray']);
// Route::put('delItem/{item}', [App\Http\Controllers\BubbleController::class, 'delItem'])->name('deleteItemWithId');
// Route::put('change/{item}',[App\Http\Controllers\BubbleController::class, 'change'])->name('updateItemWithID');
// Route::get('/detail', function() {
//     $id=$_GET['id'];
//     $rows = Bubble::whereId($id)->get()->first();
//     $rowsArray=[];
//     $rowschildren=[];
//     foreach($rows->children as $child){
//         array_push($rowschildren,['id' => $child->id,
//                                 'name' => $child->name,
//                                 'children' => [],
//                                 'size'=>1,
//                                 ]);
//         };
//     array_push($rowsArray,['id' => $rows->id,
//                             'name' => $rows->name,
//                             'children' => $rowschildren,
//                             'size'=>1,
//     ]);

//     $json = json_encode($rowsArray);

//     return view('DetailTopic', ['json' => $json, 'rows'=>$rows]);
// })->name('showItemsWithId');


// Route::resource('/', App\Http\Controllers\BookingController::class);
// Route::get('/getItem',[App\Http\Controllers\BookingController::class,'getItem'])->name('getItem');
// Route::get('EventList',[App\Http\Controllers\BookingController::class,'EventListIndex'])->name('EventList');
// Route::post('EventList/destroy/{id}',[App\Http\Controllers\BookingController::class,'EventListDestroy'])->name('EventList.destroy');
// Route::put('EventList/update/{id}',[App\Http\Controllers\BookingController::class,'EventListUpdate'])->name('EventList.update');
// Route::put('EventList/',[App\Http\Controllers\BookingController::class,'EventListStore'])->name('EventList.store');



