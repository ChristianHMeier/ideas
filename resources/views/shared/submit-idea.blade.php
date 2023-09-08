
@auth()
<h4> Share your ideas </h4>
<form action="{{ route('ideas.create') }}" method="post">
    @csrf
    <div class="row">
        <div class="mb-3">
            <textarea class="form-control" name="content" id="idea" rows="3"></textarea>
        </div>
        <div class="">
            <button class="btn btn-dark"> Share </button>
        </div>
    </div>
</form>
@endauth
@guest
<h4>You must log in to share ideas</h4>
@endguest