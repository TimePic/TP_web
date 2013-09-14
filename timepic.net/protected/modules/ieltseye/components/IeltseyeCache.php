<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ieltseyeCache
 *
 * @author lixiaoxin
 */
class IeltseyeCache {

    public $prefix = 'ieltseye_';

    static function loadCache($cacheName, $force=false) {
        $functionName = 'init' . $cacheName;
        $ieltseyeCache = new IeltseyeCache();
        $cacheData = Yii::app()->cache->get($ieltseyeCache->getKey($cacheName));
        if(empty($cacheData) || $force) {
            return $ieltseyeCache->$functionName();
        }else{
            return $cacheData;
        }

    }

    public function saveCache($key, $value, $time) {
        Yii::app()->cache->set($key, $value, $time);
    }
    
    public function getKey($key){
        return $this->prefix.$key;
    }
    
    //tag cache
    function initTags() {
        $cacheData = array();
        $cacheId = $this->getKey('Tags');
        $tags = IeltseyeTag::model()->findAll();
        foreach ($tags as $tag) {
            $item['tagname'] = $tag->tagname;
            $item['tagid'] = $tag->tagid;
            $item['aliasWords'] = $tag->aliasWords;
            $cacheData[$tag->tagid] = $item;
        }
        $this->saveCache($cacheId, $cacheData, 3600);
        return $cacheData;
    }

}

?>
