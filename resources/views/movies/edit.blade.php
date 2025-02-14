@extends('layouts.app')

@section('content')
    <h2>Sửa phim</h2>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Tiêu đề:</label>
        <input type="text" name="title" value="{{ $movie->title }}" class="form-control" required>

        <label>Giới thiệu:</label>
        <textarea name="intro" class="form-control" required>{{ $movie->intro }}</textarea>

        <label>Ngày công chiếu:</label>
        <input type="date" name="release_date" value="{{ $movie->release_date }}" class="form-control" required>

        <label>Thể loại:</label>
        <select name="genre_id" class="form-control">
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select>

        <label>Hình ảnh:</label>
        <input type="file" name="poster">

        @if($movie->poster)
            <img src="{{ asset('storage/' . $movie->poster) }}" width="100">
        @endif

        <button type="submit" class="btn btn-warning">Cập nhật</button>
    </form>
@endsection
