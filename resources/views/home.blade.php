@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')
    @if ( !$posts->count() )
        There is no post till now. Login and write a new post now!!!
    @else
        <div class="">
{{--            <x-alert message="Message Variable"></x-alert>--}}
            @foreach( $posts as $post )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3>
                            <a href="{{ route('post.show',$post) }}">{{ $post->title }}</a>
                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                @if($post->active == '1')
                                    <button class="btn" style="float: right"><a href="{{ route('post.edit',$post)}}">Edit
                                            Post</a></button>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ route('post.edit',$post)}}">Edit
                                            Draft</a></button>
                                @endif
                            @endif
                            <form action="{{ route('post.destroy',$post) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn" style="float: right">Delete Post</button>
                            </form>
                        </h3>
                        <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
                                href="{{ route('user.show',$post->author)}}">{{ $post->author->name }}</a></p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='.route("post.show",$post).'>Read More</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
