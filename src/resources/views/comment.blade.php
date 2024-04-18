@extends('commonWithSearchFunction')
@section('title')
<title>コメント-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="comment">

    <div class="comment__img">
        @foreach($itemImages as $itemImage)
        <img src="{{ asset('img/itemImage.png') }}" alt="イメージ画像">
        @endforeach
    </div>

    <div class="comment__item-info">

        <div class="comment__item-info--item">
            <div class="comment__item-info--title">
                {{ $item->item_name }}
            </div>
            <div class="comment__item-info--brand-name">
                {{ $item->brand_name }}
            </div>
            <div class="comment__item-info--price">
                ￥{{ number_format($item->price, 0, '.', ',') }}
            </div>
            <div class="comment__item-info--icon-wrapper">
                <div class="comment__item-info--icon">
                    <div class="comment__item-info--star">
                        @if(Auth::check() && Auth::user()->is_like($item->id))
                        <form action="{{ route('deleteLike', ['item_id' => $item->id] ) }}" method="POST" class="mb-4">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <button type="submit">
                                <i class="fa-regular fa-star fa-xl" style="color: #ff5555;"></i>
                            </button>
                            <div class=" detail__item-info--number">{{ $likes->count() }}
                            </div>
                        </form>
                        @else
                        <form action="{{ route('like', ['item_id' => $item->id])  }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <button type="submit">
                                <i class="fa-regular fa-star fa-xl"></i>
                            </button>
                            <div class=" detail__item-info--number">{{ $likes->count() }}
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="comment__item-info--icon">
                    <i class="fa-regular fa-comment fa-xl"></i>
                    <div class=" detail__item-info--number">{{ $comments->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="comment__item-info--talk-history-wrapper">
            <div class="comment__item-info--talk-history">
                トーク履歴
                @if($comments->isEmpty())
                <p>コメントはありません</p>
                @else
                @foreach($comments as $comment)
                @if($comment->item_id == $item_id)
                <div class="@if($comment->user_id == auth()->id()) comment-right @else comment-left @endif">

                    <form action="{{ route('commentDelete', ['comment_id' => $comment->id, 'item_id' => $item_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="reserve__edit">
                            <p>{{ $comment->text }}</p>
                        </button>
                    </form>


                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>


        <div class="comment__item-info--comment-input">
            <div class="comment__item-info--title">
                商品へのコメント
            </div>
            <form action="{{ route('comment', ['item_id' => $item->id])  }}" method="POST" class="mb-4">
                @csrf
                <div class="comment__item-info--input">
                    <textarea name="text" cols="30" rows="10"></textarea>
                </div>
                <div class="comment__item-info--button">
                    <button>コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection