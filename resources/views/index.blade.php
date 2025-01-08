@extends('layouts.app')

@section('content')
<h1 class="text-center">Cat Facts PDF Generator</h1>
<form id="cat-facts-form" method="POST" action="{{ route('generate-pdf') }}">
    @csrf
    <div class="mb-3">
        <label for="facts-count" class="form-label">Số lượng sự thật về mèo:</label>
        <input type="number" class="form-control" id="facts-count" name="facts_count" min="1" max="100" required>
    </div>
    <button type="submit" class="btn btn-primary">Lấy thông tin</button>
</form>
@endsection
