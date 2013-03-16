<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/16/13
 * Version: v1.0
 * File: specialist.php
 */

class Api_Disease_Controller extends Base_Controller{
    public $restful = true;

    public function get_index(){
        $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
        return Response::json($data, 404);
    }

    public function get_view($limit, $disease_id = ''){
        $limit = (int) $limit;
        $disease_id = (int) $disease_id;

        $diseases = Users::prominent_disease($limit, $disease_id);
        if( $diseases === false || empty($diseases) ){
            $data = array('status'=>'fail', 'message'=>'No disease with id ' .$disease_id. ' found!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Disease found!', 'data'=>$diseases);
            return Response::json($data, 200);
        }

    }

}