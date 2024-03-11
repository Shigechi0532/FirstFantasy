<?php 
class Brave extends Human
{
    const MAX_HITPOINT = 120;
    private $hitPoint = self::MAX_HITPOINT;
    private $attackPoint = 30;

    public function __construct($name)
    {
        parent::__construct($name,$this->hitPoint,$this->attackPoint);
    }

    public function doAttack($enemies)
    {
        //チェック1:自身のHPが0かどうか
        if($this->getHitPoint() <= 0){
            return false;
        }

        $enemyIndex = rand(0, count($enemies) -1);
        $enemy = $enemies[$enemyIndex];

        //乱数の発生
        if(rand(1,3) === 1){
            //スキルの発動
            echo "『". $this->getName(). "』のスキルが発動した!\n";
            echo "『ぜんりょくぎり』!!\n";
            echo $enemy->getName(). "に". $this->attackPoint * 1.5. "のダメージ!\n";
            $enemy->tookDamage($this->attackPoint * 1.5);
        }else{
            parent::doAttack($enemies);
        }
        return true;
    }
}
?>