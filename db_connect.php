<?php
// 環境変数から接続情報を取得する（Renderの設定画面で後ほど登録します）
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT') ?: '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // 本番環境では詳細なエラーを出さないのがセオリーですが、今は確認のため表示します
    echo "接続失敗: " . $e->getMessage();
    exit;
}