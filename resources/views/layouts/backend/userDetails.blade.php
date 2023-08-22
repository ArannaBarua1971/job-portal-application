@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->AppliedJobs->first()->name  }} Information :-</h5>
                <div class="card-text">
                    <p> <span style="font-size: 20px">email </span> :- {{ $user->email }}</p>
                    <p> <span style="font-size: 20px">phone Number </span> :- {{ $user->phone }}</p>
                    <p> <span style="font-size: 20px">ex-company name </span> :- {{ $user->company_name }}</p>
                    <p> <span style="font-size: 20px">working_exp </span> :- {!! $user->working_exp !!}</p>
                    <p> <span style="font-size: 20px">skills </span> :- {!! $user->skills !!}</p>
                    <p> <span style="font-size: 20px">portfolio </span> :- <a href="{{ $user->portfolio }}">{{ $user->portfolio }}</a></p>
                    <p> <span style="font-size: 20px">eduction </span> :- {!! $user->education !!}</p>
                    <p> <span style="font-size: 20px">certificates </span> :- {!! $user->certificates !!}</p>
                    <hr>
                    <p>Social links :</p>
                    <p> <span style="font-size: 20px">email </span> :- <a href="{{ $user->facebook }}">{{ $user->facebook }}</a></p>
                    <p> <span style="font-size: 20px">email </span> :- <a href="{{ $user->twitter }}">{{ $user->twitter }}</a></p>
                    <p> <span style="font-size: 20px">email </span> :- <a href="{{ $user->youtube }}">{{ $user->youtube }}</a></p>
                    <p> <span style="font-size: 20px">email </span> :- <a href="{{ $user->whatsapp }}">{{ $user->whatsapp }}</a></p>
                </div>

            </div>
        </div>
    </div>
@endsection
