<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/15/13
 * Version: v1.0
 * File: Profile.php
 */

class Profile extends Basemodel {
    public static $table = 'profiles';
    public static $timestamps = false;

    public function user(){
        return $this->has_one('Users','users_id');
    }

}