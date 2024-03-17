<?php
function isFinish($objects)
{
    $deathCut = 0; //HPが0以下の仲間の数
    foreach ($objects as $object) {
        if($object->getHitPoint() > 0){
            return false;
        }
        $deathCut++;
    }
    if($deathCut === count($objects)){
        return true;
    }
}