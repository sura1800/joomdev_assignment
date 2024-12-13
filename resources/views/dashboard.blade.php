<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="bg-light">
    <div class="container mt-5">
    <a href="{{route('login')}}"><button type="button" class="btn btn-warning mb-5">User Login</button></a>
    <button type="button" id="register_btn" class="btn btn-success mb-5">Add User</button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


    <table class="table table-bordered text-center bg-white">
        <thead>
            <tr style="background-color:#ccffff;">
                <th style="width:5%;">Sl.No.</th>                
                <th style="width:15%;">User Name</th>
                <th style="width:15%;">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key=>$user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>  
    </div>


    <!--===================================> Register User Modal <==================================-->

    <div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('user.register')}}" method="POST">@csrf
            <div class="modal-body">
                <div class="col-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="col-12 mt-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-12 mt-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>


</body>
</html>

<script>
    $("#register_btn").click(function(){
        $("#register_modal").modal('show');
    })
</script>