
    <div  id='{{'ID' . $rows->id . 'Parent' . $rows->Kind}}' class="AddChild">
        <form  method="POST" action="{{route('addItemRoute',$rows)}}" class="field"  autocomplete="off">
            @csrf
            @method('PUT')

            <div>
                <input type="text" name="name" placeholder="derive another Topic" required>
            </div>

            <button type="submit">Add Chil</button>

        </form>
    </div>
