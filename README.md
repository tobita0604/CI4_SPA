# CI4_SPA
CodeIgniter 4 と Vue 3 を使用した管理画面のひな形（テンプレート）です。

## 概要

このテンプレートは、以下の機能を備えています：

- **バックエンド**: CodeIgniter 4 + Shield 認証
- **フロントエンド**: Vue 3 + TypeScript + Element Plus
- **Docker** による開発環境の統合

## 機能

### バックエンド

- RESTful API の実装
- CodeIgniter Shield による認証
- ユーザー管理 API
- サンプル項目管理 API
- バリデーションとエラーハンドリング

### フロントエンド

- Vue 3 による SPA 実装
- Element Plus UI ライブラリ
- TypeScript による型定義
- Pinia による状態管理
- Vue Router によるルーティング
- ログイン・認証機能
- ダッシュボード
- ユーザー管理画面
- 項目管理画面

## 環境構築

### 前提条件

- Docker と Docker Compose がインストールされていること

### セットアップ手順

1. リポジトリをクローン
```bash
git clone https://github.com/tobita0604/CI4_SPA.git
cd CI4_SPA
```

2. Docker Compose で環境を起動
```bash
docker-compose up -d
```

3. バックエンドの依存関係をインストール
```bash
docker-compose exec backend composer install
```

4. マイグレーションを実行
```bash
docker-compose exec backend php spark migrate
```

5. 初期ユーザーを作成
```bash
docker-compose exec backend php spark shield:setup
docker-compose exec backend php spark shield:create_user admin@example.com admin Admin@123
```

6. フロントエンドの依存関係をインストール
```bash
docker-compose exec frontend npm install
```

## 使用方法

### 開発環境へのアクセス

- **バックエンド API**: http://localhost:8080
- **フロントエンド**: http://localhost:3000

### ログイン情報

- **メールアドレス**: admin@example.com
- **パスワード**: Admin@123

## ディレクトリ構造

```
CI4_SPA/
├── backend/                 # CodeIgniter 4 バックエンド
│   ├── app/
│   │   ├── Config/          # 設定ファイル
│   │   ├── Controllers/     # コントローラー
│   │   ├── Database/        # マイグレーション
│   │   ├── Filters/         # フィルター
│   │   ├── Models/          # モデル
│   ├── public/              # 公開ディレクトリ
│   └── ...
├── frontend/                # Vue 3 フロントエンド
│   ├── src/
│   │   ├── assets/          # 静的ファイル
│   │   ├── components/      # コンポーネント
│   │   ├── layouts/         # レイアウト
│   │   ├── router/          # ルーティング
│   │   ├── services/        # API サービス
│   │   ├── stores/          # Pinia ストア
│   │   ├── types/           # 型定義
│   │   ├── views/           # ビュー
│   └── ...
└── docker-compose.yml       # Docker Compose 設定
```

## API エンドポイント

### 認証

- `POST /api/login` - ログイン
- `POST /api/register` - ユーザー登録
- `POST /api/logout` - ログアウト
- `GET /api/profile` - ユーザープロフィール

### ユーザー管理

- `GET /api/users` - ユーザー一覧
- `GET /api/users/{id}` - ユーザー詳細
- `POST /api/users` - ユーザー作成
- `PUT /api/users/{id}` - ユーザー更新
- `DELETE /api/users/{id}` - ユーザー削除

### アイテム管理

- `GET /api/items` - アイテム一覧
- `GET /api/items/{id}` - アイテム詳細
- `POST /api/items` - アイテム作成
- `PUT /api/items/{id}` - アイテム更新
- `DELETE /api/items/{id}` - アイテム削除

## ライセンス

MIT
