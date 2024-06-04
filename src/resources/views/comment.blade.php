@extends('commonWithSearchFunction')
@section('title')
<title>コメント-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/like.js') }}"></script>
@endsection
@section('content')

<div class="comment">

    <div class="comment__img">
        @foreach($itemImages as $itemImage)
        <div class="card__image-container">
            <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
            <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
        </div>
        @endforeach
    </div>

    <div class="comment__item-info--wrapper">

        <div class="comment__item-info">
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
                        <form action="{{ route('deleteLike', ['item_id' => $item->id] ) }}" method="POST" class="like-form mb-4">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                            <button type="submit" class="like-button">
                                <i class="fa fa-star fa-xl" style="color: #ff5555;"></i>
                            </button>
                            <div class="comment__item-info--number">{{ $likes->count() }}</div>
                        </form>
                        @else
                        <form action="{{ route('like', ['item_id' => $item->id]) }}" method="POST" class="like-form mb-4">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                            <button type="button" class="like-button">
                                <i class="fa fa-star-o fa-xl"></i>
                            </button>
                            <div class="comment__item-info--number">{{ $likes->count() }}</div>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="comment__item-info--icon">
                    <i class="fa-regular fa-comment fa-xl"></i>
                    <div class=" comment__item-info--number">{{ $comments->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="comment__item-info--talk-history">
            @if($comments->isEmpty())
            <p>コメントはありません</p>
            @else
            @foreach($comments as $comment)
            @if($comment->item_id == $item_id)
            <div class="@if($comment->user_id == auth()->id()) comment-right @else comment-left @endif">
                <div class="comment__user-icon">

                    @if (Auth::check() && Auth::user()->img !== null)
                    <img src="{{ asset($comment->user->img) }}" alt="イメージ画像">
                    @else
                    <img src="{{ asset('img/sampleUserImage.png') }}" alt="イメージ画像">
                    @endif

                </div>
                <div class="comment__name">
                    {{ $comment->user->user_name}}
                </div>
                <div class="comment__trash">
                    <form action="{{ route('commentDelete', ['comment_id' => $comment->id, 'item_id' => $item_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="comment__text">
                {{ $comment->text }}
            </div>
            @endif
            @endforeach
            @endif
        </div>


        <div class="comment__item-info--wrapper">
            <div class="comment__item-info--title">
                商品へのコメント
            </div>
            <form action="{{ route('comment', ['item_id' => $item->id])  }}" method="POST" class="mb-4">
                @csrf
                <div class="comment__item-info--input">
                    <textarea name="text" cols="30" rows="10"></textarea>
                </div>
                @error('text')
                <p>{{$errors->first('text')}}</p>
                @enderror
                <div class="comment__item-info--button">
                    <button>コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const routes = {
        like: <?php echo json_encode(route('like', ['item_id' => 'ITEM_ID_PLACEHOLDER'])); ?>,
        deleteLike: <?php echo json_encode(route('deleteLike', ['item_id' => 'ITEM_ID_PLACEHOLDER'])); ?>
    };
</script>

@endsection