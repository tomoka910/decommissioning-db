<?php
// Renderの「Environment」で設定した値を読み込みます
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// 接続文字列（DSN）を作成します
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // search.phpで使うための「$pdo」という変数に接続を保存します
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // 接続に失敗した場合は、エラーメッセージを表示して処理を中断します
    die("接続失敗: " . $e->getMessage());
}
?>