<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
function get_real_path($url)
{
    if (!$url) {
        return '';
    }
    if (strpos($url, "http://") === FALSE && strpos($url, 'https://') === FALSE) {
        return ROOT_PATH . $url;
    } else {
        return $url;
    }
}
function get_taodianjin($c = '')
{
    $CI =& get_instance();
    $CI->load->helper('file');
    $path = APPPATH . 'data/taodianjin';
    if ($c) {
        write_file($path, $c);
    } else {
        return read_file($path);
    }
}
function clear_space($str)
{
    if (!$str) {
        return $str;
    }
    $search = array("'([\\s])+'");
    $replace = array('');
    return @preg_replace($search, $replace, $str);
}
function create_query($k)
{
    parse_str($_SERVER['QUERY_STRING'], $get);
    if (is_array($get)) {
        foreach ($get as $k1 => $v1) {
            if ($k1 == $k) {
                unset($get[$k1]);
            } else {
                $get[$k1] = $k1 . '=' . urlencode($v1);
            }
        }
        return implode('&', $get);
    } else {
        return '';
    }
}
function do_upload($up_config)
{
    if (is_array($up_config)) {
        foreach ($up_config as $key => $value) {
            ${$key} = $value;
        }
    } else {
        return array('status' => FALSE, 'upload_errors' => "<li>配置参数有误</li>");
    }
    if (!file_exists($up_path)) {
        @mkdir($up_path);
    }
    $up_path = rtrim($up_path, '/');
    $up_path .= '/' . date("Ymd", time()) . '/';
    if (!file_exists($up_path)) {
        @mkdir($up_path);
    }
    $config['upload_path'] = $up_path;
    if (isset($suffix)) {
        $config['allowed_types'] = $suffix;
    }
    $config['encrypt_name'] = TRUE;
    if (isset($max_size)) {
        $config['max_size'] = $max_size;
    }
    $my_obj =& get_instance();
    $my_obj->load->library('upload');
    $my_obj->upload->initialize($config);
    if (!$my_obj->upload->do_upload($form_name)) {
        if ($_FILES[$form_name]['name']) {
            $file_data = array('status' => FALSE, 'upload_errors' => $my_obj->upload->display_errors('<li>', '</li>'));
        } else {
            $file_data = array('status' => TRUE, 'file_path' => '');
        }
        return $file_data;
    } else {
        $data = $my_obj->upload->data();
        $file_data = array('status' => TRUE, 'file_path' => $up_path . $data['file_name'], 'data' => $data);
        return $file_data;
    }
}
function my_site_url($uri = '')
{
    $my_obj =& get_instance();
    if (is_array($uri)) {
        $uri = implode('/', $uri);
    }
    $index_page = $my_obj->config->item('index_page') ? $my_obj->config->item('index_page') . '/' : '';
    if ($uri == '') {
        return ROOT_PATH . $index_page;
    } else {
        $suffix = $my_obj->config->item('url_suffix') == FALSE ? '' : $my_obj->config->item('url_suffix');
        return ROOT_PATH . $index_page . trim($uri, '/') . $suffix;
    }
}
function get_curren_url()
{
    $r_uri = '';
    if (isset($_SERVER["REQUEST_URI"]) && !empty($_SERVER["REQUEST_URI"])) {
        $r_uri = $_SERVER["REQUEST_URI"];
    } else {
        if (isset($_SERVER['PATH_INFO']) && !empty($_SERVER["PATH_INFO"])) {
            $r_uri = $_SERVER['SCRIPT_NAME'] . $_SERVER["PATH_INFO"];
            if ($_SERVER['QUERY_STRING']) {
                $r_uri .= '?' . $_SERVER['QUERY_STRING'];
            }
        }
    }
    $r_uri = 'http://' . $_SERVER['SERVER_NAME'] . $r_uri;
    $my_obj =& get_instance();
    if (!$my_obj->config->item('index_page')) {
        $r_uri = str_replace('/index.php', '', $r_uri);
    }
    return urlencode($r_uri);
}
function get_content($url)
{
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        @curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        $pageContent = @curl_exec($ch);
        curl_close($ch);
    } else {
        $pageContent = @file_get_contents($url);
    }
    return $pageContent;
}
function getBytes($folder)
{
    $totalSize = 0;
    if ($handle = @opendir($folder)) {
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                if (is_dir($folder . "/" . $file)) {
                    $totalSize = $totalSize + getBytes($folder . "/" . $file);
                } else {
                    $totalSize = $totalSize + filesize($folder . "/" . $file);
                }
            }
        }
        closedir($handle);
    }
    return $totalSize;
}
function diem($msg = '')
{
    global $CI;
    if (class_exists('CI_DB') && isset($CI->db)) {
        $CI->db->close();
    }
    die($msg);
}
function echo_msg($msg, $rdr = '', $infotype = 'no', $target = '_self')
{
    if (empty($rdr)) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $rdr = $_SERVER['HTTP_REFERER'];
        } else {
            $rdr = "javascript:window.history.back();";
        }
    }
    $tx_msg = array('infotype' => $infotype, 'infos' => $msg, 'red_url' => $rdr, 'target' => $target);
    $my_obj =& get_instance();
    global $CI;
    if (class_exists('CI_DB') && isset($CI->db)) {
        $CI->db->close();
    }
    die($my_obj->load->view(TPL_FOLDER . 'msg', $tx_msg, true));
}
function strcut($string, $length)
{
    $strlen = strlen($string);
    if ($strlen <= $length) {
        return $string;
    }
    $n = 0;
    $i = 1;
    while ($n < $strlen) {
        $t = ord($string[$n]);
        if ($t == 9 || $t == 10 || 32 <= $t && $t <= 126) {
            $n++;
        } elseif (194 <= $t && $t <= 223) {
            $n += 2;
        } elseif (224 <= $t && $t <= 239) {
            $n += 3;
        } elseif (240 <= $t && $t <= 247) {
            $n += 4;
        } elseif (248 <= $t && $t <= 251) {
            $n += 5;
        } elseif ($t == 252 || $t == 253) {
            $n += 6;
        } else {
            $n++;
        }
        if ($i >= $length) {
            break;
        }
        $i++;
    }
    return substr($string, 0, $n);
}
function format_curren($v)
{
    if (is_numeric($v)) {
        return '￥' . number_format($v, 2);
    } else {
        return '￥' . number_format(0, 2);
    }
}
function replace_htmlAndjs($document)
{
    $document = trim($document);
    if (strlen($document) <= 0) {
        return $document;
    }
    $search = array("'<script[^>]*?>.*?</script>'si", "'<[\\/\\!]*?[^<>]*?>'si", "'([\r\n\t\\s]+)'", "'&(quot|#34);'i", "'&(amp|#38);'i", "'&(lt|#60);'i", "'&(gt|#62);'i", "'&(nbsp|#160);'i");
    $replace = array("", "", "", "\"", "&", "<", ">", " ");
    return @preg_replace($search, $replace, $document);
}
function filter_str($str)
{
    if (!$str) {
        return '';
    }
    $f = array(';', '"', "'", "\r\n", "\r", "\n", "\t", "<", ">");
    $r = array('', '', '', '', '', '', '', '', '');
    return str_replace($f, $r, $str);
}
function save_cache($id, $data)
{
    $CI =& get_instance();
    $CI->load->helper('file');
    $path = APPPATH . 'data/';
    if (write_file($path . $id, serialize($data))) {
        @chmod($path . $id, 0777);
        return TRUE;
    }
    return FALSE;
}
function get_cache($id)
{
    $ci =& get_instance();
    $ci->load->helper('file');
    $path = APPPATH . 'data/';
    if (!file_exists($path . $id)) {
        return FALSE;
    }
    $data = read_file($path . $id);
    return unserialize($data);
}
function author_code($data)
{
    $CI =& get_instance();
    $CI->load->helper('file');
    $path = APPPATH . 'data/author_code';
    if (!$data) {
        return read_file($path);
    } else {
        $f = array("\r\n", "\r", "\n", "\t");
        $r = array('', '', '', '');
        $data = str_replace($f, $r, $data);
        if (write_file($path, $data)) {
            @chmod($path, 0777);
            return TRUE;
        }
    }
}
function filter_sql($str)
{
    if (!$str) {
        return $str;
    }
    if (!get_magic_quotes_gpc()) {
        $str = addslashes($str);
    }
    $str = strip_tags($str);
    $f = array('and', 'execute', 'update', 'count', 'chr', 'mid', 'master', 'truncate', 'char', 'declare', 'select', 'create', 'delete', 'insert', 'or', '=');
    $r = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    return str_ireplace($f, $r, $str);
}
function filter_get(&$arr)
{
    if (is_array($arr)) {
        foreach ($arr as $k => $v) {
            $arr[$k] = filter_sql($v);
        }
    }
}
function decrypt($txt, $key = 'jfgdseru785dg278hfg74s')
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
    $ikey = "-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
    $knum = 0;
    $i = 0;
    $tlen = strlen($txt);
    while (isset($key[$i])) {
        $knum += ord($key[$i++]);
    }
    $ch1 = $txt[$knum % $tlen];
    $nh1 = strpos($chars, $ch1);
    $txt = substr_replace($txt, '', $knum % $tlen--, 1);
    $ch2 = $txt[$nh1 % $tlen];
    $nh2 = strpos($chars, $ch2);
    $txt = substr_replace($txt, '', $nh1 % $tlen--, 1);
    $ch3 = $txt[$nh2 % $tlen];
    $nh3 = strpos($chars, $ch3);
    $txt = substr_replace($txt, '', $nh2 % $tlen--, 1);
    $nhnum = $nh1 + $nh2 + $nh3;
    $mdKey = substr(md5(md5(md5($key . $ch1) . $ch2 . $ikey) . $ch3), $nhnum % 8, $knum % 8 + 16);
    $tmp = '';
    $j = 0;
    $k = 0;
    $tlen = strlen($txt);
    $klen = strlen($mdKey);
    for ($i = 0; $i < $tlen; $i++) {
        $k = $k == $klen ? 0 : $k;
        $j = strpos($chars, $txt[$i]) - $nhnum - ord($mdKey[$k++]);
        while ($j < 0) {
            $j += 64;
        }
        $tmp .= $chars[$j];
    }
    $tmp = str_replace(array('-', '_', '.'), array('+', '/', '='), $tmp);
    return trim(base64_decode($tmp));
}
function format_num($n)
{
    if (!is_numeric($n)) {
        return $n;
    }
    if ($n >= 10000) {
        $n = round($n / 10000, 1) . '万';
    }
    return $n;
}
function replace_s($t)
{
    if (!is_string($t)) {
        return $t;
    }
    return str_replace('</span>', '', str_replace('<span class=H>', '', $t));
}
if (!function_exists('json_decode')) {
    function json_decode($json, $assoc = FALSE, $n = 0, $state = 0, $waitfor = 0)
    {
        $val = NULL;
        static $lang_eq = array("true" => TRUE, "false" => FALSE, "null" => NULL);
        static $str_eq = array("n" => "\n", "r" => "\r", "\\" => "\\", '"' => '"', "f" => "\f", "b" => "\\b", "t" => "\t", "/" => "/");
        for (; $n < strlen($json);) {
            $c = $json[$n];
            if ($state === '"') {
                if ($c == '\\') {
                    $c = $json[++$n];
                    if (isset($str_eq[$c])) {
                        $val .= $str_eq[$c];
                    } elseif ($c == "u") {
                        $hex = hexdec(substr($json, $n + 1, 4));
                        $n += 4;
                        if ($hex < 0x80) {
                            $val .= chr($hex);
                        } elseif ($hex < 0x800) {
                            $val .= chr(0xc0 + $hex >> 6) . chr(0x80 + $hex & 63);
                        } elseif ($hex <= 0xffff) {
                            $val .= chr(0xe0 + $hex >> 12) . chr(0x80 + ($hex >> 6) & 63) . chr(0x80 + $hex & 63);
                        }
                    } else {
                        $val .= "\\" . $c;
                    }
                } elseif ($c == '"') {
                    $state = 0;
                } else {
                    $val .= $c;
                }
            } elseif ($waitfor && strpos($waitfor, $c) !== false) {
                return array($val, $n);
            } elseif ($state === ']') {
                list($v, $n) = json_decode_($json, 0, $n, 0, ",]");
                $val[] = $v;
                if ($json[$n] == "]") {
                    return array($val, $n);
                }
            } elseif ($state === '}') {
                list($i, $n) = json_decode_($json, 0, $n, 0, ":");
                list($v, $n) = json_decode_($json, $assoc, $n + 1, 0, ",}");
                $val[$i] = $v;
                if ($json[$n] == "}") {
                    return array($val, $n);
                }
            } else {
                if (preg_match("/\\s/", $c)) {
                } elseif ($c == '"') {
                    $state = '"';
                } elseif ($c == "{") {
                    list($val, $n) = json_decode_($json, $assoc, $n + 1, '}', "}");
                    if ($val && $n && !$assoc) {
                        $obj = new stdClass();
                        foreach ($val as $i => $v) {
                            $obj->{$i} = $v;
                        }
                        $val = $obj;
                        unset($obj);
                    }
                } elseif ($c == "[") {
                    list($val, $n) = json_decode_($json, $assoc, $n + 1, ']', "]");
                } elseif ($c == "/" && $json[$n + 1] == "*") {
                    $n = strpos($json, "*/", $n + 1) or $n = strlen($json);
                } elseif (preg_match("#^(-?\\d+(?:\\.\\d+)?)(?:[eE]([-+]?\\d+))?#", substr($json, $n), $uu)) {
                    $val = $uu[1];
                    $n += strlen($uu[0]) - 1;
                    if (strpos($val, ".")) {
                        $val = (double) $val;
                    } elseif ($val[0] == "0") {
                        $val = octdec($val);
                    } else {
                        $val = (int) $val;
                    }
                    if (isset($uu[2])) {
                        $val *= pow(10, (int) $uu[2]);
                    }
                } elseif (preg_match("#^(true|false|null)\\b#", substr($json, $n), $uu)) {
                    $val = $lang_eq[$uu[1]];
                    $n += strlen($uu[1]) - 1;
                } else {
                    trigger_error("json_decode_: error parsing '{$c}' at position {$n}", E_USER_WARNING);
                    return $waitfor ? array(NULL, 1 << 30) : NULL;
                }
            }
            if ($n === NULL) {
                return NULL;
            }
            $n++;
        }
        return $val;
    }
}
function is_author()
{
    return TRUE;
    $code = author_code('');
    if (!$code) {
        return FALSE;
    }
    $dn = decrypt($code);
    $cdn = '';
    if (isset($_SERVER['HTTP_HOST'])) {
        $cdn = $_SERVER['HTTP_HOST'];
    } else {
        if (isset($_SERVER['SERVER_NAME'])) {
            $cdn = $_SERVER['SERVER_NAME'];
        }
    }
    $cdn = strtolower($cdn);
    if (strpos($cdn, 'www.') === 0) {
        $cdn = substr($cdn, 4);
    }
    $cdn = ',' . $cdn . ',';
    if (strpos($dn, $cdn) === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}
function get_sg()
{
    $CI =& get_instance();
    return $CI->uri->segment(1);
}
if (!is_author()) {
}