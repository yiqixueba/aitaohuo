<?php

class ShopGetRequest
{
    private $fields;
    private $nick;
    private $apiParas = array();
    public function setFields($fields)
    {
        $this->fields = $fields;
        $this->apiParas["fields"] = $fields;
    }
    public function getFields()
    {
        return $this->fields;
    }
    public function setNick($nick)
    {
        $this->nick = $nick;
        $this->apiParas["nick"] = $nick;
    }
    public function getNick()
    {
        return $this->nick;
    }
    public function getApiMethodName()
    {
        return "taobao.shop.get";
    }
    public function getApiParas()
    {
        return $this->apiParas;
    }
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->fields, "fields");
        RequestCheckUtil::checkNotNull($this->nick, "nick");
    }
}

?>