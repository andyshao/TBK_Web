<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TopClient
{
	public $appkey; 

	public $secretkey;
	
	public $cache_time;
	
	public $purl;
	
	protected $ci;

	public $gatewayUrl = "http://gw.api.taobao.com/router/rest";

	public $format = "xml";

	protected $signMethod = "md5";

	protected $apiVersion = "2.0";

	protected $sdkVersion = "top-sdk-php-20150308";
	
	function TopClient()
	{
		$this->ci =& get_instance();
		$this->ci->load->config('top_config');
		$appkey = $this->ci->config->item('appkey');
		$this->appkey = $appkey['appkey'];
		$this->secretkey = $appkey['secretkey'];
		$this->cache_time = $this->ci->config->item('cache_time') * 60;
	}

	protected function generateSign($params)
	{
		ksort($params);

		$stringToBeSigned = $this->secretkey;
		foreach ($params as $k => $v)
		{
			if("@" != substr($v, 0, 1))
			{
				$stringToBeSigned .= "$k$v";
			}
		}
		unset($k, $v);
		$stringToBeSigned .= $this->secretkey;
		return strtoupper(md5($stringToBeSigned));
	}

	protected function curl($url, $postFields = null)
	{
		if(function_exists('curl_init') && function_exists('curl_exec'))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			if (is_array($postFields) && 0 < count($postFields))
			{
				$postBodyString = "";
				$postMultipart = false;
				foreach ($postFields as $k => $v)
				{
					if("@" != substr($v, 0, 1))//判断是不是文件上传
					{
						$postBodyString .= "$k=" . urlencode($v) . "&"; 
					}
					else//文件上传用multipart/form-data，否则用www-form-urlencoded
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
					curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
				}
			}
			$reponse = curl_exec($ch);
			
			if (curl_errno($ch))
			{
				throw new Exception(curl_error($ch),0);
			}
			else
			{
				$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if (200 !== $httpStatusCode)
				{
					throw new Exception($reponse,$httpStatusCode);
				}
			}
			curl_close($ch);
		}
		else
		{
			$postBodyString = '';
			if (is_array($postFields) && 0 < count($postFields))
			{
				foreach ($postFields as $k => $v)
				{
					$postBodyString .= "&$k=" . urlencode($v); 
				}
				unset($k, $v);
			}
			if($postBodyString != '') $url .= $postBodyString;
			$reponse = $this->get_taobao_data($url);
		}
		return $reponse;
	}
	
	protected function get_taobao_data($file)
	{
		if (function_exists('file_get_contents'))
		{
			return file_get_contents($file);		
		}

		if ( ! $fp = @fopen($file, FOPEN_READ))
		{
			return FALSE;
		}
		
		flock($fp, LOCK_SH);
	
		$data = '';
		if (filesize($file) > 0)
		{
			$data =& fread($fp, filesize($file));
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		return $data;
	}

	public function execute($request, $session = null)
	{
		//组装系统参数
		$sysParams["app_key"] = $this->appkey;
		$sysParams["v"] = $this->apiVersion;
		$sysParams["format"] = $this->format;
		$sysParams["sign_method"] = $this->signMethod;
		$sysParams["method"] = $request->getApiMethodName();
		$sysParams["timestamp"] = date("Y-m-d H:i:s");
		$sysParams["partner_id"] = $this->sdkVersion;
		if (null != $session)
		{
			$sysParams["session"] = $session;
		}

		//获取业务参数
		$apiParams = $request->getApiParas();

		//签名
		$temp_par = array_merge($apiParams, $sysParams);
		$sysParams["sign"] = $this->generateSign($temp_par);
		
		unset($temp_par['timestamp']);
		$cache_id = $this->generateSign($temp_par);
		
		$cache = FALSE;
		if($this->cache_time > 0)
		{
			$cache = $this->_read_cache($cache_id,$request->getApiMethodName());
		}
		
		if($cache)
		{
			$resp = $cache;
			$is_from_cache = TRUE;
		}
		else
		{
			//系统参数放入GET请求串
			$requestUrl = $this->gatewayUrl . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);
			$this->purl = $requestUrl;
	
			//发起HTTP请求
			try
			{
				$resp = $this->curl($requestUrl, $apiParams);
			}
			catch (Exception $e)
			{
				return false;
			}
			$is_from_cache = FALSE;
		}

		//解析TOP返回结果
		$respWellFormed = false;
		if ("json" == $this->format)
		{
			$respObject = json_decode($resp);
			if (null !== $respObject)
			{
				$respWellFormed = true;
				foreach ($respObject as $propKey => $propValue)
				{
					$respObject = $propValue;
				}
			}
		}
		else if("xml" == $this->format)
		{
			$respObject = @simplexml_load_string($resp,'SimpleXMLElement',LIBXML_NOCDATA);
			if (false !== $respObject)
			{
				$respWellFormed = true;
			}
		}

		//返回的HTTP文本不是标准JSON或者XML，记下错误日志
		if (false === $respWellFormed)
		{
			log_message('debug', "返回的HTTP文本不是标准JSON或者XML");
			return false;
		}

		//如果TOP返回了错误码，记录到业务错误日志中
		if (isset($respObject->code))
		{
			$e = array(
				'code' => 'code:'.$respObject->code,
				'msg' => 'msg:'.$respObject->msg,
				'sub_code' => 'sub_code:'.$respObject->sub_code,
				'sub_msg' => 'sub_msg:'.$respObject->sub_msg
			);
			$estr = implode("\n\r",$e);
			log_message('debug', $estr);
			return false;
		}
		else
		{
			$respObject = $this->get_object_vars_final($respObject);
			if( ! $is_from_cache && $this->cache_time > 0) $this->_write_cache($cache_id,$resp,$request->getApiMethodName());
			return $respObject;
		}
	}
	
	public function get_object_vars_final($obj)
	{
		if (is_object($obj)) {
			$obj = get_object_vars($obj);
		}
		if (is_array($obj)) {
			foreach ($obj as $key => $value) 
			{
				$obj[$key] = $this->get_object_vars_final($value);
			}
		}
		return $obj;
	}
	
	private function _write_cache($id,$output,$apiname)
	{
		$cache_path = $this->ci->config->item('apicache_path');
	
		if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
		{
			return;
		}
		
		$cache_path = rtrim($cache_path,'/').'/'.$apiname.'/';
		if ( ! @is_dir($cache_path))
		{
			if ( ! @mkdir($cache_path, DIR_WRITE_MODE))
			{
				return FALSE;
			}
			@chmod($cache_path, DIR_WRITE_MODE);
		}
		$cache_path .= $id; 
		
		if ( ! $fp = @fopen($cache_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{
			log_message('error', "Unable to write cache file: ".$cache_path);
			return;
		}
		
		$expire = time() + $this->cache_time;
		
		if (flock($fp, LOCK_EX))
		{
			fwrite($fp, $expire.'TS--->'.$output);
			flock($fp, LOCK_UN);
		}
		else
		{
			log_message('error', "Unable to secure a file lock for file at: ".$cache_path);
			return;
		}
		fclose($fp);
		@chmod($cache_path, DIR_WRITE_MODE);

		log_message('debug', "Cache file written: ".$cache_path);
	}
	
	private function _read_cache($id,$apiname)
	{
		$cache_path = $this->ci->config->item('apicache_path');
	
		if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
		{
			return FALSE;
		}
		
		$cache_path = rtrim($cache_path,'/').'/'.$apiname.'/';
		
		$cache_path = $cache_path.$id;
		
		if ( ! @file_exists($cache_path))
		{
			return FALSE;
		}
	
		if ( ! $fp = @fopen($cache_path, FOPEN_READ))
		{
			return FALSE;
		}
			
		flock($fp, LOCK_SH);
		
		$cache = '';
		if (filesize($cache_path) > 0)
		{
			$cache = fread($fp, filesize($cache_path));
		}
	
		flock($fp, LOCK_UN);
		fclose($fp);
					
		// Strip out the embedded timestamp		
		if ( ! preg_match("/(\d+TS--->)/", $cache, $match))
		{
			@unlink($cache_path);
			return FALSE;
		}
		
		// Has the file expired? If so we'll delete it.
		if (time() >= trim(str_replace('TS--->', '', $match['1'])))
		{ 		
			@unlink($cache_path);
			log_message('debug', "Cache file has expired. File deleted");
			return FALSE;
		}
		log_message('debug', "Read from cache");
		return str_replace($match['0'], '', $cache);
	}
}