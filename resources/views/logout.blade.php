<!DOCTYPE html>
<html lang="en">
<head>
    <title>Выход</title>
</head>
<body>
<h1>Выход</h1>
<hr>
<form method="post" action="{{ route('logout') }}">

    @csrf

    <button type="submit">Выход</button>
</form>

<hr>

</body>
</html>
