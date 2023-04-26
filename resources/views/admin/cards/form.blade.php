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
        <form method="POST" action="{{ route('admin.cards.update', $card) }}" enctype="multipart/form-data">
          @method('PUT')
      @else
      <form method="POST" action="{{ route('admin.cards.store') }}" class="row" enctype="multipart/form-data">
      @endif

      @csrf

      <div class="col-4 mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $card->title)  }}" >
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-4 mb-3">
        <label for="published" class="form-label">Pubblicato</label>
        <input type="checkbox" name="published" id="published" class="form-check-control @error('published') is-invalid @enderror" @checked(old('published', $card->published)) value="1">
        @error('published')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-4 mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" >
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        <img src="{{ $card->getImageUri() }}" alt="" width="200" class="mt-2" id="image-preview">
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

@section('scripts')
    <script>
      const imageInputEl = document.getElementById('image');
      const imagePreviewEl = document.getElementById('image-preview');
      const placeholder = imagePreviewEl.src;

      imageInputEl.addEventListener('change', () => {
        if(imageInputEl.files && imageInputEl.files[0]){
          const reader = new FileReader();
          reader.readAsDataURL(imageInputEl.files[0]);

          reader.onload = e => {
            imagePreviewEl.src = e.target.result;
          }
        } else{
          imagePreviewEl.src = placeholder;
        }
      })
    </script>
@endsection