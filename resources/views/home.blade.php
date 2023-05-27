@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="row">
    <ul class="list-group">
        @foreach($pages as $page)
        <a class="list-group-item" href="/{{ $page['data']['uri'] }}">
            <li class="list-group-item">
                {{ $page['data']['page_name'] }}
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
