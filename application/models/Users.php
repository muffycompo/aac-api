<?php
class Users extends Basemodel {
    public static $table = 'users';
    public static $timestamps = false;

    public function profile(){
        return $this->has_one('Profile');
    }

    public static $new_user_rules = array(
        'surname' => 'required',
        'firstname' => 'required',
        'password' => 'required',
        'email' => 'required|email|unique:users',
        'gsm' => 'required|numeric',
        'lga' => 'required|numeric',
        'state' => 'required|numeric'
    );

    public static $update_user_rules = array(
        'surname' => 'required|alpha',
        'firstname' => 'required|alpha',
        'gsm' => 'required|numeric',
        'lga' => 'required|numeric',
        'state' => 'required|numeric'
    );

    public static $auth_user_rules = array(
        'email' => 'required',
        'password' => 'required'
    );

    public static function validate_new_user($data){
        return self::validation($data,self::$new_user_rules);
    }

    public static function validate_user_update($data){
        return self::validation($data,self::$update_user_rules);
    }

    public static function validate_user_auth($data){
        return self::validation($data,self::$auth_user_rules);
    }

    public static function new_user($data){

        $member_data = array(
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        );
        $member_id = self::create($member_data);

        $profile_data = array(
            'users_id' => $member_id->id,
            'surname' => $data['surname'],
            'firstname' => $data['firstname'],
            'gsm' => $data['gsm'],
            'lga_id' => $data['lga'],
            'states_id' => $data['state']
        );

        $user = DB::table('profiles')->insert($profile_data);
        if( $user ){
            return array_merge($member_data, $profile_data);
        } else {
            return false;
        }

    }

    public static function update_user_profile($user_id, $data){
        if(empty($user_id)){ return false;}

        if( !empty($data['password']) ){
            DB::table('users')->where('id','=',$user_id)->update(array('password'=>Hash::make($data['password'])));
        }

        // Profile Data Array
        $profile_data = array(
            'surname' => $data['surname'],
            'firstname' => $data['firstname'],
            'gsm' => $data['gsm'],
            'lga_id' => $data['lga'],
            'states_id' => $data['state']
        );

        $user = DB::table('profiles')->where('users_id','=',$user_id)->update($profile_data);
        if( $user ){
            return $profile_data;
        } else {
            return false;
        }

    }

    public static function view_user($id){
        $user = Users::find($id);
        if($user === null){
            return false;
        }
        $user_profile = $user->profile()->first();
        return $user_profile->original;
    }

    public static function auth_user($data){
        $auth_data = array(
            'username' => $data['email'],
            'password' => $data['password']
        );
        if( Auth::attempt($auth_data) ){
            $user = Auth::user();
            $user_profile = Users::find($user->id)->profile()->first();
            return $user_profile->original;
        } else {
            return false;
        }
    }

    public static function specialist_by_area($state_id, $lga_id){
        if( $lga_id === 0 ){
            $specialists = DB::table('medical_specialists')->where('states_id','=',$state_id)->get();
        } else {
            $specialists = DB::table('medical_specialists')->where('states_id','=',$state_id)
                ->where('lga_id','=',$lga_id)->get();
        }

        if( $specialists === null ){
            return false;
        } else {
            return $specialists;
        }
    }

    public static function prominent_disease($limit, $disease_id){
        if( $disease_id === 0 ){
            $diseases = DB::table('prominent_diseases')->order_by('disease_name','asc')->take($limit)->get();
        }
        else{
            $diseases = DB::table('prominent_diseases')->where('id','=',$disease_id)
                ->order_by('disease_name','asc')->take($limit)->get();
        }

        if( $diseases === null ){
            return false;
        } else {
            return $diseases;
        }
    }

    public static function health_tips($category_id, $limit){
        if( $limit === 0 ){
            $tips = DB::table('health_tips')->where('categories_id','=',$category_id)
                ->order_by('categories_id','asc')->get();
        } else {
            $tips = DB::table('health_tips')->where('categories_id','=',$category_id)
                ->order_by('categories_id','asc')->take($limit)->get();

        }

        if( $tips === null ){
            return false;
        } else {
            return $tips;
        }
    }

    public static function health_tips_single($tip_id){
        $tips = DB::table('health_tips')->where('id','=',$tip_id)->get();

        if( $tips === null ){
            return false;
        } else {
            return $tips;
        }
    }

    public static function health_tips_category($limit){
        if( $limit === 0 ){
            $tips = DB::table('health_tip_categories')->order_by('id','asc')->get();
        } else {
            $tips = DB::table('health_tip_categories')->order_by('id','asc')->take($limit)->get();

        }

        if( $tips === null ){
            return false;
        } else {
            return $tips;
        }
    }

    public static function map_specialist($disease, $lga_id, $state_id){
        $d = explode(' ',$disease);
        $disease_name = $d[0];
        $specialists = DB::table('medical_specialists')->where('specializations','LIKE','%' . strtolower($disease_name) . '%')
            ->where('lga_id','=',$lga_id)->or_where('states_id','=', $state_id)->get();
        if( $specialists === null ){
            return false;
        } else {
            return $specialists;
        }

    }


}