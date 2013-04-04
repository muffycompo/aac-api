<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 4/3/13
 * Version: v1.0
 * File: Bloodpressure.php
 */

class Bloodpressure extends Basemodel {

    public static function bloodPressureCheck($systolic, $diastolic, $age){
        $bp = new Bloodpressure();
        return $bp->getLowNormalHighBpRange($systolic, $diastolic);
    }

    private function getLowNormalHighBpRange($sys, $dias){
        if( ($sys <= 90) && ($dias <=60) ) {
//            Call method to determine the proper pressure range
//            I.E. Borderline, Too low or Dangerously low BP
            return $this->checkLowBpRangeType($sys, $dias);
        } elseif( ($sys > 90 && $sys <= 130) && ($dias > 60 && $dias <= 85) ) {
//            Call method to determine the proper pressure range
//            I.E. High Normal, Normal or Low Normal
            return $this->checkNormalBpRangeType($sys, $dias);
        } elseif( ($sys > 130 && $sys <= 210) && ($dias > 85 && $dias <= 120) ) {
//            Call method to determine the proper pressure range
//            I.E. Stage 1, 2, 3 and 4 High BP
                return $this->checkHighBpRangeType($sys, $dias);
        } elseif( ( $sys > 210 ) or ($dias > 120) ) {
//            Call method to determine the proper pressure range
//            I.E. Stage 1, 2, 3 and 4 High BP
                return $this->checkHighBpRangeType($sys, $dias);
        } else {
            return false;
        }
    }

   private function checkLowBpRangeType( $s, $d ){
       if( ($s >= 50 && $s <= 59) && ($d >= 33 && $d <= 39) ){
            return array('bpstatus' => 'Borderline Low Blood Pressure');
       } elseif( ($s >= 60 && $s <= 89) && ($d >= 40 && $d <= 59) ){
           return array('bpstatus' => 'Too Low Blood Pressure');
       }else{
           return array('bpstatus' => 'Dangerously Low Blood Pressure');
       }
   }

   private function checkNormalBpRangeType( $s, $d ){
       if( ($s >= 110 && $s <= 119) && ($d >= 75 && $d <= 79) ){
            return array('bpstatus' => 'Low Normal Blood Pressure');
       } elseif( ($s >= 120 && $s <= 129) && ($d >= 80 && $d <= 84) ){
           return array('bpstatus' => 'Normal Blood Pressure');
       }else{
           return array('bpstatus' => 'High Normal Blood Pressure');
       }
   }

   private function checkHighBpRangeType( $s, $d ){
       if( ($s >= 140 && $s <= 159) && ($d >= 90 && $d <= 99) ){
            return array('bpstatus' => 'Stage-1 High Blood Pressure');
       } elseif( ($s >= 160 && $s <= 179) && ($d >= 100 && $d <= 109) ){
           return array('bpstatus' => 'Stage-2 High Blood Pressure');
       } elseif( ($s >= 180 && $s <= 209) && ($d >= 110 && $d <= 119) ){
           return array('bpstatus' => 'Stage-3 High Blood Pressure');
       }else{
           return array('bpstatus' => 'Stage-4 High Blood Pressure');
       }
   }

}