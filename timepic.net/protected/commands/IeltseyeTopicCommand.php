<?php

/*
 * [Willlee] (C)2001-2099 oss.xiaomi.com Inc.
 * This is NOT a freeware, use is subject to license terms

 */

/**
 * Description of ClearCacheCommand
 *
 * @author Will Lee<lishuzu@gmail.com> 2012-4-20 19:15:07
 */
class IeltseyeTopicCommand extends CConsoleCommand {

    public function getHelp() {
        parent::getHelp();
        return "fetch Topic from vious website";
    }

    public function init() {
        parent::init();
        //设置不超时
        set_time_limit(0);
        Yii::app()->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        Yii::import('application.modules.ieltseye.models.*');
    }

    public function run($args) {
        parent::run($args);
    }

    public function actionIndex() {
        $this->actionSpider('Hubpages');
        Yii::app()->end();
    }

    public function actionSpider($domain = '') {
        $method = "actionFetch" . $domain;
        $this->$method();
    }

    public function actionFetchHubpages() {
        Yii::import('application.helpers.*');
        require_once('SimpleHtmlDom.php');
        $argument = $html_str = $httpcode = '';

        $kits = array();
        $site = "http://hubpages.com/topics/education-and-science/linguistics/english-as-a-foreign-or-second-language/ielts-standardized-test/6930";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site);
        if ($argument) {
            foreach ($params as $key => $value) {
                $argument .="$key=$value&";
            }
        }

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $argument . "1=1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, '60');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.googlebot.com/bot.html'); //这里写一个来源地址，可以写要抓的页面的首页     
        curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.googlebot.com/bot.html)');
        $html_str = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpcode && $html_str) {
            $html = str_get_html($html_str);
        }
        $topics = $html->find('a[class=title]');
        if ($topics) {
            foreach ($topics as $key => $value) {
                $content = $question = $description = '';
                if (stripos($value->innertext(), 'Part 2') !== FALSE) {
                    $sampleHtml = file_get_html($value->href);
                    $sample = $sampleHtml->find('div[class=txtd]', 0);
                    //find tag p
                    $sample = str_get_html($sample->outertext);
                    $samples = $sample->find('p');
                    $card = $sample->find('strong');
                    if (count($card)==3) {
                        $card = explode('<br />', $card[2]);
                        foreach($card as $ckey=>$cvalue){
                            if (strpos($cvalue, 'Describe ') !== FALSE) {
                                $question = strip_tags($cvalue);
                                $questionStartIndex = $ckey;
                            }
                            if (strpos($cvalue, 'And explain') !== FALSE) {
                                $description = '';
                                $questionEndIndex = $ckey;
                                $descriptionEndIdex = $ckey;
                            }
                        }
                        for ($i = $questionStartIndex + 1; $i <= $questionEndIndex; $i++) {
                            $description .= strip_tags($card[$i]) . "\r\n";
                        }
                        echo '111111';
                        echo "\r\n";
                    }else{
                        foreach($card as $ckey=>$cvalue){
                            if (strpos($cvalue->innertext, 'Describe ') !== FALSE) {
                                $question = strip_tags($cvalue->innertext);
                                $questionStartIndex = $ckey;
                            }
                            if (strpos($cvalue->innertext, 'And explain') !== FALSE) {
                                $description = '';
                                $questionEndIndex = $ckey;
                                $descriptionEndIdex = $ckey;
                            }
                        }
                        for ($i = $questionStartIndex + 1; $i <= $questionEndIndex; $i++) {
                            $description .= strip_tags($samples[$i]->innertext) . "\r\n";
                        }
                    }

                    echo $question;
                    echo "\r\n";        
                    echo $description;
                    echo "\r\n";
                    echo $value->href;
                    echo "\r\n";
                    //content
                    foreach ($samples as $k => $v) {
                        if (strpos($v->innertext, '<strong>') !== FALSE || strpos($v->innertext, '(International English ') !== FALSE) {
                            $samples[$k]='';
                        }else{
                            $content .= strip_tags($samples[$k]->innertext) . "\r\n";
                        }
                    }
                    $card = new IeltseyeSpeakingTopicCard();
                    $card->question = $question;
                    $card->description = $description;
                    $card->type = 2;
                    $card->dateline = time();
                    $card->save();
                    $sampleModel = new IeltseyeSpeakingTopicSample();
                    $sampleModel->content = trim($content);
                    $sampleModel->author = '';
                    $sampleModel->cardid = $card->cardid;
                    $sampleModel->dateline = time();
                    $sampleModel->source = $value->href;
                    $sampleModel->save();
                }
            }
        }

        Yii::app()->end();
    }

}

?>
