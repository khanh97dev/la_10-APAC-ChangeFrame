@extends('layouts.main')
@section('title', 'Farame Add')

@section('content')

<div class="d-flex justify-content-center">
    <form
        action="/frame/create"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span
                    class="input-group-text"
                    id="basic-addon3"
                >Username </span>
            </div>
            <input
                type="text"
                class="form-control"
                name="username"
            >
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input
                    type="file"
                    class="custom-file-input"
                    name="image"
                    onchange="previewImage(event);"
                >
                <hr>
                <div class="d-flex justify-content-center">
                    <img class="img-thumbnail" style="object-fit: contain; max-height: 200px;" id="preview_image" src="" alt="">
                </div>
            </div>
        </div>

        <input
            class="btn btn-primary w-100"
            type="submit"
            value="Add"
        />
    </form>
</div>

@endsection

<script>

    function previewImage(event)
    {
        const [file] = event.target.files
        preview_image.src = URL.createObjectURL(file)
    }
</script>
