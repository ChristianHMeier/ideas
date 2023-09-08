@extends('layout.layout')
@section('content')
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.user-edit-card')
            </div>
            <div class="col-3">
                @include('shared.search-box')
                @include('shared.follow-box')
            </div>
        </div>
@endsection