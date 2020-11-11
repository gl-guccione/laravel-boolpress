@extends('layouts.app')

@section('content')

  <h1>Titolo: {{$post->title}}</h1>

  @if ($post->image != null)
    <img src="{{asset('storage')}}/{{$post->image}}" alt="{{$post->title}}">
  @endif

  <h2>Autore: {{$post->user->name}}</h2>

  <p>{{$post->content}}</p>

@endsection