<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts</title>
</head>
<body>
    <h1>Cat Facts Generator</h1>
    <form method="POST" action="{{ route('generate.pdf') }}">
        @csrf
        <label for="number">Enter number of facts:</label>
        <input type="number" name="number" id="number" min="1" required>
        <button type="submit">Get Facts</button>
    </form>

    @if (isset($pdfFiles) && count($pdfFiles) > 0)
        <h2>Available PDF Files</h2>
        <ul>
            @foreach ($pdfFiles as $file)
                <li>
                    <a href="{{ asset('storage/' . $file) }}" download>{{ $file }}</a>

                    <!-- Form xóa file -->
                    <form action="{{ route('delete.pdf', $file) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')">
                            Delete
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @elseif(isset($pdfFiles) && count($pdfFiles) == 0)
        <p>No PDF files found!</p>
    @endif

    
</body>

</html>


