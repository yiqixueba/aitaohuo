<?php

class TaobaokeItemsDetailGetRequest
{
    private $fields;
    private $nick;
    private $numIids;
    private $outerCode;
    private $pid;
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
    public function setNumIids($numIids)
    {
        $this->numIids = $numIids;
        $this->apiParas["num_iids"] = $numIids;
    }
    public function getNumIids()
    {
        return $this->numIids;
    }
    public function setOuterCode($outerCode)
    {
        $this->outerCode = $outerCode;
        $this->apiParas["outer_code"] = $outerCode;
    }
    public function getOuterCode()
    {
        return $this->outerCode;
    }
    public function setPid($pid)
    {
        $this->pid = $pid;
        $this->apiParas["pid"] = $pid;
    }
    public function getPid()
    {
        return $this->pid;
    }
    public function getApiMethodName()
    {
        return "taobao.taobaoke.items.detail.get";
    }
    public function getApiParas()
    {
        return $this->apiParas;
    }
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->fields, "fields");
        RequestCheckUtil::checkNotNull($this->numIids, "numIids");
        RequestCheckUtil::checkMaxListSize($this->numIids, 20, "numIids");
        RequestCheckUtil::checkMaxLength($this->outerCode, 12, "outerCode");
    }
}

?>