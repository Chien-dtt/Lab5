@extends('layouts.app')

@section('content')
    <h2>Thêm phim mới</h2>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tiêu đề:</label>
        <input type="text" name="title" class="form-control" required>

        <label>Giới thiệu:</label>
        <textarea name="intro" class="form-control" required></textarea>

        <label>Ngày công chiếu:</label>
        <input type="date" name="release_date" class="form-control" required>

        <label>Thể loại:</label>
        <select name="genre_id" class="form-control">
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>

        <label>Hình ảnh:</label>
        <input type="file" name="poster" class="form-control">

        <button type="submit" style="margin-top: 20px;" class="btn btn-primary">Thêm phim</button>
    </form>
@endsection
