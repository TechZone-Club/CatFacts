<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách file PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Danh sách file PDF</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Tên file</th>
            <th>Kích thước (KB)</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($files as $file)
            <tr>
                <td>{{ $file['name'] }}</td>
                <td>{{ round($file['size'] / 1024, 2) }}</td>
                <td>{{ date('d-m-Y H:i:s', $file['last_modified']) }}</td>
                <td>
                    <a href="{{ route('pdf.download', $file['name']) }}" class="btn btn-primary btn-sm">Tải xuống</a>

                    <!-- Nút Xóa -->
                    <form action="{{ route('pdf.delete', $file['name']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa file này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Không có file nào</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Add Bootstrap JS for any interactive components -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
