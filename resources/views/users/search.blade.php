@extends('layouts.app')

@section('title', 'Explore People or Post')

@section('content')
    <div class="row justify-content-center">
       <div class="col-5">
           <p class="h5 text-muted mb-4">Search Results for "<span class="fw-bold">{{ $search }}</span>"</p>

           @forelse ($users as $user)
              <div class="row align items-center mb-3">
                   <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id)}}">
                            @if ($user->avatar)
                              <img src="{{ $user->avatar}}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else
                              <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                   </div>

                   <div class="col ps-0 text-truncate">
                       <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                       <p class="text-muted mb-0">{{ $user->email }}</p>
                   </div>

                   <div class="col-auto">
                       @if ($user->id !==Auth::user()->id)
                           @if ($user->isFollowed())
                               <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                               @csrf
                               @method('DELETE')

                               <button class="btn btn-outline-secondary fw-bold btn-sm">Following</button>
                               </form>
                           @else
                               <form action="{{ route('follow.store', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="fw-bold btn btn-primary btn-sm">Follow</button>
                               </form>
                           @endif
                       @endif
                   </div>
              </div>
          @empty
             <p class="lead text-muted text-center">No users found.</p>
          @endforelse
        </div>
    </div>
          <div class="row">
          @forelse ($description as $post)
                  
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
                        </a>
                    </div>
          @empty
            <p class="lead text-muted text-center">No Posts found.</p>f
          @endforelse
          </div>
@endsection