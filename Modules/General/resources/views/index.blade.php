@extends('general::layouts.master')

@section('content')

<div class="container mt-3">
  <h2>Stacked form</h2>
  <form action="{{ route('general.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 mt-3">
      <label for="file">Gambar:</label>
      <input type="file" class="form-control" id="file" placeholder="Enter File" name="image">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
