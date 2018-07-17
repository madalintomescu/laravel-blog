@extends('layouts.dashboard.base')
@section('pageTitle', 'Create post')

@section('content')

{{ Breadcrumbs::render('dashboard.posts.create') }}

<div class="container-fluid">

    <h1 class="page-heading mb-3">Create a new post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-12 col-lg-8">

                <div class="form-group">
                    <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" id="title" placeholder="Enter post title..." value="{{ old('title') }}" required>

                    @if ($errors->has('title'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <textarea name="body" id="post-body" class="form-control box-shadow" placeholder="Post content...">{{ old('body') }}</textarea>

                    <div id="count" class="fs-14">0 words, 0 characters</div>

                    @if ($errors->has('body'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                    @endif

                </div>
            </div>

            <div class="col-12 col-lg-4">

                <div class="form-group">

                    <div class="box bg-white rounded box-shadow p-3 mb-3">
                        <p class="mb-4">Post settings</p>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="draft" class="btn btn-sm btn-outline-secondary">Save draft</button>

                            <button class="btn btn-sm btn-primary" type="submit">Publish</button>
                        </div>
                    </div>

                </div>

                <div class="form-group">

                    <div class="box bg-white rounded box-shadow p-3 mb-3">
                        <p class="mb-4">Featured image</p>

                        <div id="image_container">

                            <input type="file" name="image" id="image_select" class="fs-14 mt-1">

                            <button type="button" id="remove_image_button" class="btn btn-sm btn-link p-0 display-none">
                                Remove image
                            </button>
                        </div>

                        @if ($errors->has('image'))
                        <span class="invalid-message">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>

                <div class="form-group">

                    <div class="box bg-white rounded box-shadow p-3 mb-3">
                        <label for="categories" class="mb-3">Categories</label>

                        <select name="categories[]" id="categories" class="form-control" multiple="multiple">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group">

                    <div class="box bg-white rounded box-shadow p-3 mb-3">
                        <label for="tags" class="mb-3">Tags</label>

                        <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

@push('scripts')

<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
<script src="{{ asset('js/plugins/summernote/summernote-bs4.js') }}"></script>

<script>
$(document).ready(function() {

  function countCharacters() {
    var words = $('.note-editable').text().replace(/\s+/g, ' ').trim().split(' ');
    var wordsCount = words.filter(entry => entry.trim() != '').length;
    var characters = $('.note-editable').text().length;
    var count = `${wordsCount} ${wordsCount === 1 ? 'word' : 'words'}, 
    ${characters} ${characters === 1 ? 'character' : 'characters'}`;
    $('#count').text(count);
  }

  $('#post-body').summernote({
    placeholder: 'Post content...',
    height: 350,
    callbacks: {
      onInit: function() {
        if ($('.note-editable').text().length) {
          countCharacters();
        }
      },
      onChange: function() {
        countCharacters();
      }
    }
  });
});
</script>

<script src="{{ asset('js/image_preview.js') }}"></script>

{{-- Select2 select boxes --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/select2.js') }}"></script>

<script>
  // Focus on post title input on page load
  document.getElementById('title').select();
</script>

@endpush
@endsection
