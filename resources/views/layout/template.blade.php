<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('header-title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <style>
        body { padding-bottom: 70px; }

        #header a{
            color: white;
            font-family: 'Times New Roman', Times, serif;
        }

        #register{
            margin-top: 215px;
        }

        #login{
            margin-top: 240px;
        }

        #main-content{
            margin-top: 120px;
        }



        #footer{
            color: white;
            font-family: 'Times New Roman', Times, serif;
            padding: 0px 10px;
            margin-top: 10px;
        }

        .dropdown-item:hover{
            background-color: blue;
        }

        .form{
            margin-top: 5%
        }
    </style>
</head>
<body>

    {{--  Header  --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-primary" id="header">
        <div class="container-fluid">
          <a class="navbar-brand" href="/home">Book Store</a>
            @if(Auth::check())
                @if (Auth::user()->roles == 'Member')
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/viewCart">View Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/histories">View Transaction History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        {{--  <li><a class="dropdown-item" href="/changePassword">Change Password</a></li>  --}}
                        <li><a class="dropdown-item" href="{{route('logout')}}">Log Out</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
            @elseif(Auth::user()->roles == 'Admin')
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Manage
                        </a>
                        <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/manageBook">Books</a></li>
                        <li><a class="dropdown-item" href="/genre">Genre</a></li>
                        <li><a class="dropdown-item" href="/manageUser">User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        {{--  <li><a class="dropdown-item" href="/changePassword">Change Password</a></li>  --}}
                        <li><a class="dropdown-item" href="{{route('logout')}}">Log Out</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
                @endif
            @else
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/register">Register</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                        </li>
                    </ul>
                    </div>
                </div>
            @endif
      </nav>

      <div class="container" id="main-content">
        @yield('main-content')
      </div>

      <div class="footer bg-primary navbar fixed-bottom" id="footer">
        <div class="text-start">
            <p id="date"></p>
        </div>
        <div class="text-center">
            Copyright &copy 2021 Book Store;
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">

        function getHour(hour){
            if(hour >= 12) return hour-12;
            return hour
        }

        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        var day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        var today = new Date();
        var date = day[today.getDay()] + ', '+ month[today.getMonth()] + ' ' +today.getDate() + ',' + today.getFullYear();
        var time = "0" + getHour(today.getHours()) + " : " + today.getMinutes() + " PM";
        var dateTime = date+' '+time;
        document.getElementById("date").innerHTML = dateTime;
    </script>
</body>
</html>
