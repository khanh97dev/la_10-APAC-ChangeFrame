@extends('layouts.main')
@section('title', 'Excute: ' . request()->input('username', '⚠ username not found!'))

@section('content')
<div class="row">
    @forelse ($images as $image)
    <div class="col-4">
        <a href="{{  '/storage/images/' . $image }}" target="_blank">
            <img src="{{  '/storage/images/' . $image }}" alt="{{ basename($image) }}">
        </a>
    </div>
    @empty
        Image not found
    @endforelse
</div>
@endsection

<script>

</script>
