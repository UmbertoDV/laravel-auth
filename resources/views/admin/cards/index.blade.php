@extends('layouts.app')

@section('title', 'Cards')

@section('content')
<section>
  <div class="container">

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
              <a href="{{ route('admin.cards.show', $card) }}"><i class="bi bi-eye"></i></a>
            </td>
          </tr>
          @empty
        @endforelse
      </tbody>
    </table>

    {{ $cards->links() }}

  </div>
</section>
@endsection