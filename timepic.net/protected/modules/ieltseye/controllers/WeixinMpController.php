<?php

class WeixinMpController extends Controller {

    public $token = "e8b706605a5c63e2440570980c561e38";
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
	Yii::getLogger()->autoFlush = 1;
	Yii::getLogger()->autoDump = true;
    }

    private function checkSignature() {
	$signature = Yii::app()->request->getParam('signature');
	$timestamp = Yii::app()->request->getParam('timestamp');
	$nonce = Yii::app()->request->getParam('nonce');
	$log_str = json_encode($_GET);
	Yii::log("IeltsEyeWeixinMp.request:" . $log_str, 'info', 'ieltseye_web.log.mp');
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

    public function responseMsg() {
	//get post data, May be due to the different environments
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	//extract post data
	if (!empty($postStr)) {

	    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	    $fromUsername = $postObj->FromUserName;
	    $toUsername = $postObj->ToUserName;
	    $keyword = trim($postObj->Content);
	    $time = time();
	    $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
	    if (!empty($keyword)) {
		$msgType = "text";
		$contentStr = "Welcome to wechat world!";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	    } else {
		echo "Input something...";
	    }
	} else {
	    echo "";
	    exit;
	}
    }

    public function actionIndex() {
	$responseMsg = '';
	
//    	$echoStr = $_GET["echostr"];
	//valid signature , option
//	if ($this->checkSignature()) {
//	    echo $echoStr;
//	    exit;
//	}
	$weixinMessage = $GLOBALS["HTTP_RAW_POST_DATA"];
	$messageObj = simplexml_load_string($weixinMessage, 'SimpleXMLElement', LIBXML_NOCDATA);
	
	if (strpos($messageObj->Content, "up") !== false) {
	    $weibos = IeltseyeWeibo::getApiWeibo(array(), 0, 10);
	    foreach($weibos as $weibo){
		$weibo['text'] = $weibo['screen_name']."\r\n".$weibo['text']."\r\n".$weibo['created_at']."\r\n";
		$responseMsg .= sprintf($this->replyItemTemplate, $weibo['text'], '', '', 'http://weibo.cn/'.$weibo['uid']);
//		$responseMsg .= $weibo['screen_name']."\r\n";
//		$responseMsg .= $weibo['text']."\r\n";
//		$responseMsg .= $weibo['created_at']."\r\n";
//		$responseMsg .= "----------------\r\n";
	    }
	    var_dump($responseMsg);
	    $resultStr = sprintf($this->replyPicTemplate, $messageObj->FromUserName, $messageObj->ToUserName, time(), 'news', 10, $responseMsg);
	    
	}else{
	    $responseMsg = "我是雅思网蹲哥，欢迎关注我的公众微信。假冒者太多，请认准ielts_eye!本微信提供雅思考试最新的口语回忆。发送关键词“up”取得最新的口语回忆。";
	    $resultStr = sprintf($this->replyTemplate, $messageObj->FromUserName, $messageObj->ToUserName, time(), 'text', $responseMsg);
	}
//	$resultStr = sprintf($this->replyTemplate, $messageObj->FromUserName, $messageObj->ToUserName, time(), 'text', $responseMsg);
	echo $resultStr;
	Yii::log("IeltsEyeWeixinMp.request:" . $messageObj->Content, 'info', 'ieltseye_web.log.mp');
    }

}