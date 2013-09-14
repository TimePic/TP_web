<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminController
 *
 * @author lixiaoxin
 */
class IeltseyeController extends Controller {

        public function init() {
            $this->layout = 'application.modules.ieltseye.views.layouts.main';
            Yii::app()->homeUrl = Yii::app()->params['ieltseye']['homeUrl'];
            Yii::app()->name = Yii::app()->params['ieltseye']['name'];
            $this->initCache();
        }
        
        public function initCache(){
            IeltseyeCache::loadCache('Tags');
        }
}
?>
