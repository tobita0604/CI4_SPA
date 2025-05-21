# Contributing to CI4_SPA / CI4_SPAへの貢献について

Thank you for considering contributing to the CI4_SPA project. This document provides guidelines and information to help you contribute effectively.  
CI4_SPAプロジェクトへのご貢献をご検討いただきありがとうございます。このドキュメントは、効果的に貢献するためのガイドラインと情報を提供します。

---

## Table of Contents / 目次

- [Project Overview / プロジェクト概要](#project-overview-プロジェクト概要)
  - [Architecture / アーキテクチャ](#architecture-アーキテクチャ)
  - [Project Structure / プロジェクト構成](#project-structure-プロジェクト構成)
- [Development Environment Setup / 開発環境のセットアップ](#development-environment-setup-開発環境のセットアップ)
  - [Prerequisites / 前提条件](#prerequisites-前提条件)
  - [Setup Instructions / セットアップ手順](#setup-instructions-セットアップ手順)
- [Coding Standards / コーディング規約](#coding-standards-コーディング規約)
  - [General Guidelines / 一般的なガイドライン](#general-guidelines-一般的なガイドライン)
  - [Backend (PHP/CodeIgniter 4) / バックエンド（PHP/CodeIgniter 4）](#backend-phpcodeigniter-4-バックエンドphpcodeigniter-4)
  - [Frontend (Vue.js 3/TypeScript) / フロントエンド（Vue.js 3/TypeScript）](#frontend-vuejs-3typescript-フロントエンドvuejs-3typescript)
- [Git Workflow / Gitワークフロー](#git-workflow-gitワークフロー)
  - [Branch Naming / ブランチ命名規則](#branch-naming-ブランチ命名規則)
  - [Commit Message Format / コミットメッセージフォーマット](#commit-message-format-コミットメッセージフォーマット)
  - [Pull Request Process / プルリクエストの手順](#pull-request-process-プルリクエストの手順)
- [Testing Guidelines / テストガイドライン](#testing-guidelines-テストガイドライン)
  - [Backend Testing / バックエンドテスト](#backend-testing-バックエンドテスト)
  - [Frontend Testing / フロントエンドテスト](#frontend-testing-フロントエンドテスト)
- [CI/CD Process / CI/CDプロセス](#cicd-process-cicdプロセス)
- [AI Implementation Guidelines / AI実装ガイドライン](#ai-implementation-guidelines-ai実装ガイドライン)
  - [General AI Usage / AI利用の一般原則](#general-ai-usage-ai利用の一般原則)
  - [Prompting Best Practices / プロンプト作成のベストプラクティス](#prompting-best-practices-プロンプト作成のベストプラクティス)
  - [Specific Guidelines for CI4_SPA / CI4_SPA向けの具体的ガイドライン](#specific-guidelines-for-ci4_spa-ci4_spa向けの具体的ガイドライン)
  - [Code Review for AI-Generated Code / AI生成コードのレビュー](#code-review-for-ai-generated-code-ai生成コードのレビュー)
- [Additional Resources / 追加リソース](#additional-resources-追加リソース)
- [Questions and Support / 質問・サポート](#questions-and-support-質問サポート)

---

## Project Overview / プロジェクト概要

CI4_SPA is a modern web application using CodeIgniter 4 for the backend API and Vue.js 3 for the frontend SPA, all containerized with Docker. The project follows a clear separation of concerns with dedicated backend and frontend components.  
CI4_SPAは、バックエンドAPIにCodeIgniter 4、フロントエンドSPAにVue.js 3を使用したモダンなWebアプリケーションです。すべてDockerでコンテナ化されており、バックエンドとフロントエンドの責務分離を徹底しています。

---

### Architecture / アーキテクチャ

The project follows a typical modern web application architecture:  
本プロジェクトは、現代的なWebアプリケーションの典型的なアーキテクチャに従っています。

- **Backend**: CodeIgniter 4 PHP framework providing RESTful APIs  
  **バックエンド**: RESTful APIを提供するCodeIgniter 4 PHPフレームワーク
- **Frontend**: Vue.js 3 SPA with TypeScript, Vuetify and Tailwind CSS  
  **フロントエンド**: TypeScript、Vuetify、Tailwind CSSを使用したVue.js 3 SPA
- **Database**: MySQL 8.0  
  **データベース**: MySQL 8.0
- **Containerization**: Docker for development environment consistency  
  **コンテナ化**: Dockerによる開発環境の一貫性確保

---

### Project Structure / プロジェクト構成

```
CI4_SPA/
├── backend/                # CodeIgniter 4 application / CodeIgniter 4アプリケーション
│   ├── app/               # Application code / アプリケーションコード
│   │   ├── Config/        # Configuration files / 設定ファイル
│   │   ├── Controllers/   # API controllers / APIコントローラー
│   │   ├── Models/        # Data models / データモデル
│   │   ├── Filters/       # Request filters / リクエストフィルター
│   ├── public/            # Public assets and entry point / 公開アセット・エントリーポイント
│   ├── tests/             # Test files / テストファイル
│
├── frontend/              # Vue.js 3 application / Vue.js 3アプリケーション
│   ├── src/               # Source files / ソースファイル
│   │   ├── assets/        # Static assets / 静的アセット
│   │   ├── components/    # Vue components / Vueコンポーネント
│   │   ├── router/        # Vue router configuration / ルーター設定
│   │   ├── stores/        # Pinia stores / Piniaストア
│   │   ├── views/         # Vue views / Vueビュー
│   ├── public/            # Public assets / 公開アセット
│
├── docker/                # Docker configuration files / Docker設定ファイル
│   ├── mysql/             # MySQL configuration / MySQL設定
│   ├── node/              # Node.js configuration / Node.js設定
│   ├── php/               # PHP configuration / PHP設定
│
├── docker-compose.yml     # Docker Compose configuration / Docker Compose設定
```

---

## Development Environment Setup / 開発環境のセットアップ

### Prerequisites / 前提条件

- [Docker](https://www.docker.com/get-started) and Docker Compose  
  DockerとDocker Compose
- [Git](https://git-scm.com/downloads)  
  Git

### Setup Instructions / セットアップ手順

1. Clone the repository:  
   リポジトリをクローンします
   ```
   git clone https://github.com/tobita0604/CI4_SPA.git
   cd CI4_SPA
   ```

2. Copy environment file:  
   環境変数ファイルをコピーします
   ```
   cp .env.example backend/.env
   ```

3. Start the Docker containers:  
   Dockerコンテナを起動します
   ```
   docker-compose up -d
   ```

4. Run database migrations:  
   データベースマイグレーションを実行します
   ```
   docker exec -it ci4spa_backend php spark migrate
   ```

5. Run database seeder:  
   データベースシーダーを実行します
   ```
   docker exec -it ci4spa_backend php spark db:seed UserSeeder
   ```

6. Access the application:  
   アプリケーションにアクセスします
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8080/api
   - phpMyAdmin: http://localhost:8081 (username: root, password: root)

---

## Coding Standards / コーディング規約

### General Guidelines / 一般的なガイドライン

- Use UTF-8 encoding for all files  
  すべてのファイルでUTF-8エンコーディングを使用してください
- Use LF (Unix-style) line endings  
  改行コードはLF(Unixスタイル)を使用してください
- Keep lines within a reasonable length (120 characters maximum)  
  1行は120文字以内を目安にしてください
- Write clear, descriptive comments  
  わかりやすく説明的なコメントを記述してください
- Follow the principle of "clean code" - self-documenting, simple, and DRY (Don't Repeat Yourself)  
  「クリーンコード」原則（自己説明的、シンプル、DRY）に従ってください

### Backend (PHP/CodeIgniter 4) / バックエンド（PHP/CodeIgniter 4）

#### PHP Coding Style / PHPのコーディングスタイル

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style  
  PSR-12コーディングスタイルに従ってください
- Use type hints for parameters and return types when possible  
  パラメータや戻り値には可能な限り型ヒントを使用してください
- Use strict_types declaration in PHP files  
  PHPファイルではstrict_types宣言を使用してください

#### CodeIgniter Specific Guidelines / CodeIgniter固有のガイドライン

- Follow the [CodeIgniter 4 Style Guide](https://codeigniter.com/user_guide/contributing/styleguide.html)  
  CodeIgniter 4スタイルガイドに従ってください
- Use CodeIgniter's built-in validation and security features  
  CodeIgniterの組み込みバリデーション・セキュリティ機能を利用してください
- Use the appropriate Models, Services, and Entities pattern  
  適切なモデル・サービス・エンティティパターンを利用してください
- Keep controllers thin and delegate business logic to models or services  
  コントローラーは薄く保ち、ビジネスロジックはモデルやサービスに委譲してください

#### Naming Conventions / 命名規則

- **Controllers**: PascalCase with `Controller` suffix (e.g., `UserController`)  
  コントローラー: `Controller`サフィックス付きパスカルケース（例: `UserController`）
- **Models**: PascalCase with `Model` suffix (e.g., `UserModel`)  
  モデル: `Model`サフィックス付きパスカルケース（例: `UserModel`）
- **Methods**:  
  - Controller methods: camelCase (e.g., `getUsers()`)  
    コントローラーメソッド: camelCase（例: `getUsers()`）
  - Model methods: camelCase (e.g., `findByEmail()`)  
    モデルメソッド: camelCase（例: `findByEmail()`）
- **Variables**: camelCase (e.g., `$userName`)  
  変数: camelCase（例: `$userName`）
- **Database tables**: snake_case plural (e.g., `users`, `blog_posts`)  
  データベーステーブル: 複数形のsnake_case（例: `users`, `blog_posts`）
- **Database columns**: snake_case (e.g., `first_name`, `created_at`)  
  データベースカラム: snake_case（例: `first_name`, `created_at`）

#### Documentation / ドキュメント

- Add PHPDoc blocks to classes and methods  
  クラスやメソッドにはPHPDocブロックを追加してください
- Document parameters, return types, and exceptions  
  パラメータ・戻り値・例外をドキュメント化してください
- Explain complex logic with inline comments  
  複雑なロジックはインラインコメントで説明してください

### Frontend (Vue.js 3/TypeScript) / フロントエンド（Vue.js 3/TypeScript）

#### Vue/TypeScript Style Guide / Vue/TypeScriptスタイルガイド

- Follow the [Vue Style Guide](https://vuejs.org/style-guide/) with priority A and B rules as requirements  
  VueスタイルガイドのA・B優先ルールに従ってください
- Use TypeScript for type safety  
  型安全のためTypeScriptを使用してください
- Prefer the Composition API with `<script setup>` for new components  
  新規コンポーネントにはComposition APIと`<script setup>`を推奨します
- Use ES6+ features appropriately  
  ES6以降の機能を適切に利用してください

#### Component Structure / コンポーネント構成

- Use Single File Components (.vue files)  
  単一ファイルコンポーネント（.vueファイル）を使用してください
- Follow this order in components:  
  コンポーネント内は以下の順序にしてください
  1. `<template>`
  2. `<script>`
  3. `<style>`
- Use kebab-case for component filenames (e.g., `user-profile.vue`)  
  コンポーネントファイル名はkebab-case（例: `user-profile.vue`）で記述してください
- Use PascalCase for component registration and JSX (e.g., `<UserProfile>`)  
  コンポーネント登録やJSXではPascalCase（例: `<UserProfile>`）を使用してください

#### Vuetify and Tailwind CSS Guidelines / Vuetify・Tailwind CSS利用指針

- Use Vuetify components for complex UI elements  
  複雑なUIにはVuetifyコンポーネントを使用してください
- Use Tailwind CSS for custom styling  
  カスタムスタイルにはTailwind CSSを使用してください
- Avoid inline styles when possible  
  可能な限りインラインスタイルは避けてください
- Use CSS utility classes from Tailwind rather than custom CSS when appropriate  
  必要に応じて、独自CSSよりもTailwindのユーティリティクラスを優先してください

#### Naming Conventions / 命名規則

- **Components**: PascalCase (e.g., `UserProfile.vue`)  
  コンポーネント: PascalCase（例: `UserProfile.vue`）
- **Files**: kebab-case (e.g., `user-profile.vue`)  
  ファイル名: kebab-case（例: `user-profile.vue`）
- **Methods**: camelCase (e.g., `fetchUsers()`)  
  メソッド: camelCase（例: `fetchUsers()`）
- **Properties**: camelCase (e.g., `userName`)  
  プロパティ: camelCase（例: `userName`）
- **Store files**: kebab-case with `.store.ts` suffix (e.g., `user.store.ts`)  
  ストアファイル: kebab-case＋`.store.ts`サフィックス（例: `user.store.ts`）

#### State Management / ステート管理

- Use Pinia for state management  
  ステート管理にはPiniaを使用してください
- Structure Pinia stores with clear actions, getters, and state  
  Piniaストアはアクション・ゲッター・ステートを明確に分けて構成してください
- Avoid accessing the store outside of components when possible  
  可能な限りコンポーネント外からストアを直接操作しないでください

---

## Git Workflow / Gitワークフロー

### Branch Naming / ブランチ命名規則

- Use prefixes to identify the type of work:  
  作業種別を識別できるプレフィックスを使ってください
  - `feature/` for new features / 新機能
  - `fix/` for bug fixes / バグ修正
  - `docs/` for documentation updates / ドキュメント更新
  - `refactor/` for code refactoring / リファクタリング
  - `test/` for adding or updating tests / テスト追加・更新

**Examples / 例:**
- `feature/user-authentication`
- `fix/login-validation`
- `docs/api-documentation`

### Commit Message Format / コミットメッセージフォーマット

Follow the [Conventional Commits](https://www.conventionalcommits.org/) specification:  
[Conventional Commits](https://www.conventionalcommits.org/)仕様に従ってください。

```
<type>(<scope>): <description>

[optional body]

[optional footer]
```

**Types / 種別:**
- `feat`: A new feature / 新機能
- `fix`: A bug fix / バグ修正
- `docs`: Documentation changes / ドキュメント修正
- `style`: Code style changes (formatting, missing semicolons, etc.) / コードスタイル修正
- `refactor`: Code refactoring / リファクタリング
- `test`: Adding or updating tests / テスト追加・修正
- `chore`: Other changes that don't modify src or test files / その他

**Examples / 例:**
- `feat(auth): add user registration endpoint`
- `fix(login): resolve validation error on login form`
- `docs(api): update API documentation`

### Pull Request Process / プルリクエストの手順

1. Create a branch from `main` using the naming convention above  
   上記命名規則で`main`からブランチを作成してください
2. Make your changes, following the coding standards  
   コーディング規約に従って修正を加えてください
3. Test your changes thoroughly  
   変更内容を十分にテストしてください
4. Push your branch and create a pull request  
   ブランチをプッシュし、プルリクエストを作成してください
5. Fill in the pull request template with relevant information  
   PRテンプレートの必要事項を記入してください
6. Request a review from a maintainer  
   メンテナーにレビューを依頼してください
7. Address any feedback and update your pull request as needed  
   フィードバックに対応し、必要に応じてPRを更新してください

---

## Testing Guidelines / テストガイドライン

### Backend Testing / バックエンドテスト

- Use PHPUnit for unit and integration tests  
  ユニットテスト・統合テストにはPHPUnitを使用してください
- Follow the CodeIgniter 4 testing methodology  
  CodeIgniter 4のテスト手法に従ってください
- Write tests for controllers, models, and services  
  コントローラー・モデル・サービスにテストを書いてください
- Aim for high code coverage, especially for critical functionality  
  重要な機能は高いカバレッジを目指してください

**To run backend tests / バックエンドテストの実行方法:**
```
docker exec -it ci4spa_backend php spark test
```

### Frontend Testing / フロントエンドテスト

- Use Jest for unit tests  
  ユニットテストにはJestを使用してください
- Test components with Vue Test Utils  
  Vue Test Utilsでコンポーネントをテストしてください
- Write tests for complex components and Pinia stores  
  複雑なコンポーネントやPiniaストアにはテストを書いてください

**To run frontend tests / フロントエンドテストの実行方法:**
```
docker exec -it ci4spa_frontend npm run test
```

---

## CI/CD Process / CI/CDプロセス

- GitHub Actions are used for continuous integration  
  継続的インテグレーションにはGitHub Actionsを使用しています
- Tests are run automatically on pull requests  
  プルリクエスト作成時に自動でテストが実行されます
- Code style and quality checks are performed automatically  
  コードスタイル・品質チェックも自動で行われます

---

## Additional Resources / 追加リソース

- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)  
  CodeIgniter 4 ドキュメント
- [Vue.js 3 Documentation](https://vuejs.org/guide/introduction.html)  
  Vue.js 3 ドキュメント
- [Vuetify Documentation](https://vuetifyjs.com/en/)  
  Vuetify ドキュメント
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)  
  Tailwind CSS ドキュメント
- [Pinia Documentation](https://pinia.vuejs.org/)  
  Pinia ドキュメント
- [TypeScript Documentation](https://www.typescriptlang.org/docs/)  
  TypeScript ドキュメント

---

## AI Implementation Guidelines / AI実装ガイドライン

When using AI tools (like GitHub Copilot, ChatGPT, or Claude) for development tasks in this project, please follow these guidelines:  
本プロジェクトの開発でAIツール（GitHub Copilot, ChatGPT, Claudeなど）を利用する場合は、以下のガイドラインに従ってください。

### General AI Usage / AI利用の一般原則

- Use AI as a coding assistant, not as a replacement for understanding the codebase  
  AIはコーディング補助として使い、コードベース理解の代替にしないでください
- Always review and test AI-generated code before committing  
  AI生成コードは必ずレビュー・テストしてからコミットしてください
- Do not paste sensitive information (API keys, credentials, etc.) into AI prompts  
  機密情報（APIキーや認証情報など）はAIへのプロンプトに入力しないでください

### Prompting Best Practices / プロンプト作成のベストプラクティス

- Provide context about the project structure and architecture  
  プロジェクトの構成・アーキテクチャの情報をプロンプトに含めてください
- Include references to this CONTRIBUTING.md file in your prompts  
  このCONTRIBUTING.mdへの参照もプロンプトに含めてください
- Specify the coding standards and naming conventions to follow  
  準拠すべきコーディング規約や命名規則を明示してください
- Ask for explanations of complex logic to ensure understanding  
  複雑なロジックは説明を求めて理解を深めてください

### Specific Guidelines for CI4_SPA / CI4_SPA向けの具体的ガイドライン

- Direct AI to follow the established patterns in the codebase  
  コードベースの既存パターンに従うようAIに指示してください
- For backend (CodeIgniter 4):  
  バックエンド（CodeIgniter 4）の場合
  - Request code that follows PSR-12 and CodeIgniter's conventions  
    PSR-12・CodeIgniterの規約に準拠したコードをリクエストしてください
  - Ask for proper use of Models, Controllers, and Services  
    モデル・コントローラー・サービスの適切な使い方を指定してください
  - Ensure proper validation and security practices are followed  
    適切なバリデーション・セキュリティ実装を求めてください
- For frontend (Vue.js 3):  
  フロントエンド（Vue.js 3）の場合
  - Direct AI to use the Composition API with TypeScript  
    TypeScript＋Composition APIの利用をAIに指示してください
  - Request proper Vuetify component implementation  
    適切なVuetifyコンポーネント実装をリクエストしてください
  - Ensure state management follows Pinia patterns  
    ステート管理はPiniaパターンに従うようにしてください

### Code Review for AI-Generated Code / AI生成コードのレビュー

- Check for inconsistencies with existing code style  
  既存コードスタイルと矛盾がないか確認してください
- Verify that security best practices are followed  
  セキュリティベストプラクティスが守られているか検証してください
- Test thoroughly for edge cases  
  エッジケースも含めて十分にテストしてください
- Remove any unnecessary code or comments  
  不要なコード・コメントは削除してください
- Ensure proper error handling is implemented  
  適切なエラーハンドリングが実装されているか確認してください

---

## Questions and Support / 質問・サポート

If you have any questions or need support, please create an issue in the GitHub repository.  
ご質問やサポートが必要な場合は、GitHubリポジトリでIssueを作成してください。

Thank you for contributing to CI4_SPA!  
CI4_SPAへのご貢献ありがとうございます！
