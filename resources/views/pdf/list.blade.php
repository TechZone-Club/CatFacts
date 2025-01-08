<!DOCTYPE html>
<html>
<head>
    <title>Danh sách file PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách file PDF đã lưu</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Tên File</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfFiles as $index => $file)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $file }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $file) }}" class="btn btn-primary" download>Tải xuống</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
