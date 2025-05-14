@extends("partials.layout")

@section("title")
    Statistika rezervacija
@endsection

@section("content")
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Grafikon: Broj rezervacija po stolu</h1>
    </div>

    <div id="barchart" style="width: 100%; height: 500px;"></div>
</div>

{{-- Google Charts --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Sto', 'Broj rezervacija'],
            @foreach ($data as $item)
                ['{{ $item['naziv'] }}', {{ $item['broj'] }}],
            @endforeach
        ]);

        var options = {
            title: 'Broj rezervacija po stolu',
            hAxis: {
                title: 'Naziv stola',
                slantedText: true,
                slantedTextAngle: 45,
                showTextEvery: 1,
                textStyle: {
                    fontSize: 12
                }
            },
            vAxis: {
                title: 'Broj rezervacija',
                ticks: [1,2,3,4,5,6,7,8,9,10],
                minValue: 0,
                textStyle: {
                    fontSize: 12
                }
            },
            legend: { position: 'none' },
            chartArea: { width: '70%', height: '70%' },
            bar: { groupWidth: '70%' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
        chart.draw(data, options);
    }
</script>
@endsection
