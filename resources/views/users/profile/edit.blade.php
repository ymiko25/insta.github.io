@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
         <div class="col-8">
            <form action="{{ route('profile.update')}}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h2 class="h2 mb-3 fw-light text-muted">Update Profile</h2>

                <div class="row mb-3">
                      <div class="col-4">
                          @if ($user->avatar)
                              <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                          @else
                              <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                          @endif
                      </div>

                      <div class="col-auto align-self-end">
                          <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-1" aria-describedby = "avatar-info">
                          <div class="form-text" id="avatar-info">
                              Acceptable formats: jpeg, jpg, png, gif only <br>
                              Max file size is 1048kb
                          </div>
                          {{-- error --}}
                          @error('avatar')
                          <div class="text-danger small">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="name" class="form-label fw-bold">Name</label>
                          <input type="text" name="name" id="name" class="form-control" value="{{old('name', $user->name)}}">
                          {{-- error --}}
                          @error('name')
                          <div class="text-danger small">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="email" class="form-label fw-bold">E-mail</label>
                          <input type="email" name="email" id="email" class="form-control" value="{{old('email', $user->email)}}">
                          {{-- error --}}
                          @error('email')
                          <div class="text-danger small">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="password" class="form-label fw-bold">Password</label>
                          <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                          {{-- error --}}
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                            <label for="password-confirm" class="form-label fw-bold">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>

                      <div class="mb-3">
                          <label for="introduction" class="form-label fw-bold">Introduction</label>
                          <textarea type="introduction" name="introduction" id="introduction" row="5" class="form-control" placeholder="Describe yourself">{{old('introduction', $user->introduction)}}</textarea>
                          {{-- error --}}
                          @error('introduction')
                          <div class="text-danger small">{{ $message }}</div>
                          @enderror
                      </div>
                </div>
                <button type="submit" class="btn btn-warning px-5">Save</button>
            </form>
         </div>
    </div>
@endsection