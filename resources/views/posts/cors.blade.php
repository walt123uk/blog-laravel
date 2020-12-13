@extends('layouts.app')

@section('title')
    CORS Middleware Demo
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script>
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'http://blog.laravel/post/cors',
            success: function (data) {
            }
        });
    </script>
@endsection
