<?php
$host = 'localhost';
$db   = 'my_sample_db';
$user = 'postgres'; // あなたのユーザー名
$pass = 'Tomoyuki3534'; // pgAdminで設定したパスワード
$port = '5432';

// 接続文字列（DSN）
$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    // PDOインスタンスの作成
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "データベース接続に成功しました！ 🎉";
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage();
}
?>