@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Channel Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Channel Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Channel ID: {{$channel->id}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" disabled class="form-control" id="exampleInputEmail1" placeholder="Channel Name" value="{{$channel->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Device Type</label>
                                    <input type="text" disabled class="form-control" id="exampleInputPassword1" placeholder="Device Type" value="{{$channel->device_type}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">MicroController Type</label>
                                    <input type="text" disabled class="form-control" id="exampleInputPassword1" placeholder="MicroController Type" value="{{$channel->micon_type}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">API Token</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="text" class="form-control" id="exampleInputFile" value="@if ($token) {{$token->token}}  @endif">
                                        </div>
                                        <div class="input-group-append">
                                            <a href="/generate/{{$channel->id}}/" class="btn btn-warning btn-sm"><i class="fas fa-sync-alt"></i> Generate</a>
                                            <!-- <span class="input-group-text" id=""><i class="fas fa-sync-alt"></i>Generate</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="card" style="padding:30px;">
            <div class="form-group" style ="width:300px;margin:auto;">
                <label for="_display">Chart Display</label>
                <select class="form-control"  id="_display" onchange="reDraw(this)">
                    <option value="1">1 Jam</option>
                    <option value="2">1 Hari</option>
                    <option value="3">1 Minggu</option>
                    <option value="4">2 Minggu</option>
                    <option value="5">1 Bulan</option>
                    <option value="6">3 Bulan</option>
                </select>
            </div>
        </div>
        <div class="row">
            @foreach($field as $f)             
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$f->name}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p id="time_{{$f->id}}"></p>
                        <div class="chart">
                            <canvas id="line_{{$f->id}}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;overflow-y:auto"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @endforeach
            <!-- /.col (RIGHT) -->
        </div>
    </div>
    <input type="hidden" id="_field" value = '<?= json_encode($field) ?>'>
</section>
@endsection

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/js/demo.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<!-- page script -->
<script>

    var field;
    var mode = 1;

    function reDraw(data) {
        mode = data.value;
        getData();
    }

    function getData() {

        for(var w = 0 ; w < field.length; w ++) {    
            $.ajax({
                type: "POST",
                url: '<?= url('/channel/data') ?>', // This is what I have updated
                data: { id: field[w].id, mode : mode}
            }).done(function( data ) {
                console.log(data);
                makeChart(data);
            });
        }
    }
    function randomColorFactor() {
        return Math.round(Math.random() * 255);
    }
    function randomColor(opacity) {
        return (
            "rgba(" +
            randomColorFactor() +
            "," +
            randomColorFactor() +
            "," +
            randomColorFactor() +
            "," +
            (opacity || ".3") +
            ")"
        );
    }
    function makeChart(data) {
        var time = '';
        var labels = [];
        var datasets = [];
        var date = '';
        var id=0;
        for(var w = 0 ; w < data.length ; w ++) {
            var mmnt = moment(data[w].date + ' ' + data[w].time);
            datasets.push(data[w].nilai);
            labels.push(mmnt.format('D-MM-YY h:mm'));
            date = data[w].date;
            time = data[w].time;
            id = data[w].field_id;
        }
        var chart_data = {
            labels:labels,
            datasets: [{
                    label: date,
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: true,
                    pointColor: randomColor(0.7),
                    pointStrokeColor: randomColor(0.5),
                    pointHighlightFill: randomColor(0.2),
                    pointHighlightStroke: randomColor(0.6),
                    pointBorderWidth: 2,
                    data: datasets
                },
            ]
        }
        var chart_options = {
            animation: {
                duration: 0
            },
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            pan: {
                // Boolean to enable panning
                enabled: true,

                // Panning directions. Remove the appropriate direction to disable 
                // Eg. 'y' would only allow panning in the y direction
                mode: 'y',

                speed: 1
            },

            // Container for zoom options
            zoom: {
                // Boolean to enable zooming
                enabled: true,                      
                // Zooming directions. Remove the appropriate direction to disable 
                // Eg. 'y' would only allow zooming in the y direction
                mode: 'y',
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }
        document.getElementById('time_'+id).innerHTML = 'Last Update ' + date + ' ' + time;
        var lineChartCanvas = $('#line_'+id).get(0).getContext('2d')
        var lineChartOptions = jQuery.extend(true, {}, chart_options)
        var lineChartData = jQuery.extend(true, {}, chart_data)
        lineChartData.datasets[0].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    }

    $(function() {
        field = JSON.parse(document.getElementById('_field').value);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        getData();
        setInterval(() => {
            getData();
        }, 10 * 1000);
    })
</script>
</body>

</html>