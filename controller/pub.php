<?php

class pub extends baseuser
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->timeline();
    }
    public function focus()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::focus($this->user_id);
    }
    public function shares()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::shares($this->user_id);
    }
    public function album()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::album($this->user_id);
    }
    public function favorite_share()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::favorite_share($this->user_id);
    }
    public function following()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::following($this->user_id, $this->current_user['user_id']);
    }
    public function fans()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->userControlPub($this->user_id);
        }
        parent::fans($this->user_id, $this->current_user['user_id']);
    }
    public function timeline()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->set_user_banner($this->user_id);
        }
        parent::timeline($this->user_id);
    }
    public function forumline()
    {
        $this->parameter_need('user_id');
        if ($this->page == 1)
        {
            $this->set_user_banner($this->user_id);
        }
        parent::forumline($this->user_id);
    }
}

?>