<?php
Yii::import('application.helpers.ImageWorkshop');
/**
 * attachment
 */
class UploadHelper {

    public $attach = array();
    public $type = '';
    public $extid = 0;
    public $errorcode = 0; //100 sucessful
    public $forcename = '';
    public $attachDir = '/images/upload';
    public $attachType = array('totorotalk', 'coffee', 'chinchillaMarket');
    public $tmpPath = '';
    public $thumb = true;
    public $watermark = true;
    //如果使用过saveToTmp 则 tmp_name值会被替换成tmp目录
    function init($attach, $type = 'tmp', $forcename = '', $watermark = true, $thumb = true) {
        if (!is_array($attach) || empty($attach) || trim($attach['name']) == '' || $attach['size'] == 0) {
            $this->attach = array();
            $this->errorcode = -1;
            return false;
        } else {
            $this->tmpPath = Yii::app()->params['tmpPath'];
            $this->type = $this->check_dir_type($type);
            $this->forcename = $forcename;
            $this->watermark = $watermark;
            $this->thumb = $thumb;

            $attach['size'] = intval($attach['size']);
            $attach['name'] = trim($attach['name']);
            $attach['thumb'] = '';
            $attach['ext'] = strtolower(CFileHelper::getExtension($attach['name']));

            $attach['name'] = htmlspecialchars($attach['name'], ENT_QUOTES);
            if (strlen($attach['name']) > 90) {
                $attach['name'] = CommonHelper::cutstr($attach['name'], 80, '') . '.' . $attach['ext'];
            }
            $attach['isimage'] = $this->isImageExt($attach['ext']);
            $attach['extension'] = $this->get_target_extension($attach['ext']);
            $attach['attachdir'] = $this->get_target_dir($this->type);
            $attach['attachName'] = $this->getTargetFilename();
            $attach['attachment'] = $attach['attachdir'] . $attach['attachName'] . '.' . $attach['extension'];
            $attach['target'] = $this->attachDir . '/' . $this->type . '/' . $attach['attachment'];
            $this->attach = $attach;
            $this->errorcode = 100;
            return true;
        }
    }

    function check_dir_exists($type, $sub1 ='') {
        
        $type = $this->check_dir_type($type);
        if ($type == 'tmp') {
            $sub1 = '';
        }
        $basedir = Yii::getPathOfAlias('webroot') . $this->attachDir;

        $typedir = $type ? ($basedir . '/' . $type) : '';
        $subdir1  = $type && $sub1 !== '' ?  ($typedir.'/'.$sub1) : '';
        $res = $subdir1 ? is_dir($subdir1) : is_dir($typedir);
        if (!is_dir($res)) {
			$res = $typedir && $this->make_dir($typedir);
			$res && $subdir1 && ($res = $this->make_dir($subdir1));
        }
        return $res;
    }

    function save_to_local($source, $target) {
        if (!$this->is_upload_file($source)) {
            $succeed = false;
        } elseif (@copy($source, $target)) {
            $succeed = true;
        } elseif (function_exists('move_uploaded_file') && @move_uploaded_file($source, $target)) {
            $succeed = true;
        } elseif (@is_readable($source) && (@$fp_s = fopen($source, 'rb')) && (@$fp_t = fopen($target, 'wb'))) {
            while (!feof($fp_s)) {
                $s = @fread($fp_s, 1024 * 512);
                @fwrite($fp_t, $s);
            }
            fclose($fp_s);
            fclose($fp_t);
            $succeed = true;
        }

        if ($succeed) {
            $this->errorcode = 0;
            @chmod($target, 0644);
            @unlink($source);
        } else {
            $this->errorcode = 0;
        }

        return $succeed;
    }
    
	function is_upload_file($source) {
		return $source && ($source != 'none') && (is_uploaded_file($source) || is_uploaded_file(str_replace('\\\\', '\\', $source)));
	}
    function get_target_dir($type, $check_exists = true) {

        $type = $this->check_dir_type($type);
        $subdir = $this->makePath();
        $check_exists && $this->check_dir_exists($type, $subdir);
        return $subdir;
    }

    function getTargetFilename() {
        if ($this->forcename) {
            $filename = $this->forcename;
        } else {
            $filename = date('His') . strtolower(CommonHelper::random(16));
        }

        return $filename;
    }

    function make_dir($dir, $index = true) {
        $res = true;
        if (!is_dir($dir)) {
            $res = @mkdir($dir, 0777);
            $index && @touch($dir . '/index.html');
        }
        return $res;
    }

    // 创建目录
    public static function makePath($format = 'Ym') {
        return gmdate($format, time()) . "/";
    }

    function get_target_extension($ext) {
        static $safeext = array('attach', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'bmp', 'txt', 'zip', 'rar', 'mp3');
        return strtolower(!in_array(strtolower($ext), $safeext) ? 'attach' : $ext);
    }

    function check_dir_type($type) {
        return !in_array($type, $this->attachType) ? 'tmp' : $type;
    }

    function isImageExt($ext) {
        static $imgext = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
        return in_array($ext, $imgext) ? 1 : 0;
    }

    /**
     * upload the attachment to the temporary path
     * @param  string $tmpPath [description]
     * @return boolean          be successful or failed
     */
    function saveToTmp($tmpPath = 'tmp', $thumb = true) {
        $tmpPath = $tmpPath ? $tmpPath : $this->tmpPath;
        $uploadPath = Yii::getPathOfAlias('webroot') . $this->attachDir . '/' . $tmpPath;
        if (!is_dir($uploadPath)) {
            $this->make_dir($uploadPath);
        }
        //存储图片
        if ($this->attach['attachName']) {
            $tmpImage = $this->attach['tmp_name'];
            $targetImage = $uploadPath . '/' . $this->attach['attachName'] . '.' . $this->attach['extension'];
            $this->save_to_local($tmpImage, $targetImage);
            $this->attach['copyTmp'] = $this->attachDir . '/' . $tmpPath . '/' . $this->attach['attachName'] . '.' . $this->attach['extension'];
            $this->attach['tmp_name'] = $this->attachDir . '/' . $tmpPath . '/' . $this->attach['attachName'] . '.' . $this->attach['extension'];
        }
        //thumb
        if ($thumb && $targetImage) {
            $backgroundColor = "000000";
			$width = 170;
			$height = null;
            $layer = new ImageWorkshop(array(
                "imageFromPath" => $targetImage,
            ));

            $layer->resizeInPixel($width, null, true);

            $pathInfo = pathinfo($targetImage);
            $layer->save($pathInfo['dirname'] . '/', 'thumb' . '_' . $pathInfo['basename'], true, $backgroundColor, 100);
        }
        return true;
    }
    
    function save(){
        
        $source = isset($this->attach['copyTmp']) ? $this->attach['copyTmp'] : $this->attach['tmp_name'];
        $source = Yii::getPathOfAlias('webroot').$source;
        $target = Yii::getPathOfAlias('webroot').$this->attach['target'];
        @copy($source, $target);
        @chmod($target, 0644);
        @unlink($source);
        if ($this->thumb) {
            $this->resize($target);
        }
		if ($this->watermark) {
			//缩略图 不打水印
			$watermarkfile = Yii::getPathOfAlias('webroot').'/images/static/common/watermark/480.png';
			$photoPath = $this->getImageBySize($target, 'normal');
			$this->waterMark($photoPath, $watermarkfile);
			$watermarkfile = Yii::getPathOfAlias('webroot').'/images/static/common/watermark/960.png';
			$photoPath = $this->getImageBySize($target, 'big');
			$this->waterMark($photoPath, $watermarkfile);
		}
    }
    
    public function getImageBySize($image, $size="normal"){
        if ($image && in_array($size, array('thumb', 'normal', 'big'))) {
            $pathInfo = pathinfo($image);
            $sizeImage = $pathInfo['dirname'] . '/'. $size . '_' . $pathInfo['basename'];
            return $sizeImage;
        }
        return false;
    }

    public function resize($image) {
        ini_set('gd.jpeg_ignore_warning', 1);
        if (!file_exists($image)) {
            return false;
        }
        $thumbType = array(
            'thumb' => array('width' => '100', 'height' => '150'),
            'normal' => array('width' => '320', 'height' => '480'),
            'big' => array('width' => '640', 'height' => '960'),
        );
        $backgroundColor = "000000";
        foreach ($thumbType as $type => $value) {
            //缩略图
            $width = $value['width'];
            $height = $value['height'];

            $layer = new ImageWorkshop(array(
                "imageFromPath" => $image,
            ));

            $layer->resizeInPixel($width, $height, true, 0, 0, 'MM');

            $pathInfo = pathinfo($image);
            $layer->save($pathInfo['dirname'] . '/', $type . '_' . $pathInfo['basename'], true, $backgroundColor, 100);
        }
        return true;
    }

    /**
     * image 需要增加水印的图片地址
     * watermark 水印路径
     * 是否增加水印 默认增加
     *
     * 
     * @property string $image
     * @property string $watermark
     * @property boolean $addwater
     */
    //生成水印
    public static function waterMark($image, $watermark = '') {
        /* this is very importent,do not remove it */
        $watermarkKey = Yii::app()->params['watermarkKey'];
        if (file_exists($image)) {
            $photopath = $image;
            $waterpath = $watermark;

            $photo = new ImageWorkshop(array(
                "imageFromPath" => $photopath,
            ));
            $watermarkLayer = new ImageWorkshop(array(
                "imageFromPath" => $waterpath,
            ));
            $photoPathInfo = pathinfo($photopath);
            $savepath = $photoPathInfo['dirname'] . '/mark/';
            $savefile = md5($photoPathInfo['basename'] . $watermarkKey) . '.' . $photoPathInfo['extension'];

            $positionY = intval($photo->getHeight() / 3) - 10;
            $photo->addLayerOnTop($watermarkLayer, 12, $positionY, "RB");


            $photo->save($savepath, $savefile, true);
            return true;
        }
        return false;
    }

}

?>