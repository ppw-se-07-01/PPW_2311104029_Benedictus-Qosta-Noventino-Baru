<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard dari Controller</h1>
</body>

</html>
mahasiswa.blade.php
<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <h1>Perulangan FOR</h1>
    @for ($i = 1; $i <= 10; $i++)
        {{ $i }} <br>
    @endfor
    <h1>Perulangan WHILE</h1>
    @php $i = 1; @endphp
    @while ($i <= 10)
        {{ $i }} <br>
        @php $i++; @endphp
    @endwhile
    <h1>Perulangan FOREACH (Nilai)</h1>
    @foreach ($nilai as $n)
        Nilai: {{ $n }} <br>
    @endforeach
    <img src="{{ asset('assets/img/logo.png') }}" width="150">
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>