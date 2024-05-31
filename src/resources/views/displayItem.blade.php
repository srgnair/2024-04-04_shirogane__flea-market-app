@extends('commonOnlyLogo')
@section('title')
<title>出品-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endsection
@section('content')
<div class="list-item__container">
    <div class="form__submit">
        {{ session('message') }}
    </div>
    <div class="form__submit">
        {{ session('image') }}
    </div>
    <form class="form__wrapper" action="{{ route('displayItem') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class=" list-item__title">
            商品の出品
        </div>
        <div class="list-item__form">
            <div class="form__item">
                @error('image')
                <p>{{$errors->first('image')}}</p>
                @enderror
                <div class="form__item--border">
                    <div class="form__image--select-button">
                        <input type="file" class="fileElem" onchange="onChangeFileInput(this)" id="fileElem" multiple accept="image/*" style="display:none" name="image" />
                        <button id="fileSelect" type="button">画像を選択する</button>
                        <div id="fileList"></div>
                    </div>
                </div>
                <script src="{{ asset('js/sendImg.js') }}"></script>
            </div>
            <div class="list-item__form">
                <div class="form__title">商品の詳細</div>
                <div class="form__item">
                    <label for="category">カテゴリー</label>
                    @error('category')
                    <p>{{$errors->first('category')}}</p>
                    @enderror
                    <!-- <input type="text" name="category" value="{{ old('category') }}" /> -->
                    <select id="selectCategory" name="category" class="form__item--control">
                        <option value="">選択してください</option>
                        <option value="1">ファッション</option>
                        <option value="2">ベビー・キッズ</option>
                        <option value="3">ゲーム・おもちゃ・グッズ</option>
                        <option value="4">メンズ</option>
                        <option value="5">レディース</option>
                    </select>
                </div>
                <div class="form__item">
                    <label for="condition">商品の状態</label>
                    @error('condition')
                    <p>{{$errors->first('condition')}}</p>
                    @enderror
                    <!-- <input type="text" name="condition" value="{{ old('condition') }}" /> -->
                    <select id="selectCondition" name="condition" class="form__item--control">
                        <option value="">選択してください</option>
                        <option value="1">新品、未使用</option>
                        <option value="2">未使用に近い</option>
                        <option value="3">目立った傷や汚れなし</option>
                        <option value="4">やや傷や汚れあり</option>
                        <option value="5">傷や汚れあり</option>
                    </select>
                </div>
                <div class="form__item">
                    <label for="condition">ブランド名</label>
                    @error('brand_name')
                    <p>{{$errors->first('brand_name')}}</p>
                    @enderror
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" />
                </div>
            </div>
            <div class="list-item__form">
                <div class="form__title">商品名と説明</div>
                <div class="form__item">
                    <label for="item-name">商品名</label>
                    @error('item_name')
                    <p>{{$errors->first('item_name')}}</p>
                    @enderror
                    <input type="text" name="item_name" value="{{ old('item_name') }}" />
                </div>
                <div class="form__item">
                    <label for="description">商品の説明</label>
                    @error('description')
                    <p>{{$errors->first('description')}}</p>
                    @enderror
                    <textarea name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="list-item__form--price">
            <div class="form__title">販売価格</div>
            <div class="form__item">
                <label for="price">販売価格</label>
                @error('price')
                <p>{{$errors->first('price')}}</p>
                @enderror
                <input type="text" name="price" value="{{ old('price') }}" />
            </div>
        </div>
        <div class="form__submit">
            <button type="submit">出品する</button>
        </div>
    </form>
</div>
@endsection