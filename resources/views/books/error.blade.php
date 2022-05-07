@extends('layouts.app')


@section('content')
<h1>ERROR</h1>
<h2>編集権限がありません。</h2>

<a href="{{route('books.index')}}" class="btn btn-secondary">TOPへ戻る</a>

@endsection