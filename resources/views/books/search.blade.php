@extends('layouts.app')


@section('content')
<h1>家計簿</h1>
<h2>検索条件</h2>
<form method="POST" action="search">
    @csrf
    <p>金額<input type="number" name="num">万円以上</p>
    <button type="submit">検索</button>
</form>

<table class="table">
    <tr>
        <th>年月</th>
        <th>区分</th>
        <th>科目</th>
        <th>金額</th>
        <th>リンク</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{ $book->year }}年{{ $book->month }}月</td>
        <td>{{ $book->inout }}</td>
        <td>{{ $book->category }}</td>
        <td>{{ $book->amount }}万円</td>
        <td>
            <a href="{{ route('books.edit',$book) }}" class="btn btn-warning">編集</a>
            <a href="{{ route('books.show',$book) }}" class="btn btn-info">詳細</a>
            <form action="/books/{{$book->id}}" method="POST" style="display:inline;">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger" onclick='return confirm("本当に削除しますか？");'>削除</button>
            </form>
        </td>
    
    </tr>
    @endforeach
</table>
<a href="{{route('books.index')}}" class="btn btn-secondary">TOPへ戻る</a>
@endsection