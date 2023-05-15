@extends('layouts.form')
@section('title', 'Add - Frame')

@section('form')
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
                value="{{ old('username') }}"
            >
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input
                    type="file"
                    class="custom-file-input"
                    name="image"
                    onchange="previewImage(event);"
                    value="{{ old('image') }}"
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
@endsection
