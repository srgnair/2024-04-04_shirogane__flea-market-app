@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="admin">
    <div class="adminShopContents">
        <div class="adminShopContents__title">
            メール送信
        </div>
        <div class="adminShopContents__content">

            <form class="form__wrapper" action="{{ route('sendEmail') }}" method="POST">
                @csrf
                <div class="form">

                    <div class="form__item">
                        <select name="recipient">
                            <option value="">宛先を選択してください</option>
                            @foreach($users as $user)
                            @if($user)
                            <option value="{{ $user->email }}">{{ $user->user_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form__item">
                        <input size="20" type="text" class="wide" name="subject" placeholder="こちらに件名を入力してください" />
                    </div>

                    <div class="form__item">
                        <textarea name="body" cols="50" rows="5" placeholder="こちらに本文を入力してください"></textarea>
                    </div>

                    @if(session('message'))
                    <div class="form__submit">
                        {{ session('message') }}
                    </div>
                    @else
                    <div class="form__submit">
                        <button type="submit">メール送信</button>
                    </div>
                    @endif

                </div>

            </form>
        </div>

    </div>
</div>
@endsection