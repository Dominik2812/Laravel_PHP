@extends('layouts.app')
@section('content')

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="container" id='makeAppointment'>



    <div class="card"  >
        <div class = "card-body" id='makeAppointmentModal'>
            <h4 class="card-title"> make an Appointment that is not in the Reservoir </h4>
            <form action="{{route('EventList.store')}}" method = "POST">
                @csrf
                @method('PUT')
                <label for="name"> Appointment</label>
                <br >
                <textarea name="name" id="" cols="30" rows="1" placeholder="create an Event that is individual and not in the bubble Reservoir"></textarea>
                <br>
                <label for="meeting_time"> date and time</label>
                <br >
                <input type="date" name="meeting_date" id="">
                <input type="time" name="meeting_time" id="">
                <br>
                <button type="submit">Make New event</button>
                <br>
            </form>
        </div>
    </div>
</div>


    



    <div class="container" id='events'>

        <div class="card">
            <div class = "card-body">
                <h4 class="card-title"> List of Events</h4>
    
                    @if( $events ?? '')
                        @foreach ($events as $item)
                           <p>
                            <div class="card" id='event'>
                                <div class = "card-body">
                                    <p>
                                        <h4 class="card-title"> {{$item->name }}</h4>
                                        <div >{{$item->startDateTime}}</div>
                                    
    
                                    <form action="{{route('EventList.update',$item->id)}}" method = "POST">
                                        @csrf
                                        @method("PUT")
                                        <label for="name"></label>
                                        <br >
                                        <textarea name="name" id="" cols="30" rows="1" placeholder="Change the name of the appointment to..."></textarea>
                                        <br>
                                        <label for="meeting_time"> date and time</label>
                                        <br >
                                        <input type="date" name="meeting_date" id="">
                                        <input type="time" name="meeting_time" id="">
                                        <br>
                                        <button type="submit">Update</button>
                                        <br>
    
                                    </form>

                                    <form action="{{route('EventList.destroy',$item->id)}}" method = "POST">
                                        @csrf
                                        {{-- @method("DELETE") --}}
                                        <button type="submit">delete</button>
                                    </form>
                                </div>
                            </div>
                           </p>
                           <br>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>

</p>




</div>
@endsection