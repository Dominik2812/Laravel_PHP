
@extends('layouts.app')
@section('content')

<div id='organizer'>
    
    <iframe src="https://calendar.google.com/calendar/embed?src=YOUR API KEYgroup.calendar.google.com&ctz=Europe%2FBerlin"  frameborder="0" scrolling="no" id="Gcalendar"></iframe>
    <div id='reservoir2'>@include('ReservoirTopics')</div>
    <div id= 'week'>@include('Week')</div>

</div>


<script>

    var dump = d3.selectAll("td");
    var yPos = 0;

    dump.on("mouseup", function () {
        xx=this.getBoundingClientRect().left
        yy=this.getBoundingClientRect().top
        var ii=0
        for(dum of dump[0]){
            // console.log(dump[0].indexOf(dum))
            if (dum.getBoundingClientRect().top ==this.getBoundingClientRect().top && dum.getBoundingClientRect().left ==this.getBoundingClientRect().left){
                Stunde=dum.id.substring(1,3);
                console.log(Stunde)
                Tag=dum.className.substring(1,2);
                ii=dump[0].indexOf(dum);
                // console.log(dum.id)
                dum.id='dump'+'_'+ ii
                dum.className= Stunde+ '_' +Tag
            }
        }

        dum= d3.select("#dump_"+ ii)

        new_g=dum.append("g").attr("id","gggg"+String(yy)+String(xx))//.attr("x", xx).attr("y", yy+200)
        text=new_g.append("text").attr("id","text"+String(yy)+String(xx));//.attr("x", 20).attr("y", 20);
        text.node().innerHTML=g_Id;


        tds=d3.selectAll("td")
        ths=d3.selectAll("th")



var curr = new Date(); // get current date
var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
var choice = first + Number(Tag)+1; // chosen day is the first day + Tag
var choiceday = new Date(curr.setDate(choice));

Month=Number(choiceday.getMonth())+1
Datum=choiceday.getFullYear()+"-" +Month+"-"+choiceday.getDate()

window.location.href = "/getItem/?id="+ String(g_Id)+"&meeting_date="+Datum+"&meeting_time="+Stunde+"%3A00";
});

</script>
@endsection

