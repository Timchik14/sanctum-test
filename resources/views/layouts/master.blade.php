<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
</head>
<body>

@auth()
    <a href="{{ route('personal') }}">Личный кабинет</a>
@endauth

@yield('content')

</body>
</html>
