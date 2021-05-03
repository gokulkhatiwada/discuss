@extends('discuss::layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('thread.update',$thread->uuid) }}" method="post">
                @csrf
                <div class="modal-header">
                    <input type="text" value="{{ old('title',$thread->title) }}" name="title" class="form-control shadow-none" style="border: none;" placeholder="Add a title">
                    @error('title') {{ $message }} @enderror
                    <select name="category" class="form-control-sm" id="">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option {{ $category->id === $thread->discuss_category_id ? 'selected':'' }}
                                    value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category') {{ $message }} @enderror
                </div>
                <div class="modal-body">
                    <textarea name="text" id="editor" class="from-control shadow-none w-100"
                              placeholder="Add text"  style="border: none;outline:none;"></textarea>
                    @error('text') {{ $message }} @enderror

                    <input id="previewThis" type="checkbox"> Preview Mode
                    <div class="form-check float-right">
                        <input class="form-check-input" {{ $thread->anonymous?'checked':'' }} type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Anonymous
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
    <script>
        var turndownService  = new TurndownService();
       let markdown = turndownService.turndown(`{!! $thread->text !!}`);
       window.easyMDE.value(markdown);
    </script>
@endsection
