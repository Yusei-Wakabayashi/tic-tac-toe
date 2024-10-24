<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>tic-tac-toe</title>
</head>
<body>
<form action="{{ url('/room/check') }}" method="GET">
    {{csrf_field()}}
    <h1>tic-tac-toe</h1>
    <button type="submit" class="add">マッチング</button>
</form>
</body>
</html>