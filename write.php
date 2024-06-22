<?php

// $name = $_GET['name'];
// $birthPlace = $_GET['birthPlace'];

$age = $_GET['age'];
$pref = $_GET['pref'];


// ファイルに書き込み
$time = date('Y-m-d H:i:s');
//文字作成
// $data = $time . 'test' . "\n";
$data = $time . "　" . $age . "　" . $pref . "\n";

file_put_contents('data/data.txt', $data, FILE_APPEND);

?>

<!-- このwrite.phpのファイルを開くたびにdata.txtに保存される -->
 <!-- \nは改行 -->

<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
</head>

<body>

    <h1>書き込みしました。</h1>
    <h2>./data/data.txt を確認しましょう！</h2>

    <ul>
        <li><a href="read.php">確認する</a></li>
        <li><a href="input.php">戻る</a></li>
    </ul>
</body>

</html>
