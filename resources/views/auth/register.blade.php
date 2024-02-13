@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title">Register</h1>
            </div>
        </div>
        <form action="{{ route('register') }}" method="POST" class="mb-5">
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-black" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            required autofocus>
                        @error('name')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-black" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-black" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-black" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            required>
                        @error('password_confirmation')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary-hover-outline">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection
