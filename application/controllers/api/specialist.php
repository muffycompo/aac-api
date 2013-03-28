<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/16/13
 * Version: v1.0
 * File: specialist.php
 */

class Api_Specialist_Controller extends Base_Controller{
    public $restful = true;

    public function get_index(){
        $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
        return Response::json($data, 404);
    }

    public function get_view($state_id, $lga_id = 0){
        $state_id = (int) $state_id;
        $lga_id = (int) $lga_id;

        $specialists = Users::specialist_by_area($state_id, $lga_id);
        if( $specialists === false || empty($specialists) ){
            $data = array('status'=>'fail', 'message'=>'No specialist in your area!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Specialist found in you area!', 'data'=>$specialists);
            return Response::json($data, 200);
        }

    }

    public function get_map($disease_name, $lga, $state = ''){
        $state = (int) $state;
        $lga = (int) $lga;
        $disease_name = urldecode($disease_name);
        $specialists = Users::map_specialist($disease_name, $lga, $state);
        if( $specialists === false || empty($specialists) ){
            $data = array('status'=>'fail', 'message'=>'No specialist in your area!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Specialist found in you area!', 'data'=>$specialists);
            return Response::json($data, 200);
        }
    }
}