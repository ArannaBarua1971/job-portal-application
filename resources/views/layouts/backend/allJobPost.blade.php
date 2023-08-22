@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="row">
            @forelse ($allJobPost as $post)
                <div class="card col-lg-3 mx-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->job_title }}</h5>
                        <p class="card-text">
                            {{ $post->position_title }}
                            {{ $post->job_salary_min . 'k - ' . $post->job_salary_max . 'k' }} <br />
                            {{ $post->job_location }}
                        </p>
                        <a href="{{ route('post.detail', $post->id) }}" class="btn btn-sm btn-primary">all Details</a>
                        @if ($post->user_id == auth()->user()->id)
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit Post</a>
                        @endif
                        @hasrole('employer')
                            <button class="btn-{{ $post->status ? 'success' : 'secondary ' }} btn btn-sm" href="#"
                                role="button">{{ $post->status ? 'approved' : 'post is pending' }}</button>
                        @endhasrole

                        @hasanyrole(['admin', 'employer'])
                            @if ($post->status)
                                <a href="{{ route('user.JobAppliedPost',$post->id) }}" class="btn btn-sm btn-warning">Applied : {{ $post->appliedUser->count() }}</a>
                            @endif
                        @endhasanyrole
                    </div>
                </div>
            @empty
                <h2>Not any post uploaded yet</h2>
            @endforelse
        </div>
    </div>
@endsection
