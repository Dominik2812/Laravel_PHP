@extends('layouts.app')
@section('content')

{{-- dump bubbles here and manipulate them --}}
<div id="topics">
    @include('DropBox')

    {{--Reservoir that displays the bubbles--}}
    @include('ReservoirTopics')





    <script >
        //dump2 is in 'original.bucket'
        var dump = d3.select("#dump2");
        dump.on("mouseup", function () {
            //get Position of the target
            xx=this.getBoundingClientRect().left
            yy=this.getBoundingClientRect().top

            // create new elements in the d3 way
            new_g=dump.append("g").attr("id","gggg"+String(yy)+String(xx))
            text=new_g.append("text").attr("id","text"+String(yy)+String(xx));

            //dump the g_Id that is from main.js =>ReservoirTopics.blade.php
            text.node().innerHTML=g_Id;

            //redirect to ReservoirTopics2 where bubble can be manipulated
            window.location.href = "/detail?id="+ String(g_Id);
    });

    </script>
</div>
@endsection

