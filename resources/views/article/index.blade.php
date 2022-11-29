@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2><a href="{{ $url = url('articles'); }}/{{$article->id}}">{{$article->name}}</a></h2>
        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
<a href="{{ route('articles.edit', $article) }}">Редактировать</a> 
<a href="{{url("/articles/$article->id")}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
<!--form action="{{url("/articles/$article->id")}}" method="post">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<button type="submit">Delete</button>
</form-->
    @endforeach
    {{$articles->links();}}
@endsection