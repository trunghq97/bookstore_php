<?php

class URL
{
    public static function createLink($module, $controller, $action, $params = null, $router = null)
    {
        if($router != null) return URL_ROOT . $router;

        $linkParams = '';
        if ($params) {
            foreach ($params as $key => $value) {
                $linkParams .= "&{$key}={$value}";
            }
        }
        $url = sprintf('index.php?module=%s&controller=%s&action=%s%s', $module, $controller, $action, $linkParams);
        return URL_ROOT . $url;
    }

    public static function redirect($module, $controller, $action, $params = null, $router = null)
    {
        // if($router != null) return $router;

        // $linkParams = '';
        // if ($params) {
        //     foreach ($params as $key => $value) {
        //         $linkParams .= "&{$key}={$value}";
        //     }
        // }
        // $link = sprintf('index.php?module=%s&controller=%s&action=%s%s', $module, $controller, $action, $params);
        $link = self::createLink($module, $controller, $action, $params, $router);
        header("location: {$link}");
        exit();
    }

    public static function checkRefreshPage($value, $module, $controller, $action, $params = null){
        if(Session::get('token') == $value){
            Session::delete('token');
            URL::redirect($module, $controller, $action, $params);
        }else{
            Session::set('token', $value);
        }
    }

    private function removeSpace($value){
        $value = trim($value ?? '');
        // $value = preg_replace('#(\s)+#', ' ', $value); //cách 2
        return $value;
    }

    private function  removeCircumflex($value){
		//$value		= strtolower($value);

		$characterA	= '#(a|à|ả|ã|á|ạ|ă|ằ|ẳ|ẵ|ắ|ặ|â|ầ|ẩ|ẫ|ấ|ậ)#imsU';
        $replaceA	= 'a';
		$value = preg_replace($characterA, $replaceA, $value);

        $characterD	= '#(đ|Đ)#imsU';
		$replaceD	= 'd';
		$value = preg_replace($characterD, $replaceD, $value);

        $characterE	= '#(è|ẻ|ẽ|é|ẹ|ê|ề|ể|ễ|ế|ệ)#imsU';
		$replaceE	= 'e';
		$value = preg_replace($characterE, $replaceE, $value);

        $characterI	= '#(ì|ỉ|ĩ|í|ị)#imsU';
		$replaceI	= 'i';
		$value = preg_replace($characterI, $replaceI, $value);
		
		$characterO = '#(ò|ỏ|õ|ó|ọ|ô|ồ|ổ|ỗ|ố|ộ|ơ|ờ|ở|ỡ|ớ|ợ)#imsU';
		$replaceCharacterO = 'o';
		$value = preg_replace($characterO,$replaceCharacterO,$value);
		
		$characterU = '#(ù|ủ|ũ|ú|ụ|ư|ừ|ử|ữ|ứ|ự)#imsU';
		$replaceCharacterU = 'u';
		$value = preg_replace($characterU,$replaceCharacterU,$value);
		
		$characterY = '#(ỳ|ỷ|ỹ|ý)#imsU';
		$replaceCharacterY = 'y';
		$value = preg_replace($characterY,$replaceCharacterY,$value);
        $value;

        $characterSpecial = '#(,|$)#imsU';
		$replaceSpecial = '';
		$value = preg_replace($characterSpecial,$replaceSpecial,$value);
        
		$value = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $value);
		$value = preg_replace($characterSpecial, '', $value);

        if(substr($value, -1) == '-'){
            $value = substr_replace($value, "", -1);
        }
        
        return $value;
    }


    private function convert_name($str) {
        $str = strtolower($str);
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ|D|Đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\:|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
        $str = preg_replace('#(-)+#', '-', $str);
        if(substr($str, -1) == '-'){
            $str = substr_replace($str, "", -1);
        }
		return $str;
	}

    private function replaceSpace($value){
        $value = trim($value ?? '');
		$value = str_replace(' ', '-', $value);
        return $value;
    }
    
	public static function filterURL($value){
		//$value = URL::removeSpace($value);
        $value = self::replaceSpace($value);
		$value = self::convert_name($value);
		return $value;
	}
}
