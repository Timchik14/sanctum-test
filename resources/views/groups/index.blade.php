<p>Выберите или создайте новую группу</p>
<select name="groups">
    <option value="">Выберите</option>
@foreach($groups as $group)
        <option id="groups" name="groups" value="{{ $group->name }}">{{ $group->name }}</option>
@endforeach
</select>

<p>
    <input type="text" id="groups" name="groups_text" >Название группы
</p>
