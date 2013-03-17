<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/16/13
 * Version: v1.0
 * File: specialist.php
 */

class Api_Authenticate_Controller extends Base_Controller{
    public $restful = true;

    public function get_index(){
        $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
        return Response::json($data, 404);
    }

    public function post_index(){
        $validate = Users::validate_user_auth(Input::all());
        if( $validate === true ){
            $auth = Users::auth_user(Input::all());
            if( $auth === false ) {
                $data = array('status'=>'fail', 'message'=>'Authentication not successful!', 'data'=>null);
                return Response::json($data, 404);
            } else {
                $data = array('status'=>'success','message'=>'Authentication successful!', 'data'=>$auth);
                return Response::json($data, 200);
            }
        } else {
            $data = array('status'=>'fail', 'message'=>'Validation failed!', 'data'=>$validate->errors);
            return Response::json($data, 401);
        }
    }

}