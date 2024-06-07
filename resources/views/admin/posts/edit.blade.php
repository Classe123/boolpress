@extends('layouts.admin')

@section('title', 'Edit Post: ' . $post->title)

@section('content')
    <section>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h2>Edit post: {{$post->title}}</h2>
            <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-danger">Show Post</a>
        </div>

        <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" minlength="3" maxlength="200" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div>
            </div>
            <div class='d-flex'>
                <div class="media me-4">
                    @if($post->image)
                    <img class="shadow" width="150" src="{{asset('storage/' . $post->image)}}" alt="{{$post->title}}" id="uploadPreview">
                    @else
                    <img class="shadow" width="150" src="/images/placeholder.png" alt="{{$post->title}}" id="uploadPreview">
                    @endif

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="uploadImage"
                        name="image" value="{{ old('image', $post->image) }}" maxlength="255">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group mb-3">
                <p>Select Tag:</p>
                @foreach ($tags as $tag)
                    <div>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input"
                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                        <label for="" class="form-check-label">{{ $tag->name }}</label>
                    </div>
                @endforeach
                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>


    </section>
    @include('partials.editor');
@endsection
