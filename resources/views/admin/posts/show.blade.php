@extends('layouts.admin')
@section('title', $post->title)

@section('content')
<section>
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>{{$post->title}}</h1>
        <div>
            <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-secondary">Edit</a>
            <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-danger"  data-item-title="{{ $post->title }}">
                 Delete Post</i>
                </button>

              </form>
        </div>

    </div>


    <p>{!! $post->content !!}</p>
    <img src="{{asset('storage/' . $post->image)}}" alt="{{$post->title}}">
    @if($post->category)
    <p>Category: {{$post->category->name}}</p>
    @endif
    <div>
        @if($post->tags)
            @foreach ($post->tags as $tag)
            <span class="badge text-bg-danger">{{$tag->name}}</span>
            @endforeach
        @endif
    </div>

</section>
@include('partials.modal-delete')
@endsection
