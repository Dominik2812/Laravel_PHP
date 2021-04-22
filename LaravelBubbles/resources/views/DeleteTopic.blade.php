
    <div  id='{{'ID' . $rows->id . 'Löschen' . $rows->Kind}}' class="Del">
        <form  method="POST" action="{{route('deleteItemWithId',$rows)}}" class="field"  autocomplete="off">
            @csrf
            @method('PUT')
            <button type="submit" class="Del" style="width=30px; height=30px">Delete Topic</button>

        </form>
    </div>

