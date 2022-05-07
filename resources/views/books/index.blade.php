@extends('layouts.app')


@section('content')
<h1>家計簿</h1>
<a href="{{route('books.create')}}" class="btn btn-secondary">新規データ追加</a>

<h2>検索条件</h2>
<form method="POST" action="search">
    @csrf
     @csrf
        <div class="form-group">
            <label>レビュー日</label>
                <input type="number" name="year" class="form-control">
        </div>
        
        <div class="form-group">
            <label>対象月</label>
                <input type="number" name="month" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="product-name">収支区分</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="inout" value="1" checked>
                <label class="form-check-label">収入</label>
            </div>
            <div class = "form-check">
                <input class="form-check-input" type="radio" name="inout" value="2">
                <label class="form-check-label" for="inout">支出</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="product-name">カテゴリ</label>
            <select class="custom-select" name="category">
                @foreach(App\Book::$categories as $category)
                    <option value="{{$category}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="product-name">金額</label>
            <input type="number" name="amount" id="product-name" class="form-control">
        </div>
        
        
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
        <td>
             @if(file_exists(public_path().'/storage/post_img/'. $book->id .'.jpg'))
                <img src="/storage/post_img/{{ $book->id }}.jpg" witth=75 height=50>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.jpeg'))
                <img src="/storage/post_img/{{ $book->id }}.jpeg" witth=75 height=50>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.png'))
                <img src="/storage/post_img/{{ $book->id }}.png" witth=75 height=50>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.gif'))
                <img src="/storage/post_img/{{ $book->id }}.gif" witth=75 height=50>
            @else
                <img src="/storage/post_img/noImage.png" witth=75 height=50>
            @endif
        </td>
        <td>{{ $book->year }}年{{ $book->month }}月</td>
        <td>ID:{{ $book->user_id }}</td>
        <td>{{ $book->inout }}</td>
        <td>{{ $book->category }}</td>
        <td>{{ $book->amount }}万円</td>
        <td>
            <a href="{{ route('books.show',$book) }}" class="btn btn-outline-info">詳細</a>
            @if(Auth::user()->id == $book->user_id)
            <a href="{{ route('books.edit',$book) }}" class="btn btn-outline-dark">編集</a>
            <form action="/books/{{$book->id}}" method="POST" style="display:inline;">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-outline-danger" onclick='return confirm("本当に削除しますか？");'>削除</button>
            </form>
            @endif
        </td>
    
    </tr>
    @endforeach
</table>
@endsection