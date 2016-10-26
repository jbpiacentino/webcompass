<!DOCTYPE html>
<html lang="en">
<head>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/tether.min.css')}}">


        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

        @yield('header')

    </head>
    <body>
        <div class="container">

            

            <div class="col-md-6 col-md-offset-3">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (count($errors))          
                    <ul class="list-group">    
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                
                @yield('content')    
            </div>        
            
        </div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
