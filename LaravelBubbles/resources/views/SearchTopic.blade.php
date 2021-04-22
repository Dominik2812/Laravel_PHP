
<div id='searchTopic' class="card" >
    <div class = "card-body">
        <h4 class="card-title"> Search Topic</h4>
        <form  method="GET" action="{{route('showItemsWithId',$_GET)}}" class="field"  autocomplete="off">
            <div>
                <textarea name="id"  cols="5" rows="5" placeholder= "type id"></textarea>
                <button type="submit" class="update" style="width=30px; height=30px">Search Bubble by ID</button>
            </div>
        </form>
    </div>
</div>
