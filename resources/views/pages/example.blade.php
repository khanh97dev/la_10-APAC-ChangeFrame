@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
<div class="q-pa-md">
    <q-table
        :rows="{{ json_encode(\App\Models\Food::getData()) }}"
        row-key="name"
        :pagination="{
            rowsPerPage: {{ request(K_PER_PAGE, V_PER_PAGE) }}
        }"
        flat
        bordered
    />
</div>
@endsection
