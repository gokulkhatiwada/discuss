
@extends('discuss::layouts.master')
@section('button')
    <a href="#" class="btn btn-block btn-primary mb-3"
       data-toggle="modal" data-target="#threadModal">New Discussion</a>
@endsection
@section('content')
    @foreach($threads as $thread)
        <div class="card shadow-lg rounded-lg mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img class="img img-fluid rounded-circle" src="https://via.placeholder.com/70" alt="">
                    </div>
                    <div class="col-10">

                        <a href="{{ route('thread.show',$thread->slug) }}"><strong class="text-weight-bolder">{{ $thread->title }}</strong></a>
                        <a href="{{ route('discussion',['category'=>$thread->category->slug]) }}" class="btn btn-sm text-white float-right" style="background-color: {{ $thread->category->colour }}">{{ $thread->category->name }}</a>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                @isset($thread->last_reply_at)
                    <strong>Last activity</strong> <strong>{{ $thread->last_reply_at->diffForHumans() }}</strong>
                @else
                    <strong>{{ $thread->discussant->name }}</strong> posted <strong>{{ $thread->created_at->diffForHumans() }}</strong>
                @endisset
                <span class="float-right text-muted">
                                 <i class="fas fa-eye"></i> {{ $thread->views }}
                                 <i class="fas fa-comments"></i> {{ $thread->replies->count() }}
                                </span>
            </div>
        </div>
    @endforeach

    <div class="modal fade in show" id="threadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="align-items: flex-end;">
            <div class="modal-content">

                <form action="{{ route('thread.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <input type="text" name="title" class="form-control shadow-none" style="border: none;" placeholder="Add a title">
                        @error('title') {{ $message }} @enderror
                        <select name="category" class="form-control-sm" id="">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
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
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Anonymous
                            </label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Post Thread</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



@endsection

