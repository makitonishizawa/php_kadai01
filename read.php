<?php
$data = file_get_contents('data/data.txt');

echo nl2br($data);

// nl2brで改行タグが見えるようになる



//授業では、input.php⇒write.php⇒data.txtでデータが流れてread.phpで表示している。
?>