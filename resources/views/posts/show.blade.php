@extends('layouts.my-app')

@section("page.title", $post->title)

@section('content')
    <div class="pt-4">
        <div class="border-b border-grey-lighter pb-8 sm:pb-12">
            <span class="mb-5 inline-block rounded-full bg-green-light px-2 py-1 font-body text-sm text-green sm:mb-8">category</span>
            <h2 class="block font-body text-3xl font-semibold leading-tight text-primary sm:text-4xl md:text-5xl">
                {{ $post->title }}
            </h2>
            <div class="flex items-center pt-5 sm:pt-8">
                <p class="pr-2 font-body font-light text-primary">
                    {{ $post->created_at }}
                </p>
                <span class="vdark:text-white font-body text-grey">//</span>
                <p class="pl-2 font-body font-light text-primary">
                    4 min read
                </p>
                <span class="vdark:text-white font-body text-grey">//</span>
                <p class="pl-2 font-body font-light text-primary">
                    <a class="text-blue-500 hover:underline" href="{{ route('posts.edit', ['postId' => $post->id]) }}">Edit</a>
                </p>
            </div>
        </div>
d        <div class="prose prose max-w-none border-b border-grey-lighter py-8 sm:py-12">
            {!! $post->content !!}
        </div>

        <div class="flex items-center py-10">
            <span class="pr-5 font-body font-medium text-primary">Share</span>
            <a href="/">
                <i class="bx bxl-facebook text-2xl text-primary transition-colors hover:text-secondary"></i></a>
            <a href="/">
                <i class="bx bxl-twitter pl-2 text-2xl text-primary transition-colors hover:text-secondary"></i>
            </a>
            <a href="/">
                <i class="bx bxl-linkedin pl-2 text-2xl text-primary transition-colors hover:text-secondary"></i></a>
            <a href="/">
                <i class="bx bxl-reddit pl-2 text-2xl text-primary transition-colors hover:text-secondary"></i></a>
        </div>
    </div>
@endsection
