@extends('layouts.app')

@section('content')
    <h2>Chi tiết phim</h2>

    <p><strong>Tiêu đề:</strong> {{ $movie->title }}</p>
    <p><strong>Thể loại:</strong> {{ $movie->genre->name }}</p>
    <p><strong>Giới thiệu:</strong> {{ $movie->intro }}</p>
    <p><strong>Ngày công chiếu:</strong> {{ $movie->release_date }}</p>

    @if($movie->poster)
        <img src="{{ asset('storage/' . $movie->poster) }}" width="200">
    @endif

    <br>
    <a href="{{ route('movies.index') }}" class="btn btn-warning">Quay lại danh sách</a>
@endsection
