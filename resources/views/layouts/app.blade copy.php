<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- To use bootstrap and configure the UI in Laravel 8, do the following:
            1- run on terminal (not on git bash of vs code): 
                composer require laravel/ui
            2- also: 
                php artisan ui bootstrap
            3- then: 
                npm install
            4- lastly:  
                npm run dev
            GOT AN ERROR????? TRY THESE:
                run: composer install
                run: npm install
                run: npm run dev
    -->
    
    <!-- CSS files: -->
    <!-- asset() is also from the blade syntax i think -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    
    <title>{{config('app.name','Laravel App')}}</title>
</head>

<body>

    @include('inc.navbar')
    <br><br><br>
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>


    <!-- JS files: -->
    <!-- notice that the bootstrap is not duplicated, this one is js not css-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    
    <!-- ck editor -->
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>


</body>

</html>