<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="bg-light">
    <div class="container mt-5">
        <a href="{{route('user.logout')}}"><button type="button" class="btn btn-danger mb-5">logout</button></a>
        <a href="{{route('user.change_password')}}"><button type="button" class="btn btn-warning mb-5">Change Password</button></a>
        <a href="{{route('user.profile')}}"><button type="button" class="btn btn-success mb-5">My Profile</button></a>

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

            <div class="row">  
                <div class="col-4 mx-auto d-block">
                    <div class="card bg-white">
                        <div class="card-body">
                            <p class="text-center">Hello, {{$user->name}}</p>
                            <h4 class="text-center">Welcome To Dashboard</h4>
                        </div>
                    </div>
                </div>
            </div>

 
    </div>

</body>
</html>

