<?php

function getStatus()
{
    return ['Occupied', 'Vacant', 'Maintenance'];
}

function customErrorHandler($errors){

    $error_msgs = $errors->messages();
    $msgs = array_values($error_msgs);
    $full_messages = [];

    foreach($msgs as $key => $msg){
        $full_messages[$key] = $msg[0];
    }
    
    return implode(";",$full_messages);
}

function customSearch($table_name,$request){

    $data = array_filter($request->except("_token","sorting"));
    $values = array_values($data);
    $keys = array_keys($data);
    
    if (count($keys) == 2) {
        $response = \DB::table($table_name)->where("$keys[0]",$values[0])->where("$keys[1]",$values[1]);
    } elseif (count($keys) == 1) {
        $response = \DB::table($table_name)->where("$keys[0]",$values[0]);
    } else {
        $response = \DB::table($table_name)->whereNotNull('id'); 
    }

    if($request->sorting){
        $response = $response->orderBy('id',"$request->sorting");
    }
    $result = $response->get();
    return $result;

}
