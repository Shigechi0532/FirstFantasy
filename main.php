<?php 
//ファイルのロード
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');

//インスタンス化
$brave_man = new Human();
$goblin = new Enemy();

$brave_man->name = "勇者";
$goblin->name = "ゴブリン";

$turn = 1;

while($brave_man->hitPoint > 0 && $goblin->hitPoint > 0){
    echo "***$turn ターン目 ***\n\n";
    //ステータスの表示
    echo $brave_man->name .":" .$brave_man->hitPoint ,"/" .$brave_man::MAX_HITPOINT ."\n";
    echo $goblin->name .":" .$goblin->hitPoint ,"/" .$goblin::MAX_HITPOINT ."\n";
    echo "\n";

    //攻撃
    $brave_man->doAttack(($goblin));
    echo "\n";
    $goblin->doAttack($brave_man);
    echo "\n";

    $turn++;
}

echo "★★★ 戦闘終了 ★★★\n\n";
echo $brave_man->name .":" .$brave_man->hitPoint ."/" .$brave_man::MAX_HITPOINT ."\n";
echo $goblin->name .":" .$goblin->hitPoint ."/" .$goblin::MAX_HITPOINT ."\n";
?>