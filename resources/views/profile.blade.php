<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/01b4b6f929.js" crossorigin="anonymous"></script>
</head>
<body>
    {{-- Navigation bar for logged in user --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">User Profile Project</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$user->name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="profile">My Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-sm-5">
                <h4 class="text-center">My Profile</h3>
                <hr>
                <div class="profile-form-div p-4" style="background: #FFFCF7; border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
                    <form action="{{url('update-profile')}}" method="POST">

                        {{-- Success alert if the user is saved sucessfully --}}
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
    
                        {{-- Fail alert if the user is not saved successfully --}}
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
    
                        {{-- This is a security token in Laravel for security purposes: It must be added --}}
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name ?? ''}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{$user->email ?? ''}}">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-success">Update</button>                    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>