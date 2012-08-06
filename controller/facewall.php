<?php

class facewall extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
        $this->seo_title(T('facewall'));
    }
    public function index()
    {
        $num_per_page = $this->settings['ui_layout']['face_pagenum'];
        $num_per_page = $num_per_page?$num_per_page:20;
        $ptx_user = spClass("ptx_user");
        $wf = $this->spArgs("wf");
        $order = $this->spArgs("sort");
        $sort = null;
        $args = array("page" => "2");
        if (in_array($order, array('fans', 'reg', 'share', 'like', 'nickname')))
        {
            if ($order == 'fans')
            {
                $sort = ' ptx_user.total_followers DESC ';
            }
            else if ($order == 'reg')
            {
                $sort = ' ptx_user.create_time DESC ';
            }
            else if ($order == 'share')
            {
                $sort = ' ptx_user.total_shares DESC ';
            }
            else if ($order == 'like')
            {
                $sort = ' ptx_user.total_likes DESC ';
            }
            else if ($order == 'nickname')
            {
                $sort = ' ptx_user.nickname ASC ';
            }
            $args['sort'] = $order;
            $this->sort = $order;
        }
        $users = $ptx_user->search(null, $this->page, $num_per_page, null, $sort);
        $user_id = $this->is_login()?$this->current_user['user_id']:0;
        $this->prepareView($users, $user_id);
        $this->nextpage_url = spUrl("facewall", "index", $args);
        $need_header_footer = ($wf == '1')?false:true;
        $this->ouput("/facewall/index.php", $need_header_footer);
    }
    private function prepareView($friends, $user_id)
    {
        foreach ($friends as $key => $friend)
        {
            $friends[$key]['relation_view'] = $this->relationView($user_id, $friend['user_id']);
        }
        $this->waterfallView($friends, 'user');
    }
}
?>