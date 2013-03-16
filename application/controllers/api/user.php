<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/15/13
 * Version: v1.0
 * File: Users.php
 */

class Api_User_Controller extends Base_Controller {
    public $restful = true;

    public function get_index(){
        $data = array('status'=>'fail', 'message'=>'UNIMPLEMENTED Resource! Check API documentation.', 'data'=>null);
        return Response::json($data, 404);
    }

    public function get_view($id){
        $user = Users::view_user((int) $id);
        if( $user === false ){
            $data = array('status'=>'fail', 'message'=>'User with id ' . $id . ' does not exist!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'User with id ' .$id. ' found!', 'data'=>$user);
            return Response::json($data, 200);
        }
    }

    public function post_index(){
        $user = Users::new_user(Input::all());
        if( $user === false ){
            $data = array('status'=>'fail', 'message'=>'Signup not successful!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Signup was successful!', 'data'=>$user);
            return Response::json($data, 200);
        }
    }
    public function put_index(){
        $user = Users::update_user_profile(Input::all());
        if( $user === false ){
            $data = array('status'=>'fail', 'message'=>'Update not successful!', 'data'=>null);
            return Response::json($data, 404);
        } else {
            $data = array('status'=>'success', 'message'=>'Update was successful!', 'data'=>$user);
            return Response::json($data, 200);
        }
    }

}