<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        {{ config('app.name', 'Laravel') }}
    </title>


    <!-- Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          rel="stylesheet">

</head>


<body>


<div id="app">


<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

    <div class="container">


        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>



        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>



        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">


            <ul class="navbar-nav mr-auto">

            </ul>



            <ul class="navbar-nav ml-auto">


                @guest


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('login') }}">

                        Login

                    </a>

                </li>



                @else



                <li class="nav-item dropdown">


                    <a class="nav-link dropdown-toggle"
                       href="#"
                       id="navbarDropdown"
                       role="button"
                       data-toggle="dropdown">


                        {{ Auth::user()->name }}

                    </a>



                    <div class="dropdown-menu dropdown-menu-right">


                        <a class="dropdown-item"
                           href="#"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">

                            Logout

                        </a>



                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              style="display:none;">

                            @csrf

                        </form>


                    </div>


                </li>


                @endguest


            </ul>


        </div>


    </div>


</nav>



<main class="py-4">

    @yield('content')

</main>



</div>




<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>