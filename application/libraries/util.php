<?php
/**
 * File Description here.
 * Author: Mfawa Alfred Onen
 * Date: 3/16/13
 * Version: v1.0
 * File: util.php
 */

class Util {

    public static function state_dropdown($name, $selected = null, $attrib = array()){
        $opts = DB::table('states')->get();
        foreach($opts as $opt){
            $options[$opt->id] = $opt->states_name;
        }
        return Form::select($name, $options, $selected, $attrib);
    }

    public static function lga_dropdown($name, $selected = 1, $attrib = array()){
        $opts = DB::table('local_government')->where('states_id','=',$selected)->get();
        foreach($opts as $opt){
            $options[$opt->id] = $opt->lg_name;
        }
        return Form::select($name, $options, $selected, $attrib);
    }

}