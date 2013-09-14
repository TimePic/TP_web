<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author lixiaoxin
 */
class CommonHelper {

    public static function cutstr($string, $length, $dot = ' ...', $charset = 'utf-8') {
        if (strlen($string) <= $length) {
            return $string;
        }

        $pre = chr(1);
        $end = chr(1);
        $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), $string);

        $strcut = '';
        if (strtolower($charset) == 'utf-8') {

            $n = $tn = $noc = 0;
            while ($n < strlen($string)) {

                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t <= 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }

                if ($noc >= $length) {
                    break;
                }
            }
            if ($noc > $length) {
                $n -= $tn;
            }

            $strcut = substr($string, 0, $n);
        } else {
            for ($i = 0; $i < $length; $i++) {
                $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
            }
        }

        $strcut = str_replace(array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

        $pos = strrpos($strcut, chr(1));
        if ($pos !== false) {
            $strcut = substr($strcut, 0, $pos);
        }
        return $strcut . $dot;
    }

    //获取图片路径
    public static function getImageByType($path, $type, $size = 'big', $formate = 'path', $watermark = '0') {
        $size = in_array($size, array('thumb', 'normal', 'big', 'origin')) ? $size : 'big';
        $type = in_array($type, array('totorotalk', 'coffee', 'chinchillaMarket')) ? $type : '';
        $formate = in_array($formate, array('path', 'url')) ? $formate : 'path';
        if (empty($type)) {
            return false;
        }

        $siteurl = Yii::app()->params['attachurl'] ? Yii::app()->params['attachurl'] : Yii::app()->params['site'];

        $baseUrl = $siteurl . "/images/upload/" . $type;
        $basePath = Yii::getPathOfAlias('webroot') . '/images/upload/' . $type;
        $watermarkKey = Yii::app()->params['watermarkKey'];
        if ($path) {
            $fileinfo = pathinfo($path);
            if ($formate == 'path') {
                if ($size == 'origin') {
                    $filename = $basePath . '/' . $path;
                } else {
                    if ($watermark) {
                        $filename = $basePath . '/' . $fileinfo['dirname'] . '/mark/' . md5($size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'] . $watermarkKey) . '.' . $fileinfo['extension'];
                    } else {
                        $filename = $basePath . '/' . $fileinfo['dirname'] . '/' . $size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'];
                    }
                }
            }

            if ($formate == 'url') {
                if ($size == "origin") {
                    $filename = $baseUrl . '/' . $path;
                } else {
                    $filename = $baseUrl . '/' . $fileinfo['dirname'] . '/' . $size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'];
                }
                if ($watermark) {
                    $filename = $baseUrl . '/' . $fileinfo['dirname'] . '/mark/' . md5($size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'] . $watermarkKey) . '.' . $fileinfo['extension'];
                    $filepath = $basePath . '/' . $fileinfo['dirname'] . '/mark/' . md5($size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'] . $watermarkKey) . '.' . $fileinfo['extension'];
                    //缩略图 不打水印
                    if (!file_exists($filepath)) {
                        $addwater = ($size == 'thumb') ? FALSE : TRUE;
                        if ($addwater) {
                            $watermarkfile = Yii::getPathOfAlias('webroot') . '/images/static/common/watermark/480.png';
                            if ($size == 'big') {
                                $watermarkfile = Yii::getPathOfAlias('webroot') . '/images/static/common/watermark/960.png';
                            }
                            $photoPath = $basePath . '/' . $fileinfo['dirname'] . '/' . $size . '_' . $fileinfo['filename'] . '.' . $fileinfo['extension'];
                            UploadHelper::waterMark($photoPath, $watermarkfile);
                        }
                    }
                }
            }
            return $filename;
        }
        return false;
    }

    // 创建目录
    public static function makepath($path = "", $format = 'Ym') {
        return $path . gmdate($format, time()) . "/";
    }

    //产生随机字符
    public static function random($length, $numeric = 0) {
        PHP_VERSION < '4.2.0' ? mt_srand((double) microtime() * 1000000) : mt_srand();
        $seed = base_convert(md5(print_r($_SERVER, 1) . microtime()), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        $hash = '';
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed[mt_rand(0, $max)];
        }
        return $hash;
    }

    //时间格式化
    public static function sgmdate($dateformat, $timestamp = '', $format = 0) {
        if (empty($timestamp)) {
            $timestamp = time();
        }
        $result = '';
        if ($format) {
            $time = time() - $timestamp;
            if ($time > 24 * 3600 * 365) {
                $result = gmdate($dateformat, $timestamp);
            } elseif ($time > 24 * 3600 * 30) {
                $result = intval($time / (24 * 3600 * 30)) . Yii::t('Base', 'n==1#month|n>1#months', array($result)) . Yii::t('Base', 'ago');
            } elseif ($time > 24 * 3600) {
                $result = intval($time / (3600 * 24)) . Yii::t('Base', 'n==1#day|n>1#days', array($result)) . Yii::t('Base', 'ago');
            } elseif ($time > 3600) {
                $result = intval($time / 3600) . Yii::t('Base', 'n==1#hour|n>1#hours', array($result)) . Yii::t('Base', 'ago');
            } elseif ($time > 60) {
                $result = intval($time / 60) . Yii::t('Base', 'n==1#minute|n>1#minutes', array($result)) . Yii::t('Base', 'ago');
            } elseif ($time > 0) {
                $result = $time . Yii::t('Base', 'n==1#second|n>1#seconds', array($result)) . Yii::t('Base', 'ago');
            } else {
                $result = Yii::t('Base', 'now');
            }
        } else {
            $result = gmdate($dateformat, $timestamp);
        };
        return $result;
    }

    public static function checkmobile() {
        $mobile = array();
        static $mobilebrowser_list = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
        'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
        'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
        'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
        'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
        'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
        'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
        $pad_list = array('pad', 'gt-p1000');

        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

        if (CommonHelper::dstrpos($useragent, $pad_list)) {
            return false;
        }
        if (($v = CommonHelper::dstrpos($useragent, $mobilebrowser_list, true))) {
            Yii::app()->session->add('mobile', $v);
            return true;
        }
        $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
        if (CommonHelper::dstrpos($useragent, $brower))
            return false;

        Yii::app()->session->add('mobile', 'unkown');
        if ($_GET['mobile'] === 'yes') {
            return true;
        } else {
            return false;
        }
    }

    public static function dstrpos($string, &$arr, $returnvalue = false) {
        if (empty($string))
            return false;
        foreach ((array) $arr as $v) {
            if (strpos($string, $v) !== false) {
                $return = $returnvalue ? $v : true;
                return $return;
            }
        }
        return false;
    }

    public static function getOpenIdUrl($type) {
        if (intval($type)) {
            switch ($type) {
                case '0':
                    break;
                //Sina Weibo
                case '1':
                    Yii::import('ext.openID.SDK.sina.SaeTOAuthV2');
                    $openIdInfo = Yii::app()->params['openIds'][$type];
                    $openService = new SaeTOAuthV2($openIdInfo['akey'], $openIdInfo['skey']);
                    $loginUrl = $openService->getAuthorizeURL($openIdInfo['callback']);
                    return $loginUrl;
                    break;
                default:
                    break;
            }
        }
        return false;
    }

    public static function TimePicMenu($uri, $right = FALSE) {
        $TimePic_menu = array(
            '---',
            '/' => array('label' => Yii::t('Base', 'Home'), 'url' => '/'),
            '---',
            '/wallpaper' => array('label' => Yii::t('Base', 'Wallpapermenu'), 'url' => '/wallpaper'),
            '---',
            'totoro' => array('label' => Yii::t('Base', 'About Totoro'), 'url' => '#', 'items' => array(
                    '/chinchilla/market' => array('label' => Yii::t('Base', 'chinchillaMarket'), 'url' => '/chinchilla/market'),
                    '---',
                    '/totoroTalk' => array('label' => Yii::t('Base', 'totorotalk'), 'url' => '/totoroTalk'),
                    '---',
                    '/totoroCrossCalculator' => array('label' => Yii::t('Base', 'totoroCrossCalculator'), 'url' => '/totoroCrossCalculator'),
                    '---',
                    '/totoroPic' => array('label' => Yii::t('Base', 'totoroPicmenu'), 'url' => '/totoroPic'),
                    '---',
                    '/totoroVideo' => array('label' => Yii::t('Base', 'totoroVideo'), 'url' => '/totoroVideo'),
                    '---',
                )),
        );

        $TimePic_menu_right = array(
            '---',
            '/Msgboard' => array('label' => Yii::t('Base', 'Help'), 'url' => '/Msgboard'),
            '---',
            'languages' => array('label' => Yii::t('Base', 'Languages'), 'url' => '#', 'items' => array(
                    'zh_cn' => array('label' => Yii::t('Base', 'Chinese'), 'url' => '?lang=zh_cn'),
                    '---',
                    'en' => array('label' => Yii::t('Base', 'English'), 'url' => '?lang=en'),
                    '---',
                    'kr' => array('label' => Yii::t('Base', 'Korean'), 'url' => '?lang=kr'),
                ),
            ),
            '---'
        );

        if (Yii::app()->language) {
            //todo when choose the right language which should up to the top.
            $TimePic_menu_right[Yii::app()->language]['active'] = true;
        }

        if ($right) {
            if ($TimePic_menu_right[$uri]) {
                $TimePic_menu_right[$uri]['active'] = true;

                return $TimePic_menu_right;
            } else {
                return $TimePic_menu_right;
            }
        } else {

            if ($TimePic_menu[$uri]) {
                $TimePic_menu[$uri]['active'] = true;
                return $TimePic_menu;
            }
            if ($TimePic_menu['totoro']['items'][$uri]) {
                $TimePic_menu['totoro']['active'] = true;
                return $TimePic_menu;
            }
        }

        return $TimePic_menu;
    }

    public static function removeEmoji($text) {

        $clean_text = "";

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clean_text = preg_replace($regexEmoticons, '', $text);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clean_text = preg_replace($regexSymbols, '', $clean_text);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clean_text = preg_replace($regexTransport, '', $clean_text);

        // Match flags (iOS)
        $regexTransport = '/[\x{1F1E0}-\x{1F1FF}]/u';
        $clean_text = preg_replace($regexTransport, '', $clean_text);


        return $clean_text;
    }

}

?>
