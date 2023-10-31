@extends('layout.head')

@section('content')
    @if($user->role === 'admin')
        @include('layout.dash.admin')
    @else
        <h1>Welcome User</h1>
    @endif
@endsection
