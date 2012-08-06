<?php
class event_dispatcher
{
    public function __construct()
    {
        $this->ptx_settings = spClass('ptx_settings');
        $this->settings = $this->ptx_settings->getSettings();
        $this->ptx_usergroup = spClass('ptx_usergroup');
        $this->usergroups = $this->ptx_usergroup->getUsergroups();
        $this->ptx_user = spClass('ptx_user');
    }

    public function invoke($event, $user_id)
    {
        $event_arr = array('login_everyday', 'post_comment', 'post_share', 'post_video', 'forward_share', 'been_like', 'been_like_album', 'add_like', 'add_like_album', 'email_active', 'create_avatar');
        if (!in_array($event, $event_arr)) return;
        eval("\$result=\$this->$event($user_id);");
        if ($result['update_credit'])
        {
            $this->credit_strategy_invoke($event, $user_id);
            $this->update_usercredits($user_id);
        }
        if ($result['add_log'])
        {
            $ptx_event_log = spClass('ptx_event_log');
            $ptx_event_log->add_one($event, 'reward', $user_id);
        }
    }

    public function credit_strategy_invoke($event, $user_id)
    {
        $credit_strategy = $this->settings['credit_strategy'];
        $ext_credits_1 = is_numeric($credit_strategy[$event . '_credits_1'])?$credit_strategy[$event . '_credits_1']:0;
        $ext_credits_2 = is_numeric($credit_strategy[$event . '_credits_2'])?$credit_strategy[$event . '_credits_2']:0;
        $ext_credits_3 = is_numeric($credit_strategy[$event . '_credits_3'])?$credit_strategy[$event . '_credits_3']:0;
        $sql = "UPDATE {$this->ptx_user->tbl_name} " . "SET ext_credits_1=ext_credits_1+{$ext_credits_1}, " . " ext_credits_2=ext_credits_2+{$ext_credits_2}, " . " ext_credits_3=ext_credits_3+{$ext_credits_3} " . "WHERE user_id='{$user_id}'";
        $this->ptx_user->runSql($sql);
        return TRUE;
    }

    private function update_usergroup($user_data, $user_update)
    {
        $usergroup = $this->usergroups[$user_data['usergroup_id']];
        if ($usergroup['usergroup_type'] == 'member' && ($user_update['credits'] > $usergroup['credits_higher'] || $user_update['credits'] < $usergroup['credits_lower']))
        {
            $newgroup = $this->ptx_usergroup->find_one(array('credits' => $user_update['credits']));
            if ($newgroup)
                $user_update['usergroup_id'] = $newgroup['usergroup_id'];
        }
        return $user_update;
    }

    private function update_usercredits($user_id)
    {
        $credit_setting = $this->settings['credit_setting'];
        $credit_formula_exe = $credit_setting['credit_formula_exe'];
        if ($credit_formula_exe)
        {
            $user_data = $this->ptx_user->getuser_byid($user_id);
            $total_followers = $user_data['total_followers'];
            $total_likes = $user_data['total_likes'];
            $total_shares = $user_data['total_shares'];
            $ext_credits_1 = $user_data['ext_credits_1'];
            $ext_credits_2 = $user_data['ext_credits_2'];
            $ext_credits_3 = $user_data['ext_credits_3'];
            eval("\$user_update['credits']=$credit_formula_exe;");

            $user_update = $this->update_usergroup($user_data, $user_update);

            $this->ptx_user->update(array('user_id' => $user_id), $user_update);
            spClass('UserLib')->refresh_session();
        }
    }

    private function post_share($user_id)
    {
        $this->ptx_user->add_share($user_id);
        return array('update_credit' => true, 'add_log' => true);
    }
    private function login_everyday($user_id)
    {
        $condition = array('user_id' => $user_id);
        $user_data = $this->ptx_user->find($condition, null, ' ptx_user.last_login_time ');
        $now = mktime();
        $now_date = date('Ymd', $now);
        $last_date = date('Ymd', $user_data['last_login_time']);
        $this->ptx_user->update($condition, array('last_login_time' => $now));
        if ($now_date <= $last_date)
        {
            return array('update_credit' => false, 'add_log' => false);
        }
        return array('update_credit' => true, 'add_log' => true);
    }

    private function post_video()
    {
        return array('update_credit' => true, 'add_log' => true);
    }

    private function forward_share()
    {
        return array('update_credit' => true, 'add_log' => true);
    }

    private function post_comment($user_id)
    {
        return array('update_credit' => true, 'add_log' => true);
    }
    private function email_active($user_id)
    {
        return array('update_credit' => true, 'add_log' => true);
    }
    private function been_like($user_id)
    {
        return array('update_credit' => true, 'add_log' => false);
    }
    private function been_like_album($user_id)
    {
        return array('update_credit' => true, 'add_log' => false);
    }
    private function create_avatar($user_id)
    {
        $condition['event_type'] = 'reward';
        $condition['event_code'] = 'create_avatar';
        $condition['to_user_id'] = $user_id;
        $condition['is_read'] = '1';
        $ptx_event_log = spClass('ptx_event_log');
        $log = $ptx_event_log->find_one($condition);
        if ($log)
        {
            return array('update_credit' => false, 'add_log' => false);
        }
        return array('update_credit' => true, 'add_log' => true);
    }
    private function add_like($user_id)
    {
        return array('update_credit' => true, 'add_log' => true);
    }
    private function add_like_album()
    {
        return array('update_credit' => true, 'add_log' => true);
    }
}
