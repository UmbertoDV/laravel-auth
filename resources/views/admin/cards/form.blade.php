@extends('layouts.app')

@section('title', ($card->id) ? 'Modifica Card' : 'Crea Card')

@section('actions')
    <div>
      <a class="btn btn-primary" href="{{ route('admin.cards.index') }}">Torna alla lista</a>
      @if ($card->id)
        <a href="{{ route('admin.cards.show', $card) }}" class="btn btn-primary mx-1">Mostra Card</a>
      @endif
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

<section class="card">
    <div class="card-body">

      @if ($card->id)
        <form method="POST" action="{{ route('admin.cards.update', $card) }}">
          @method('PUT')
      @else
      <form method="POST" action="{{ route('admin.cards.store') }}" class="row">
      @endif

      @csrf

      <div class="col-4 mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $card->title) }}" >
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-4 mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input type="url" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $card->image) }}" >
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        <img src="{{ old('image', $card->image) }}" alt="">
      </div>

      <div class="col-4 mb-3">
        <label for="text" class="form-label">Testo</label>
        <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror">{{ $card->text }}</textarea>
        @error('text')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Salva">
      </div>
      
      </form>
    </div>
</section>

@endsection