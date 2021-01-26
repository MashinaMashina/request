<?php namespace MashinaMashina\Request;

/*

https://github.com/MashinaMashina/request

Author:	t.me/MashinaMashina

28.11.2017
		
*/

class Request {
	
	public $response = NULL;
	public $info = array();
	public $error_code = 0;
	public $error_msg = '';
	public $session = '';
	public $directory = '';
	public $headers = '';
	public $out_headers = array();
	public $options = array();
	public $data = array();
	public $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.75 Safari/537.36';
	
	private $charset = false;
	
	private $opt_codes = array(
		3 => 'CURLOPT_PORT',
		13 => 'CURLOPT_TIMEOUT',
		14 => 'CURLOPT_INFILESIZE',
		19 => 'CURLOPT_LOW_SPEED_LIMIT',
		20 => 'CURLOPT_LOW_SPEED_TIME',
		21 => 'CURLOPT_RESUME_FROM',
		27 => 'CURLOPT_CRLF',
		32 => 'CURLOPT_SSLVERSION',
		33 => 'CURLOPT_TIMECONDITION',
		34 => 'CURLOPT_TIMEVALUE',
		41 => 'CURLOPT_VERBOSE',
		42 => 'CURLOPT_HEADER',
		43 => 'CURLOPT_NOPROGRESS',
		44 => 'CURLOPT_NOBODY',
		45 => 'CURLOPT_FAILONERROR',
		46 => 'CURLOPT_UPLOAD',
		47 => 'CURLOPT_POST',
		48 => 'CURLOPT_FTPLISTONLY',
		50 => 'CURLOPT_FTPAPPEND',
		51 => 'CURLOPT_NETRC',
		52 => 'CURLOPT_FOLLOWLOCATION',
		53 => 'CURLOPT_TRANSFERTEXT',
		54 => 'CURLOPT_PUT',
		58 => 'CURLOPT_AUTOREFERER',
		59 => 'CURLOPT_PROXYPORT',
		61 => 'CURLOPT_HTTPPROXYTUNNEL',
		64 => 'CURLOPT_SSL_VERIFYPEER',
		68 => 'CURLOPT_MAXREDIRS',
		69 => 'CURLOPT_FILETIME',
		71 => 'CURLOPT_MAXCONNECTS',
		72 => 'CURLOPT_CLOSEPOLICY',
		74 => 'CURLOPT_FRESH_CONNECT',
		75 => 'CURLOPT_FORBID_REUSE',
		78 => 'CURLOPT_CONNECTTIMEOUT',
		80 => 'CURLOPT_HTTPGET',
		81 => 'CURLOPT_SSL_VERIFYHOST',
		84 => 'CURLOPT_HTTP_VERSION',
		85 => 'CURLOPT_FTP_USE_EPSV',
		90 => 'CURLOPT_SSLENGINE_DEFAULT',
		91 => 'CURLOPT_DNS_USE_GLOBAL_CACHE',
		92 => 'CURLOPT_DNS_CACHE_TIMEOUT',
		96 => 'CURLOPT_COOKIESESSION',
		98 => 'CURLOPT_BUFFERSIZE',
		99 => 'CURLOPT_NOSIGNAL',
		101 => 'CURLOPT_PROXYTYPE',
		105 => 'CURLOPT_UNRESTRICTED_AUTH',
		106 => 'CURLOPT_FTP_USE_EPRT',
		107 => 'CURLOPT_HTTPAUTH',
		110 => 'CURLOPT_FTP_CREATE_MISSING_DIRS',
		111 => 'CURLOPT_PROXYAUTH',
		119 => 'CURLOPT_FTP_SSL',
		121 => 'CURLOPT_TCP_NODELAY',
		129 => 'CURLOPT_FTPSSLAUTH',
		151 => 'CURLOPT_SSH_AUTH_TYPES',
		155 => 'CURLOPT_TIMEOUT_MS',
		156 => 'CURLOPT_CONNECTTIMEOUT_MS',
		10001 => 'CURLOPT_FILE',
		10002 => 'CURLOPT_URL',
		10004 => 'CURLOPT_PROXY',
		10005 => 'CURLOPT_USERPWD',
		10006 => 'CURLOPT_PROXYUSERPWD',
		10007 => 'CURLOPT_RANGE',
		10009 => 'CURLOPT_INFILE',
		10015 => 'CURLOPT_POSTFIELDS',
		10016 => 'CURLOPT_REFERER',
		10017 => 'CURLOPT_FTPPORT',
		10018 => 'CURLOPT_USERAGENT',
		10022 => 'CURLOPT_COOKIE',
		10023 => 'CURLOPT_HTTPHEADER',
		10025 => 'CURLOPT_SSLCERT',
		10026 => 'CURLOPT_KEYPASSWD',
		10028 => 'CURLOPT_QUOTE',
		10029 => 'CURLOPT_WRITEHEADER',
		10031 => 'CURLOPT_COOKIEFILE',
		10036 => 'CURLOPT_CUSTOMREQUEST',
		10037 => 'CURLOPT_STDERR',
		10039 => 'CURLOPT_POSTQUOTE',
		10062 => 'CURLOPT_INTERFACE',
		10063 => 'CURLOPT_KRB4LEVEL',
		10065 => 'CURLOPT_CAINFO',
		10076 => 'CURLOPT_RANDOM_FILE',
		10077 => 'CURLOPT_EGDSOCKET',
		10082 => 'CURLOPT_COOKIEJAR',
		10083 => 'CURLOPT_SSL_CIPHER_LIST',
		10086 => 'CURLOPT_SSLCERTTYPE',
		10087 => 'CURLOPT_SSLKEY',
		10088 => 'CURLOPT_SSLKEYTYPE',
		10089 => 'CURLOPT_SSLENGINE',
		10097 => 'CURLOPT_CAPATH',
		10102 => 'CURLOPT_ENCODING',
		10103 => 'CURLOPT_PRIVATE',
		10104 => 'CURLOPT_HTTP200ALIASES',
		10152 => 'CURLOPT_SSH_PUBLIC_KEYFILE',
		10153 => 'CURLOPT_SSH_PRIVATE_KEYFILE',
		10162 => 'CURLOPT_SSH_HOST_PUBLIC_KEY_MD5',
		19913 => 'CURLOPT_RETURNTRANSFER',
		19914 => 'CURLOPT_BINARYTRANSFER',
		20011 => 'CURLOPT_WRITEFUNCTION',
		20012 => 'CURLOPT_READFUNCTION',
		20056 => 'CURLOPT_PROGRESSFUNCTION',
		20079 => 'CURLOPT_HEADERFUNCTION',
		30145 => 'CURLOPT_MAX_SEND_SPEED_LARGE',
		30146 => 'CURLOPT_MAX_RECV_SPEED_LARGE',
	);
	
	public function __construct($url, $data = array())
	{
		$this->url = $url;
			
		$default = array(
			'convert_encoding' => true
		);
		
		$this->data = array_merge($default, $data);
		
		$this->set(CURLOPT_URL, $this->url);
		$this->set(CURLOPT_RETURNTRANSFER, 1);
		$this->set(CURLOPT_FOLLOWLOCATION, true);
		$this->set(CURLOPT_USERAGENT, $this->useragent);
		$this->set(CURLOPT_HEADERFUNCTION, array(&$this, '_set_headers'));
	}
	
	public function set($key, $value)
	{
		$this->options[$key] = $value;
	}
	
	public function session($directory, $need_clear = false)
	{
		$this->directory = $directory;
		
		if( !file_exists($this->directory))
		{
			mkdir($this->directory);
		}
		
		$cookie = $this->directory . '/cookie.dat';
		
		if( $need_clear)
		{
			$handle = fopen($cookie, 'w');
			$result = fwrite($handle, '');
			fclose($handle);
		}
		
		$this->set(CURLOPT_COOKIEJAR, $cookie);
		$this->set(CURLOPT_COOKIEFILE, $cookie);
		
		return $this->directory;
	}
	
	public function post($data = array())
	{
		$this->set(CURLOPT_POST, true);
		$this->set(CURLOPT_POSTFIELDS, $data);
	}
	
	public function payload($data)
	{
		$this->set_headers('Content-Type', 'application/json');
		$this->set(CURLOPT_POST, true);
		$this->set(CURLOPT_POSTFIELDS, json_encode($data));
	}
	
	public function send()
	{
		$ch = curl_init();

		curl_setopt_array($ch, $this->options);
		
		$this->response = curl_exec($ch);
		$this->info = curl_getinfo ($ch);
		$this->error_code = curl_errno($ch);
		
		if($this->error_code)
		{
			$this->error_msg = curl_error($ch);
		}
		else
		{
			$this->error_msg = '';
		}
		
		curl_close($ch);

		if($this->info['http_code'] !== 200)
		{
			$this->error_code = 1000;
			$this->error_msg = 'Response code is '.$this->info['http_code'];
		}
		
		if( $this->data['convert_encoding'])
		{
			$charset = $this->get_charset();
		
			if( strtoupper($charset) !== 'UTF-8')
			{
				$response = iconv($charset, 'UTF-8//TRANSLIT', $this->response);
				
				if( empty($response) and !empty($this->response))
				{
					die($this->response);
				}
				else
				{
					$this->response = $response;
				}
			}
		}
		
		return $this->response;
	}
	
	public function error()
	{
		if($this->error_code)
		{
			return $this->error_code.': '.$this->error_msg;
		}
		else
		{
			return false;
		}
	}

	public function get_charset()
	{
		if( $this->charset)
		{
			return $this->charset;
		}
		
		$match = NULL;
		
		preg_match('#charset(:|=)(.+?)($|\s|;)#s', $this->headers, $match);
		
		if( count($match))
		{
			$this->charset = strtoupper($match[2]);
			return $this->charset;
		}
		
		preg_match('#charset(:|=)("|\'|)(.+?)("|\')#s', $this->response, $match);
		
		if( count($match))
		{
			$this->charset = strtoupper($match[3]);
			return $this->charset;
		}
		
		$this->charset = mb_detect_encoding($this->response);
		return $this->charset;
	}
	
	public function _set_headers($ch, $header) // system function
	{
		$this->headers .= $header;
		
		return strlen($header);
	}
	
	public function set_headers($key, $value = '')
	{
		if( is_array($key))
		{
			$this->out_headers = array_merge_recursive($this->out_headers, $key);
		}
		else
		{
			$this->out_headers[] = "{$key}: {$value}";
		}
		
		$this->set(CURLOPT_HTTPHEADER, $this->out_headers);
	}
	
	function get_cookie() {
		$filename = $this->directory . '/cookie.dat';
		
		$handle = fopen($filename, 'r');
		$size = filesize($filename);
		
		if($size === 0)
		{
			$string = '';
		}
		
		$string = fread($handle, $size);
		fclose($handle);
		
		$cookies = array();
		
		$lines = explode("\n", $string);
	 
		// iterate over lines
		foreach ($lines as $line) {
	 
			// we only care for valid cookie def lines
			if (isset($line[0]) && substr_count($line, "\t") == 6) {
	 
				// get tokens in an array
				$tokens = explode("\t", $line);
	 
				// trim the tokens
				$tokens = array_map('trim', $tokens);
	 
				$cookie = array();
	 
				// Extract the data
				$cookie['domain'] = $tokens[0];
				$cookie['flag'] = $tokens[1];
				$cookie['path'] = $tokens[2];
				$cookie['secure'] = $tokens[3];
	 
				// Convert date to a readable format
				$cookie['expiration'] = date('Y-m-d h:i:s', $tokens[4]);
	 
				$cookie['name'] = $tokens[5];
				$cookie['value'] = $tokens[6];
	 
				// Record the cookie.
				$cookies[] = $cookie;
			}
		}
		
		return $cookies;
	}
	
	public function dump()
	{
		$dump = "<b>URL:</b> {$this->url}<br />\n";
		
		$error = $this->error_msg;
		
		$dump .= $error !== '' ? "<b>Error:</b> {$error}<br />\n" : '';
		
		$dump .= 	"<b>Options:</b><br />";
		
		foreach($this->options as $k => $v)
		{
			if( !isset($this->opt_codes[$k])) $this->opt_codes[$k] = '(undefined)';
		
			$dump .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option <i>{$this->opt_codes[$k]}</i> setted to <i>";
			
			
			if( in_array($k, array(20079)))
			{
				$dump .= '(callback) this::_set_headers()';
			}
			elseif(is_array($v) or is_object($v))
			{
				$dump .= '<pre>&nbsp;&nbsp;&nbsp;&nbsp;'.str_replace("\n", "\n&nbsp;&nbsp;&nbsp;&nbsp;", print_r($v, true)).'</pre>';
			}
			elseif(is_bool($v))
			{
				$dump .= $v ? '(bool)true' : '(bool)false';
			}
			elseif(is_string($v) or is_scalar($v))
			{
				$dump .= $v;
			}
			elseif(is_resource($v))
			{
				$dump .= '(resource)';
			}
			else
			{
				$dump .= var_export($v);
			}
			
			$dump .= "</i><br />\n";
		}
		
		$dump .= "<br />\n<br />\n";
		
		$dump .= '<b>Info:</b><pre>'.print_r($this->info, true).'</pre><br />';
		$dump .= '<b>Headers:</b><pre>'.$this->headers.'</pre><br />';
		$dump .= "<b>Response:</b><br />\n<pre>".htmlspecialchars($this->response)."</pre><br />\n";
		
		return $dump;
	}
}
