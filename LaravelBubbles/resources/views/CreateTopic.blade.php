<div id='createTopic' class="card">
    <div class = "card-body">
        <h4 class="card-title"> Create Topic</h4>
            <form  method="POST" action="/Topics" autocomplete="off">
                @csrf
                <div class="field">
                    <input type="text" name="name" placeholder="NewBubble???" required>
                </div>
                <button  type="submit">Submit</button>
            </form>
            

    </div>
</div>


