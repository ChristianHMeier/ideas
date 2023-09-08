@extends('layout.layout')
@section('content')
@auth()
<h4> Edit your comment </h4>
<form action="{{ route('ideas.comments.update', [$idea, $comment]) }}" method="post" >
    @csrf
    @method('put')
    <div class="row">
        <div class="mb-3">
            <textarea class="form-control" name="content" id="comment" rows="3">{{ $comment->content }}</textarea>
            @error('content')
            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="">
            <button class="btn btn-dark"> Edit </button>
        </div>
    </div>
</form>
@endauth
@guest
<h4>Only logged in users can edit</h4>
@endguest
@endsection