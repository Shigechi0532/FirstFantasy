<?php 
//ファイルのロード
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');
require_once('./classes/Brave.php');

//インスタンス化
$braver = new Brave("勇者");
$goblin = new Enemy("ゴブリン");

$turn = 1;

while($braver->getHitPoint() > 0 && $goblin->getHitPoint() > 0){
    echo "***$turn ターン目 ***\n\n";
    //ステータスの表示
    echo $braver->getName() .":" .$braver->getHitPoint() ,"/" .$braver::MAX_HITPOINT ."\n";
    echo $goblin->getName() .":" .$goblin->getHitPoint() ,"/" .$goblin::MAX_HITPOINT ."\n";
    echo "\n";

    //攻撃
    $braver->doAttack(($goblin));
    echo "\n";
    $goblin->doAttack($braver);
    echo "\n";

    $turn++;
}

echo "★★★ 戦闘終了 ★★★\n\n";
echo $braver->getName() .":" .$braver->getHitPoint() ."/" .$braver::MAX_HITPOINT ."\n";
echo $goblin->getName() .":" .$goblin->getHitPoint() ."/" .$goblin::MAX_HITPOINT ."\n";
?>