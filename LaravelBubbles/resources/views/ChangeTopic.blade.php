    {{-- {{$item=$rows}} --}}
    <div  id='{{'ID' . $rows->id . 'change' . $rows->Kind}}' class="Del">
        <form  method="POST" action="{{route('updateItemWithID',$rows)}}" class="field"  autocomplete="off">
            @csrf
            @method('PUT')
            <div>
                <textarea name="name2" id="" cols="30" rows="10">{{$rows->name}}</textarea>
                <button type="submit" class="update" style="width=30px; height=30px">Update Topic Content</button>
            </div>

        </form>
    </div>
