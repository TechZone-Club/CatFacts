<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary">List of Cat Facts PDFs</h1>
        </div>
        <form action="{{ url('/pdf-list') }}" method="GET" class="mb-4">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search PDFs..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
        <ul class="list-group">
            @foreach ($pdfFiles as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ url('pdfs/' . $file) }}" download class="text-decoration-none text-dark">{{ $file }}</a>
                    <form action="{{ route('cat.delete_pdf', ['file' => $file]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?')">
                    <a href="{{ url('pdfs/' . $file) }}" target="_blank" class="btn btn-info btn-sm me-2">View</a>
                        <!-- Nút Download -->
                        <a href="{{ url('pdfs/' . $file) }}" download class="btn btn-success btn-sm me-2">Download</a>   
                    @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
