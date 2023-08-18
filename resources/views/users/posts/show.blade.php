@extends('layouts.app')

@section('title', 'show')

@section('content')

<style>
   .col-4{
      overflow-y: scroll;
   }

   .card-body{
      position: absolute;
      top: 65px;
   }
</style>

<div class="row border shadow">
  {{-- first column --}}
   <div class="col p-0 border-end">
      <img src="{{ $post->image}}" alt="post_id {{ $post->id }}" class="w-100">
   </div>
   {{-- second column --}}
   <div class="col-4 px-0 bg-white">
      <div class="card border-0">
           <div class="card-header bg-white py">
           <div class="row align-items-center">
           <div class="col-auto">
        <a href="{{ route('profile.show', $post->user->id) }}">
           @if ($post->user->avatar)
               <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="rounded-circle avatar-sm">
           @else
               <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
           @endif
        </a>
     </div>
     <div class="col ps-0">
        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
     </div>
     <div class="col-auto">
        <div class="dropdown">
            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>

            {{-- if you are the owner of the post, you can edit or delete the post --}}
            @if (Auth::user()->id === $post->user->id)
              <div class="dropdown-menu">
                   <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                       <i class="fa-regular fa-pen-to-square"></i> Edit
                   </a>
                   <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                      <i class="fa-regular fa-trash-can"></i> Delete
                   </button>
              </div>
              {{-- include modal here --}}
              @include('users.posts.contents.modals.delete')
            @else
              {{-- if you are not the owner of the post, then show an Unfollow button [SOON] --}}
              {{-- show follow button for now --}}
              <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                  @csrf
                  <button type="submit" class="border-0 bg-transparent p-0 text-primary">Follow</button>
              </form>
            @endif
        </div>
     </div>
  </div>
           </div>      
           <div class="card-body w-100">
           {{-- heart button + no of likes + categories --}}
    <div class="row align-items-center">
       <div class="col-auto">
           @if($post->isLiked())
           <form action="{{ route('like.destroy', $post->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm p-0">
                 <i class="fa-solid fa-heart text-danger"></i>
              </button>
           </form>
           @else
           <form action="{{ route('like.store', $post->id) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-sm shadow-none p-0">
                 <i class="fa-regular fa-heart"></i>
              </button>
           </form>
           @endif
       </div>
       <div class="col-auto px-0">
           <span>{{ $post->likes->count() }}</span>
       </div>
       <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                     {{ $category_post->category->name}}
                </div>
            @endforeach
       </div>
    </div>

    {{-- owner + description --}}
    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name}}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-uppercase text-muted xsmall">{{ date('M d,Y', strtotime ($post->created_at)) }}</p>
</div>
          
          {{-- show all comments --}}
          @if ($post->comments->isNotEmpty())
             <ul class="list-group mt-2">
                @foreach ($post->comments as $comment)
                   <li class="list-group-item border-0 p-0 mb-2">
                       <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-non text-dark fw-bold">{{ $comment->user->name}}</a>
                       &nbsp;
                       <p class="d-line fw-light">{{$comment->body}}</p>

                       <form action="#" method="post">
                           @csrf
                           @method('DELETE')

                           <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                           {{-- if the user is not the OWNER OF THE COMMENT --}}
                           @if (Auth::user()->id === $comment->user->id)
                              &middot;
                              <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                           @endif
                       </form>
                   </li>
                @endforeach
             </ul>
          @endif
          {{-- include comment here --}}
          <form action="{{ route('comment.store', $post->id)}}" method="post">
          @csrf

          <div class="input-group">
             <textarea name="comment_body{{ $post->id}}" rows="1" class="form-control form-control-sm" placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>
             <button type="submit" class="btn btn-outlines-secondary btn-sm">Post</button>
          </div>
          {{-- error --}}
          @error('comment_body' . $post->id)
             <div class="text-danger small">{{ $message }}</div>
          @enderror
          </form>

         </div>
      </div>
   </div>
</div>

@endsection