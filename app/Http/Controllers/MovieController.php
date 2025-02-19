<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Hiển thị danh sách phim
    public function index(Request $request)
    {
        $query = Movie::query()->with('genre');

        // Kiểm tra nếu có tham số tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%");
        }

        $movies = $query->paginate(10); // Phân trang

        return view('movies.index', compact('movies'));
    }

    // Thêm mới
    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    // Lưu phim
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:movies,title|max:255',
            'poster' => 'nullable|image|max:2048', // 2MB = 2048KB
            'intro' => 'required|max:255',
            'release_date' => 'required|date|after_or_equal:today',
            'genre_id' => 'required|exists:genres,id',
        ], [
            'title.required' => 'Tiêu đề phim không được để trống.',
            'title.unique' => 'Tiêu đề phim đã tồn tại.',
            'title.max' => 'Tiêu đề phim không được vượt quá 255 ký tự.',
            'poster.image' => 'Poster phải là một tệp ảnh.',
            'poster.max' => 'Dung lượng ảnh không được quá 2MB.',
            'intro.required' => 'Giới thiệu phim không được để trống.',
            'release_date.required' => 'Ngày công chiếu không được để trống.',
            'release_date.after_or_equal' => 'Ngày công chiếu không được nhỏ hơn ngày hiện tại.',
            'genre_id.required' => 'Thể loại phim không được để trống.',
            'genre_id.exists' => 'Thể loại phim không hợp lệ.',
        ]);

        // Lưu phim vào database
        Movie::create($request->all());

        return redirect()->route('movies.index')->with('success', 'Phim đã được thêm thành công!');
    }

    // Hiển thị chi tiết
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    // Sửa
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    // Cập nhật
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|unique:movies,title,' . $movie->id . '|max:255',
            'poster' => 'nullable|image|max:2048',
            'intro' => 'required|max:255',
            'release_date' => 'required|date|after_or_equal:today',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')->with('success', 'Phim đã được cập nhật thành công!');
    }

    // Xóa
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Xóa phim thành công!');
    }
}
