@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="row">
            @forelse ($likePost as $post)
                <div class="card col-lg-3 mx-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->jobPost->job_title }}</h5>
                        <p class="card-text">
                            {{ $post->jobPost->position_title }}
                            {!! Str::substr($post->jobPost->job_description, 0, 250) !!}
                            {{ Str::length($post->jobPost->job_description) > 100 ? '...' : '' }}<br>
                            {{ $post->jobPost->job_salary_min . 'k - ' . $post->jobPost->job_salary_max . 'k' }} <br />
                            {{ $post->jobPost->job_location }}
                        </p>
                        <a href="{{ route('post.detail',$post->jobPost->id) }}" class="btn btn-sm btn-primary">all Details</a>
                        <a href="{{ route('disLike',$post->id) }}" class="btn btn-sm btn-primary">Unsaved</a>
                    </div>
                </div>
            @empty
                <h2>Not any post saved yet</h2>
            @endforelse
        </div>
    </div>
@endsection
