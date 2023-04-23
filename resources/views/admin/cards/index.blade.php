@extends('layouts.app')

@section('title', 'Cards')

@section('actions')
    <div>
      <a class="btn btn-primary" href="{{ route('admin.cards.create') }}">Crea nuovo post</a>
    </div>
@endsection

@section('content')
<section>
  <div class="container">
    <div class="card px-4">

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Abstract</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($cards as $card)
            <tr>
              <th scope="row">{{ $card->id }}</th>
              <td>{{ $card->title }}</td>
              <td>{{ $card->getAbstract() }}</td>
              <td>
                <a href="{{ route('admin.cards.show', $card) }}"><i class="bi bi-eye mx-2"></i></a>
                <a href="{{ route('admin.cards.edit', $card) }}"><i class="bi bi-pencil mx-2"></i></i></a>
                <a href="{{ route('admin.cards.edit', $card) }}" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-post-{{ $card->id }}"><i class="bi bi-trash mx-2"></i></i></a>
              </td>
            </tr>
            @empty
          @endforelse
        </tbody>
      </table>
  
      {{ $cards->links() }}
    </div>

  </div>
</section>
@endsection

@section('modals')
    @foreach ($cards as $card)
      

      <div class="modal modal-lg fade" id="delete-modal-post-{{ $card->id }}" tabindex="-1" aria-labelledby="delete-modal-post-{{ $card->id }}-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-post-{{ $card->id }}-label">Rimuovi Card</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sei sicuro di voler eliminare il post "{{ $card->title }}"? <br>
              L'operazione non è reversibile
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
              <form method="POST" action="{{ route('admin.cards.destroy', $card) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection