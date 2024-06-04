@extends('commonWithSearchFunction')
@section('title')
<title>マイページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="review">
    <p>{{ $seller_information->user_name }}さんのレビュー一覧</p>
    <table>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <th>評価</th>
                <th>コメント</th>
            </tr>
            <tr>
                <td>{{ $review->rating }}</td>
                <td>{{$review->comment }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection