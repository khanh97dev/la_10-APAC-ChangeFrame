@extends('layouts.main')
@section('title', 'Farame List')

@section('content')
<div>
    <form
        id="form_search"
        class="form-inline"
    >
        <div class="input-group">
            <div class="input-group-pr">
                <a
                    class="btn btn-success"
                    href="{{ url()->current() }}/add"
                >Add</a>
            </div>
            <input
                class="form-control"
                type="text"
                name="search"
            >
            <div class="input-group-append">
                <button class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</div>
<hr>
<div class="row">
    @foreach ($data as $item)
    <div class="col-md-4">
        <div class="card mb-3 rounded-0">
            <div class="card-header">{{ $item->username }}</div>
            <div class="card-body">
                {{-- Image --}}
                <div class="my-2">
                    <img
                        src="{{ $item->image->src }}"
                        style="object-fit: contain;"
                        height="300"
                        class="card-img-top img-thumbnail"
                        alt="{{ $item->image->title }}"
                    >
                </div>
                {{-- Action --}}
                <div class="d-flex justify-content-between">
                    <a
                        href="#"
                        href="{{ url()->current() }}/edit/{{ $item->id }}"
                        class="btn btn-info"
                    >Edit</a>
                    <a
                        href="/excute/{{ $item->username }}"
                        class="btn btn-success"
                    >Execute</a>
                    <a
                        class="btn btn-warning"
                        data-href="{{ url()->current() }}/delete/{{ $item->id }}"
                        data-message-to-delete="You want delete for: '{{ $item->username }}'"
                        onclick="return handleDelete(event);"
                    >Delete</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<script>
</script>
