@extends('layouts.main')
@section('title')

@section('content')
<div class="d-flex justify-content-center">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="d-flex justify-content-center">
    @yield('form')
</div>
@endsection

<script>
    function previewImage(event) {
        const [file] = event.target.files
        preview_image.src = URL.createObjectURL(file)
    }
</script>
