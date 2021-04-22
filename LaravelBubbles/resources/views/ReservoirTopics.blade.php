
@if(@isset($rows))
    <script>
        var myArr = '<?php  echo $json; ?>';

        
    </script>
    @else
    <script>
        var myArr = '[]';
    </script>
@endif
<?php  echo $json; ?>
<div class="card" id="reservoir">
    <div class = "card-body">
        <h4 class="card-title" style="color: whitesmoke; font: bold"> Reservoir </h4>
            <div id="wrapper" style="background-color: rgb(255, 255, 255)">
                <div style="margin-left:80px;" id="chart"></div>
            </div>
    </div>
</div>
<script type="text/javascript" src="/js/reservoir.js"></script>




