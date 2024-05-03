@extends('commonOnlyLogo')
@section('title')
<title>出品-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endsection
@section('content')
<div class="list-item__container">
    @if (count($errors) > 0)
    <p>内容を確認してください</p>
    @endif
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
                <!-- <label for="image">商品画像</label> -->
                @error('image')
                <p>{{$errors->first('image')}}</p>
                @enderror
                <div class="form__item--border">
                    <div class="form__image--select-button">
                        <!-- <input class="form__item--control" type="file" name="image">
                        <button>画像を選択する</button> -->
                        <input type="file" id="fileElem" multiple accept="image/*" style="display:none" name="image" />
                        <button id="fileSelect" type="button">画像を選択する</button>
                        <script>
                            const fileSelect = document.getElementById("fileSelect");
                            const fileElem = document.getElementById("fileElem");

                            fileSelect.addEventListener("click", (e) => {
                                if (fileElem) {
                                    fileElem.click();
                                }
                            }, false);
                        </script>
                    </div>
                </div>
            </div>
            <div class="list-item__form">
                <div class="form__title">商品の詳細</div>
                <div class="form__item">
                    <label for="category">カテゴリー</label>
                    @error('category')
                    <p>{{$errors->first('category')}}</p>
                    @enderror
                    <input type="text" name="category" value="{{ old('category') }}" />
                    <!-- <select id="selectArea" name="area" class="form__item--control">
                        <option value="">area</option>
                        <option value="1">東京都</option>
                        <option value="2">大阪府</option>
                        <option value="3">福岡県</option>
                    </select> -->
                </div>
                <div class="form__item">
                    <label for="condition">商品の状態</label>
                    @error('condition')
                    <p>{{$errors->first('condition')}}</p>
                    @enderror
                    <input type="text" name="condition" value="{{ old('condition') }}" />
                </div>
                <div class="form__item">
                    <label for="condition">商品の状態</label>
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