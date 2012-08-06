<?php

import(APP_PATH . '/controller/social.php');
class callback_taobao extends social
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $vendor = 'Taobao';
        $connector = spClass("Connector");
        $token = $connector->get_accesstoken($vendor);
        $userinfo = $connector->get_userinfo($vendor);
        $userinfo['vendor'] = $vendor;
        $this->session->set_data('social_info', $userinfo);
        $this->social_info = $userinfo;
        $this->bind();
    }
}
?>