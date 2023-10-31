@extends('layout.head')

@section('content')
    <div style="text-align: center; display: flex; justify-content: center; align-items:center; height: 100vh;">
        <div>
            <h1>You Dont Have Access.</h1>
            <p>Please Login to Access Your Account!</p>
            <a href="/login" class="form-control bg-primary text-white" style="font-size: 18px;">Login</a>
        </div>
    </div>
@endsection