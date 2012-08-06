<?php

class goodshop extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
        $this->seo_title(T('goodshop'));
    }
    public function index()
    {
        $num_per_page = 8;
        $ptx_goodshop = spClass("ptx_goodshop");
        if ($this->category_id)
        {
            $conditions['category_id'] = $this->category_id;
            $args['cat'] = $this->category_id;
        }
        $shops = $ptx_goodshop->search($conditions, $this->page, $num_per_page);
        $this->pages = createTPages($ptx_goodshop->spPager()->getPager(), 'goodshop', 'index', $conditions);
        $this->prepareView($shops);
        $this->ouput("/goodshop/index.php");
    }
    private function prepareView($shops)
    {
        $user_id = $this->is_login()?$this->current_user['user_id']:0;
        $ptx_share = spClass('ptx_share');
        $this->is_shop = true;
        foreach ($shops as $key => $shop)
        {
            $conditions['user_id'] = $shop['user_id'];
            $shares = $ptx_share->search($conditions, 1, 5);
            $shops[$key]['shares'] = $shares;
            $shops[$key]['relation_view'] = $this->relationView($user_id, $shop['user_id']);
        }
        $this->shops = $shops;
    }
    public function apply()
    {
        $this->ajax_check_login();
        if ($this->txt && $this->category_id)
        {
            $ptx_apply = spClass("ptx_apply");
            if ($ptx_apply->check_exits($this->current_user['user_id'], $this->category_id, 2))
            {
                ajax_failed_response(T('already_applied'));
                return;
            }
            $ptx_apply->add_shopapply($this->current_user['user_id'], $this->category_id, $this->txt);
            ajax_success_response(null, T('apply_succeed'));
            return;
        }
        ajax_failed_response();
    }
    public function edit()
    {
        $this->ajax_check_login();
        $shop_desc = $this->spArgs("shop_desc");
        if ($shop_desc)
        {
            $ptx_goodshop = spClass("ptx_goodshop");
            $ptx_goodshop->update(array('user_id' => $this->current_user['user_id']), array('shop_desc' => $shop_desc));
            ajax_success_response(null, T('operate_succeed'));
            return;
        }
        ajax_failed_response();
    }
}
?>