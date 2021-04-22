@extends('layouts.app')
@section('content')


<script>
    var myArr = '<?php  echo $json; ?>';
</script>

<div id='detail'>

    <div id="detailChart">
        <div style="margin-left:80px;" id="chart" ></div>
    </div>


    {{$rows->name .' '. $rows->id}}
    <div id='searchTopic' class="card" >
        <div class = "card-body", id='manipulate'>
            <h4 class="card-title"> Search Topic</h4>
                @include('AddChild')
                @include('ChangeTopic')
                @include('DeleteTopic')

        </div>
    </div>

</div>

<script type="text/javascript" src="/js/detail.js"></script>

@endsection
