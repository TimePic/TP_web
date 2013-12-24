<?php

class WeixinMpController extends Controller {

    public $token = "e8b706605a5c63e2440570980c561e38";
    public $messageObj = "";
    public $replyTemplate = "
	    <xml>
	    <ToUserName><![CDATA[%s]]></ToUserName>
	    <FromUserName><![CDATA[%s]]></FromUserName>
	    <CreateTime>%s</CreateTime>
	    <MsgType><![CDATA[%s]]></MsgType>
	    <Content><![CDATA[%s]]></Content>
	    </xml>
	    ";
    public $replyPicTemplate = "
	    <xml>
	    <ToUserName><![CDATA[%s]]></ToUserName>
	    <FromUserName><![CDATA[%s]]></FromUserName>
	    <CreateTime>%s</CreateTime>
	    <MsgType><![CDATA[%s]]></MsgType>
	    <ArticleCount>%s</ArticleCount>
	    <Articles>%s</Articles>
	    </xml> 	
	    ";
    public $replyItemTemplate = "
	    <item>
	    <Title><![CDATA[%s]]></Title> 
	    <Description><![CDATA[%s]]></Description>
	    <PicUrl><![CDATA[%s]]></PicUrl>
	    <Url><![CDATA[%s]]></Url>
	    </item>	
	";

    public function init() {
        parent::init();
//        Yii::getLogger()->autoFlush = 1;
//        Yii::getLogger()->autoDump = true;
        $this->messageObj = simplexml_load_string($GLOBALS["HTTP_RAW_POST_DATA"], 'SimpleXMLElement', LIBXML_NOCDATA);
    }

    public function actionIndex() {
        $responseMsg = '';
    	if (!$this->checkSignature()) {
            Yii::app()->end();
    	}

        if (stripos($this->messageObj->Content, "top") !== false) {
            echo $this->opUpdate();
        }elseif(stripos($this->messageObj->Content, "search") !== false) {
            echo $this->opSearch();
        }else{
            echo $this->opDefault();
        }
    }
    
    private function opUpdate(){
        $resultStr = array();
        if ($this->messageObj) {
            $weibos = IeltseyeWeibo::getApiWeibo(array(), 0, 10);
            foreach ($weibos as $weibo) {
                $weibo['text'] = $weibo['screen_name'] . ":\r\n" . $weibo['text'] . "\r\n" . $weibo['created_at'] . "\r\n";
                $responseMsg .= sprintf($this->replyItemTemplate, $weibo['text'], '', '', 'http://weibo.cn/' . $weibo['uid']);
            }
            $resultStr = sprintf($this->replyPicTemplate, $this->messageObj->FromUserName, $this->messageObj->ToUserName, time(), 'news', 10, $responseMsg);
        }
        return $resultStr;
    }
    
    private function opDefault() {
        $responseMsg = "欢迎关注我的公众微信，假冒者太多，请认准ielts_eye!\n
            本微信提供雅思考试最新的口语回忆。\n
            更多信息请访问:http://www.ieltseye.com\n
            发送“top”取得最新的口语回忆。\n
            发送“search 关键字”取得该关键字的最新搜索结果。\n";
        $resultStr = sprintf($this->replyTemplate, $this->messageObj->FromUserName, $this->messageObj->ToUserName, time(), 'text', $responseMsg);
        return $resultStr;
    }
    
    private function opSearch(){
        $resultStr = array();
        if ($this->messageObj) {
            $keyword = trim(str_replace(array("search", ":"), '', strtolower($this->messageObj->Content)));
            $weibos = IeltseyeWeibo::getApiWeibo(array('keyword'=>$keyword), 0, 10);
            foreach ($weibos as $weibo) {
                $weibo['text'] = $weibo['screen_name'] . ":\r\n" . $weibo['text'] . "\r\n" . $weibo['created_at'] . "\r\n";
                $responseMsg .= sprintf($this->replyItemTemplate, $weibo['text'], '', '', 'http://weibo.cn/' . $weibo['uid']);
            }
            $resultStr = sprintf($this->replyPicTemplate, $this->messageObj->FromUserName, $this->messageObj->ToUserName, time(), 'news', 10, $responseMsg);
        }
        return $resultStr;
    }
    
    
    private function checkSignature() {
        $signature = Yii::app()->request->getParam('signature');
        $timestamp = Yii::app()->request->getParam('timestamp');
        $nonce = Yii::app()->request->getParam('nonce');
        
        $tmpArr = array($this->token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}