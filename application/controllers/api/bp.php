<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 4/3/13
 * Version: v1.0
 * File: bp.php
 */

class Api_Bp_Controller extends Base_Controller {
    public $restful = true;

    public function get_index($sys, $dias, $age = ''){
        if( ( ! is_null($sys) && $sys == 0 ) && ( ! is_null($dias) && $dias == 0 ) OR ( ! is_null($age) && $age == 0 )){

            $bpCheck = Bloodpressure::bloodPressureCheck($sys, $dias, $age);
            if( $bpCheck !== false ){
                $data = array('status'=>'success', 'message'=>'Blood Pressure Checker Success', 'data'=>$bpCheck);
                return Response::json($data, 200);
            } else {
                $data = array('status'=>'fail', 'message'=>'Invalid Systolic or Diastolic value!', 'data'=>null);
                return Response::json($data, 404);
            }
        } else {
            $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
            return Response::json($data, 404);
        }

    }
}