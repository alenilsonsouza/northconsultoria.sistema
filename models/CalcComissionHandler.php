<?php
class CalcComissionHandler {

    public static function calc($planValue, $dependentsTotal) {

        // Percentual para dependentes
        $percentual = 0.10;

        $dependentValueUnique = $planValue - ($planValue * $percentual);
        $dependentValueTotal = $dependentValueUnique * $dependentsTotal;

        return $dependentValueTotal;
    }
}