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
class adminController extends Controller {

        public function init() {
                parent::init();
                $this->layout = $this->module->adminLayout;
        }

        public function filters() {
                return array(
                    'accessControl',
                );
        }

        public function accessRules() {
                return array(
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'expression' => array($this, 'isAdmin'),
                    ),
                    array('deny', // deny all users
                        'users' => array('*'),
                        'expression' => array($this, 'denyAnyOne'),
                    ),
                );
        }

        public function denyAnyOne() {
                throw new CHttpException(404);
        }
        
        public function isAdmin($user){
                if (isset ($user->adminid) && isset ($user->isLoginAdmin)) {
                     return true; 
                }
                return false;
        }
}

?>
