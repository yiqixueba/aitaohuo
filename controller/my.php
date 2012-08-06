<?php

class my extends baseuser
{
    public function __construct()
    {
        parent::__construct();
        $this->seo_title(T('my_pin'));
    }
    public function index()
    {
        $this->focus();
    }
    public function focus()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::focus($this->current_user['user_id']);
    }
    public function shares()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::shares($this->current_user['user_id']);
    }
    public function at_shares()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::at_shares($this->current_user['user_id']);
    }
    public function at_comments()
    {
        $this->check_login();
        $this->userControl();
        parent::at_comments($this->current_user['user_id']);
    }
    public function album()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::album($this->current_user['user_id']);
    }
    public function favorite_share()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::favorite_share($this->current_user['user_id']);
    }
    public function favorite_album()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::favorite_album($this->current_user['user_id']);
    }
    public function following()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::following($this->current_user['user_id'], $this->current_user['user_id']);
    }
    public function fans()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        parent::fans($this->current_user['user_id'], $this->current_user['user_id']);
    }
    public function timeline()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->set_user_banner($this->current_user['user_id']);
        }
        parent::timeline($this->current_user['user_id']);
    }
    public function forumline()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->set_user_banner($this->current_user['user_id']);
        }
        parent::forumline($this->current_user['user_id']);
    }
    public function setting_basic()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $this->ouput("/user/setting_basic.php");
    }
    public function setting_forum()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $this->ouput("/user/setting_forum.php");
    }
    public function setting_bind()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $connector = spClass('ptx_connector');
        $this->bind_connectors = $connector->get_bind_connectors($this->user['user_id']);
        $cs = array();
        foreach ($this->bind_connectors as $c)
        {
            $vendor = $c['vendor'];
            $cs[$vendor]['id'] = $c['connect_id'];
            $cs[$vendor]['username'] = $c['username'];
        }
        $this->cs = $cs;
        $this->ouput("/user/setting_bind.php");
    }
    public function setting_security()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $this->ouput("/user/setting_security.php");
    }
    public function setting_shop()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $ptx_goodshop = spClass('ptx_goodshop');
        $condition['user_id'] = $this->user['user_id'];
        $this->shop = $ptx_goodshop->find_one($condition);
        $this->ouput("/user/setting_shop.php");
    }
    public function setting_star()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $ptx_staruser = spClass('ptx_staruser');
        $condition['user_id'] = $this->user['user_id'];
        $this->staruser = $ptx_staruser->find_one($condition);
        $this->ouput("/user/setting_star.php");
    }
    public function message()
    {
        $this->check_login();
        if ($this->page == 1)
        {
            $this->userControl();
        }
        $num_per_page = 10;
        $ptx_user = spClass('ptx_user');
        $ptx_message = spClass('ptx_message');
        $conditions['to_user_id'] = $this->current_user['user_id'];
        $this->messages = $ptx_message->search($conditions, $this->page, $num_per_page);
        $length = array_length($this->messages);
        if ($length == 10)
        {
            $start_clean_message = $this->messages[$length-1];
            $start_clean_id = $start_clean_message['message_id'];
        }
        $ptx_user->clean_message($this->current_user['user_id'], $start_clean_id);
        $this->ouput("/user/message.php");
    }
}

?>