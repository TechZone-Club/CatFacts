<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách File PDF</title>
</head>
<body>
    <h1>Danh sách các file PDF đã tạo</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <ul>
        @foreach($pdfFiles as $file)
            <li>
                <a href="{{ route('catfact.download', ['filename' => basename($file)]) }}">
                    Tải xuống {{ basename($file) }}
                </a> |
                <form action="{{ route('catfact.delete', ['filename' => basename($file)]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa file này?')">Xóa</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
