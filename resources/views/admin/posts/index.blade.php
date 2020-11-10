@extends('layouts.app');

@section('content')

    <ul>
      @foreach ($posts as $post)
        <li>
          <h3>Titolo: {{$post->title}}</h3>
          <h4>Autore: {{$post->user->name}}</h4>
          <h6>Dettagli - Modifica - Elimina</h6>
        </li>
      @endforeach
    </ul>

@endsection