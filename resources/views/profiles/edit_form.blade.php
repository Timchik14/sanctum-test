@csrf
@include('layouts.errors')

Имя:
<input type="text" id="slug" name="name" value="{{ old('name', auth()->user()->name) }}">
<br>
<br>
Пол:
<input type="text" id="sex" name="sex" value="{{ old('sex', $profile->sex) }}">
<br>
<br>
Город:
<input type="text" id="city" name="city" value="{{ old('', $profile->city) }}">
<br>
<br>
Возраст:
<input type="text" id="age" name="age" value="{{ old('', $profile->age) }}">

<br>
<br>
<button type="submit">Принять</button>
