<?php
class BlackMage extends Human
{
    const MAX_HITPOINT = 80;
    private $hitPoint = 80;
    private $attackPoint = 10;
    private $intelligence = 30; //魔法攻撃力

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

    public function doAttack($enemies){

        //自身のHPが0以上か、敵のHPが0以上かなどをチェックするメソッド
        if(!$this->isEnableAttack($enemies)){
        return false;
        }
        //ターゲットの決定
        $enemy = $this->selectTarget($enemies);

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