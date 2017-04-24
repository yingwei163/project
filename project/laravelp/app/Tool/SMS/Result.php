<?php
namespace App\Tool\SMS;
class Result
{
    public  $status;
    public  $message;

    public function tojosn()
    {
        return json_encode($this);
    }
}




