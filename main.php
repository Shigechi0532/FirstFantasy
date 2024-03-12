<?php
//ファイルのロード
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');
require_once('./classes/Brave.php');
require_once('./classes/BlackMage.php');
require_once('./classes/WhiteMage.php');
require_once('./classes/Message.php');

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

$messageObj = new Message;

while(!$isFinishFlg){
    echo "***$turn ターン目 ***\n\n";

    //仲間の表示
    $messageObj->displayStatusMessage($members);

    //敵の表示
    $messageObj->displayStatusMessage($enemies);

    //仲間の攻撃
    $messageObj->displayAttackMessage($members,$enemies);

    //敵の攻撃
    $messageObj->displayAttackMessage($enemies,$members);

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

//仲間の表示
$messageObj->displayStatusMessage($members);

//敵の表示
$messageObj->displayStatusMessage($enemies);