@extends('discuss::layouts.master')

@section('button')
    @if(!$thread->closed)
        <a href="#" class="btn btn-block btn-primary mb-3"
           data-toggle="modal" data-target="#replyModal">Reply</a>
    @endif
@endsection
@section('content')
    <div class="card px-2 shadow-lg">
        <div class="card-body">
            <img class="img img-fluid rounded-circle" style="height: 40px" src="{{ $thread->discussant->getImageUrl() }}" alt="">
            <strong>
                {{ ($thread->anonymous)?'Anonymous':$thread->discussant->getDisplayName() }} started this thread {{ $thread->created_at->diffForHumans() }}
            </strong>
            <span class="float-right text-muted">
             <i class="fas fa-eye"></i> {{ $thread->views }}
            <i class="fas fa-comment"></i> {{ $thread->replies->count() }}
        </span>
        </div>

    </div>

    <div class="card mt-3 rounded-lg shadow-lg">
        <div class="card-header">
            <strong>{{ $thread->title }}</strong>
            @if(auth()->check() && $thread->discussant->is(auth()->user()))
                <span class="float-right">
            @if((config('discuss.threads.allow_close') && !$thread->closed) || (config('discuss.threads.allow_reopen') && $thread->closed) )
               <a href="{{ route('thread.close',$thread->uuid) }}"
                  data-toggle="tooltip" title="Close Thread">
                   <i class="fas {{ $thread->closed?'fa-lock-open text-success':'fa-lock text-danger' }}"></i>
               </a>
            @endif
            @if(config('discuss.threads.allow_update'))
               <a href="{{ route('thread.edit',$thread->uuid) }}" data-toggle="tooltip" title="Update Thread"> <i class="fas fa-pen px-2"></i> </a>
                @endif
                @if(config('discuss.threads.allow_delete'))
               <a href="{{ route('thread.destroy',$thread->uuid) }}" data-toggle="tooltip" title="Delete Thread"> <i class="fas fa-trash text-danger px-2"></i> </a>
                    @endif
           </span>
            @endif
        </div>
        <div class="card-body px-2">
            {!! $thread->text !!}
        </div>

    </div>

    @forelse($thread->replies as $reply)
        <div class="card shadow-lg mt-3">

            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img class="img img-fluid rounded-circle" src="{{ $reply->discussant->getImageUrl() }}" alt="">
                    </div>
                    <div class="col-10">
                        <strong class="text-muted">{{ ($reply->anonymous)?'Anonymous':$reply->discussant->getDisplayName() }} replied {{ $reply->created_at->diffForHumans() }}</strong>
                        @if($reply->discussant->is(auth()->user()))
                            <span class="float-right">
                                @if(config('discuss.replies.allow_update'))
                                    <a href="#"><i class="fas fa-pen"></i></a>
                                @endif
                                    @if(config('discuss.replies.allow_delete'))
                                        <a href="#"><i class="fas fa-trash px-2 text-danger"></i></a>
                                    @endif
                            </span>
                        @endif
                        {!! $reply->body !!}
                    </div>
                </div>

            </div>
        </div>


    @empty
        @if(!$thread->closed)
            <div class="card shadow-lg mt-3">
                <div class="card-body text-center">
                    <a href="#"  data-toggle="modal" data-target="#replyModal">
                        <strong class="text-primary">Be the first to reply</strong>
                    </a>
                </div>
            </div>

        @endif
    @endforelse

    @if($thread->closed)
        <div class="card shadow-lg mt-3">
            <div class="card-body text-center">
                <strong class="text-danger">This thread has been closed</strong>
            </div>
        </div>
    @endif


    @if(!$thread->closed)
        <div class="modal fade in show" id="replyModal"
             tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="align-items: flex-end;">
                <div class="modal-content">
                    <form action="{{ route('reply.store',$thread->uuid) }}" method="post">
                        @csrf

                        <div class="modal-body">
                    <textarea name="text" id="editor" class="from-control shadow-none w-100"
                              placeholder="Add text"  style="border: none;outline:none;"></textarea>
                            @error('text') {{ $message }} @enderror

                            <input id="previewThis" type="checkbox"> Preview Mode
                            @if(config('discuss.anonymous.reply'))
                            <div class="form-check float-right">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Anonymous
                                </label>
                            </div>
                                @endif

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Post Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif





@endsection
