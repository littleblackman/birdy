<?php use_helper('dates');?>
<li>
    <div class="collapsible-header">
        <h5>
            <i class="fas fa-user-check"></i>
            Détail des présences
        </h5>
    </div>
    <div class="collapsible-body">
        <table class="striped" >
            <thead>
                <tr>
                    <th>Sessions</th>
                    <th style="width: 30px">A</th>
                    <th style="width: 30px">P</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($studentPresenceList as $key => $checkpoint):?>
                    <tr>
                        <td>
                            <?= $sessionKey = showDate($checkpoint['sessionInfo']['date'], 'd/m/y').' '.showHour($checkpoint['sessionInfo']['start']);?>
                        </td>
                        <td>
                            <a class="modal-trigger" href="#modal<?= $key;?>">
                                <?= $absence = isset($checkpoint['absent']) ? count($checkpoint['absent']) : '0';?>
                            </a>
                            <div id="modal<?= $key;?>" class="modal">
                                <div class="modal-content">
                                    <?php if(isset($checkpoint['absent'])):?>
                                        <h5>
                                            Absent(s) - 
                                            <?= $sessionKey;?>
                                        </h5>
                                        <br/>
                                        <ul>
                                            <?php foreach($checkpoint['absent'] as $student):?>
                                                <li><?= $student['lastname'].' '.$student['firstname'];?></li>
                                            <?php endforeach;?>
                                        </ul>
                                    <?php endif;?>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?= $presence = isset($checkpoint['present']) ? count($checkpoint['present']) : '0';?>
                        </td>
                    </tr>
                    <?php $stat[] = [showDate($checkpoint['sessionInfo']['date'], 'd/m'), $presence*100/$classroom->getNbStudents() ,$presence, intval($absence) ];?> 
                <?php endforeach;?>

                <?php $stats = array_reverse($stat);?>
            </tbody>
        </table>
    </div>
</li>

<div id="curve_chart" style="width: 900px; height: 500px"></div>




<script>
   
   window.onload = function() {

    let js_array = <?php echo json_encode($stats)?>;

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Session');
        data.addColumn('number', 'Taux de présence en %');
        data.addColumn('number', 'Présence');
        data.addColumn('number', 'Absence');

        data.addRows(js_array);

        let options = {
          title: 'Taux de présence',
          legend: { position: 'bottom' }
        };

        let chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
   }

</script>
