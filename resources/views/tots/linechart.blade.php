<div>
<canvas id="myLineChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myLineChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'line',
        data: {
             labels: [  	{{$legend}}  ],
        datasets: [{
        label: "{{$title}}:",
            backgroundColor: "{{$rgbs}}",
            borderColor: "{{$rgbs}}",
            data: [  {{$moneys }}   ],
            fill: false
            },
            ]
        },
    options: {}
    });
    </script>
</div>

