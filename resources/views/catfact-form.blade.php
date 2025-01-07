<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận Sự Thật Về Mèo</title>
</head>
<body>
    <h1>Nhập số lượng sự thật về mèo</h1>

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('catfact.generate') }}" method="POST">
        @csrf
        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        <button type="submit">Lấy thông tin</button>
    </form>
</body>
</html>
