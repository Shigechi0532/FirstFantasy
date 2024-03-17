<?php
class WhiteMage extends Human
{
    const MAX_HITPOINT = 80;
    private $hitPoint = 80;
    private $attackPoint = 10;
    private $intelligence = 30;

    private static $instance;

    public function __construct($name)
    {
        parent::__construct($name, $this->hitPoint, $this->attackPoint, $this->intelligence);
    }

        //シングルトンで常にインスタンスは一つしか生成しない。
        public static function getInstance($name)
        {
            if(empty(self::$instance)){
                self::$instance = new Brave($name);
            }
            return self::$instance;
        }

    public function doAttackWhiteMage($enemies,$members)
    {
        //自分のHPが0以上か。敵のHPが0以上かなどをチェックするメソッド
        if(!$this->isEnableAttack($enemies)){
            return false;
        }

        if(rand(1,2) === 1){
            //ターゲットの決定
            $member = $this->selectTarget($members);

            echo "『" .$this->getName() ."』のスキルが発動した！\n";
            echo "『ケアル』！！\n";
            echo $member->getName() ."のHPを" .$this->intelligence * 1.5 ."回復！\n";
            $member->recoveryDamage($this->intelligence * 1.5, $member);
        }else{
            //ターゲットの決定
            $enemy = $this->selectTarget($enemies);
            parent::doAttack($enemies);
        }
        return true;
    }
}
?>