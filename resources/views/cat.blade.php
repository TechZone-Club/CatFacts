<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary">Cat Facts</h1>
            <p class="lead">Get interesting facts about cats by entering the number of facts you'd like to see.</p>
        </div>
        <form action="{{ url('/cat-facts') }}" method="POST" class="w-50 mx-auto p-4 bg-white shadow rounded">
            @csrf
            <div class="mb-3">
                <label for="num_facts" class="form-label">Enter number of cat facts:</label>
                <input type="number" id="num_facts" name="num_facts" min="1" max="100" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Get Cat Facts</button>
            </div>
        </form>
    </div>
</body>
</html>
