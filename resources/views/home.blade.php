@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div>
    <form id="form_search" class="form-inline">
        <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text">Search</span>
            </div>
            <input class="form-control" type="text" name="search">
        </div>
    </form>
</div>
<hr/>
<div class="row">
    @for ($i = 1; $i <= 5; $i++)
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 rounded-0">
            <div class="card-header">Header</div>
            <div class="card-body">
                <h5 class="card-title">Primary card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                {{-- Image --}}
                <div class="my-2">
                    <img src="https://placekitten.com/400/300" style="object-fit: cover;" height="150" class="card-img-top" alt="...">
                </div>
                {{-- Action --}}
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-info">Card link</a>
                    <a href="#" class="btn btn-warning">Another link</a>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>
@endsection
