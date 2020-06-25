@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Field</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit Field</li>
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
                        <h3 class="card-title">Data Field</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/field/{{$field->id}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Field</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Field" value="{{$field->name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Channel Name</label>
                                <!-- <input name="channel_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Device Type" value="{{$field->channel_id}}"> -->
                                <select class="form-control" name="channel_id" id="cars">
                                    @foreach($data_channel as $channel)
                                    <option @if ($channel->id == $field->channel_id)
                                        selected
                                        @endif
                                        value="{{$channel->id}}">{{$channel->name}}</option>
                                    @endforeach


                                </select>
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