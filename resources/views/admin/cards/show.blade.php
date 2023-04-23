@extends('layouts.app')

@section('title', $card->title)

@section('content')
<section class="clearfix">
  <a href="{{ route('admin.cards.index') }}" class="btn btn-primary float-end">Torna alla lista</a>

  <div class="card">
    <div class="card-body">
      <img src="{{ $card->image }}" alt="" width="250" class="float-start me-3 mb-1">
      <p>{{ $card->text }}</p>
    </div>
  </div>
</section>
@endsection