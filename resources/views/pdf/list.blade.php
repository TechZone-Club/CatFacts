<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách file PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách file PDF đã lưu</h1>
    
    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Tên File</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfFiles as $index => $file)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $file }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $file) }}" class="btn btn-primary" download>Tải xuống</a>
                        <!-- Nút "Xóa" -->
                        <form action="{{ route('delete-pdf', $file) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
