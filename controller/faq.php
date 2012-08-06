<?php

class faq extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
        $this->faq_nav();
    }
    private function faq_nav()
    {
        $this->fav_nav = $this->render("/faq/faq_nav.php");
    }
    public function fav()
    {
        $this->seo_title(T('collect_tool'));
        $this->ouput("/faq/fav_tool.php");
    }
    public function about_us()
    {
        $this->seo_title(T('about_us'));
        $this->ouput("/faq/about_us.php");
    }
    public function agreement()
    {
        $this->seo_title(T('agreement'));
        $this->ouput("/faq/agreement.php");
    }
    public function contact_us()
    {
        $this->seo_title(T('contact_us'));
        $this->ouput("/faq/contact_us.php");
    }
}
?>