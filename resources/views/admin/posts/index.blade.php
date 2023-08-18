@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-success text-secondary">
        <tr>
             <th></th>
             <th></th>
             <th>CATEGORY</th>
             <th>OWNER</th>
             <th>CREATED AT</th>
             <th>STATUS</th>
             <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>
                    @if ($post->image)
                       <img src="{{ $post->image }}" alt="{{ $post->name}}" class="rounded d-block mx-auto avatar-lg">
                    @else
                       <i class="fa-solid fa-picture d-block text-center"></i>
                    @endif
                </td>
                <td>
                    @foreach($post->categoryPost as $category_post)
                    <span class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</span>
                    @endforeach
                </td>
                <td>
                    {{$post->user_id}}
                </td>
                <td>
                    {{$post->created_at}}
                </td>
                <td>
                    @if($post->trashed())
                    <i class="fa-regular fa-circle text-secondary"></i> &nbsp; Hidden
                    @else
                    <i class="fa-regular fa-circle text-primary"></i> &nbsp; Visible
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                             <i class="fa-solid fa-ellipsis"></i>
                        </button>
                    @if($post->trashed())
                    <div class="dropdown-menu">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visible-post-{{ $post->id }}">
                            <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                        </button>
                    </div>
                    @else
                        <div class="dropdown-menu">
                               <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                     <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                               </button>
                        </div>
                    </div>
                    @endif

                    @include('admin.posts.modal.status')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection