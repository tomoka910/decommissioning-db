<?php
// 接続用ファイルを読み込む
require_once 'db_connect.php';

// 登録したいデータ
$name = "山田太郎";
$email = "yamada@example.com";

try {
    // SQL文の準備（値を入れる場所を :name などの「プレースホルダ」にする）
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);

    // プレースホルダに実際の値を割り当てて実行
    $stmt->execute([
        ':name' => $name,
        ':email' => $email
    ]);

    echo "<br>データの登録に成功しました！ 📝";
} catch (PDOException $e) {
    echo "<br>登録失敗: " . $e->getMessage();
}
?>