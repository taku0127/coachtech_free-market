# coachtech_free-market

## 環境構築

- Docker ビルド
  1. git clone git@github.com:taku0127/coachtech_free-market.git
  2. cd coachtech_free-market/
  3. make init
     ※MySQL は、OS によって起動しない場合があるのでそれぞれの PC に合わせて docker-compose.yml ファイルを編集してください。
- Laravel 環境構築
  1. chmod -R 777 ./\*
  2. .envファイルの環境変数を設定
     - DB\_\*を独自の環境変数へ変更
     - SESSION_DRIVER=cookie に変更
     - STRIPE_KEY={stripe の公開鍵}
     - STRIPE_SECRET={stripe の秘密鍵}
  3. make fresh (DBの設定)
- sass の仕様
  1. make npm-watch
  2. src/resources/scss/配下で編集
- テストの実行
  1. docker-compose exec mysql mysql -u root -p
  2. CREATE DATABASE demo_test;
  3. テスト用のenvファイルは .env.testing.example ファイルから.env.testing をコピーしてください。
  4. docker-compose exec php bash
  5. php artisan key:generate --env=testing
  6. php artisan config:clear
  7. php artisan migrate --env=testing
  8. php artisan test --testsuite=Feature (全テストの実行)

## ダミーテスト用アカウント
- テスト1
  - ID:test1@example.com
  - PW:00000000
- テスト2
  - ID:test2@example.com
  - PW:00000000
- テスト3
  - ID:test3@example.com
  - PW:00000000
## 使用技術(実行環境)

- Laravel 8.83
- PHP 7.4
- MySQL 8.0
- nginx 1.21.1
- mailhog
- sass 1.83.4

## ER 図

![irv2 drawio](https://github.com/user-attachments/assets/59c3a714-35eb-49ed-96db-0d564f503923)

## URL

- 開発環境：http://localhost/
- 開発環境(phpmyadmin)：http://localhost:8080/
- mailhog(メール受信テスト用): http://localhost:8025/
