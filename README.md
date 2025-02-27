# coachtech_free-market

## 環境構築

- Docker ビルド
  1. git clone git@github.com:taku0127/coachtech_free-market.git
  2. cd coachtech_free-market/
  3. docker-compose up -d --build
     ※MySQL は、OS によって起動しない場合があるのでそれぞれの PC に合わせて docker-compose.yml ファイルを編集してください。
- Laravel 環境構築
  1. docker-compose exec php bash
  2. composer install
  3. .env.example ファイルから.env をコピーし、環境変数を設定
     - DB\_\*を独自の環境変数へ変更
     - SESSION_DRIVER=cookie に変更想定
     - STRIPE_KEY={stripe の公開鍵}
     - STRIPE_SECRET={stripe の秘密鍵}
  4. php artisan key:generate
  5. php artisan migrate
  6. php artisan db:seed
  7. chmod -R 777 ./\*
- sass の仕様
  1. cd src/ (src ディレクトリに入る)
  2. npm install
  3. npm run watch
  4. src/resources/scss/配下で編集

## 使用技術(実行環境)

- Laravel 8.83
- PHP 7.4
- MySQL 8.0
- nginx 1.21.1
- mailhog
- sass 1.83.4

## ER 図

## URL

- 開発環境：http://localhost/
- 開発環境(phpmyadmin)：http://localhost:8080/
- mailhog(メール受信テスト用): http://localhost:8025/
