<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts PDF Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Cat Facts PDF Generator</h1>
        <form id="catFactsForm" class="mt-4" method="POST" action="{{ route('generate.pdf') }}">
            @csrf
            <div class="mb-3">
                <label for="number" class="form-label">Number of Cat Facts:</label>
                <input type="number" class="form-control" id="number" name="number" placeholder="Enter a number" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate PDF</button>
        </form>
    </div>
</body>
</html>
