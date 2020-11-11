@extends('layouts.app')

@section('content')

    <ul>
      @foreach ($posts as $post)
        <li>
          <h3>Titolo: {{$post->title}}</h3>
          <h4>Autore: {{$post->user->name}}</h4>
          <h6>
            <a href="{{ route('admin.posts.show', $post->slug)}}">Dettagli</a>
            -
            <a href="{{ route('admin.posts.edit', $post->slug)}}">Modifica</a>
            -
            <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="Elimina">
            </form>
          </h6>
        </li>
      @endforeach
    </ul>

@endsection