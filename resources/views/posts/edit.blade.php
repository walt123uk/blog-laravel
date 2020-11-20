@extends('layouts.app')
@section('title')
    Edit Post
@endsection
@section('content')
    <form method="post" action='{{ url("post") }}'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
        <div class="form-group">
            <label>Title</label>
            <input required="required" placeholder="Enter title here" type="text" name="title" class="form-control"
                   value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea name='body' class="form-control">
              @if(!old('body'))
                    {!! $post->body !!}
                @endif
                {!! old('body') !!}
            </textarea>
        </div>
        <div class="form-group">
            <label>Tags</label></br>
            @foreach($tagsAll as $tag)
                <input type="checkbox" name="tags[]" value={{$tag->name}} @if($tags->contains($tag->id)) checked=checked @endif/><label>{{$tag->name}}</label></br>
            @endforeach
        </div>
        @if($post->active == '1')
            <input type="submit" name='publish' class="btn btn-success" value="Update"/>
        @else
            <input type="submit" name='publish' class="btn btn-success" value="Publish"/>
        @endif
        <input type="submit" name='save' class="btn btn-default" value="Save As Draft"/>
    </form>
@endsection
