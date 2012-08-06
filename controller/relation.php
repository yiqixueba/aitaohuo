<?php

class relation extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function add_follow()
    {
        $this->ajax_check_login();
        $friend_id = $this->spArgs("fid");
        if (!is_numeric($friend_id))
        {
            ajax_failed_response(T('illegal_operation'));
            return;
        }
        $ptx_user = spClass('ptx_user');
        $user = $ptx_user->find(array('user_id' => $this->current_user['user_id']), ' ptx_user.total_follows ');
        if ($this->permission['other_permission']['fllow_maxnum'] && $user['total_follows'] >= $this->permission['other_permission']['fllow_maxnum'])
        {
            ajax_failed_response(T('reach_max_follow_num') . $this->permission['other_permission']['fllow_maxnum']);
        }
        $ptx_relationship = spClass("ptx_relationship");
        $result = $ptx_relationship->add_follow($this->current_user['user_id'], $friend_id);
        if ($result)
        {
            $data = $this->relationView($this->current_user['user_id'], $friend_id);
            $ptx_message = spClass("ptx_message");
            $ptx_message->add_follow($this->current_user['user_id'], $friend_id);
            ajax_success_response($data, '');
            return;
        }
        else
        {
            ajax_failed_response(T('add_follow_failed'));
            return;
        }
    }
    public function remove_follow()
    {
        $this->ajax_check_login();
        $friend_id = $this->spArgs("fid");
        if (!is_numeric($friend_id))
        {
            ajax_failed_response(T('illegal_operation'));
            return;
        }
        $ptx_relationship = spClass("ptx_relationship");
        $result = $ptx_relationship->remove_follow($this->current_user['user_id'], $friend_id);
        if ($result)
        {
            $data = $this->relationView($this->current_user['user_id'], $friend_id);
            ajax_success_response($data, '');
            return;
        }
        else
        {
            ajax_failed_response(T('remove_follow_failed'));
            return;
        }
    }
}
?>