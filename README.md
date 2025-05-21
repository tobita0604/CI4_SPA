# CI4_SPA Project

A modern web application using CodeIgniter 4 for the backend API and Vue.js 3 for the frontend SPA, all containerized with Docker.

# CI4_SPAプロジェクト

CodeIgniter 4をバックエンドAPIとして、Vue.js 3をフロントエンドSPAとして使用した、Dockerでコンテナ化されたモダンなWebアプリケーションです。

## Project Structure / プロジェクト構成

- `backend/` - CodeIgniter 4 application / CodeIgniter 4アプリケーション
- `frontend/` - Vue.js 3 application / Vue.js 3アプリケーション
- `docker/` - Docker configuration files / Docker設定ファイル
- `docker-compose.yml` - Docker Compose configuration / Docker Compose設定

## Quick Start / クイックスタート

1. Clone the repository: / リポジトリをクローン
   ```
   git clone https://github.com/tobita0604/CI4_SPA.git
   cd CI4_SPA
   ```

2. Copy environment file: / 環境変数ファイルをコピー
   ```
   cp .env.example backend/.env
   ```

3. Start the Docker containers: / Dockerコンテナを起動
   ```
   docker-compose up -d
   ```

4. Run database migrations: / データベースマイグレーションを実行
   ```
   docker exec -it ci4spa_backend php spark migrate
   ```

5. Run database seeder: / データベースシーダーを実行
   ```
   docker exec -it ci4spa_backend php spark db:seed UserSeeder
   ```

6. Access the application: / アプリケーションにアクセス
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8080/api
   - phpMyAdmin: http://localhost:8081 (username: root, password: root)

## Features / 機能

### Backend (CodeIgniter 4)
- RESTful API structure / RESTful API構造
- User authentication with filters / フィルターによるユーザー認証
- MySQL database integration / MySQLデータベース連携
- CORS support for frontend-backend communication / フロントエンドとバックエンド間のCORSサポート

### Frontend (Vue.js 3)
- TypeScript support / TypeScript対応
- Vuetify as UI component library / VuetifyによるUIコンポーネント
- Tailwind CSS for custom styling / Tailwind CSSによるカスタムスタイル
- Pinia for state management / Piniaによる状態管理
- Vue Router for navigation / Vue Routerによる画面遷移
- Axios for API communication / AxiosによるAPI通信

## Development / 開発

### Backend Commands / バックエンドコマンド
Run these commands inside the backend container:  
バックエンドコンテナ内で以下のコマンドを実行してください。

```
# Access the container / コンテナへアクセス
docker exec -it ci4spa_backend bash

# Run migrations / マイグレーション実行
php spark migrate

# Create a new migration / 新しいマイグレーション作成
php spark make:migration CreateTableName

# Create a new controller / 新しいコントローラ作成
php spark make:controller ControllerName

# Create a new model / 新しいモデル作成
php spark make:model ModelName
```

### Frontend Commands / フロントエンドコマンド
Run these commands inside the frontend container:  
フロントエンドコンテナ内で以下のコマンドを実行してください。

```
# Access the container / コンテナへアクセス
docker exec -it ci4spa_frontend sh

# Install dependencies / 依存関係インストール
npm install

# Run development server / 開発サーバー起動
npm run dev

# Build for production / 本番ビルド
npm run build
```

## License / ライセンス

MIT
