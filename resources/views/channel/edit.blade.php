@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Channel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit Channel</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Channel</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/channel/{{$channel->id}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Channel</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Channel" value="{{$channel->name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Device Type</label>
                                <input name="device_type" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Device Type" value="{{$channel->device_type}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Micon Type</label>
                                <input name="micon_type" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Micon Type" value="{{$channel->micon_type}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Metadata</label>
                                <input name="metadata" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Metadata" value="{{$channel->metadata}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" val>{{$channel->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User ID</label>
                                <input readonly name="user_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID" value="{{$channel->user_id}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection