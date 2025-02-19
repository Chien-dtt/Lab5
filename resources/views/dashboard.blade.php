<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.app')

@section('content')
    <h2>Thông tin tài khoản</h2>
    <p><strong>Họ tên:</strong> {{ Auth::user()->fullname }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Tên tài khoản:</strong> {{ Auth::user()->username }}</p>
    <p><strong>Vai trò:</strong> {{ Auth::user()->role }}</p>
    <p><strong>Trạng thái:</strong> {{ Auth::user()->active ? 'Hoạt động' : 'Bị khóa' }}</p>

    <a href="{{ route('users.edit', Auth::user()->id) }}">Cập nhật thông tin</a>
@endsection