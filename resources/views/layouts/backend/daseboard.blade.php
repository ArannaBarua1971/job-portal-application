@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">

        <h1>Information .</h1>
        <form action="{{ route('info.personal') }}" class="form" method="POST">
            @csrf
            <div class="my-2">
                <div class="name d-flex flex-wrap justify-content-between">
                    <label for="name" class="col-lg-12">Name : </label>
                    <input type="text" class="form-control col-lg-7" value="{{ auth()->user()->name }}" name="name">
                    <button class="btn btn-sm btn-primary col-lg-4">Change Name</button>
                    @error('name')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </form>

        <a href="{{ route('info.form') }}" class="btn btn-primary">+ Add Other Info</a>

       
    </div>
    <!-- content-wrapper ends -->
@endsection
