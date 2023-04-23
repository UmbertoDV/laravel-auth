@extends('layouts.app')

@section('title', 'Crea nuova card')

@section('actions')
    <div>
      <a class="btn btn-primary" href="{{ route('admin.cards.index') }}">Torna alla lista</a>
    </div>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.cards.store') }}" class="row">
      @csrf

      <div class="col-4 mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" name="title" id="title" class="form-control">
      </div>

      <div class="col-4 mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input type="text" name="image" id="image" class="form-control">
      </div>

      <div class="col-4 mb-3">
        <label for="text" class="form-label">Testo</label>
        <textarea name="text" id="text" class="form-control"></textarea>
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Salva">
      </div>
      
      </form>
    </div>
</section>

@endsection