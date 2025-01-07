<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts</title>
</head>
<body>
    <h1>Cat Facts</h1>
    <ol>
        @foreach ($facts as $fact)
            <li>{{ $fact['fact'] }}</li>
        @endforeach
    </ol>
</body>
</html>
