<?php
class BlackMage extends Human
{
    const MAX_HITPOINT = 80;
    private $hitPoint = 80;
    private $attackPoint = 10;
    private $intelligence = 30; //魔法攻撃力

    public function __construct($name)
    {
        parent::__construct($name, $this->hitPoint, $this->attackPoint);
    }

    public function doAttack($enemies){

        //チェック1:自身のHPが0かどうか
        if($this->getHitPoint() <= 0){
            return false;
        }

        $enemyIndex = rand(0, count($enemies) -1);
        $enemy = $enemies[$enemyIndex];

        if(rand(1,2) === 1){
            echo "『" .$this->getName() ."』のスキルが発動した！\n";
            echo "『ファイア』！！\n";
            echo $enemy->getName() ."に". $this->intelligence * 1.5. "のダメージ！\n";
            $enemy->tookDamage($this->intelligence * 1.5);
        }else{
            parent::doAttack($enemies);
        }
        return true;
    }
}