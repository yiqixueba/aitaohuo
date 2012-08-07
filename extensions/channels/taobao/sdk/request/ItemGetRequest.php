<?php

class ItemGetRequest
{
    private $fields;
    private $numIid;
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
    public function setNumIid($numIid)
    {
        $this->numIid = $numIid;
        $this->apiParas["num_iid"] = $numIid;
    }
    public function getNumIid()
    {
        return $this->numIid;
    }
    public function getApiMethodName()
    {
        return "taobao.item.get";
    }
    public function getApiParas()
    {
        return $this->apiParas;
    }
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->fields, "fields");
        RequestCheckUtil::checkNotNull($this->numIid, "numIid");
        RequestCheckUtil::checkMinValue($this->numIid, 1, "numIid");
    }
}

?>