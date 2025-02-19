@extends('layouts.app')

@section('content')
    <h2>Thêm phim mới</h2>

    @if ($errors->any())
        <div style="color: red;">
            <div style="background-color: aquamarine">
                <ul>
                    @foreach ($errors->all() as $error)
                        <b><li>{{ $error }}</li></b>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tiêu đề:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>

        <label>Giới thiệu:</label>
        <textarea name="intro" class="form-control" required>{{ old('intro') }}</textarea>

        <label>Ngày công chiếu:</label>
        <input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}" required>

        <label>Thể loại:</label>
        <select name="genre_id" class="form-control" required>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>

        <label>Hình ảnh:</label>
        <input type="file" name="poster" class="form-control" accept="image/*">

        <button type="submit" style="margin-top: 20px;" class="btn btn-primary">Thêm phim</button>
    </form>
@endsection
