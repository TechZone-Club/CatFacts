<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF List</title>
</head>
<body>
    <h1>List of Cat Facts PDFs</h1>

    <ul>
        @foreach ($pdfFiles as $file)
            <li>
                <a href="{{ url('pdfs/' . $file) }}" download>{{ $file }}</a>
                <!-- Nút xóa -->
                <form action="{{ route('cat.delete_pdf', ['file' => $file]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
