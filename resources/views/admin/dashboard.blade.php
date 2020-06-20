 @extends('layouts.master')

 @section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1>Dashboard</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Blank Page</li>
                 </ol>
             </div>
         </div>
     </div><!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
             <div class="col-lg-6 col-6">
                 <!-- small box -->
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3>{{$count_channel}}</h3>

                         <p>Total Channel</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-microchip"></i>
                     </div>
                     <a href="/channel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-6 col-6">
                 <!-- small box -->
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h3>{{$count_field}}</h3>

                         <p>Total Field</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-satellite-dish"></i>
                     </div>
                     <a href="/field" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
         </div>
         <!-- /.row -->
     </div>

     <!-- Default box -->
     <!-- <div class="card">
         <div class="card-header">
             <h3 class="card-title">Title</h3>

             <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                     <i class="fas fa-minus"></i></button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                     <i class="fas fa-times"></i></button>
             </div>
         </div>
         <div class="card-body">
             Start creating your amazing application!
         </div> -->
     <!-- /.card-body -->
     <!-- <div class="card-footer">
             Footer
         </div> -->
     <!-- /.card-footer-->
     <!-- </div> -->
     <!-- /.card -->

 </section>
 <!-- /.content -->
 @endsection

 <!-- <p>Total Channel = {{$count_channel}}</p>
<table>
    <tr>
        <th>Name</th>
        <th>Device Type</th>
        <th>Micon Type</th>
        <th>Metadata</th>
        <th>Description</th>
        <th>User ID</th>
    </tr>
    @foreach($data_channel as $channel)
    <tr>
        <td>{{$channel->name}}</td>
        <td>{{$channel->device_type}}</td>
        <td>{{$channel->micon_type}}</td>
        <td>{{$channel->metadata}}</td>
        <td>{{$channel->description}}</td>
        <td>{{$channel->user_id}}</td>
    </tr>
    @endforeach
</table>

<br>
<p>Total Field = {{$count_field}}</p>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Channel ID</th>
    </tr>
    @foreach($data_field as $field)
    <tr>
        <td>{{$field->id}}</td>
        <td>{{$field->name}}</td>
        <td>{{$field->channel_id}}</td>
    </tr>
    @endforeach
</table> -->