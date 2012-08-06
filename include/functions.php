<?php
function strip_slashes($str)
{
	if (is_array($str))
	{
		foreach ($str as $key => $val)
		{
			$str[$key] = strip_slashes($val);
		}
	}
	else
	{
		$str = stripslashes($str);
	}

	return $str;
}
function uc_log($str){
	$debugStr = date('Y-m-d H:i:s', time()) . ':' . $str. print_r(array('log'=>2), 1);
	$debugLogFile = APP_PATH.'/data/uc_client_log.txt';
	file_put_contents($debugLogFile, $debugStr, FILE_APPEND);
}
function slash_item($item)
{
	if(!isset($item))
	{
		return FALSE;
	}
	if(trim($item) == '')
	{
		return '';
	}

	return rtrim($item, '/').'/';
}

function base_url($uri = '')
{
	if (isset($_SERVER['HTTP_HOST']))
	{
		$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$base_url .= '://'. $_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	}

	else
	{
		$base_url = 'http://localhost/';
	}
	return slash_item($base_url).ltrim($uri,'/');
}

function host_url($uri = '') {
	if (isset($_SERVER['HTTP_HOST']))
	{
		$host_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$host_url .= '://'. $_SERVER['HTTP_HOST'];
		//$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	}

	else
	{
		$host_url = 'http://localhost';
	}
	return $host_url.ltrim($uri,'');
}

function random_string($type = 'alnum', $len = 8)
{
	switch($type)
	{
		case 'basic'	: return mt_rand();
		break;
		case 'alnum'	:
		case 'numeric'	:
		case 'nozero'	:
		case 'alpha'	:

			switch ($type)
			{
				case 'alpha'	:	$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
				case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
				case 'numeric'	:	$pool = '0123456789';
				break;
				case 'nozero'	:	$pool = '123456789';
				break;
			}

			$str = '';
			for ($i=0; $i < $len; $i++)
			{
				$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
			}
			return $str;
			break;
		case 'unique'	:
		case 'md5'		:

			return md5(uniqid(mt_rand()));
			break;
	}
}


function createPages($pager,$controller,$action,$args){
	if(!$pager)
	return '';
	$des = T('total').' '.$pager['total_count'].' '.T('items').', '.T('total').' '.$pager['total_page'].' '.T('page').' ('.$pager['page_size'].'/'.T('page').'):';
	if ($pager['current_page'] != $pager['first_page']){
		$args['page'] = $pager['first_page'];
		$des .= '<a href="'.spUrl($controller,$action,$args).'">'.T('first_page').'</a> | ';
		$args['page'] = $pager['prev_page'];
		$des .= '<a href="'.spUrl($controller,$action,$args).'">'.T('prev_page').'</a> | ';
	}

	foreach ($pager['all_pages'] as $thepage){
		if ($thepage != $pager['current_page']) {
			$args['page'] = $thepage;
			$des .= '<a href="'.spUrl($controller,$action,$args).'">'.$thepage.'</a> ';;
		}else{
			$des .= '<b>'.$thepage.'</b>';
		}
	}

	if ($pager['current_page'] != $pager['last_page']){
		$args['page'] = $pager['next_page'];
		$des .= '<a href="'.spUrl($controller,$action,$args).'">'.T('next_page').'</a> | ';
		$args['page'] = $pager['last_page'];
		$des .= '<a href="'.spUrl($controller,$action,$args).'">'.T('last_page').'</a>';
	}

	return $des;
}

function createTPages($pager,$controller,$action,$args){
	if(!$pager||$pager['total_page']==1)
	return '';
	$des = '<div class="pagination"><ul>';
	if ($pager['current_page'] != $pager['first_page']&&$pager['prev_page']>0){
		$args['page'] = $pager['prev_page'];
		$des .= '<li><a href="'.spUrl($controller,$action,$args).'">'.T('prev_page').'</a></li>';
	}

	foreach ($pager['all_pages'] as $thepage){
		if ($thepage != $pager['current_page']) {
			$args['page'] = $thepage;
			$des .= '<li><a href="'.spUrl($controller,$action,$args).'">'.$thepage.'</a></li>';;
		}else{
			$des .= '<li class="active"><a href="#">'.$thepage.'</a></li>';
		}
	}

	if ($pager['current_page'] != $pager['last_page']){
		$args['page'] = $pager['next_page'];
		$des .= '<li><a href="'.spUrl($controller,$action,$args).'">'.T('next_page').'</a></li>';
	}
	$des .= '</ul></div>';
	return $des;
}

/**
 * @packae     二维数组排序
 * @version     $Id: functions.php,v 1.9 2012/06/15 13:21:01 lijihua Exp $
 *
 *
 * Sort an two-dimension array by some level two items use array_multisort() function.
 *
 * sysSortArray($Array,&quot;Key1&quot;,&quot;SORT_ASC&quot;,&quot;SORT_RETULAR&quot;,&quot;Key2&quot;……)
 * @author                      Chunsheng Wang &lt;wwccss@263.net>
 * @param  array   $ArrayData   the array to sort.
 * @param  string  $KeyName1    the first item to sort by.
 * @param  string  $SortOrder1  the order to sort by(&quot;SORT_ASC&quot;|&quot;SORT_DESC&quot;)
 * @param  string  $SortType1   the sort type(&quot;SORT_REGULAR&quot;|&quot;SORT_NUMERIC&quot;|&quot;SORT_STRING&quot;)
 * @return array                sorted array.
 */
function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR")
{
	if(!is_array($ArrayData))
	{
		return $ArrayData;
	}

	// Get args number.
	$ArgCount = func_num_args();

	// Get keys to sort by and put them to SortRule array.
	for($I = 1;$I < $ArgCount;$I ++)
	{
		$Arg = func_get_arg($I);
		if(!eregi("SORT",$Arg))
		{
			$KeyNameList[] = $Arg;
			$SortRule[]    = '$'.$Arg;
		}
		else
		{
			$SortRule[]    = $Arg;
		}
	}

	// Get the values according to the keys and put them to array.
	foreach($ArrayData AS $Key => $Info)
	{
		foreach($KeyNameList AS $KeyName)
		{
			${$KeyName}[$Key] = $Info[$KeyName];
		}
	}

	// Create the eval string and eval it.
	$EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
	eval ($EvalString);
	return $ArrayData;
}

//中文字符串截取
function sysSubStr($string,$length,$append = false)
{
	if(strlen($string) <= $length )
	{
		return $string;
	}
	else
	{
		$i = 0;
		while ($i < $length)
		{
			$stringTMP = substr($string,$i,1);
			if ( ord($stringTMP) >=224 )
			{
				$stringTMP = substr($string,$i,3);
				$i = $i + 3;
			}
			elseif( ord($stringTMP) >=192 )
			{
				$stringTMP = substr($string,$i,2);
				$i = $i + 2;
			}
			else
			{
				$i = $i + 1;
			}
			$stringLast[] = $stringTMP;
		}
		$stringLast = implode("",$stringLast);
		if($append)
		{
			$stringLast .= "…";
		}
		return $stringLast;
	}
}

/*
 * friendlyDate()
 *
 * @param mixed $timestamp
 * @param array $formats,自定义时间格式
 * @return 友好的时间日期
 */

function friendlyDate($timestamp, $formats = null)
{

	$_DATE_FORMAT = array(
    'DAY'           => T('DAY'),  
    'DAY_HOUR'      => T('DAY_HOUR'),  
    'HOUR'          => T('HOUR'),  
    'HOUR_MINUTE'   => T('HOUR_MINUTE'),  
    'MINUTE'        => T('MINUTE'),  
    'MINUTE_SECOND' => T('MINUTE_SECOND'),  
    'SECOND'        => T('SECOND'),  
	);

	if ($formats == null) {
		$formats = $_DATE_FORMAT;
	}
	/* 计算出时间差 */
	$seconds = time() - $timestamp;
	$minutes = floor($seconds / 60);
	$hours   = floor($minutes / 60);
	$days    = floor($hours / 24);

	if ($days > 0 && $days<=3) {
		$diffFormat = 'DAY';
	} else if($days > 3){
		return date('Y-m-d',$timestamp);
	} else {
		$diffFormat = ($hours > 0) ? 'HOUR' : 'MINUTE';
		if ($diffFormat == 'HOUR') {
			$diffFormat .= ($minutes > 0 && ($minutes - $hours * 60) > 0) ? '_MINUTE' : '';
		} else {
			$diffFormat = (($seconds - $minutes * 60) > 0 && $minutes > 0)
			? $diffFormat.'_SECOND' : 'SECOND';
		}
	}

	$dateDiff = null;
	switch ($diffFormat) {
		case 'DAY':
			$dateDiff = sprintf($formats[$diffFormat], $days);
			break;
		case 'DAY_HOUR':
			$dateDiff = sprintf($formats[$diffFormat], $days, $hours - $days * 60);
			break;
		case 'HOUR':
			$dateDiff = sprintf($formats[$diffFormat], $hours);
			break;
		case 'HOUR_MINUTE':
			$dateDiff = sprintf($formats[$diffFormat], $hours, $minutes - $hours * 60);
			break;
		case 'MINUTE':
			$dateDiff = sprintf($formats[$diffFormat], $minutes);
			break;
		case 'MINUTE_SECOND':
			$dateDiff = sprintf($formats[$diffFormat], $minutes, $seconds - $minutes * 60);
			break;
		case 'SECOND':
			$dateDiff = sprintf($formats[$diffFormat], $seconds);
			break;
	}
	return $dateDiff;
}
/*
 * count() always return a wrong value
 * */
function array_length($arr){
	$num = 0;
	if($arr&&is_array($arr)&&!empty($arr)){
		foreach ($arr as $value) {
			if($value!=null&&$value!=''){
				$num++;
			}
		}
	}
	return $num;
}

function delete_html($str)
{
	$str = trim($str);
	$str = strip_tags($str,"");
	$str = ereg_replace("\t","",$str);
	$str = ereg_replace("\r\n","",$str);
	$str = ereg_replace("\r","",$str);
	$str = ereg_replace("\n","",$str);
	$str = ereg_replace(" "," ",$str);
	return trim($str);
}


function useravatar($uid,$type){
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	$info = array();
	$dir = '/data/avatars/'.$dir1.'/'.$dir2.'/'.$dir3.'/';
	$filename = substr($uid, -2).'_avatar';
	return base_url().$dir.$filename."_{$type}.jpg";
}

function array_to_str($arr,$coma=','){
	$pro = array();
	foreach ($arr as $k=>$v) {
		if($k!=null&&$k!=''&&$v!=null&&$v!='')
		$pro[] = "{$k}:{$v}";
	}
	$text = implode(",", $pro);
	return $text;
}

function str_to_arr($str,$coma=','){
	$arr = array();
	$f_array = explode($coma, $str);
	foreach ($f_array as $f) {
		$s_array = explode(':', $f);
		$arr[$s_array[0]] = $s_array[1];
	}
	return $arr;
}

function str_to_arr_list($array_str){
	$arr = array();
	if($array_str){
		$f_array = explode('|', $array_str);
		if(is_array($f_array)){
			foreach ($f_array as $f) {
				array_push($arr, str_to_arr($f,$coma=','));
			}
		}else{
			array_push($arr, $this->str_to_arr(str_replace('|', '', $view_history),$coma=','));
		}
		return $arr;
	}else{
		return array();
	}
}

function arr_list_to_str($array_list){
	$str = array();
	foreach ($array_list as $v) {
		$str[] = array_to_str($v);
	}
	$text = implode("|", $str);
	return $text;
}

function tpl_modifier_bbcode2html($data)
{
	$data = nl2br(stripslashes(addslashes($data)));

	$search = array("\n", "\r", "[b]", "[/b]", "[i]", "[/i]", "[u]", "[/u]");
	$replace = array("", "", "<b>", "</b>", "<i>", "</i>", "<u>", "</u>");
	$data = str_replace($search, $replace, $data);

	$search = array(
		"/\[email\](.*?)\[\/email\]/si",
		"/\[email=(.*?)\](.*?)\[\/email\]/si",
		"/\[url\](.*?)\[\/url\]/si",
		"/\[url=(.*?)\](.*?)\[\/url\]/si",
		"/\[img\](.*?)\[\/img\]/si",
		"/\[code\](.*?)\[\/code\]/si",
		"/\[pre\](.*?)\[\/pre\]/si",
		"/\[list\](.*?)\[\/list\]/si",
		"/\[\*\](.*?)/si"
		);
		$replace = array(
		"<a href=\"mailto:\\1\">\\1</a>",
		"<a href=\"mailto:\\1\">\\2</a>",
		"<a href=\"\\1\" target=\"_blank\">\\1</a>",
		"<a href=\"\\1\" target=\"_blank\">\\2</a>",
		"<img src=\"\\1\" class=\"bbimage\" border=\"0\" >",
		"<p><blockquote><font size=\"1\">code:</font><hr noshade size=\"1\"><pre>\\1</pre><br><hr noshade size=\"1\"></blockquote></p>",
		"<pre>\\1<br></pre>",
		"<ul>\\1</ul>",
		"<li>\\1</li>"
		);
		$data = preg_replace($search, $replace, $data);
		return $data;
}
function messageclean($str) {
	$sppos = strpos($str, chr(0).chr(0).chr(0));
	if($sppos !== false) {
		$str = substr($str, 0, $sppos);
	}
	$bbcodes = 'b|i|u|p|color|size|font|align|list|indent|float';
	$bbcodesclear = 'email|code|free|table|backcolor|tr|td|img|swf|flash|attach|media|audio|payto';
	$str = strip_tags(preg_replace(array(
			"/\[hide=?\d*\](.*?)\[\/hide\]/is",
			"/\[quote](.*?)\[\/quote]/si",
			"/^\[i=s\] 本帖最后由 .*? 于 .*? 编辑 \[\/i\]\n\n/s",
			"/\[url=?.*?\](.+?)\[\/url\]/si",
			"/\[($bbcodesclear)=?.*?\].+?\[\/\\1\]/si",
			"/\[($bbcodes)=?.*?\]/i",
			"/\[\/($bbcodes)\]/i",
			"/\[attach\]\d+\[\/attach\]/i",
	), array(
			"",
			'',
			'',
			'\\1',
			'',
			'',
			'',
			'',
	), $str));
	return trim($str);
}

function zeronum($num){
	if(!is_numeric($num)){
		return false;
	}
	$num = explode('.',$num);//把整数和小数分开
	$rl = $num[1];//小数部分的值
	$int_part = sprintf("%09d",$num[0]);
	$i = 0;
	$rvalue='';
	while($i <= strlen($int_part)){
		$rvalue .= substr($int_part, $i, 3).',';//三位三位取出再合并，按逗号隔开
		$i = $i + 3;
	}
	$rvalue = substr($rvalue,0,strlen($rvalue)-2);//去掉最后一个逗号
	$rvalue = explode(',',$rvalue);//分解成数组

	$rs=array();
	$null_url = base_url('assets/img/null.png');
	$dot_url = base_url('assets/img/dot.png');
	$dot_part='<img src="'.$dot_url.'" class="dot"/>';
	foreach ($rvalue as $value) {
		$part = '';
		if($value==0){
			for ($i=0;$i<3;$i++){
				$part.='<img src="'.$null_url.'" class="null"/>';
			}
		}else{
			for ($i=0;$i<3;$i++){
				$url = base_url('assets/img/'.$value[$i].'.png');
				$part.='<img src="'.$url.'" class="num"/>';
			}
		}
		$rs[] = $part;
	}
	return implode($dot_part, $rs);
}


function logUc($pos){
	if(TRUE == UC_DEBUG)
	{
		$get['realtime'] = date('Y-m-d H:i:s', $get['time']);
		$debugStr = date('Y-m-d H:i:s', time()) . ':' . 'we got here:'.$pos;
		$debugLogFile = APP_PATH.'/data/uc_client_log.txt';
		file_put_contents($debugLogFile, $debugStr, FILE_APPEND);
	}
}
function dhtmlspecialchars($string, $flags = null) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val, $flags);
		}
	} else {
		if($flags === null) {
			$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
			if(strpos($string, '&amp;#') !== false) {
				$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
			}
		} else {
			if(PHP_VERSION < '5.4.0') {
				$string = htmlspecialchars($string, $flags);
			} else {
				if(strtolower(CHARSET) == 'utf-8') {
					$charset = 'UTF-8';
				} else {
					$charset = 'ISO-8859-1';
				}
				$string = htmlspecialchars($string, $flags, $charset);
			}
		}
	}
	return $string;
}

function ajax_success_response($data,$message){
	$response = array('success' => true, 'data' => $data, 'message'=>$message);
	echo json_encode($response);
	exit();
}

function ajax_failed_response($message='failed_msg'){
	$response = array('success' => false, 'message'=>$message);
	echo json_encode($response);
	exit();
}
function deparse_message(&$message,$needbr=false) {
	$message = str_replace(array('[/at]'), array(''),preg_replace(array("/\[at=(\d+?)\]/i"),array(""), $message));
	return $message;
}

function parse_message(&$message,$needbr=false) {
	$ptx_smile = spClass('ptx_smile');
	$smiles = $ptx_smile->getSmilies();
	$message = preg_replace($smiles['searcharray'], $smiles['replacearray'], $message, 5);
	$userlink = spUrl('pub','index',array('uid'=>'\\1'));
	$taglink = spUrl('pin','index',array('tag'=>'\\1'));
	$message = preg_replace("/#([^#\r\n]+?)#/i", "<a href=\"$taglink\" target=\"_blank\">#\\1#</a>", $message, 5);
	$br = $needbr?'<br/>':'';
	$message = str_replace(array('[/at]',"\n"), array('</a>',$br),preg_replace(array("/\[at=(\d+?)\]/i"),array("<a href=\"$userlink\"  data-user-id=\"\\1\" data-user-profile=\"1\" target=\"_blank\">"), $message));
	//$message = preg_replace("/#([^\r\n]*?)#/i", "<a href=\"index.php?c=tag&a=index&tag=\\1\">#\\1#</a>", $message);
	return $message;
}

function unicode2utf($str){
	$result = '';
	if($str < 0x80){
		$result .= $str;
	}elseif($str < 0x800){
		$result .= chr(0xC0 | $str>>6);
		$result .= chr(0x80 | $str & 0x3F);
	}elseif($str < 0x10000){
		$result .= chr(0xE0 | $str>>12);
		$result .= chr(0x80 | $str>>6 & 0x3F);
		$result .= chr(0x80 | $str & 0x3F);
	} elseif($str < 0x200000) {
		$result .= chr(0xF0 | $str>>18);
		$result .= chr(0x80 | $str>>12 & 0x3F);
		$result .= chr(0x80 | $str>>6 & 0x3F);
		$result .= chr(0x80 | $str & 0x3F);
	}
	return $result;
}


function entities2utf8($unicode_c){
	$replacedString = preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", $unicode_c);
	$unicode_c = mb_convert_encoding($replacedString, 'UTF-8', 'HTML-ENTITIES');
	return $unicode_c;
}

function parseflv($url, $width = 0, $height = 0) {
	$lowerurl = strtolower($url);
	$flv = '';
	$imgurl = '';
	$title = '';
	if($lowerurl != str_replace(array('player.youku.com/player.php/sid/','tudou.com/v/','player.ku6.com/refer/'), '', $lowerurl)) {
		$flv = $url;
	} elseif(strpos($lowerurl, 'v.youku.com/v_show/') !== FALSE) {
		$ctx = stream_context_create(array('http' => array('timeout' => 10)));
		if(preg_match("/http:\/\/v.youku.com\/v_show\/id_([^\/]+)(.html|)/i", $url, $matches)) {
			$flv = 'http://player.youku.com/player.php/sid/'.$matches[1].'/v.swf';
			if(!$width && !$height) {
				$api = 'http://v.youku.com/player/getPlayList/VideoIDS/'.$matches[1];
				$str = stripslashes(file_get_contents($api, false, $ctx));
				if(!empty($str) && preg_match("/\"logo\":\"(.+?)\"/i", $str, $image)) {
					$url = substr($image[1], 0, strrpos($image[1], '/')+1);
					$filename = substr($image[1], strrpos($image[1], '/')+2);
					//$imgurl = $url.'0'.$filename;//0 small one, 1 big one
					$imgurl = $url.'1'.$filename;
				}
				if(!empty($str) && preg_match("/\"title\":\"(.+?)\"/i", $str, $desc)) {
					$title = entities2utf8(str_replace('u', '\\u', $desc[1]));
				}
			}
		}
	} elseif(strpos($lowerurl, 'tudou.com/programs/view/') !== FALSE) {
		if(preg_match("/http:\/\/(www.)?tudou.com\/programs\/view\/([^\/]+)/i", $url, $matches)) {
			$flv = 'http://www.tudou.com/v/'.$matches[2];
			if(!$width && !$height) {
				$str = file_get_contents($url, false, $ctx);
				$str = iconv('GBK', 'UTF-8', $str);
				if(!empty($str) && preg_match("/lpic = \"(.+?)\"/i", $str, $image)) {
					$imgurl = trim($image[1]);
				}
				if(!empty($str) && preg_match("/kw = \"(.+?)\"/i", $str, $desc)) {
					$title = trim($desc[1]);
				}
			}
		}
	} elseif(strpos($lowerurl, 'tudou.com/listplay/') !== FALSE) {
		if(preg_match("/http:\/\/(www.)?tudou.com\/listplay\/([^\/]+)\/([^\/]+).html/i", $url, $matches)) {
			$icode = $matches[3];
			$flv = 'http://www.tudou.com/v/'.$icode;
			if(!$width && !$height) {
				$str = file_get_contents($url, false, $ctx);
				$str = iconv('GBK', 'UTF-8', $str);
				if(!empty($str) && preg_match("/\{[^\{^\}]+title:\"(.+?)\"[^\{^\}]+icode:\"$icode\"[^\{^\}]+,pic:\"(.+?)\"[^\{^\}]+\}/i", $str, $image)) {
					$title = trim($image[1]);
					$imgurl = trim($image[2]);
				}
			}
		}
	}elseif(strpos($lowerurl, 'v.ku6.com/show/') !== FALSE) {
		if(preg_match("/http:\/\/v.ku6.com\/show\/([^\/]+).html/i", $url, $matches)) {
			$flv = 'http://player.ku6.com/refer/'.$matches[1].'/v.swf';
			if(!$width && !$height) {
				$api = 'http://v.ku6.com/fetchVideo4Player/1/'.$matches[1].'.html';
				$str = file_get_contents($api, false, $ctx);
				if(!empty($str) && preg_match("/\"bigpicpath\":\"(.+?)\"/i", $str, $image)) {
					$imgurl = str_replace(array('\u003a', '\u002e'), array(':', '.'), $image[1]);
				}

				if(empty($imgurl)&&!empty($str) && preg_match("/\"picpath\":\"(.+?)\"/i", $str, $image)) {
					$imgurl = str_replace(array('\u003a', '\u002e'), array(':', '.'), $image[1]);
				}
				if(!empty($str) && preg_match("/\"t\":\"(.+?)\"/i", $str, $desc)) {
					$title = entities2utf8(trim($desc[1]));
				}
			}
		}
	} elseif(strpos($lowerurl, 'v.ku6.com/special/show_') !== FALSE) {
		if(preg_match("/http:\/\/v.ku6.com\/special\/show_\d+\/([^\/]+).html/i", $url, $matches)) {
			$flv = 'http://player.ku6.com/refer/'.$matches[1].'/v.swf';
			if(!$width && !$height) {
				$api = 'http://v.ku6.com/fetchVideo4Player/1/'.$matches[1].'.html';
				$str = file_get_contents($api, false, $ctx);

				if(!empty($str) && preg_match("/\"bigpicpath\":\"(.+?)\"/i", $str, $image)) {
					$imgurl = str_replace(array('\u003a', '\u002e'), array(':', '.'), $image[1]);
				}

				if(empty($imgurl)&&!empty($str) && preg_match("/\"picpath\":\"(.+?)\"/i", $str, $image)) {
					$imgurl = str_replace(array('\u003a', '\u002e'), array(':', '.'), $image[1]);
				}
				if(!empty($str) && preg_match("/\"t\":\"(.+?)\"/i", $str, $desc)) {
					$title = entities2utf8(trim($desc[1]));
				}
			}
		}
	} elseif(strpos($lowerurl, 'http://www.ouou.com/starmv_mvview') !== FALSE) {
		$str = file_get_contents($url, false, $ctx);
		if(!empty($str) && preg_match("/var\sflv\s=\s'(.+?)';/i", $str, $matches)) {
			$flv = base_url().'assets/flash/flvplayer.swf?&autostart=true&file='.urlencode($matches[1]);
			if(!$width && !$height && preg_match("/var\simga=\s'(.+?)';/i", $str, $image)) {
				$imgurl = trim($image[1]);
			}
		}
	} elseif(strpos($lowerurl, 'iqiyi.com') !== FALSE) {
		if(!$width && !$height && !empty($lowerurl)) {
			$api = $lowerurl;
			$str = file_get_contents($api, false, $ctx);
			if(!empty($str) && preg_match("/\"?url\s*\"?:\s*\"(.+?)\"/i", $str, $qyurl)) {
				$qyurl = trim($qyurl[1]);
			}
			if(!empty($qyurl) && preg_match("/\/(\d+)\/(.+?).html/i", $qyurl, $qyurl_param)) {
				$date = trim($qyurl_param[1]);
				$code = trim($qyurl_param[2]);
				if(strpos($qyurl, 'yule')!=false){
					$type = 'yule';
				}
			}
			if(!empty($qyurl) && preg_match("/\/(\w+?)\/(\d+)\/(.+?).html/i", $qyurl, $qyurl_param)) {
				$type = trim($qyurl_param[1]);
			}
			if(!empty($str) && preg_match("/\"?title\s*\"?:\s*\"(.+?)\"/i", $str, $qytitle)) {
				$title = trim($qytitle[1]);
			}
			if(!empty($str) && preg_match("/\"?videoId\s*\"?:\s*\"(.+?)\"/i", $str, $qyvideoid)) {
				$qyvideoid = trim($qyvideoid[1]);
			}
			if(!empty($str) && preg_match("/\"?tvId\s*\"?:\s*\"(.+?)\"/i", $str, $tvid)) {
				$tvid = trim($tvid[1]);
			}
			if(!empty($str) && preg_match("/\"?pid\s*\"?:\s*\"(.+?)\"/i", $str, $pid)) {
				$pid = trim($pid[1]);
			}
			if(!empty($str) && preg_match("/\"?ptype\s*\"?:\s*\"(.+?)\"/i", $str, $ptype)) {
				$ptype = trim($ptype[1]);
			}
			if(!empty($str) && preg_match("/\"?albumId\s*\"?:\s*\"(.+?)\"/i", $str, $albumId)) {
				$albumId = trim($albumId[1]);
			}
			if(!empty($str) && preg_match("/\"?qitanId\s*\"?:\s*\"(.+?)\"/i", $str, $qitanId)) {
				$qitanId = trim($qitanId[1]);
			}
			if(!empty($str) && preg_match("/<span id=\"imgPathData\" style=\"display:none\">(.+?)<\/span>/i", $str, $image)) {
				$imgurl = trim(str_replace('_baidu', '', $image[1]));
			}
			if(!empty($date) && !empty($type) && !empty($code) && !empty($tvid)&& !empty($qyvideoid)){
				if($type=='dianying') $fl_type='6296';
				else if($type=='dianshiju') $fl_type='2736';
				else $fl_type='600';
				$flv = "http://player.video.qiyi.com/{$qyvideoid}/0/{$fl_type}/{$type}/{$date}/{$code}.swf-pid={$pid}-ptype={$ptype}-albumId={$albumId}-tvId={$tvid}-autoplay=0-qitanId={$qitanId}-isDrm=0-isPurchase=0";
			}
		}
	} elseif(strpos($lowerurl, 'http://www.56.com') !== FALSE) {

		if(preg_match("/http:\/\/www.56.com\/\S+\/play_album-aid-(\d+)_vid-(.+?).html/i", $url, $matches)) {
			$flv = 'http://player.56.com/v_'.$matches[2].'.swf';
			$matches[1] = $matches[2];
		} elseif(preg_match("/http:\/\/www.56.com\/\S+\/([^\/]+).html/i", $url, $matches)) {
			$flv = 'http://player.56.com/'.$matches[1].'.swf';
		}
		if(!$width && !$height && !empty($matches[1])) {
			$api = 'http://vxml.56.com/json/'.str_replace('v_', '', $matches[1]).'/?src=out';
			$str = file_get_contents($api, false, $ctx);
			if(!empty($str) && preg_match("/\"bimg\":\"(.+?)\"/i", $str, $image)) {
				$imgurl = trim($image[1]);
			}
			if(empty($imgurl) && !empty($str) && preg_match("/\"img\":\"(.+?)\"/i", $str, $image)) {
				$imgurl = trim($image[1]);
			}
			if(!empty($str) && preg_match("/\"Subject\":\"(.+?)\"/i", $str, $desc)) {
				$title = trim($desc[1]);
			}
		}
	} elseif(strpos($lowerurl, 'www.youtube.com/watch?') !== FALSE) {
		if(preg_match("/http:\/\/www.youtube.com\/watch\?v=([^\/&]+)&?/i", $url, $matches)) {
			//$flv = 'http://www.youtube.com/v/'.$matches[1].'&hl=zh_CN&fs=1';
			if(!$width && !$height) {
				$str = file_get_contents($url, false, $ctx);
				if(!empty($str) && preg_match("/<meta property=\"og:video\" content=\"(.+?)\">/i", $str, $video)) {
					$flv = trim($video[1]);
				}
				if(!empty($str) && preg_match("/<meta property=\"og:title\" content=\"(.+?)\">/i", $str, $desc)) {
					$title = trim($desc[1]);
				}
				if(!empty($str) && preg_match("/<meta property=\"og:image\" content=\"(.+?)\">/i", $str, $image)) {
					$imgurl = trim($image[1]);
				}
			}
		}
	}
	if($flv) {
		if(!$width && !$height) {
			return array('flv' => $flv, 'imgurl' => $imgurl,'title'=>$title);
		} else {
			$width = addslashes($width);
			$height = addslashes($height);
			$flv = addslashes($flv);
			$randomid = 'flv_'.random(3);
			return '<span id="'.$randomid.'"></span><script type="text/javascript" reload="1">$(\''.$randomid.'\').innerHTML=AC_FL_RunContent(\'width\', \''.$width.'\', \'height\', \''.$height.'\', \'allowNetworking\', \'internal\', \'allowScriptAccess\', \'never\', \'src\', \''.$flv.'\', \'quality\', \'high\', \'bgcolor\', \'#ffffff\', \'wmode\', \'transparent\', \'allowfullscreen\', \'true\');</script>';
		}
	} else {
		return FALSE;
	}
}

function rand_pop($arr){
	if($length = array_length($arr)){
		$i=rand(0,$length-1);
		return $arr[$i];
	}
	return null;
}