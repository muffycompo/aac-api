<?php
class Users extends Basemodel {
    public static $table = 'users';
    public static $timestamps = false;

    public function profile(){
        return $this->has_one('Profile');
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

    //TODO: Find a way to make PUT work with REST clients
    public static function update_user_profile($data){
        $member_id = $data['member_id'];
        if(empty($member_id)){ return false;}

        $profile_data = array(
            'surname' => $data['surname'],
            'firstname' => $data['firstname'],
            'gsm' => $data['gsm'],
            'lga_id' => $data['lga'],
            'states_id' => $data['state']
        );

        $user = DB::table('profiles')->where('users_id','=',$member_id)->update($profile_data);
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
        return (array) $user_profile;
    }

    public static function auth_user($data){
        $auth_data = array(
            'username' => $data['email'],
            'password' => $data['password']
        );
        if( Auth::attempt($auth_data) ){
            $user = Auth::user();
            $user_profile = Users::find($user->id)->profile()->first();
            return $user_profile;
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


}