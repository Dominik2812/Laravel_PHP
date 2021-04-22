        
<link rel="stylesheet" href="css/week.css">
        <table>
            <tr>
                <th></th>
                    <th scope="col">06</th>
                    <th scope="col">08</th>
                    <th scope="col">10</th>
                    <th scope="col">12</th>
                    <th scope="col">14</th>
                    <th scope="col">16</th>
                    <th scope="col">18</th>
                    <th scope="col">20</th>

            </tr>
            <tr>
                <th scope="row">Montag</th>
                    <td class= "_0" id="_06"></td>
                    <td class= "_0" id="_08"></td>
                    <td class= "_0" id="_10"></td>
                    <td class= "_0" id="_12"></td>
                    <td class= "_0" id="_14"></td>
                    <td class= "_0" id="_16"></td>
                    <td class= "_0" id="_18"></td>
                    <td class= "_0" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Dienstag</th>
                <td class= "_1" id="_06"></td>
                <td class= "_1" id="_08"></td>
                <td class= "_1" id="_10"></td>
                <td class= "_1" id="_12"></td>
                <td class= "_1" id="_14"></td>
                <td class= "_1" id="_16"></td>
                <td class= "_1" id="_18"></td>
                <td class= "_1" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Mittwoch</th>
                <td class= "_2" id="_06"></td>
                <td class= "_2" id="_08"></td>
                <td class= "_2" id="_10"></td>
                <td class= "_2" id="_12"></td>
                <td class= "_2" id="_14"></td>
                <td class= "_2" id="_16"></td>
                <td class= "_2" id="_18"></td>
                <td class= "_2" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Donnerstag</th>
                <td class= "_3" id="_06"></td>
                <td class= "_3" id="_08"></td>
                <td class= "_3" id="_10"></td>
                <td class= "_3" id="_12"></td>
                <td class= "_3" id="_14"></td>
                <td class= "_3" id="_16"></td>
                <td class= "_3" id="_18"></td>
                <td class= "_3" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Freitag</th>
                <td class= "_4" id="_06"></td>
                <td class= "_4" id="_08"></td>
                <td class= "_4" id="_10"></td>
                <td class= "_4" id="_12"></td>
                <td class= "_4" id="_14"></td>
                <td class= "_4" id="_16"></td>
                <td class= "_4" id="_18"></td>
                <td class= "_4" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Samstag</th>
                <td class= "_5" id="_06"></td>
                <td class= "_5" id="_08"></td>
                <td class= "_5" id="_10"></td>
                <td class= "_5" id="_12"></td>
                <td class= "_5" id="_14"></td>
                <td class= "_5" id="_16"></td>
                <td class= "_5" id="_18"></td>
                <td class= "_5" id="_20"></td>
            </tr>
            <tr>
                <th scope="row">Sonntag</th>
                <td class= "_6" id="_06"></td>
                <td class= "_6" id="_08"></td>
                <td class= "_6" id="_10"></td>
                <td class= "_6" id="_12"></td>
                <td class= "_6" id="_14"></td>
                <td class= "_6" id="_16"></td>
                <td class= "_6" id="_18"></td>
                <td class= "_6" id="_20"></td>
            </tr>

        </table>




        @if( $events ?? '')
        <script> einträge =[] </script>
        @foreach ($events as $item)
        <?php $id= $item->id?>
        <?php $name = $item->name?>
        <?php $startTime= substr($item->startDateTime,-8,-6)?>
        <?php $startDate= substr($item->startDateTime,-19,-9)?>

        <script>
            var id = '<?php echo json_encode($id); ?>';
            var name = <?php echo json_encode($name); ?>;
            var startDate = <?php echo json_encode($startDate); ?>;
            var startTime = <?php echo json_encode($startTime); ?>;
            eintrag=[id,name, startDate, startTime];
            einträge.push(eintrag);
        </script>


        @endforeach


        <script>


            for(i in einträge){

                var curr = new Date();
                var first = curr.getDate() - curr.getDay();
                var choicedate = einträge[i][2]
                choicedate= new Date(choicedate)
                var choiceday=choicedate.getDate()
                einträge[i].push(choiceday-first)
                Tag=choiceday-first-1
                Tag=String(Tag)
                Stunde=einträge[i][3]
                console.log(Tag)
                td=document.querySelector("._"+Tag+"#_"+Stunde)
                td.textContent= einträge[i][0] + ' : ' +einträge[i][1]
                console.log(td)



            };




        </script>
        @endif





