# アプリケーション名
coachtechフリマ

## 概要
####  フリマアプリ
<img width="950" alt="スクリーンショット 2024-06-03 152552" src="https://github.com/srgnair/2024-04-04_shirogane__flea-market-app/assets/143247574/43516345-2494-46f0-a288-8a4f9573f530">

## サービスを作成した背景
coachtechブランドのアイテムを出品するために作成しました。

## ~~アプリケーションURL~~
デプロイしていません。

## メイン機能
#### 新規会員登録
- メールアドレス・パスワードで新規会員登録ができます。
#### ログイン・ログアウト機能
- 会員情報をつかってログイン・ログアウトができます。
- Googleアカウント（外部API）
#### 商品一覧・詳細取得機能
- 出品された商品一覧を表示します。
- 商品一覧から選択された商品の詳細情報を表示します。
#### 目的別商品一覧取得機能
- お気に入りに登録した商品一覧を表示します。
- 購入した商品一覧を表示します。
- 出品した商品一覧を表示します。
#### ユーザ情報表示・変更機能
- 登録済みのユーザー情報を確認できます。
- 同じページから編集もできます。
#### お気に入り機能
- 商品詳細ページのハートマークからお気に入り追加・削除ができます。
- 非同期処理でページリロードなしで読みこみます。
#### コメント機能
- 商品詳細ページから商品へのコメントを投稿できます。
- 削除機能もあります。
#### 出品 
- 商品を出品できます。
#### 購入
- 商品を購入できます。
- クレジットカード・銀行振込が選択できます。
#### 配送先設定
- 登録住所以外に配送先を設定できます。
#### 管理画面
- 管理者と利用者の２つの権限があります。
- 管理者は管理者の作成、商品一覧の確認。出品者への送金額の確認ができます。
- 利用者にメールを送信することができます。
#### 商品検索機能
- キーワード検索、カテゴリー・商品の状態・値段の絞込検索ができます。
#### 発送登録・到着登録
- 発送登録と到着登録ができます。
#### 出品者の評価・閲覧
- 取引終了後にお互いの評価ができます。
  
## 使用技術

| カテゴリ       | 技術  |
| :------------- | :------------ |
| フレームワーク | Laravel Framework version:11.4.0 |
| フロントエンド | blade / CSS |
| バックエンド   | php:8.3.3 | nginx:1.25.4
| データベース   | mySQL:8.0.36 / phpMyAdmin:5.2.1 | mailhog:latest
| 認証           | Fortify |
| サーバー       | nginx:1.21.1 |

## テーブル設計
####  <img width="540" alt="スクリーンショット 2024-06-03 131314" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/d8dd0d97-cdb9-42e2-a67f-8a16a716b2c5">
####  <img width="540" alt="スクリーンショット 2024-06-03 131354" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/adac0432-4870-4fa2-ac74-e91703f67f35">
####  <img width="540" alt="スクリーンショット 2024-06-03 131435" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/788a57e0-a46f-4bc5-a6cc-2b78ee9a1a77">
####  <img width="540" alt="スクリーンショット 2024-06-03 131451" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/c7fa44ec-b779-499d-8886-8299dc294766">
####  <img width="540" alt="スクリーンショット 2024-06-03 131505" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/f3041899-cd5c-4855-86dd-5dc52476f11c">
####  <img width="540" alt="スクリーンショット 2024-06-03 131521" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/a3b0caf8-d848-44e0-bec7-54f40b11c487">

## ER図
####  <img width="540" src="https://github.com/srgnair/2024-02-04_shirogane_Rese/assets/143247574/8b447129-b518-4080-b149-c8aa33489efa">

## 環境構築

###### まず、GitHubからリポジトリをクローンします。

```bash
 git clone https://github.com/srgnair/2024-04-04_shirogane__flea-market-app.git
 cd 2024-04-04_shirogane__flea-market-app
```

###### 次に、Composerを使用して依存パッケージをインストールします。

```bash 
composer install
```

###### .env.example ファイルをコピーして .env ファイルを作成します。

```bash
cp .env.example .env
```

###### アプリケーションキーを生成します。

```bash
php artisan key:generate
```

###### .env ファイルを開き、データベース接続情報を設定します。
###### 足りない部分を追加してください。

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=
```

###### データベースのテーブルを作成するためにマイグレーションを実行します。

```bash
php artisan migrate
```

###### ローカルサーバの起動・アプリケーションを起動します。

```bash
php artisan serve
```

###### これで、ブラウザから http://localhost にアクセスしてアプリケーションを確認できます。

## ほかに記載すること
全ての機能は完成できませんでした。

