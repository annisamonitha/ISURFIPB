@extends('layouts.master')

@section('content')



<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data Channel</h1>
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
                            <h3>Total Channel: {{$count_channel}}</h3>
                        </div>
                        <div class="col-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                                Tambah Channel
                            </button>
                        </div>
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Device Type</th>
                                <th>Micon Type</th>
                                <th>Metadata</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data_channel as $channel)
                            <tr>
                                <td>{{$channel->id}}</td>
                                <td>{{$channel->name}}</td>
                                <td>{{$channel->device_type}}</td>
                                <td>{{$channel->micon_type}}</td>
                                <td>{{$channel->metadata}}</td>
                                <td>{{$channel->description}}</td>
                                <td>
                                    <a href="/channel/{{$channel->id}}/detail" class="btn btn-success btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="/channel/{{$channel->id}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="/channel/{{$channel->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin dihapus?')"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

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
                                <form action="/channel/create" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Channel</label>
                                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Channel">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Device Type</label>
                                        <input name="device_type" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Device Type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Micon Type</label>
                                        <input name="micon_type" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Micon Type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Metadata</label>
                                        <input name="metadata" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Metadata">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User ID</label>
                                        <input readonly name="user_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID" value="{{Session::get('user_id')}}">
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
            </div>
        </div>
    </div>
</div>
@endsection