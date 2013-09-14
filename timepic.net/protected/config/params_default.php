<?php

return array(
    // this is used in contact page
    'adminEmail' => 'timepic.net@gmail.com',
    'site' => 'http://test.timepic.net',
    //附件url 可以换到cdn显示
    'attachurl' => 'http://test.timepic.net',
    'tmpPath' => '/images/upload/tmp',
    'watermarkKey' => 'timepic719',
    'robotMember' => array('xxx'),
    'coffee_category' => array(
        '1' => array(
            'catid' => '1',
            'catname' => '咖啡资讯'
        ),
        '2' => array(
            'catid' => '2',
            'catname' => '咖啡馆资讯'
        ),
        '3' => array(
            'catid' => '3',
            'catname' => '学习咖啡'
        ),
        '4' => array(
            'catid' => '4',
            'catname' => '咖啡产地大全'
        ),
    ),
    'openIds' => array(
        '1' => array(
            'name' => 'sina',
            'akey' => 'xxx',
            'skey' => 'xxx',
            'callback' => 'http://test.timepic.net/TPUser/sinaLogin',
            'url' => 'http://weibo.com/',
        ),
    ),
    'adminUid' => array(
        1
    ),
    'chinchilla' => array(
            'colorTranslate' => array(
                "Beige (Hetero)" => "米色",
                "Beige (Homo)" => "金色",
                "(Hetero Beige)" => "(米色)",
                "(Hetero  Beige)" => "(米色)",
                "(Homo Beige)" => "(金色)",
                "(Homo  Beige)" => "(金色)",
                "Mosaic" => "纯白",
                "Silver" => "银白",
                "Sapphire" => "蓝灰",
                "Violet" => "紫灰",
                "Carrier" => "基因",
                "Black" => "黑色",
                "Brown" => "咖啡",
                "Velvet" => "丝绒",
                "Vio-Sap" => "紫蓝灰",
                "Chocolate" => "深褐色",
                "Ebony" => "黑色",
                "White" => "白色",
                "Tan" => "咖啡",
                "TOV" => "丝绒",
                "Sap" => "蓝灰",
                "Homo Beige" => "金色",
                "Lethal" => "致命的",
                "Light" => "浅",
                "Medium" => "中",
                "MediTOV" => "中",
                "Extra" => "纯",
                "Dark" => "深",
                "Pink" => "粉",
                "Standard" => "标准",
                "Carr." => "基因",
                "Carr" => "基因",
                "Gray" => "灰",
                "Beige" => "米色",
                "Homo" => "类似",
                "Hetero" => "不同",
                "and" => "并且",
                "or" => "或",
            )
        ),
    'ieltseye'=>  require_once(dirname(__FILE__).'/params_ieltseye.php'),
);
?>
