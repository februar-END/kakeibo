@extends("layouts.app")

@section("content")

<h1>家計簿詳細</h1>
<table class="table table-striped">
    <tr>
        <th>年月</th>
        <td>{{ $book->year }}年{{ $book->month }}月</td>
    </tr>
    
    <tr>
        <th>ユーザーID</th>
        <td>{{ $book->user_id }}</td>
    </tr>
    
    <tr>
        <th>ログインユーザーID</th>
        <td>{{ Auth::user()->id}}</td>
    </tr>
    
    <tr>
        <th>区分</th>
        <td>{{ $book->inout }}</td>
    </tr>
    
    <tr>
        <th>科目</th>
        <td>{{ $book->category }}</td>
    </tr>
    
    <tr>
        <th>金額</th>
        <td>{{ $book->amount }}万円</td>
    </tr>
    
    <tr>
        <th>メモ</th>
        <td>{{$book->memo}}</td>
    </tr>
    <tr>
        <th>
            @if(file_exists(public_path().'/storage/post_img/'. $book->id .'.jpg'))
                <img src="/storage/post_img/{{ $book->id }}.jpg" witth=300 height=200>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.jpeg'))
                <img src="/storage/post_img/{{ $book->id }}.jpeg" witth=300 height=200>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.png'))
                <img src="/storage/post_img/{{ $book->id }}.png" witth=300 height=200>
            @elseif(file_exists(public_path().'/storage/post_img/'. $book->id .'.gif'))
                <img src="/storage/post_img/{{ $book->id }}.gif" witth=300 height=200>
            @endif
        </th>
    </tr>
    
</table>
<a href="{{route('books.index')}}" class="btn btn-secondary">TOPへ戻る</a>
@endsection