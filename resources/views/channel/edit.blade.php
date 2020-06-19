<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit Channel</h1>
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <form action="/channel/{{$channel->id}}/update" method="POST">
                    {{csrf_field()}}
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
                        <input name="user_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID" value="{{$channel->user_id}}">
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>