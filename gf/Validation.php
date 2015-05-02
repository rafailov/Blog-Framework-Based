<?php


namespace GF;
/**
* 
*/
class Validation {
	
	private $_rules = array();

	public function setRule($rule, $value, $params = null, $name = null)	{
		$this->_rules[] = array('val' => $value, 'rule' => $rule, 'par' => $params, 'name' => $name );
		return $this;
	}

	public function validate()
	{
		$this->_errors = array();
		if (count($this->_rules) > 0) {
			foreach ($this->_rules as $v) {
				if (!$this->$v['rule'] ($v['val'], $v['par'])) {
					if ($v['name']) {
						$this->_errors[] = $v['name'];
					} else {
						$this->_errors[] = $v['rule'];
					}
				}
			}
		}
		return (bool) !count($this->_errors);
	}

	public function getErrors() {
		return $this->_errors;
	}

	public static function normalize($data, $types){
		$types = explode('|', $types);

		if (is_array($types)) {
			foreach ($types as $value) {
				if ($value == 'int') {
					$data = (int)$data;
				} elseif ($value == 'float') {
					$data = (float)$data;
				} elseif ($value == 'double') {
					$data = (double)$data;
				} elseif ($value == 'bool') {
					$data = (bool)$data;
				} elseif ($value == 'string') {
					$data = (string)$data;
				} elseif ($value == 'trim') {
					$data = trim($data);
				}elseif ($v == 'xss') {
					$data = self::xss_clean($data);
				}
			}
		}
        
		return $data;
	}

	public static function xss_clean($data)	{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
	}
    

	public static function required($val)	{
		if (is_array($val)) {
			return !empty($val);
		} else {
			return $val != '';
		}
	}

	public function _call($a, $b) {
		throw new Exception("Invalid validation rule", 500);
		
	}

	public static function matches($val1, $val2){
		return $val1 == $val2;
	}


	public static function matchesStrict($val1, $val2){
		return $val1 === $val2;
	}


	public static function different($val1, $val2){
		return $val1 != $val2;
	}

	public static function differentStrict($val1, $val2){
		return $val1 !== $val2;
	}

	public static function minlength($val1, $val2){
		return (mb_strlen($val1) >= $val2);
	}

	public static function maxlength($val1, $val2){
		return (mb_strlen($val1) <= $val2);
	}

	public static function exactlength($val1, $val2){
		return (mb_strlen($val1) == $val2);
	}

	public static function gt($val1, $val2){
		return ($val1 > $val2);
	}

	public static function lt($val1, $val2){
		return ($val1 < $val2);
	}

	public static function alpha($val1){
		return (bool) preg_match('/^([a-z])+$/i', $val1);
	}

	public static function alphanum($val1){
		return (bool) preg_match('/^([a-z0-9])+$/i', $val1);
	}

	public static function alphanumdash($val1){
		return (bool) preg_match('/^([a-z0-9_-])+$/i', $val1);
	}

	public static function numeric($val1){
		return is_numeric($val1);
	}

	public static function email($val1){
		return filter_var($val1, FILTER_VALIDATE_EMAIL) !== false;
	}

	public static function emails($val1){
		if (is_array($val1)) {
			foreach ($val1 as $v) {
				if (!self::email($v)) {
					return false;
				}
			}
		}
		return false;
	}

	public static function url($val1){
		return filter_var($val1,FILTER_VALIDATE_URL) !== false;
	}

	public static function ip($val1){
		return filter_var($val1,FILTER_VALIDATE_IP) !== false;
	}

	public static function regex($val1, $val2){
		return (bool) preg_match($val2, $val1);
	}

	public static function custom($val1, $val2){
		if ($val2 instanceof \Closure) {
			return (boolean) call_user_func($val2, $val1);
		}
		throw new \Exception;
		
	}

}