<?php

    class Lives
    {
        //プロパティ
        private $name;
        private $hitPoint;
        private $attackPoint; //攻撃力
        private $intelligence; //魔法攻撃力

        //メソッド
        public function __construct($name, $hitPoint = 50, $attackPoint = 10, $intelligence = 0)
        {
            $this->name = $name;
            $this->hitPoint = $hitPoint;
            $this->attackPoint = $attackPoint;
            $this->intelligence = $intelligence;
        }

        //名前を取得するメソッド
        public function getName()
        {
            return $this->name;
        }

        //現在HPを取得するメソッド(ゲッター)
        public function getHitPoint()
        {
            $result = $this->hitPoint;
            if($result < 0 ){
                $result = 0;
            }
            return $result;
        }

        //現在HPを設定するメソッド(セッター)
        public function tookDamage($damage)
        {
            $this->hitPoint -= $damage;
            //HPが0にならないための処理
            if($this->hitPoint < 0){
                $this->hitPoint = 0;
            }
        }

        //現在HPを設定するメソッド(セッター)
        public function recoveryDamage($heal, $target)
        {
            $this->hitPoint += $heal;
            //最大血を超えて回復しない
            if($this->hitPoint > $target::MAX_HITPOINT){
                $this->hitPoint = $target::MAX_HITPOINT;
            }
        }

        //攻撃できるかどうかチェック
        public function isEnableAttack($targets)
        {
            //チェック1:自身のHPが0異常かどうか
            if($this->hitPoint <= 0 ){
                return false;
            }
            //チェック2:敵が全員HP0以下かどうか
            foreach($targets as $target){
                if($target->getHitPoint() > 0){
                    //0以上のhHPがある場合は攻撃可能
                    return true;
                }
            }
        }

        //ターゲットを決めるメソッド
        public function selectTarget($targets)
        {
            $target = $targets[rand(0,count($targets) -1)];
            //敵のHPが0以下の場合、再度ターゲットを決める
            while($target->getHitPoint() <= 0){
                $target = $targets[rand(0, count($targets) -1)];
            }
            return $target;
        }
    }