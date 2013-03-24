<?php

class Home_Controller extends Base_Controller {
    public $restful = true;

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function get_index()
	{
		return View::make('home.index');

	}

    public function get_signup(){
        return View::make('web.signup');
    }

    // AJAX - LGA Dropdown List helper
    public function post_lga_list($id){
        $lga_data = Util::lga_dropdown('lga', $id, array('id'=>'lga'));
        return Response::json(array('html_select'=>$lga_data));
    }

    public function post_json_demo(){
        $data = file_get_contents('php://input');
        $json = json_decode($data);
        $service = $json->{'service'};
        print $service;
    }
}