<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">PDF List</h1>
        
        <!-- Success message after deletion -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Back to Home Button -->
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Home</a>

        <!-- PDF Files List -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size (KB)</th>
                    <th>Facts Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $file)
                    <tr>
                        <td>{{ $file['name'] }}</td>
                        <td>{{ number_format($file['size'] / 1024, 2) }}</td>
                        <td>{{ $file['facts_count'] }}</td>
                        <td>
                            <!-- Correct Download Link -->
                            <a href="{{ route('download.pdf', ['filename' => $file['name']]) }}" class="btn btn-success btn-sm">Download</a>

                            <!-- Delete Form -->
                            <form action="{{ route('pdf.delete', $file['name']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No PDFs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
