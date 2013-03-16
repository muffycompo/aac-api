<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/16/13
 * Version: v1.0
 * File: specialist.php
 */

class Api_Tip_Controller extends Base_Controller{
    public $restful = true;

    public function get_index(){
        $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
        return Response::json($data, 404);
    }

    public function get_view($category_id, $limit = 0){
        $limit = (int) $limit;
        $category_id = (int) $category_id;

        $tips = Users::health_tips($category_id, $limit);
        if( $tips === false || empty($tips) ){
            $data = array('status'=>'fail', 'message'=>'No health tips found!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Health tip(s) found!', 'data'=>$tips);
            return Response::json($data, 200);
        }

    }

}