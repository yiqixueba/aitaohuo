<?php

class OAuth_Taobao
{
    public $appkey;
    public $secretKey;
    public $gatewayUrl = "http://gw.api.taobao.com/router/rest";
    public $format = "json";
    protected $signMethod = "md5";
    protected $apiVersion = "2.0";
    protected $sdkVersion = "top-sdk-php-20110616";
    function __construct($appkey, $secret)
    {
        $this->appkey = $appkey;
        $this->secretKey = $secret;
    }
    protected function generateSign($params)
    {
        ksort($params);
        $stringToBeSigned = $this->secretKey;
        foreach ($params as $k => $v)
        {
            if ("@" != substr($v, 0, 1))
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $this->secretKey;
        return strtoupper(md5($stringToBeSigned));
    }
    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if ("@" != substr($v, 0, 1))
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&";
                }
                else
                {
                    $postMultipart = true;
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
            }
        }
        $reponse = curl_exec($ch);
        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch), 0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse, $httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }
    protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        $localIp = isset($_SERVER["SERVER_ADDR"]) ?$_SERVER["SERVER_ADDR"] : "CLI";
        $logger = new LtLogger;
        $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_comm_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
        $logger->conf["separator"] = "^_^";
        $logData = array(
            date("Y-m-d H:i:s"),
            $apiName,
            $this->appkey,
            $localIp,
            PHP_OS,
            $this->sdkVersion,
            $requestUrl,
            $errorCode,
            str_replace("\n", "", $responseTxt)
            );
        $logger->log($logData);
    }
    public function execute($request, $session = null)
    {
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = $request['action'];
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams["partner_id"] = $this->sdkVersion;
        if (null != $session)
        {
            $sysParams["session"] = $session;
        }
        $apiParams = $request['paras'];
        $sysParams["sign"] = $this->generateSign(array_merge($apiParams, $sysParams));
        $requestUrl = $this->gatewayUrl . "?";
        foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        $requestUrl = substr($requestUrl, 0, -1);
        try
        {
            $resp = $this->curl($requestUrl, $apiParams);
        }
        catch (Exception $e)
        {
            $this->logCommunicationError($sysParams["method"], $requestUrl, "HTTP_ERROR_" . $e->getCode(), $e->getMessage());
            return false;
        }
        $respWellFormed = false;
        if ("json" == $this->format)
        {
            $respObject = json_decode($resp, TRUE);
            if (null !== $respObject)
            {
                $respWellFormed = true;
            }
        }
        else if ("xml" == $this->format)
        {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject)
            {
                $respWellFormed = true;
            }
        }
        if (false === $respWellFormed)
        {
            $this->logCommunicationError($sysParams["method"], $requestUrl, "HTTP_RESPONSE_NOT_WELL_FORMED", $resp);
            return false;
        }
        if (isset($respObject->code))
        {
            $logger = new LtLogger;
            $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_biz_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
            $logger->log(array(
                    date("Y-m-d H:i:s"),
                    $resp
                    ));
        }
        return $respObject;
    }
    public function exec($paramsArray)
    {
        if (!isset($paramsArray["method"]))
        {
            trigger_error("No api name passed");
        }
        $inflector = new LtInflector;
        $inflector->conf["separator"] = ".";
        $requestClassName = ucfirst($inflector->camelize(substr($paramsArray["method"], 7))) . "Request";
        if (!class_exists($requestClassName))
        {
            trigger_error("No such api: " . $paramsArray["method"]);
        }
        $session = isset($paramsArray["session"]) ?$paramsArray["session"] : null;
        $req = new $requestClassName;
        foreach($paramsArray as $paraKey => $paraValue)
        {
            $inflector->conf["separator"] = "_";
            $setterMethodName = $inflector->camelize($paraKey);
            $inflector->conf["separator"] = ".";
            $setterMethodName = "set" . $inflector->camelize($setterMethodName);
            if (method_exists($req, $setterMethodName))
            {
                $req->$setterMethodName($paraValue);
            }
        }
        return $this->execute($req, $session);
    }
}
class LtLogger
{
    public $conf = array(
        "separator" => "\t",
        "log_file" => ""
        );
    private $fileHandle;
    protected function getFileHandle()
    {
        if (null === $this->fileHandle)
        {
            if (empty($this->conf["log_file"]))
            {
                trigger_error("no log file spcified.");
            }
            $logDir = dirname($this->conf["log_file"]);
            if (!is_dir($logDir))
            {
                mkdir($logDir, 0777, true);
            }
            $this->fileHandle = fopen($this->conf["log_file"], "a");
        }
        return $this->fileHandle;
    }
    public function log($logData)
    {
        if ("" == $logData || array() == $logData)
        {
            return false;
        }
        if (is_array($logData))
        {
            $logData = implode($this->conf["separator"], $logData);
        }
        $logData = $logData . "\n";
        fwrite($this->getFileHandle(), $logData);
    }
}
class LtInflector
{
    public $conf = array("separator" => "_");
    public function camelize($uncamelized_words)
    {
        $uncamelized_words = $this->conf["separator"] . str_replace($this->conf["separator"] , " ", strtolower($uncamelized_words));
        return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $this->conf["separator"]);
    }
    public function uncamelize($camelCaps)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $this->conf["separator"] . "$2", $camelCaps));
    }
}
?>