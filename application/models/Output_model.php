<?php

class Output_model extends CI_Model
{
    public function json_print($code, $message, $data = null)
    {
        $res = array();
        $res['c'] = $code;
        $res['m'] = $message;
        if ($data) {
            $res['d'] = $data;
        }

        echo json_encode($res);
    }
}
