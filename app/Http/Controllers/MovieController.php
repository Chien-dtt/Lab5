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
            'title' => 'required',
            'intro' => 'required',
            'release_date' => 'required|date',
            'genre_id' => 'required',
            'poster' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Xử lý upload ảnh
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Movie::create($data);
        return redirect()->route('movies.index')->with('success', 'Thêm phim thành công!');
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
            'title' => 'required',
            'intro' => 'required',
            'release_date' => 'required|date',
            'genre_id' => 'required',
            'poster' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Xử lý upload ảnh
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);
        return redirect()->route('movies.index')->with('success', 'Cập nhật phim thành công!');
    }

    // Xóa
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Xóa phim thành công!');
    }
}