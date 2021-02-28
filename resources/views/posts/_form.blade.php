<div class="form-group">
    <label>Title</label>
    <input required="required" placeholder="Enter title here" type="text" name="title" class="form-control"
           value="@if(isset ($post->title))
                          @if(!old('title')){{$post->title}}@endif{{ old('title') }}@endif"/>
</div>
<div class="form-group">
    <label>Content</label>
    <textarea id="edittextarea" name='body' class="form-control">
        @if(isset ($post->body))
          @if(!old('body'))
                {!! $post->body !!}
          @endif
            {!! old('body') !!}
        @endif
    </textarea>
</div>
