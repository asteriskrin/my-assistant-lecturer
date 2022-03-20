{{-- This is master template --}}
<!DOCTYPE html>
<html>
    <head>
        <title>{{ env('APP_NAME', 'App Name') }} - @yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
</html>