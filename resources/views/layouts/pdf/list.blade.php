@extends('layouts.app')

@section('content')
<h1 class="text-center">Danh sách các file PDF</h1>
<ul class="list-group">
    @foreach ($files as $file)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ basename($file) }}
            <a href="{{ asset('storage/' . basename($file)) }}" class="btn btn-success btn-sm" download>Tải xuống</a>
        </li>
    @endforeach
</ul>
@endsection
