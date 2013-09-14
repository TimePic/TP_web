<?php

class TimePicCode {

    public static function TpCode($message) {
//        $message = TimePicCode::parseurl('',$message);
        return nl2br(str_replace(array("\t", '   ', '  '), array('&nbsp; &nbsp; &nbsp; &nbsp; ', '&nbsp; &nbsp;', '&nbsp;&nbsp;'), $message));
    }

    public static function parseurl($url, $text, $scheme) {
        if (!$url && preg_match("/((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|thunder|qqdl|synacast){1}:\/\/|www\.)[^\[\"']+/i", trim($text), $matches)) {
            $url = $matches[0];
            $length = 65;
            if (strlen($url) > $length) {
                $text = substr($url, 0, intval($length * 0.5)) . ' ... ' . substr($url, - intval($length * 0.3));
            }
            return '<a href="' . (substr(strtolower($url), 0, 4) == 'www.' ? 'http://' . $url : $url) . '" target="_blank">' . $text . '</a>';
        } else {
            $url = substr($url, 1);
            if (substr(strtolower($url), 0, 4) == 'www.') {
                $url = 'http://' . $url;
            }
            $url = !$scheme ? Yii::app()->getBaseUrl(true) . $url : $url;
            return '<a href="' . $url . '" target="_blank">' . $text . '</a>';
        }
    }

}
?>
