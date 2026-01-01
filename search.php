<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>1F廃炉資料検索システム</title>
</head>
<body>
    <h1>1F廃炉資料 検索</h1>
    
    <form action="search.php" method="GET">
        
        <label for="year">作成年：</label>
        <select name="year" id="year">
            <option value="">すべて</option>
            <option value="2011">2011年</option>
            <option value="2012">2012年</option>
            </select>

        <br><br>

        <label for="source">出典：</label>
        <select name="source" id="source">
            <option value="">すべて</option>
            <option value="中長期ロードマップ">中長期ロードマップ（廃炉・汚染水・処理水対策関係閣僚等会議等）</option>
	　　<option value="汚染水対策委員会">廃炉・汚染水対策の進捗状況</option>
            </select>

        <br><br>

        <input type="submit" value="この条件で検索">
    </form>
</body>
</html>

<hr>
<h2>検索結果一覧</h2>

<?php
require_once 'db_connect.php';

// フォームから送られてきた値を受け取る（GET送信）
$selected_year = $_GET['year'] ?? '';
$selected_source = $_GET['source'] ?? '';

try {
    // 1. 基本となるSQL文
    $sql = "SELECT * FROM decommissioning_db WHERE 1=1";
    $params = [];

    // 2. 「年」が選択されていたら、条件を追加
    if ($selected_year !== '') {
        $sql .= " AND creation_year = :year";
        $params[':year'] = $selected_year;
    }

    // 3. 「出典」が選択されていたら、条件を追加
    if ($selected_source !== '') {
        $sql .= " AND source = :source";
        $params[':source'] = $selected_source;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll();

    if ($results) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>資料名称</th><th>作成年</th><th>出典</th><th>URL</th></tr>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['creation_year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['source']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($row['url']) . "' target='_blank'>リンク</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "条件に一致する資料は見つかりませんでした。";
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>