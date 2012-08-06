<?php

class Ucenter
{
    protected $params = array(
        'UC_OPEN' => FALSE,
        'UC_CONNECT' => 'mysql',
        'UC_DBHOST' => 'localhost',
        'UC_DBUSER' => 'root',
        'UC_DBPW' => '111',
        'UC_DBNAME' => 'ucenter',
        'UC_DBCHARSET' => 'utf8',
        'UC_DBTABLEPRE' => 'bbs.pre_ucenter_',
        'UC_DBCONNECT' => 0,
        'UC_CHARSET' => 'utf-8',
        'UC_KEY' => '123456',
        'UC_API' => 'http://localhost/bbs2/uc_server',
        'UC_APPID' => '2',
        'UC_IP' => '',
        'UC_DEBUG' => false,
        'UC_PPP' => 20
        );
    public function __construct()
    {
        $ucenter_info = $GLOBALS['G_SP']['ucenter'];
        $params = (false != $ucenter_info) ?array_merge($this->params, $ucenter_info) : $this->params;
        define('UC_OPEN', $params['UC_OPEN']);
        define('UC_CONNECT', $params['UC_CONNECT']);
        define('UC_DBHOST', $params['UC_DBHOST']);
        define('UC_DBUSER', $params['UC_DBUSER']);
        define('UC_DBPW', $params['UC_DBPW']);
        define('UC_DBNAME', $params['UC_DBNAME']);
        define('UC_DBCHARSET', $params['UC_DBCHARSET']);
        define('UC_DBTABLEPRE', $params['UC_DBTABLEPRE']);
        define('UC_DBCONNECT', $params['UC_DBCONNECT']);
        define('UC_CHARSET', $params['UC_CHARSET']);
        define('UC_KEY', $params['UC_KEY']);
        define('UC_API', $params['UC_API']);
        define('UC_APPID', $params['UC_APPID']);
        define('UC_IP', $params['UC_IP']);
        define('UC_PPP', $params['UC_PPP']);
        define('UC_DEBUG', $params['UC_DEBUG']);
        import(APP_PATH . '/uc_client/client.php');
    }
    public function __call($func, $args)
    {
        if ('uc_' == substr($func, 0, 3) && function_exists($func))
        {
            return call_user_func_array ($func, $args);
        }
        spError('无法找到该方法:' . $func);
    }
}

?>