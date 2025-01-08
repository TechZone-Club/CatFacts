<!DOCTYPE html>
<html>
<head>
    <title>Cat Facts</title>
</head>
<body>
    <h1>Danh sách các sự thật thú vị về mèo</h1>
    <ul>
        @foreach($facts as $fact)
            <li>{{ $fact['fact'] }}</li>
        @endforeach
    </ul>
</body>
</html>
