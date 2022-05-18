<b>Пользователь:</b> {{ $file->user->name }}
<b>Файл:</b>
<a href="{{ route('download', ['file' => $file]) }}">
    {{ $file->name }}
</a>
<b>Формат:</b> {{ $file->format }}
<b>Группа:</b> {{ $file->group->name }}
<b>Скачиваний:</b> {{ $file->count }}
