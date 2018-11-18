<div class="w3-container">
<canvas id="PieChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('PieChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [ {{ $amount }} ],
                backgroundColor: [

    				<?php foreach ($rgbs as $rgb) { ?>
                    	"{{$rgb}}", 
					<?php } ?>
                ] ,
                label : 'sample 1',
            }],
            labels: [
    				<?php foreach ($legend as $l) { ?>
                    	"{{$l}}", 
					<?php } ?>
            ],
        },
    options: {
        responsive: true
    }
    });
    </script>
</div>

