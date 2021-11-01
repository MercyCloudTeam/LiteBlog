@extends('layouts.app')
@section('title') 404 @endsection


@section('content')
    <div class="hero min-h-screen">
        <div class="text-center hero-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">
                    404
                </h1>
                <p class="mb-5">
                    这河内嘛w
                </p>
                <button class="btn btn-primary" onclick="window.history.go(-1)">回去</button>
            </div>
        </div>
    </div>
@endsection

