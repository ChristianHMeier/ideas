    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}" alt="{{ $idea->user->name }} Avatar">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}"> {{ $idea->user->name }} </a></h5>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('ideas.delete', $idea->id) }}">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                    <a class="mx-2" href="{{ route('ideas.show', $idea->id) }}">View</a>
                    <a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="mb-3">
                        <textarea class="form-control" name="content" id="idea" rows="3">{{ $idea->content }}</textarea>
                        @error('idea')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark"> Edit </button>
                    </div>
                </div>
            </form>
            @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
            @endif
            <div class="d-flex justify-content-between">
                <div>
                    <a href="#" class="fw-light nav-link fs-6">
                        <span class="fas fa-heart me-1"></span>
                        {{ $idea->likes }}
                    </a>
                </div>
                <div>
                    <span class="fs-6 fw-light text-muted">
                        <span class="fas fa-clock"> </span>
                        {{ $idea->created_at }}
                    </span>
                </div>
            </div>
        </div>
        @include('shared.comments-box')
    </div>