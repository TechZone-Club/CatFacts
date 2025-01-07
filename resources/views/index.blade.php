<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts</title>
</head>
<body>
    <h1>Cat Facts</h1>
    <form method="GET" action="{{ route('get-cat-facts') }}">
        <label for="number">Số lượng sự thật về mèo:</label>
        <input type="number" id="number" name="number" min="1" max="100" required>
        <button type="submit">Lấy thông tin</button>
    </form>
</body>
</html>
