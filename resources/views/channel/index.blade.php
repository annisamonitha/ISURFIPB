<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col-6">
                <h1>Data Channel ({{$count_channel}})</h1>
            </div>
            <div class="col-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Channel
                </button>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Device Type</th>
                    <th>Micon Type</th>
                    <th>Metadata</th>
                    <th>Description</th>
                    <th>User ID</th>
                    <th>Action</th>
                </tr>
                @foreach($data_channel as $channel)
                <tr>
                    <td>{{$channel->name}}</td>
                    <td>{{$channel->device_type}}</td>
                    <td>{{$channel->micon_type}}</td>
                    <td>{{$channel->metadata}}</td>
                    <td>{{$channel->description}}</td>
                    <td>{{$channel->user_id}}</td>
                    <td><a href="/channel/{{$channel->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/channel/{{$channel->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin dihapus?')">Delete</a></td>
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
                            <input name="user_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
<!-- 
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