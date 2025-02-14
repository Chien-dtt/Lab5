<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý phim')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h1>Quản lý Phim</h1>

    <nav>
        <a href="{{ route('movies.index') }}" class="btn btn-info">Danh sách phim</a> |
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Thêm phim</a>
    </nav>

    <hr>

    <div>
        @yield('content')
    </div>
</div>

    

</body>
</html>
