@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container p-3">
        <div class="card p-3">
          <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
               <label for="checkbox" class="form-label">Categories</label>
               @foreach($all_categories as $category)
              <div class="form-check form-check-inline">
                 <input type="checkbox" value="{{ $category->id }}" name="category[]" class="form-check-input" id="{{ $category->name }}">
                 <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
              </div>
               @endforeach

               @error('category')
                     <div class="text-danger small">{{ $message }}</div>
               @enderror
            <div>
               <label for="description" class="form-label">Description</label>
               <input type="text" class="form-control" name="description" id="description" placeholder="What's on your mind">
            </div>
               @error('description')
                     <div class="text-danger small">{{ $message }}</div>
               @enderror
            <div>
               <label for="image" class="form-label">Image</label>
               <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
               <div class="form-text" id="image-info">
                  Acceptable file types: jpeg, jpg, png, gif only <br>
                  Maximum file size: 1048kb 
                  {{-- 1048kb = 1MB --}}
               </div>
            </div>
            <button type="submit" class="btn btn-primary px-5">Post</button>
          </form>
        </div>
    </div>
@endsection