@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <h2>Applied For Job.</h2>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>CV</th>
                    <th>Current_working</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appliedJob as $key=>$apply)
                    <tr>
                        <td>{{ $appliedJob->firstItem()+$key }}</td>
                        <td><a href="{{ route('user.details',$apply->user_id) }}" style="color:black">{{ $apply->name }}</a></td>
                        <td>{{ $apply->email}}</td>
                        <td><a href="{{ $apply->cv }}">{{ $apply->cv }}</a></td>
                        <td>{{ isset($apply->Current_working)? $apply->Current_working : 'No one' }}</td>
                    </tr>
                @empty
                    <h2>any one not applied yet</h2>
                @endforelse
            </tbody>
        </table>
        {{ $appliedJob->links() }}
    </div>
@endsection
