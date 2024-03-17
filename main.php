<?php
//ファイルのロード
require_once('./lib/Loader.php');
require_once('./lib/Utility.php');

//オートロード
$loader = new loader();
//classesフォルダの中身をロード対象ディレクトリとして登録
$loader->regDirectory(__DIR__ . '/classes');
$loader->regDirectory(__DIR__ . '/classes/constants');
$loader->register();

//インスタンス化
$members = array();
$members[] = Brave::getInstance(CharacterName::Brave);
$members[] = Brave::getInstance(CharacterName::WhiteMage);
$members[] = Brave::getInstance(CharacterName::BlackMage);

$enemies = array();
$enemies[] = new Enemy(EnemyName::GOBLIN_A,20);
$enemies[] = new Enemy(EnemyName::GOBLIN_B,25);
$enemies[] = new Enemy(EnemyName::GOBLIN_C,30);

$turn = 1;
$isFinishFlg = false;

$messageObj = new Message;

while(!$isFinishFlg){
    echo "*** $turn ターン目 ***\n\n";

    //仲間の表示
    $messageObj->displayStatusMessage($members);

    //敵の表示
    $messageObj->displayStatusMessage($enemies);

    //仲間の攻撃
    $messageObj->displayAttackMessage($members,$enemies);

    //敵の攻撃
    $messageObj->displayAttackMessage($enemies,$members);

    //戦闘終了条件のチェック 仲間全員のHPが0 または、敵全員のHPが0
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