@extends('layouts.my-app')

@section("page.title", 'Редактировать запись')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold my-4">
            {{ isset($post->postId) ? 'Edit Post' : 'Create Post'}}
        </h1>

        @if ($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ isset($post->postId) ? route('posts.update', $post->postId) : route('posts.store') }}" method="POST">
            @csrf
{{--            @if (isset($post->postId))--}}
{{--                @method('PUT')--}}
{{--            @endif--}}

            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" class="{{$errors->has('title') ? 'invalid' : ''}}" required>
            </div>

            <div class="mb-4">
                <label for="text">Text</label>
                <textarea name="content" id="content" rows="5" class=" {{$errors->has('title') ? 'invalid' : ''}}" required>{{ old('content', $post->content ?? '') }}</textarea>
            </div>

            <div>
                <button type="submit" class="">
                    {{ isset($post->postId) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>

@endsection
