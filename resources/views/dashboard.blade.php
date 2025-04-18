@extends('layout.layout')

@section('content')
<div class="flex">
    <div class="w-64 bg-blue-800 h-screen text-white">
        <div class="p-6 text-center">
            <h1 class="text-3xl font-semibold">لوحة التحكم</h1>
        </div>
        <ul class="mt-10">
            <li>
                <a href="{{ route('images.index') }}" class="block py-3 px-6 text-gray-300 hover:bg-blue-700">
                    <i class="fas fa-image"></i> الصور
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="block py-3 px-6 text-gray-300 hover:bg-blue-700">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </a>
            </li>
        </ul>
    </div>

    <div class="flex-1 p-6">
        <h2 class="text-2xl font-semibold mb-4">مرحبًا بك في لوحة التحكم</h2>

    
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold mb-4">إضافة صورة جديدة</h3>
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">عنوان الصورة</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600" placeholder="أدخل عنوان الصورة" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">اختر صورة</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600" required>
                </div>
                <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">رفع الصورة</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">إدارة الصور</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach($images as $image)
                <div class="relative border p-4 rounded-lg bg-gray-50 group">
                    <img src="{{ asset($image->path) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover mb-2 rounded text-lg font-semibold">                    <h4 class="text-lg font-semibold">{{ $image->title }}</h4>
                    <div class="flex space-x-2">
                        <!-- زر عرض الصورة -->
                        <a href="{{ asset('storage/' . $image->path) }}" target="_blank" class="bg-blue-600 text-white px-3 py-2 rounded-full hover:bg-blue-700 focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- زر الحذف -->
                        <form action="{{ route('images.destroy', ['id' => $image->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-full hover:bg-red-700 focus:outline-none">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection