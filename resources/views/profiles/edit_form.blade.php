@csrf
@include('layouts.errors')

Имя:
<input type="text" id="slug" name="name" value="{{ old('name', auth()->user()->name) }}">
<br>
<br>
Пол:
<input type="radio" id="male" name="sex" {{ $profile->sex == 'male' ? 'checked' : '' }} value="male">муж
<input type="radio" id="female" name="sex" {{ $profile->sex == 'female' ? 'checked' : '' }} value="female">жен
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
