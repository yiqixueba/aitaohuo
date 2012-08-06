<?php

class ajaxmessage extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function fetch()
    {
        $event = $this->spArgs("event");
        $event_arr = array('reward', 'alert', 'warn');
        if (!in_array($event, $event_arr)) return;
        eval("\$this->$event();");
    }
    private function reward()
    {
        $this->ajax_check_login();
        $ptx_event_log = spClass('ptx_event_log');
        $start_time = mktime()-5 * 24 * 3600;
        $ptx_event_log->clean_log($this->current_user['user_id'], $start_time);
        $conditions['to_user_id'] = $this->current_user['user_id'];
        $conditions['event_type'] = 'reward';
        $conditions['is_read'] = '0';
        $logs = $ptx_event_log->search_no_page($conditions);
        $credit_strategy = $this->settings['credit_strategy'];
        $messages = array();
        foreach ($logs as $log)
        {
            $msg = T($log['event_code']) . ' ';
            for ($i = 1;$i <= 3;$i++)
            {
                if ($ext_credits = $credit_strategy[$log['event_code'] . '_credits_' . $i])
                {
                    $msg .= T("ext_credits_$i") . ' +' . $ext_credits . ' ';
                }
            }
            $messages[] = $msg;
        }
        $ptx_event_log->update($conditions, array('is_read' => 1));
        ajax_success_response($messages, 'tip');
    }
}
?>