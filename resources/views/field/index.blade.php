@extends('layouts.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Field</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header">
                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div> -->
                    <!-- /.card-header -->
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Field
                                </button>
                            </div>
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Channel ID</th>
                                </tr>
                                @foreach($data_field as $field)
                                <tr>
                                    <td>{{$field->name}}</td>
                                    <td>{{$field->channel_id}}</td>
                                    <td>
                                        <a href="/field/{{$field->id}}/detail" class="btn btn-success btn-sm"><i class="fas fa-info-circle"></i></a>
                                        <a href="/field/{{$field->id}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="/field/{{$field->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin dihapus?')"><i class="fas fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/field/create" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Field</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Channel">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Channel Name</label>
                        <!-- <input name="device_type" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Device Type"> -->

                        <select class="form-control" name="channel_id" id="cars">
                            @foreach($data_channel as $channel)
                            {{$channel->id}}
                            <option value="{{$channel->id}}">{{$channel->name}}</option>
                            @endforeach


                        </select>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection