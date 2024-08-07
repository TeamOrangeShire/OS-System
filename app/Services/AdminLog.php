<?php
namespace App\Services;

use App\Models\ActivityLog;

class AdminLog {

    protected $message;
    protected $location;
    protected $header;
    public function __construct($header,$message, $location)
    {
       $this->message = $message;
       $this->location = $location;
       $this->header = $header;
    }

    public function save(){
      $act = new ActivityLog();
      $act->act_user_id = session('Admin_id');
      $act->act_user_type = 'Admin';
      $act->act_action = $this->message;
      $act->act_header = $this->header;
      $act->act_location = $this->location;
      $act->save();
    }
}
