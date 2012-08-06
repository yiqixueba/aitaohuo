<?php

class ajaxtpl extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function render_tpl()
    {
        $tpl = $this->spArgs("tpl");
        if ($tpl)
        {
            $data['tpl'] = $this->render('/js_tpl/' . $tpl . '.php');
            ajax_success_response($data, '');
            return;
        }
        ajax_failed_response('模板获取失败');
    }
}
?>