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
            $low = $this->checkLowBpRangeType($sys, $dias);
            $recommendation = array(
                'bprecommendation' => 
                '
Eat a diet higher in salt.<br><br>
Drink lots of nonalcoholic fluids<br><br>
Limit alcoholic beverages.<br><br>
Drink more fluids during hot weather and while sick with a viral illness, such as a cold or the flu.<br><br>
Have your doctor evaluate your prescription and over-the-counter medications to identify any that may be causing your symptoms.<br><br>
Get regular exercise to promote blood flow.<br><br>
Be careful when rising from lying down or sitting. To help improve circulation, pump your feet and ankles a few times before standing up. Then proceed slowly. When getting out of bed, sit upright on the edge of the bed for a few minutes before standing.<br><br>
Elevate the head of your bed at night by placing bricks or blocks under the head of bed.<br><br>
Avoid heavy lifting.<br><br>
Avoid straining while on the toilet.<br><br>
Avoid prolonged exposure to hot water, such as hot showers and spas. If you get dizzy, sit down. It may be helpful to keep a chair or stool in the shower in case you need to sit; to help prevent injury, use a nonslip chair or stool designed for use in showers and bath tubs.<br><br>
To avoid problems with low blood pressure and lessen episodes of dizziness after meals, try eating smaller, more frequent meals. Cut back on carbohydrates. Rest after eating. Avoid taking drugs to lower blood pressure before meals.<br><br>
If needed, use elastic support (compression) stockings that cover the calf and thigh. These may help restrict blood flow to the legs, thus keeping more blood in the upper body.
'
            );
            return array_merge($low, $recommendation);
        } elseif( ($sys > 90 && $sys <= 130) && ($dias > 60 && $dias <= 85) ) {
            $high = $this->checkNormalBpRangeType($sys, $dias);
            $recommendation = array(
                'bprecommendation' =>
                '
Continue to maintain a healthy lifestyle<br><br>
Try to check your blood pressure once or twice every month<br><br>
Check <a href="http://www.webmd.com/">WebMD</a> for more health related information<br><br>
                '
            );
            return array_merge($high, $recommendation);
        } elseif( ($sys > 130 && $sys <= 210) && ($dias > 85 && $dias <= 120) ) {
            $high = $this->checkHighBpRangeType($sys, $dias);
            $recommendation = array(
                'bprecommendation' =>
                '
See a Nephrologist or a Cardiologist immediately when you see high blood pressure.<br><br>
Ensure you maintain a healthy lifestyle<br><br>
Losing weight if you are overweight or obese.<br><br>
Quitting smoking.<br><br>
Eating a healthy diet, including the DASH diet (eating more fruits, vegetables, and low fat dairy products, less saturated and total fat).<br><br>
Reducing the amount of sodium in your diet to less than 1,500 milligrams a day if you have high blood pressure. Healthy adults need to limit their sodium intake to no more 2,300 milligrams a day (about 1 teaspoon of salt).<br><br>
Getting regular aerobic exercise (such as brisk walking at least 30 minutes a day, several days a week).<br><br>
Limiting alcohol to two drinks a day for men, one drink a day for women.<br><br>
In addition to lowering blood pressure, these measures enhance the effectiveness of high blood pressure drugs.
                '
            );
            return array_merge($high, $recommendation);
        } elseif( ( $sys > 210 ) or ($dias > 120) ) {
            $high = $this->checkHighBpRangeType($sys, $dias);
            $recommendation = array(
                'bprecommendation' =>
                '
See a Nephrologist or a Cardiologist immediately when you see high blood pressure.<br><br>
Ensure you maintain a healthy lifestyle<br><br>
Losing weight if you are overweight or obese.<br><br>
Quitting smoking.<br><br>
Eating a healthy diet, including the DASH diet (eating more fruits, vegetables, and low fat dairy products, less saturated and total fat).<br><br>
Reducing the amount of sodium in your diet to less than 1,500 milligrams a day if you have high blood pressure. Healthy adults need to limit their sodium intake to no more 2,300 milligrams a day (about 1 teaspoon of salt).<br><br>
Getting regular aerobic exercise (such as brisk walking at least 30 minutes a day, several days a week).<br><br>
Limiting alcohol to two drinks a day for men, one drink a day for women.<br><br>
In addition to lowering blood pressure, these measures enhance the effectiveness of high blood pressure drugs.
                '
            );
            return array_merge($high, $recommendation);
        } else {
            return false;
        }
    }

   private function checkLowBpRangeType( $s, $d ){
       if( ($s >= 50 && $s <= 59) && ($d >= 33 && $d <= 39) ){
            return array(
                'bpcode' => 1,
                'bpstatus' => 'Borderline Low Blood Pressure'
            );
       } elseif( ($s >= 60 && $s <= 89) && ($d >= 40 && $d <= 59) ){
           return array(
               'bpcode' => 2,
               'bpstatus' => 'Too Low Blood Pressure'
           );
       }else{
           return array(
               'bpcode' => 3,
               'bpstatus' => 'Dangerously Low Blood Pressure'
           );
       }
   }

   private function checkNormalBpRangeType( $s, $d ){
       if( ($s >= 110 && $s <= 119) && ($d >= 75 && $d <= 79) ){
            return array(
                'bpcode' => 4,
                'bpstatus' => 'Low Normal Blood Pressure'
            );
       } elseif( ($s >= 120 && $s <= 129) && ($d >= 80 && $d <= 84) ){
           return array(
               'bpcode' => 5,
               'bpstatus' => 'Normal Blood Pressure'
           );
       }else{
           return array(
               'bpcode' => 6,
               'bpstatus' => 'High Normal Blood Pressure'
           );
       }
   }

   private function checkHighBpRangeType( $s, $d ){
       if( ($s >= 140 && $s <= 159) && ($d >= 90 && $d <= 99) ){
            return array(
                'bpcode' => 7,
                'bpstatus' => 'Stage-1 High Blood Pressure'
            );
       } elseif( ($s >= 160 && $s <= 179) && ($d >= 100 && $d <= 109) ){
           return array(
               'bpcode' => 8,
               'bpstatus' => 'Stage-2 High Blood Pressure'
           );
       } elseif( ($s >= 180 && $s <= 209) && ($d >= 110 && $d <= 119) ){
           return array(
               'bpcode' => 9,
               'bpstatus' => 'Stage-3 High Blood Pressure'
           );
       }else{
           return array(
               'bpcode' => 10,
               'bpstatus' => 'Stage-4 High Blood Pressure'
           );
       }
   }

}