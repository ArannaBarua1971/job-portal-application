@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>sl No.</th>
                        <th>Name</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allEmployer as $key => $user)
                        <tr>
                            <td>{{ $allEmployer->firstItem()+$key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <button class="btn btn-sm  btn-{{ $user->status ? 'success' : 'danger' }}">
                                    {{ $user->status ? 'active' : 'banned' }}
                                </button>
                            </td>
                            <td>
                                <a href="{{  $user->status ? route('user.ban',$user->id) : route('user.active',$user->id) }}" class="btn btn-sm  btn-{{ $user->status ? 'danger' : 'success' }}">
                                    {{ $user->status ? 'ban' : 'active' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $allEmployer->links() }}
        </div>
    </div>
@endsection
