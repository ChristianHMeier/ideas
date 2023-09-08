
<h4> Edit your idea </h4>
<form action="{{ route(('ideas.update', $idea->id)) }}" method="post" >
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
            <button class="btn btn-dark"> Edit </button>
        </div>
    </div>
</form>
@else
<p class="fs-6 fw-light text-muted">{{ $idea->content }}</p>
@endif