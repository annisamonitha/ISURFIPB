@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <h3>Total Field: {{$count_field}}</h3>
                        </div>
                        <div class="col-6">
                        </div>
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Channel ID</th>
                                <th>Download</th>
                                <th>Show Graph</th>
                            </tr>
                            @foreach($data_field as $field)
                            <tr>
                                <td>{{$field->name}}</td>
                                <td>{{$field->channel_id}}</td>
                                <td>
                                    <a href="/field/{{$field->id}}/download_data" class="btn btn-success btn-sm"><i class="fas fa-file-download"></i> Download CSV</a></td>
                                <td>
                                    <a href="/field/{{$field->id}}/show" class="btn btn-primary btn-sm"><i class="fas fa-chart-line"></i> Show Graph</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection