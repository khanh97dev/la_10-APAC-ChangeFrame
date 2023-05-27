@extends('layouts.main')
@section('title', 'Megred image')

@section('content')
<div class="row">
    @forelse ($images as $image)
    <div class="col-4">
        <a
            href="{{  '/storage/images/' . $image }}"
            target="_blank"
        >
            <img
                class="img-thumbnail"
                style="object-fit: contain;"
                width="300"
                src="{{  '/storage/images/' . $image }}"
                alt="{{ basename($image) }}"
            >
        </a>
    </div>
    @empty
        Image not found
    @endforelse
</div>
@endsection

<script>

</script>
