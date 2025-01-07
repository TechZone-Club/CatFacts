<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Facts PDF Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4f8;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .form-label {
            font-size: 1.1rem;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-size: 1.2rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Thêm một số con mèo dễ thương */
        .cat-icon {
            font-size: 2rem;
            color: #f8c8d3;
        }

        .cat-header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        
        .cat-header h1 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

<div class="container my-5 animate__animated animate__fadeIn">
    <div class="cat-header">
        <h1>Cat Facts PDF Generator</h1>
        <span class="cat-icon">🐱</span>
        <span class="cat-icon">😺</span>
    </div>

    <form action="{{ route('pdf.generate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="count" class="form-label">Number of Cat Facts:</label>
            <input type="number" class="form-control" id="count" name="count" min="1" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate PDF</button>
    </form>

    <div class="footer">
        <p>Powered by <a href="https://catfact.ninja" target="_blank">CatFact API</a></p>
        <div>
            <span class="cat-icon">🐾</span>
            <span class="cat-icon">😻</span>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS for any interactive components -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
