<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF List</title>
</head>
<body>
    <h1>Saved PDF Files</h1>
    <ul>
        @foreach ($pdfFiles as $file)
            <li>
                <a href="{{ asset('storage/' . $file) }}" download>
                    {{ $file }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
