@extends('layouts.app')

@section('title')

    Add New Post

@endsection

@section('content')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#createtextarea',  init_instance_callback : function(editor) {
                var freeTiny = document.querySelector('.tox .tox-notification--in');
                freeTiny.style.display = 'none';
            }
        });
    </script>
    <form action="/posts" method="post">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />

        </div>

        <div class="form-group">

            <textarea id="createtextarea" name='body'class="form-control">{{ old('body') }}</textarea>

        </div>

        <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

        <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />

    </form>

@endsection
