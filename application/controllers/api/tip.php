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

    public function get_view($limit = 0, $category_id){
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

    public function get_category($limit = 0){
        $limit = (int) $limit;
        $tips = Users::health_tips_category($limit);
        if( $tips === false || empty($tips) ){
            $data = array('status'=>'fail', 'message'=>'No health Categories found!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Health Category found!', 'data'=>$tips);
            return Response::json($data, 200);
        }
    }

    public function get_single_tip($tip_id){
        $tip_id = (int) $tip_id;
        $single_tip = Users::health_tips_single($tip_id);
        if( $single_tip === false || empty($single_tip) ){
            $data = array('status'=>'fail', 'message'=>'No health Tip with id ' . $tip_id . ' found!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Health Tip with id ' . $tip_id . ' found!', 'data'=>$single_tip);
            return Response::json($data, 200);
        }
    }

}