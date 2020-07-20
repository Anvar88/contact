<?php
    if (! function_exists('groups')) {
         function groups(){
            $group = DB::table('groups')->get();
            foreach ($group as $key=>$value){
              $groups[$value->id] = $value->groups_name;
            }
            return $groups;
         }
    }