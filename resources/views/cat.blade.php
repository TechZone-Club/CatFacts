<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts</title>
</head>
<body>
    <h1>Cat Facts</h1>

    <form action="{{ url('/cat-facts') }}" method="POST">
        @csrf
        <label for="num_facts">Enter number of cat facts:</label>
        <input type="number" id="num_facts" name="num_facts" min="1" max="100" required>
        <button type="submit">Get Cat Facts</button>
    </form>
</body>
</html>
