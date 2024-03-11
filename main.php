<?php
//ファイルのロード
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');
require_once('./classes/Brave.php');
require_once('./classes/BlackMage.php');
require_once('./classes/WhiteMage.php');

//インスタンス化
$members = array();
$members[] = new Brave('勇者');
$members[] = new WhiteMage('白魔導士');
$members[] = new BlackMage('黒魔導士');

$enemies = array();
$enemies[] = new Enemy('ゴブリンA',20);
$enemies[] = new Enemy('ゴブリンB',25);
$enemies[] = new Enemy('ゴブリンC',30);

$turn = 1;

$isFinishFlg = false;

while(!$isFinishFlg){
    echo "***$turn ターン目 ***\n\n";
    //現在のHPの表示
    foreach ($members as $member){
        echo $member->getName(). ":" .$member->getHitPoint() ."/". $member::MAX_HITPOINT ."\n";
    }
    echo "\n";
    foreach ($enemies as $enemy){
        echo $enemy->getName(). ":".$enemy->getHitPoint() ."/". $enemy::MAX_HITPOINT ."\n";
    }
    echo "\n";

    //攻撃
    foreach($members as $member){
        //白魔導士の場合、味方のオブジェクトにも渡す
        if(get_class($member) == "WhiteMage"){
            $member->doAttackWhiteMage($enemies,$members);
        }else{
            $member->doAttack($enemies);
        }
        echo "\n";
    }
    echo "\n";

    foreach($enemies as $enemy){
        $enemy->doAttack($members);
        echo "\n";
    }

    //仲間の全滅チェック
    $deathCut = 0;
    foreach ($members as $member){
        if($member->getHitPoint() > 0 ){
            $isFinishFlg = false;
            break;
        }
        $deathCut++;
    }
    if($deathCut === count($members)){
        $isFinishFlg = true;
        echo "GAME OVER ...\n\n";
        break;
    }

    //敵の全滅チェック
    $deathCut = 0; //HPが0以下の敵の数
    foreach($enemies as $enemy){
        if($enemy->getHitPoint() > 0){
            $isFinishFlg = false;
            break;
        }
        $deathCut++;
    }
    if($deathCut === count($enemies)){
        $isFinishFlg = true;
        echo "♪♪♪ファンファーレ♪♪♪\n\n";
        break;
    }

    $turn++;
}

echo "★★★ 戦闘終了 ★★★\n\n";

//現在のHPを表示
foreach($members as $member){
    echo $member->getName().":" .$member->getHitPoint() ."/" .$member::MAX_HITPOINT ."\n";
}
echo"\n";
foreach($enemies as $enemy){
    echo $enemy->getName().":" .$enemy->getHitPoint() ."/" .$enemy::MAX_HITPOINT ."\n";
}