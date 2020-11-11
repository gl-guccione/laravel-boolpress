@extends('layouts.app')

@section('content')

  <form action="{{route('admin.posts.store')}}" method="POST">

    @csrf
    @method('POST')

    <div class="form-group">
      <label for="title">Titolo *</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del post" required>
    </div>

    <div class="form-group">
      <label for="slug">Slug *</label>
      <input type="text" class="form-control" id="slug" name="slug" placeholder="Inserisci lo slug del post" required>
    </div>

    <div class="form-group">
      <label for="image">Immagine</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>

    <div class="form-group">
    </div>

    <div class="form-group">
      <label for="content">Contenuto</label>
      <textarea name="content" class="form-control" id="content" cols="30" rows="10" placeholder="Inserisci il contenuto del post" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Crea Post</button>

  </form>

@endsection