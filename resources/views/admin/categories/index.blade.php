@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="row gx-2 mb-3">
            <div class="col-8">
                <input type="text" name="name" placeholder="Create a new category" class="form-control">
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
            </div>
            {{-- Error --}}
            @error ('name')
                <div class="text-danger small">{{$message}}</div>
            @enderror
        </div>
</form>
<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-warning text-secondary">
        <tr>
             <th>#</th>
             <th>NAME</th>
             <th>COUNT</th>
             <th>LAST UPDATED</th>
             <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($all_categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td class="text-dark">{{$category->name}}</td>
                <td>{{$category->categoryPost->count()}}</td>
                <td>{{$category->updated_at}}</td>
                <td class="d-flex">
                           <button type="submit" class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{$category->id}}" title="Edit">
                             <i class="fa-solid fa-pen"></i>
                           </button>
                           <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-outline-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#delete-category-{{$category->id}}" title="Delete">
                                  <i class="fa-solid fa-trash-can"></i>
                               </button>
                           </form>
                </td>
            </tr>
            @include('admin.categories.modal.action')
            @empty
            <tr>
                <td class="lead text-muted text-center">No Categories found</td>
            </tr>
        @endforelse
        <tr>
                <td class="text-dark">
                   Uncategorized
                   <p class="xsmall mb-0 text-muted">Hidden posts are not included.</p>
                </td>
                <td>{{ $uncategorized_count }}</td>
                <td></td>
                <td></td>
        </tr>
    </tbody>
</table>
{{ $all_categories->links() }}
@endsection