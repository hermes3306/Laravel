@include ('tots.header')

<div>
<canvas id="myChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'line',
        data: {
             labels: [  {{ $legend}}  ],
        datasets: [
            {   label: "KW:",
                backgroundColor: 'rgb(0,255,0)', borderColor: 'rgb(0,255,0)',
				data: [  {{ $moneys["kw"] }}   ], fill: false },
            {   label: "WR1:",
                backgroundColor: 'rgb(0,0,255)', borderColor: 'rgb(0,0,255)',
                data: [  {{ $moneys["wr1"] }}   ], fill: false },
            {   label: "WR2:",
                backgroundColor: 'rgb(0,255,0)', borderColor: 'rgb(0,255,0)',
                data: [  {{ $moneys["wr2"] }}   ], fill: false },
            {   label: "HA:",
                backgroundColor: 'rgb(0,0,255)', borderColor: 'rgb(0,0,255)',
                data: [  {{ $moneys["ha"] }}   ], fill: false },
            {   label: "HD:",
                backgroundColor: 'rgb(255,0,0)', borderColor: 'rgb(255,0,0)',
                data: [  {{ $moneys["hd"] }}   ], fill: false },
            {   label: "WO:",
                backgroundColor: 'rgb(128,0,0)', borderColor: 'rgb(128,0,0)',
                data: [  {{ $moneys["wo"] }}   ], fill: false },
            {   label: "XI:",
                backgroundColor: 'rgb(128,0,0)', borderColor: 'rgb(128,0,0)',
                data: [  {{ $moneys["xi"] }}   ], fill: false },
            {   label: "OK:",
                backgroundColor: 'rgb(255,128,0)', borderColor: 'rgb(255,128,0)',
                data: [  {{ $moneys["ok"] }}   ], fill: false },
            ]
        },
    options: {}
    });
    </script>
</div>

@include ('tots.showtab')
@include ('tots.tail')
