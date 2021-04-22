
<html>
    <head>
        <title>Bubbles</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="David Foliti">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/grid.css" rel="stylesheet">
        <link rel="stylesheet" href="css/week.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script type="text/javascript"  src="https://d3js.org/d3.v5.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>

        


    </head>

    <body>
        
    

    
        <nav class="navbar navbar-expand-lg bg-light techfont">
            <div class="container">
                <p>
                    <a class="list-group-item list-group-item-action active" href="/EventList" style="background-color: rgb(2, 151, 170); font-size:50;">Event List</a>
                </p>
                <p>
                    <a class="list-group-item list-group-item-action active" href="/Topics" style="background-color: rgb(2, 151, 170); font-size:50;">Topics</a>

                </p>
                <p>
                    <a  class="list-group-item list-group-item-action active" href="/" style="background-color: rgb(2, 151, 170); font-size:50;">Organizer</a>
                </p>

            </div>
        </nav>
    <div id='bulk'>
        <aside>
            @include('CreateTopic')
            @include('SearchTopic')
        </aside>

        @yield('content')
    </div>
    </body>
</html>


