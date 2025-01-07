<!DOCTYPE html>
<html>
<head>
    <title>Cat Facts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: square;
        }
    </style>
</head>
<body>
    <h1>Cat Facts</h1>
    <ul>
        @foreach ($facts as $fact)
            <li>{{ $fact['fact'] }}</li>
        @endforeach
    </ul>
</body>
</html>
