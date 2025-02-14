@extends('layouts.app')

@section('content')
    <h2>Danh sách phim</h2>

    <table border="1">
        <tr>
            <th>Tiêu đề</th>
            <th>Ảnh</th>
            <th>Giới thiệu</th>
            <th>Ngày công chiếu</th>
            <th>Thể loại</th>
            <th>Hành động</th>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->title }}</td>
            <td>
                @if($movie->poster)
                    <img src="{{ asset('storage/' . $movie->poster) }}" width="100">
                @else
                    Không có ảnh
                @endif
            </td>
            <td>{{ $movie->intro }}</td>
            <td>{{ $movie->release_date }}</td>
            <td>{{ $movie->genre->name }}</td>
            <td>
                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary">Xem</a>
                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                <a><form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Xóa phim này?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form></a>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{ $movies->links() }}
    </div>

    <!-- Form tìm kiếm -->
<form method="GET" action="{{ route('movies.index') }}" style="margin-top: 50px">
    <input class="form-control" type="text" name="search" placeholder="Nhập tên phim..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>
@endsection
