<?php
//ファイルのロード
require_once('./lib/Loader.php');

//オートロード
$loader = new loader();
//classesフォルダの中身をロード対象ディレクトリとして登録
$loader->regDirectory(__DIR__ . '/classes');
$loader->register();

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

//終了条件の設定
function isFinish($objects)
{
    $deathCut = 0; //HPが0以下の仲間の数
    foreach ($objects as $object) {
        //1人でもHPが0を超えていたらfalseを返す
        if($object->getHitPoint() > 0){
            return false;
        }
        $deathCut++;
    }
    //仲間の数が死亡数(HPが0以下の数)と同じであればtrueを返す
    if($deathCut === count($objects)){
        return true;
    }
}

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

    //戦闘終了条件のチェック　仲間全員のHPが0 または、敵全員のHPが0
    $isFinishFlg = isFinish($members);
    if($isFinishFlg){
        $message = "GAME OVER ....\n\n";
        break;
    }

    $isFinishFlg = isFinish($enemies);
    if($isFinishFlg){
        $message = "♪♪♪ファンファーレ♪♪♪\n\n";
        break;
    }

    $turn++;
}

echo "★★★ 戦闘終了 ★★★\n\n";

echo $message;

//仲間の表示
$messageObj->displayStatusMessage($members);

//敵の表示
$messageObj->displayStatusMessage($enemies);