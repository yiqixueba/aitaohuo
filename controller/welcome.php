<?php

class welcome extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->albums = $this->getHotestAlbum();
        $ptx_staruser = spClass('ptx_staruser');
        $staruser_cachetime = $this->settings['setting_optimizer']['cache_time_star'];
        $this->starusers = $ptx_staruser->get_staruser_cache($staruser_cachetime);
        $ptx_goodshop = spClass('ptx_goodshop');
        $this->goodshops = $ptx_goodshop->get_goodshop_cache();
        if ($this->settings['ui_layout']['count_or_lastest'] == 'lastest')
        {
            $this->shares = $this->getLastest20();
        }
        else
        {
            $this->count = $this->getPtxCount();
        }
        $this->prepareView();
        $this->ouput("/welcome/index.php");
    }
    private function prepareView()
    {
        $categories = $this->categories;
        foreach ($categories as $key => $category)
        {
            if ($category['is_home'])
            {
                $this->category = $category;
                $style = $category['style']?$category['style']:'home_1';
                $categories[$key]['home_view'] = $this->render('/common/' . $style . '.php');
            }
        }
        $this->categories = $categories;
    }
    private function getPtxCount()
    {
        $result = spAccess('r', 'ptx_count');
        if (!$result)
        {
            $this->update_count();
            $result = spAccess('r', 'ptx_count');
        }
        return $result;
    }
    private function getLastest20()
    {
        $result = spAccess('r', 'lastest_shares');
        if (!$result)
        {
            $ptx_share = spClass('ptx_share');
            $conditions['orgin_post'] = 1;
            $result = $ptx_share->search($conditions, 1, 20);
            spAccess('w', 'lastest_shares', $result, 300);
        }
        return $result;
    }
    private function getHotestAlbum()
    {
        $result = spAccess('r', 'hotest_album');
        if (!$result)
        {
            $ptx_album = spClass('ptx_album');
            $result = $ptx_album->search(NULL, 1, 4, NULL, ' ptx_album.total_like DESC ');
            $time = $this->settings['setting_optimizer']['cache_time_album'];
            spAccess('w', 'hotest_album', $result, $time);
        }
        return $result;
    }
}
?>