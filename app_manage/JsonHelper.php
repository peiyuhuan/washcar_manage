<?php
/**
 * json 生成,分析 支持中文
 */
class Json_Helper {
    /**
     * 生成json
     */
    function encode($str){
        $json = json_encode($str);
        //linux
        return preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $json);
        //windows
        //return preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2LE', 'UTF-8', pack('H4', '\\1'))", $json);
    }
    /**
     * 分析json
     */
    function decode($str) {
        return json_decode($str);
    }
}
?>