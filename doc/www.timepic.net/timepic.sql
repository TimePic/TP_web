-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 04 月 08 日 10:48
-- 服务器版本: 5.1.54
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `timepic`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_msgboard`
--

CREATE TABLE IF NOT EXISTS `tp_msgboard` (
  `mid` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` mediumint(10) DEFAULT NULL COMMENT '用户uid',
  `username` char(60) DEFAULT NULL COMMENT '用户姓名',
  `email` char(100) DEFAULT NULL COMMENT '邮箱',
  `content` text NOT NULL COMMENT '留言信息',
  `dateline` int(10) NOT NULL COMMENT '时间',
  `status` tinyint(2) NOT NULL COMMENT '状态1匿名 0 正常',
  `appid` smallint(10) NOT NULL COMMENT '应用id',
  PRIMARY KEY (`mid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tp_msgboard`
--

INSERT INTO `tp_msgboard` (`mid`, `uid`, `username`, `email`, `content`, `dateline`, `status`, `appid`) VALUES
(1, NULL, 'TimePic', 'lishuzu@gmail.com', '欢迎大家给我们提出宝贵的建议。', 1333815233, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_totorotalk_article`
--

CREATE TABLE IF NOT EXISTS `tp_totorotalk_article` (
  `aid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `image` char(255) NOT NULL,
  `thumbimg` char(255) NOT NULL,
  `dateline` int(10) NOT NULL,
  `displayorder` tinyint(1) NOT NULL COMMENT '显示顺序 数字越大 显示在前',
  PRIMARY KEY (`aid`),
  KEY `dateline` (`dateline`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `tp_totorotalk_article`
--

INSERT INTO `tp_totorotalk_article` (`aid`, `title`, `content`, `image`, `thumbimg`, `dateline`, `displayorder`) VALUES
(1, '龙猫软便和腹泻的终极治疗方法！', '龙猫软便和腹泻的终极治疗方法！\r\n\r\n一．健康的龙猫便便判断标准\r\n刚出炉的BB通常表面都有些潮湿，而且很多消化充分的BB都捏起来有弹性，所以不要以这个为是否软便的判断标准。\r\n健康BB的判断：\r\n形状大致呈长椭圆形，表面无粘液，质地不特别柔软也不特别坚硬，可以用手轻松掰开，掰开时手上不会留下泥浆一样的痕迹，截面上有蜂窝状的微小气孔，截面的颜色不是黑色。\r\n如果表面有粘液、会在手上留下泥浆一样的痕迹，掰开后截面无气孔，则是软便；\r\n如果表面有粘液、会在手上留下泥浆一样的痕迹，质地特别柔软、仿佛浓稠的半固体勉强凝结成形，则是拉稀（腹泻）；\r\n如果质地特别坚硬，掰开后截面无气孔，则是便秘；\r\n如果其它都正常，只是掰开后截面颜色是黑色，则是亚健康状态，不需要紧急治疗，但需要长期调理，尤其有肠胃长期内出血的嫌疑，大多数由日常主粮引起，也有少数是由零食引发的。\r\n\r\n若真的是软便或腹泻，兔宝宝强烈推荐先带到宠物医院找有经验的大夫治疗。若当地宠物医院的大夫因不了解龙猫而无法治疗时，再按照下文的方法，自己在家治疗。\r\n软便症状：\r\n粪便成形成粒，但非常软，有的粪便外面似乎还覆盖一层滑滑的透明黏液，掉落在地板上，很容易被踩扁踩烂\r\n治疗方法：\r\n1）停止喂一切其它食物，只往笼内放置紫花苜蓿干草或者草颗粒供龙猫自由取食，同时每两小时灌喂营养液2ml以预防脱水。\r\n\r\n二．龙猫软便或腹泻的用药\r\n\r\nA乳酸菌：龙猫肠胃保健调养良药\r\n\r\n龙猫是素食动物，肠道中缺乏很多消化酶，而在家庭饲养过程中，又难免会接触一些零食，扰乱肠道菌群平衡。这时候，就要给龙猫补充益生菌了～\r\n益生菌有好多种，其中“乳酸菌”有增加肠道有益菌群、重建肠道菌落环境的超强功效，而且在长时间的龙猫饲养过程中表现极佳，所以，我们建议在日常给龙猫喂乳酸菌保健，遇到软便、便秘等轻微肠胃问题的时候，乳酸菌又是疗效颇佳的辅助药物。\r\n但是，不要听信那些酸奶的广告说“内含乳酸菌”就给龙猫吃酸奶哦！龙猫很难消化的，反而有可能引起肠胃问题。\r\n最好购买乳酸菌素片，可以在普通药店选购，仔细阅读药品说明书，选择既没有可可粉又没有香精添加剂的比较好。可可粉内含可可碱，可能造成很多小动物（包括龙猫）的中毒反应，目前已知含有可可粉绝不推荐选购的是哈药生产的“为消”牌乳酸菌素片。\r\n\r\n使用乳酸菌和其它益生菌的共同注意事项：\r\n1）益生菌不宜与抗菌素（抗生素）合用，若需合用，两种药要相隔2－4小时服用\r\n2）不要用热水冲调益生菌药液，最好用水温低于40℃的温水\r\n3）益生菌是活性菌，一些别的药物，尤其是治疗肠道疾病的药物，很容易与之发生拮抗作用，影响药物疗效，因此，最好不要和其它药物同时服用。\r\n4）益生菌若受热或受冻容易失去活性，应在阴凉干燥处保存\r\n5）益生菌的作用与所含活菌种类、菌数有关，也与其它药物相互作用有关，服用时要充分考虑这些因素，才能取得好的治疗效果\r\n6）益生菌具有治疗腹泻和便秘的双重作用\r\n\r\nB思密达 蒙脱石散的使用: 确定龙猫已腹泻时使用\r\n\r\n\r\n思密达 蒙脱石散，在比较大的人的药房就能够买到，有保护胃黏膜的功能，而且孕妇和小于一岁的婴幼儿都可安全服用，常用于婴儿的腹泻治疗，是相当温和而且安全的药物，给龙猫也有很好的疗效。\r\n思密达尝起来有点水果味，一般龙猫也会比较爱喝，灌喂起来不会太痛苦。\r\n\r\n【注】一袋思密达药粉，配合25毫升温水，注意溶化时充分搅拌，不让药粉沉底。\r\n\r\n体重300克以下龙猫，首次2毫升药液，每隔6小时后1毫升；\r\n体重300克以上龙猫，首次3-4毫升药液，每隔6小时后1.5-2毫升。\r\n等到便便成形且不臭不黏后可改为隔8-12小时喂一次，直到便便开始发硬为止，停思密达，换伊春乳酸菌。\r\n（本店有售，售价：5元/包）\r\n\r\n注意事项1：思密达和乳酸菌的效果是不同的，思密达是止泻药，属于吸附剂，能保护生病的胃肠粘膜、吸收肠道内的致病微生物、收敛水分；乳酸菌是益生菌，若 与思密达同时服用，会降低思密达的吸附能力，所以两者最好不要同时服用，一定要彻底停了思密达再用乳酸菌重建肠道有益菌群。虽然大夫可能用思密达和乳酸菌 同时治疗人类婴儿腹泻，但也要将两者给药间隔至少2－4小时，而且婴儿用药比龙猫剂量大的多，不建议仿效！\r\n\r\n注意事项2：思密达和各种抗生素（抗菌素）也存在药物的相互拮抗作用，一起服用时，思密达会削弱抗菌素的抗菌效力，两者也最好不要同时服用，如果听从兽医的指导不得不两者合用，则务必间隔2－4小时服用。\r\n\r\n注意事项3：若服用思密达3天后病况仍无明显好转，请立刻换硫酸庆大霉素，一般口服1次即可见效，最多不要超过2次\r\n\r\n注意事项4：治疗期间的饮食配合\r\n\r\n无论是思密达还是乳酸菌都并不影响食欲，如果龙猫食欲不振，那是因为疾病的原因，治好病自然就好了。在治疗期间，除了思密达/乳酸菌之外，保证龙猫能有正 常饮水和饮食，千万不要听某些庸医说的腹泻不能喝水，腹泻本来就容易脱水，补水最关键（如何补充水份，请看防止龙猫腹泻中脱水的方法），否则最后不是腹泻 死亡而是脱水死亡的。\r\n思密达的成分特性和禁忌\r\n1）思密达的有效成分是一种高原石，无副作用，服用过多可能产生便秘，但基本各种别的治疗肠炎腹泻类药物服用过多都会产生这个效果，而且便秘很好调理，所以可以忽略不计。注意，千万别为了害怕产生便秘就少给药，不给足药量，那样龙猫是不会便秘了，但可能腹泻而死！\r\n2）思密达药性温和，对于不重的软便效果很好，但是对于严重的软便就无法控制了，如果按照正确的剂量服用思密达3天后不好转，还是尽快转用硫酸庆大霉素。\r\n3）思密达跟一种强心针的药不能一起用，要用也要前后间隔开两个小时左右。\r\n\r\n三．防止龙猫腹泻中脱水的方法\r\n\r\n1）什么是脱水\r\n脱水是指动物身体大量丧失水分和Na+，引起细胞外液严重减少的现象，脱水可能引发酸中毒，严重的话会危及生命。很多严重软便和腹泻的龙猫，并不是死于软便和腹泻，而是死于脱水。因此，防治脱水是家长们的一项重要任务。\r\n2）脱水的判断：龙猫体重明显下降\r\n龙猫在生病其间，体重少量下降是正常的，但如果体重急剧下降，一天超过5克，那就肯定是脱水了。建议家里龙猫软便或者腹泻的家长，不要等龙猫真的脱水了再采取补救措施，而是一开始就配合治疗给予补液来预防脱水。\r\n3）脱水的治疗和预防\r\n最好的办法是找有经验的宠物医院给龙猫做输液（点滴），输液能在最短时间内见效，但很多医院由于不了解龙猫而不敢接诊或者胡乱接诊，那样可能更危险，因此，我们比较推荐的是按照下面的方法给龙猫口服营养液。\r\n基本所有宠物医院都能治疗兔子，因为兽医在专科学习的时候是以兔子为实验动物的。请医生帮忙配制给兔子用的腹泻时脱水补液的营养液，主要成份应该是葡萄糖氯化钠注射液，不同医院可能会添加不同的营养素进去。只要跟医生说明是拉稀脱水补充电解质及营养用的就可以了。\r\n如果当地的宠物医院靠不住，药店又买不到上述口服补液盐，那么自己配营养液也行，就是效果会差一点，但比没有强。\r\n自己配营养液的方法：药店买小儿葡萄糖粉或多维葡萄糖粉，按照包装剂量等比例溶化成葡萄糖液，品尝口感为甜度适中为最佳。\r\n注意不要用不干净的水或者热水、冰水配制营养液，最好用温度在40℃以下的温水配制，每次不要配制太多，够用就行，下回再配。若一次配多了，剩下的不要用开水烫或者煮沸加热，把水瓶放在热水杯中温一温就可以了。\r\n\r\n在龙猫严重软便和腹泻期间，不用担心喂营养液会增加肠胃的负担，这种营养液极易被直接吸收的。而且营养液的口感也不错的，有葡萄糖还有氯化钠，所以有点甜甜的咸咸的（我们尝过了），龙猫不会太抗拒。\r\n\r\n一般每隔2小时喂一次，一次喂2ml左右。口服营养液后，龙猫的体重应该会在第2天有所回升。\r\n另外注意，龙猫按照这个剂量口服营养液，相当于人每隔2小时喝2瓶多（市面上的矿泉水瓶子）的营养液，所以会产生明显的饱腹感，很可能更不愿意吃东西，没关系的，这是正常的，等脱水症状减轻后，口服营养液的剂量和次数减少，慢慢就会回复食欲了。\r\n\r\n4）防治脱水的重要性\r\n腹泻期间，防治脱水、补充水和电解质是非常重要的缓环节。很多家长觉得，口服补液盐不是药，只是“水”，既然是水，那还不如给龙猫直接喝水呢。但实际上， 白开水、矿泉水、纯净水、果汁、白糖水、糖盐水，都不能代替口服补液盐。口服补液盐的晶体渗透压和龙猫血液中的晶体渗透压是一致的，是肠道中的平衡电解 液，不但有补充因腹泻而丢失的水和电解质的作用，还兼有一定的止泻功效。\r\n而葡萄糖水，则由于极易吸收，成为软便腹泻龙猫补充体力的最好营养液。\r\n龙猫腹泻，补液是关键，腹泻丢失了电解质，血浆晶体渗透压降低，肠腔内的水分不但不能洗手，还会有水分析出，如果只喝水，甚至会出现喝水拉水现象，有的庸 医就以此为依据让家长不给龙猫喝水，那可真是草菅猫命了！不但要喝水，而且一定要补充口服补液盐水或者葡萄糖水，才能帮助龙猫打倒腹泻的病魔！口服补液盐 可以补充电解质，促进水分吸收，纠正水、电解质紊乱状态，帮助止泻。\r\n四．用针管给龙猫灌喂的方法\r\n\r\n在人工哺乳、治病给药期间，经常需要主人给龙猫进行灌喂。在灌喂过程中，如果不慎呛到龙猫，会造成龙猫会在1-2分钟内死亡，所以准确的灌喂方法是很重要的。\r\n\r\n首先，去药店选购一支1ml的一次性注射器，将尖锐的针头去掉，以针管为主要灌喂工具。虽然是一次性的，但只要每次灌喂后彻底清洗干净，针管是可以反复使用的。\r\n\r\n其次，用温水调好需要灌喂的液体（药液、奶液或营养液），用针管吸满，一般1ml针管可以吸入1.3ml左右的液体，灌喂完一管，去除合理浪费的部分，龙猫实际喝到的差不多刚好1ml。\r\n\r\n灌喂姿势：主人从颈后抱住龙猫，用拇指和食指轻轻卡住龙猫的下颌骨（下巴），然后温柔的向上提起，使龙猫后肢着地、身体呈站立姿势，主人的另一只手握住针 管，从龙猫侧面嘴角处横插入口中，轻推一点点液体进去，然后拔出针管，待其自行完成吞咽后再重复进行，如果龙猫很配合，则可尝试从龙猫的嘴前端推一点点液 体在嘴唇上，它会伸出舌尖舔食，习惯后可连续缓慢推出，连续舔食，这种方法最安全。\r\n给药期间，千万不要给龙猫绝食，更不要给他们绝水，让龙猫在治疗期间只要想吃就有的吃、想有的喝就有的喝，但不用强迫他们吃喝。可以将水壶挂低让龙猫更容 易喝到，里面放上清洁的饮用水；食盆内放上他平时吃习惯的草类食物，比如苜蓿草粒/苜蓿干草/提摩西干草，但不要在他患病期间让他尝试以前没有吃过的草 类，比如，他从未吃过提摩西，那这期间就别给他提摩西。\r\n\r\n另外，思密达的说明书上写着，孕妇和小婴儿都可以用。因此也可以给怀孕的龙猫使用。\r\n\r\n思密达的残留药性最后会随尿液排出体外，不会残留在体内，这也是一个好处，虽然对肾脏会造成一定的负担，但什么药都是如此，只要保证他有充足的饮水就可以了。\r\n最后，要请大家注意一切用具的卫生，龙猫宝宝是非常爱干净的哦！\r\n\r\n\r\n好了，谢谢您认真并完整的看完以上文章，希望您能成功的挽救这些小小的生命，我们也在努力为大家提供一个最便捷的窗口，愿天下所有的小动物宝宝们都能快乐健康的成长虽然它们陪伴不了您的一生，但您却能陪伴它们完整的一生！', '', '', 1332673423, 0),
(2, '龙猫逃走了，怎么把他捉回来？', '要捉回逃走了的龙猫是一件很头疼的事情！因为他们喜欢找暗角躲藏，柜底，茶几底沙发底，床底也是他们躲藏的热门地点，另外，你能发现龙猫身手极为了得，像成龙般敏捷，轻易避开你的擒捕，这时若不想办法而只徒手捕捉龙猫的话，恐怕捉上一小时也徒劳无功，而且会令龙猫受惊吓呢！以下提供2种办法，可帮助你较轻易捕捉逃走了的龙猫，但其实最重要的还是要有耐性，你要慢慢等待你的龙猫上钩呀！\r\n\r\n1。食诱法：将龙猫最喜欢吃的零食放于地上或者拿于手上，引他们从暗角走出来，继而乘龙猫品尝美食时捉住他。\r\n\r\n2。冲凉引诱法：99%的龙猫都喜欢洗澡（龙猫天生爱清洁呢！）。所以，可以把有洗澡粉的盆子放在地上，但你不能离洗澡盆太远。等待龙猫自动跳入盆中打滚，利马用手挡住洗澡盆的入口处 如果有盖子就直接盖上。然后将龙猫和洗澡盆一起放入笼中。 这个办法在我家对付最狡猾的阿福是百分白奏效哈哈弄的他恨死我了。\r\n其实，若你平常训练有素，可尝试唤他的名字，龙猫可能会回应你而走出来，不过这办法可能会不奏效，原因是龙猫好奇心很大，逃走出来后多了外界的诱惑，他或许会对你的呼唤充耳不闻呢！', '', '', 1333501785, 0),
(3, '新到家的龙猫饮食调理计划', '（一）饮水：\r\n\r\n任何一天都保证笼子上挂的水壶中有干净的饮用水（晾凉的白开水、饮水机内的纯净水或矿泉水均可），每隔2天换一次水，注意最好每周彻底清洗水壶一次，用旧牙刷等小刷子仔细刷洗水壶中的水垢沉积物。\r\n \r\n（二）主食：\r\n\r\n主食要每天直接放入食盆足够的量，让他按照自己的习惯分批次自由取食，他不会撑到自己的；尽量每天晚上固定一个大致的时间给主食。\r\n\r\n收到新粮草之前的几天，喂龙猫吃你手里现有的旧草的草梗即可；\r\n\r\n收到新粮草后的第1天：将苜蓿草梗剪成3cm左右的长度，放入食盆，和食盆内之前吃剩下的旧草混合均匀。\r\n\r\n第2天：抓一把新主粮（约为整袋500克装主粮的1/15）放入食盆，和第2天食盆内吃剩下的草混合均匀，同时加喂1片乳酸菌帮助适应新食物。（乳酸菌具体在本帖下半部分保健品内也有提及）\r\n\r\n第3天：将苜蓿草梗剪成3cm左右的长度（如果买了新的苜蓿草颗粒就直接给草粒），放入食盆，和第3天食盆内吃剩下的粮草混合均匀，同时加喂1片乳酸菌帮助适应新食物。\r\n\r\n之后以此类推，都给新粮草，一天主粮，一天苜蓿（草梗或草粒），一周后不用再每天加喂1片乳酸菌，而是改成一周总共给一片乳酸菌补充即可；每天可根据每次食盆内吃剩的食物的量，酌情增减第2天给的新食物的量，慢慢的会变成每天喂食时，上一天食盆内吃剩的基本就没有了。\r\n\r\n每喂一个半月到2个月之后，单纯给孩子吃一周的苜蓿（草梗或草粒）来清理肠胃积便。\r\n\r\n当孩子成年后（5月龄），可以把普通苜蓿换为DODOLA盒装苜蓿等更新鲜、更好吃、但价格也相对更贵的苜蓿草，这类相对更新鲜更好吃的苜蓿比较不好消化，所以不建议给幼年龙猫吃。\r\n \r\n（三）保健品：\r\n \r\n \r\n1）观察孩子的牙齿，是白色还是黄色。可以用一根咬木棍（或别的棒状物体，比如旧牙刷的柄）去逗弄他，他会用牙去咬，这时候轻轻把牙刷柄提高，就能看到他的门牙。如果孩子的牙齿发白，那么就必需补钙。去药店买三精牌葡萄糖酸钙口服液，一天一支放入饮水中。一般补钙2周左右牙齿会变黄，就可以停止给口服液了。\r\n \r\n \r\n2）购买不含可可粉的乳酸菌素片（药店有售，如果没有的话我店里也有售），调理肠胃。第1－7天每天给孩子一片，先递给他看看他会不会主动接过去吃，若不吃，就掰成几块丢进食盆，他总会误食到，一般误食过一定次数就会主动吃了，不用太着急。从第8天开始，一周给孩子一片乳酸菌即可。乳酸菌具体可详细参见：\r\n乳酸菌：龙猫肠胃保健调养良药\r\n \r\n3）如果孩子到家时很小，2个多月，且担心孩子之前胎里营养和奶水不够，可以酌情在饮用水中追加贝维素等营养剂，但具体请详细咨询后再加\r\n \r\n（四）零食：\r\n\r\n主食和保健品之外所有食物都算零食。零食是可有可无的，完全可以不喂。若想喂的话，不要把零食直接放入食盆，而是每次用手拿着递给他。\r\n\r\n家里原有的旧主粮和旧草，第3天之后可以作为零食给他，免得浪费；一天给4－5颗旧主粮以及10根以下的旧草就可以了，直到喂完为止。\r\n\r\n把旧粮旧草当零食喂完后，孩子应该已经长大到5月龄左右了，你也养了他2个多月了，这时候可以酌情购买专用的龙猫零食和零食草，但不要去超市买人吃的零食，比如胡萝卜干、苹果干等，超市也有卖，但一般都有添加剂，没有龙猫专用的安全。所有零食都要少喂，一天总共给1－2颗足够；所有零食草都相对更安全，比如提摩西、黑麦草等等，可以稍微多喂些，一天可以给一小把当配餐辅食，也能增加纤维摄入量，促进消化和营养吸收。\r\n\r\n综上，目前这2个月需要购买的商品包括：\r\n1）干燥度高的苜蓿（可在我们淘宝店内购买）\r\n2）品牌主粮如枫丹等（可在我们淘宝店内购买）\r\n3）不含可可粉的乳酸菌素片（当地药房有售，也可在我们淘宝店内购买）\r\n4）三精牌葡萄糖酸钙口服液（当地药房有售，牙齿黄就没必要买）\r\n对于国外的朋友，文中的“苜蓿”的英文是ALFALFA，选购这种英文名称的、干燥度高的干草即可。\r\n也可以直接把苜蓿换成便于喂饲且不会挑食的苜蓿草颗粒，效果一样。', '', '', 1333642063, 0),
(4, '猫猫是不是不爱吃这种主食呢？', '新手养猫猫，特别容易产生一个误会：猫猫吃某种主食（主粮或苜蓿），吃几口就不吃了，是不是不爱吃？是否需要换另外一种试试看？\r\n其实，猫猫除了一些很爱吃的东西之外，日常吃习以为常的主食粮草，基本都是一天分几十顿来吃，一顿只吃几口就结束进餐了；而且大部分猫猫都会在陌生家长注视自己吃食的时候缩短自己的进食时间，因为家长们直勾勾的眼光让他们感到紧张。\r\n也因此，夜深人静的时候，新到家的猫猫们吃的比白天多得多。\r\n另外，新家长千万不要惯坏孩子，一般来说，从正规店铺买回家的龙猫孩子，都养成了不挑食、不求零食、一天主粮一天苜蓿（草粒或草梗）的好习惯，但回家后，这个好习惯很容易在家长的心软之下几天就被放弃，然后猫猫会变得越来越挑嘴，于是在3－6月龄的这个黄金发育阶段打不好营养基础，不仅胖的比较慢，反而有的猫猫会越来越瘦。\r\n我就见过8月龄仍然只有不到300克体重的猫猫，一问，原来家长自从接回家后，就由着他的性子，爱吃什么吃什么，然后发现猫猫最后只肯吃两口草叶子，就只会眼巴巴等着苹果干果腹，买的一包150克的纯苜蓿草叶吃了2个月还剩大半包，苹果干反而一周就干掉差不多半斤，家长还很郁闷的和我说：我琢磨着苹果干是很有营养的东西啊，怎么越吃越瘦呢？你不是在论坛上也写了苹果有诸多营养吗？——其实，苹果再有营养，也只是“零食中的佼佼者”，相对于苜蓿草梗和龙猫主粮而言，苹果以及任何其它零食，包括麦片、各种牧草，都不可能提供均衡充足的龙猫成长所需的营养。因此，规律饮食是再重要不过的事情了！好比说我们人类的小孩子，一日三餐不好好吃，只吃苹果之类的东西，照样会营养不良。\r\n所以，建议所有的新家长，一天只给龙猫孩子放一次食物，一次给足全天24小时分量，一般猫猫一天需要吃30克左右的食物，听起来多，其实30克主粮或草粒只能勉强铺满一个食盆的盆底。当然，草梗很轻，所以30克草梗就要好几大盆了。然后不要管他是不是真的吃了，明天这个时候再检查食盆，根据他剩的量决定加减和更换多少食物。另外，一天只给一种主食（或主粮，或苜蓿）也是个好办法，因为这样能让龙猫孩子不至于在两种主食中挑挑拣拣。如果孩子已经养成偏食的习惯，就连续几天只给他不爱吃的那种主食和清水，不要屈服于他那可怜兮兮的眼光，如果你熬不住怕自己心软，可以给笼子加个罩子，让自己看不到他的恳求，让龙猫孩子也断绝向家长乞求更好吃的食物的期望。这样最多一周就能改好毛病，让孩子养成好的饮食习惯。', '', '', 1333642207, 0),
(5, '食物的搭配和喂食时间', '对于不挑食的猫猫，可以每日喂食两次，1次主粮1次牧草，分为早晚投喂，主粮20-30克，牧草20克左右。准确的投喂量以2小时内吃光为好，过多会造成浪费。\r\n对于有些挑食的猫猫，主粮和草分天喂，一天主粮一天牧草，一天只喂一次。 不爱吃的那种开始要少量给，挑食的习惯就慢慢改过来了。\r\n有些挑食严重的龙猫，就要采取特别的办法了，把所有它喜欢吃的食物停掉，在未来的3-5天内只给它不喜欢吃的主粮或牧草，让它饿得没有其它食物选择就能够接受了。\r\n', '', '', 1333724744, 0),
(6, '龙猫把耳朵耷拉下来是什么意思？', '有些龙猫在睡觉的时候喜欢吧耳朵耷拉下来。睡醒后耳朵因为压迫时间过长会无法竖起来，一般几个小时至几天会自行恢复。', '', '', 1333724930, 0),
(7, '刚生出来几天的小猫猫可以洗澡吗？', '刚出生的小龙猫无须洗澡,小龙猫让其随母亲自学。产后母龙猫7天内不能洗澡,避免造成产后体内物排出时污染毛发和生殖器。\r\n', '', '', 1333724972, 0),
(8, '龙猫能听懂人话吗?', '龙猫可以听懂简单的语言,其实大多数动物是一种条件反射,当你的声音伴随某种动作或者行为,慢慢它们就知道特定的声音意味着什么。因此,当你给她喂食或者洗澡时,可以对它说"吃饭","洗澡"等简单语言,它们就会慢慢熟悉了。\r\n', '', '', 1333725014, 0),
(9, '龙猫胃口不好，怎么办？', '其实有很多情况会令龙猫胃口变得不好！如中暑，牙齿太长，心情紧张或情绪不安等。\r\n龙猫是一种很怕热的动物（看他身上的毛多厚阿）！28度以上的气温已经令龙猫不好受，甚至会引起中暑，不吃东西便是中暑的病症之一。 中暑之后更会是全身软绵绵的趴在那里。\r\n门牙太长是龙猫胃口不好的原因之一，龙猫的门牙是会不断生长的，门牙太长影响龙猫进食。所以，笼子内应长期放置磨牙石或磨牙木给他们磨牙。 \r\n心情紧张或情绪不安。龙猫是一种心情容易紧张的动物，转天气或改变笼子位置都会令龙猫心情紧张而引致食欲不振。更有龙猫在死去伴侣后，伤心的没有食欲呢。\r\n过量使用零食造成挑食的坏习惯也会令龙猫不爱吃主粮，此外频繁的变换龙猫主粮，也是会让龙猫胃口变小的原因之一。\r\n', '', '', 1333725057, 0),
(10, '龙猫骨折的处理', '龙猫喜欢跑跳，最有可能发生腿部或头部骨折(相对较少,发生后死亡率极高)。本人根据多年来饲养经验总结如下(仅以腿部骨折为例)。\r\n轻度骨折(骨裂):外观来看除大幅度动作无法进行,基本日常活动不受,患处比较敏感,不会对龙猫产生致命威胁,会自己康复,恢复期内应不放出笼,将笼内高层攀爬物全部拆除,减少运动量有利恢复。\r\n中度骨折:骨明显折断,肢体无反应,拖拽现象,但未刺穿皮肤肌肉组织.腿部无明显肿涨,精神状态良好,用普通的竹木夹板龙猫会咬下来,可制作薄金属片夹板(内衬纱布)固定断肢.减少活动空间以利恢复。\r\n重度骨折:骨明显折断,伴随主血管破裂,患处明显肿涨,需联系有经验的宠物医生做封闭止血,创口消毒处理等,然后用薄金属片(内衬沙布),对于伤口后期炎症,需服用少量抗生素消炎或创口外敷(云南白药比较理想),切忌不得使用麻醉药物。\r\n', '', '', 1333725156, 0),
(11, '龙猫体重年龄对照表', '成长周期 体重平均值(克）\r\n出生 47  （出生后几天体重有可能较出生时轻微下降是正常现象）\r\n1周 62 \r\n2周 82 \r\n3周 104 \r\n4周 125 \r\n6周 176 \r\n8周 223\r\n\r\n10周 251 \r\n12周 298 \r\n14周 308 \r\n16周 338 \r\n18周 363 \r\n20周 388 \r\n22周 399 \r\n24周 408 \r\n26周 414 \r\n28周 423 \r\n30周 428 \r\n32周 435 \r\n34周 444 \r\n36周 453 \r\n38周 465 \r\n40周 466 \r\n', '', '', 1333725258, 0),
(12, '母猫发情期', '母猫的发情也有规律性的周期，一般每隔32天左右就会出现一次发情期。但也会因个体的健康、营养、季节和温度不同等周期长短也有差别。\r\n母猫发情的时候会比平时活跃 表现的很兴奋，见到公猫不会躲避反而会主动接近，相互亲昵，有时候还会爬到公猫猫身上。猫猫的下身也会明显的红肿并切会有分泌物流出。\r\n', '', '', 1333725287, 0),
(13, ' 零食与诱食剂的危害', '零食：非自然状态并添加人工制剂的食物.\r\n零食通常是指人(宠物)满足营养需要的主要食物以外的各种经过人为处理口味,添加色素,味素的食品.\r\n宠物零食的泛滥是商人追求利润最大化的产物,在人类社会中我们已经知道零食的危害,但是对于宠物似乎很多人并不重视零食会带来什么危害,而以我亲身经历过的很多病例都与零食有关.几乎所有的零食为了色香味能够吸引宠物,都要添加工业色素(商家是不会添加高昂的天然色素的),防腐剂,干燥剂,诱食剂,而这些物质对动物伤害是日积月累才会体现的,当我们开心的看着她们吃零食的时候,也许不久就要收获痛苦.\r\n危害性：零食给饲养者一个表面感觉就是动物很喜欢吃,更有个别饲养者,大量供给零食.这就是让动物慢性自杀.动物如同小孩一样,他们已经丧失了野生同类应有的辨别食物是否对健康不利的能力.家养动物更贪食,特别是有香味和甜味的零食,对动物有莫大的吸引力.长此以往,会让动物的消化系统失调,俱乐部接到很多吃零食引起的便秘,肠梗阻(高油脂引起)以至死亡的情况均有发生.在此提醒您不要图一时的开心拿她们的生命做代价。建议不要喂食水果（果干）、坚果类。\r\n我们能够理解宠物饲养者的心情,都希望自己的宝贝健康快乐,因此愿意提供一切让宝贝开心的食物和玩具.但我们这么做其实是很自私的,我们得到更多的是自己的满足和开心,而后果就要你的宝贝来承担.谁也无法预料零食会对她们的健康有何危害,我每个月都能接到几十个求助电话,相当比例是因为平常乱给食物引起的消化系统疾病或不明症状.\r\n在此,希望大家能够按照动物的食物习性来饲养,市场上那么多零食其实只是商人赚钱的工具,要赚钱是不会考虑动物死活的.\r\n\r\n诱食剂：人工合成化学剂，针对不同的动物有不同的味道和香味，其主要用途是家禽饲养场在短期内促进动物快速增长，缩短养殖周期。\r\n危害性：让动物对某种食物嗜瘾,不会再食用其它牌子的同类食物。由于诱食剂为人工化学合成药物,其对动物有不可预知的危害性,在宠物饲料中不应使用。\r\n', '', '', 1333725357, 0),
(14, '龙猫饮水问题', '饮水应注意以下几个问题：\r\n一、饮水的器具要保持干净清洁，有条件的保持每天换水；\r\n二、水的选择，使用净化的饮用水；\r\n三、绝对不要用冷藏过的水直接引用,须恢复到室温再用.\r\n', '', '', 1333725422, 0),
(15, ' 龙猫是否会经常挠痒痒?', '龙猫会经常自己挠痒,而且也喜欢人给它挠痒。它们最喜欢就是脖子那里挠痒,会眯上双眼享受的样子。\r\n\r\n', '', '', 1333725493, 0),
(16, '龙猫对孕妇的健康有影响?', '目前国内外尚未发现龙猫致孕妇传染弓形虫的病例.本人也认为孕妇饲养龙猫不会对胎儿产生影响。但为了避免您的家人对您饲养宠物产生的误解，应及时到医院做弓形虫抗体检查，解除他们不必要的担心。下面把介绍一下令国人恐惧的弓形虫吧！\r\n\r\n对孕妇及胎儿健康产生危害的动物寄生虫主要为弓形虫。\r\n主要传播源: \r\n     1.弓形虫的传染首先是吃未煮熟的肉。（爱吃路边烤串的女孩子特别要注意了）\r\n     2.感染的猫粪是重要的传染来源。猫和猫科动物是弓形虫的终宿主，感染的猫粪便里排出囊合子，因而猫粪污染的食物、饮水，甚至灰尘，人吃下去都可以传染。所以即使你不养猫，在室外一样会有传染弓形虫的可能。\r\n   3.狗也可以传染弓形虫，但是狗的粪便和排泄物都没有传染性，如果不吃狗肉就不会传染。不知道韩国人是怎么控制的。\r\n感染后病状: 大多数人没有症状，或者症状很轻，只有少数人初次感染时有发热、淋巴结肿大、头痛、肌肉关节痛和腹痛，几天或数周后随着人体产生免疫力，一般都能自愈。\r\n对胎儿的危害:　孕妇感染弓形虫可传染给胎儿，发生先天性感染，有可能产生严重后果。可是，只有在怀孕前没有感染过弓形虫的孕妇，在怀孕期间发生初次感染才有可能传染给胎儿，如果孕妇在怀孕前感染过弓形虫，那她就不再有传染的危险。（我认为在结婚前都去养宠物为好，而且最好传染上弓形虫形成抗体，婚后就不用担心什么了）。\r\n怎样防治弓形虫感染？\r\n第一，注意饮食卫生，肉类要充分煮熟，避开生肉污染熟食。\r\n第二，猫（非龙猫）要养在家里，喂熟食或成品猫粮，不让它们在外捕食。\r\n第三，每天清除猫的粪便，接触动物排泄物后要认真洗手。\r\n第四，除非孕妇血清检查证明已经有过弓形虫感染，否则孕妇怀孕期间要避免接触猫（非龙猫）及其粪便。\r\n第五，弓形虫感染有多种简便有效的药物治疗，须按医嘱进行，孕妇感染及时治疗可使胎儿感染机会减少。\r\n*最重要的一点，弓形虫是广泛传播，不会只存在于饲养猫的人群中，在自然界由于猫等动物的排泄物很多，所以即使不养宠物，除非生活在真空环境，否则感染弓形虫的几率是一样存在的。国内的一些媒体和医院过度夸大了弓形虫的危害性，请树立正确的医学观念，不要先患上疑心病。\r\n\r\n', '', '', 1333725545, 0),
(17, '为什么我的龙猫不肯让我抱？', '你抱龙猫的方法是否正确？若龙猫被你抱着感觉不安全不舒服，龙猫便自然想逃离你的魔爪了 关于如何抱龙猫的方法请参考怎样抱起你的龙猫这贴\r\n你的龙猫已经跟你混熟了吗？虽然大多数龙猫也很温顺，只要你抱他的时候令他感到安全，他便很少会反抗，但在饲养的初期，每次只适宜抱龙猫一段很短的时间（约为数分钟）。 \r\n这可能是因为你那龙猫的性格不喜欢给人抱，有些龙猫天生的性格不喜欢被人捉摸，所以会很抗拒你的拥抱。那就顺其自然吧，龙猫的个性太多也改不了，只管好好照顾他，多点伸手入笼内逗玩，使他渐渐接受你吧。\r\n发现婚后的猫猫会只要老婆不要老娘的情况的呵呵。\r\n个人发现一般情况母猫比较稀饭人抱，公猫嘛。。。比较稀饭他老婆抱呵呵 小猫比成年猫更稀饭要人抱。\r\n', '', '', 1333725662, 0),
(18, '龙猫洗澡的问题', '龙猫需要用专用的洗澡粉。细一些的洗澡粉容易进入毛发内部,更彻底的清理油脂和杂质.缺点是容易扬尘,建议在封闭箱中使用,避免污染周围环境。颗粒粗的洗澡粉相对来说不易进入毛发内部,清洗效果差一些.优点是不会扬尘。\r\n洗澡时间:最好在傍晚，与喂食的时间间隔开1小时左右，最好是在喂食前进行，这样可以避免龙猫在洗澡盆里BB。\r\n洗澡用具:洗澡用的盆不用很大，只要能容纳龙猫就可以，但是注意盆的高度要高些，这样可以避免洗澡粉被龙猫弄撒。洗澡粉的量控制在铺满盘底，厚度0.5—1厘米即可。洗澡粉可重复使用，如果发现里面有BB就拣出来，如果湿了晾干即可再用。\r\n洗澡次数:夏季高温最好每天一次.冬季3天左右一次。\r\n', '', '', 1333725693, 0),
(19, '怎样才能抱起我的龙猫？', '首先，接近龙猫及把他抱起的动作都要慢，因为龙猫会害怕主人快速的动作。\r\n先让他闻闻你的手（但要小心，要尽量避免将指尖伸向龙猫），一只手放在龙猫的腋下（肚子位置）另一手托着龙猫的屁股，以手承托龙猫的双脚把他抱起。轻轻将龙猫放在你弯曲的臂弯内，让他完全踏在你的手臂上，给予龙猫安全感。 \r\n若怕在怀中的龙猫逃走，可将手轻轻放在其身上，若龙猫尝试逃走，便把他移回臂弯内。另可轻抚龙猫，通常轻轻抚摸耳后、腮后及头部位置也会令龙猫觉得很舒服。 \r\n不可尝试用手拿着龙猫的尾巴将他提起，因如果龙猫受惊而跳起逃走的话，他的尾巴可能因此而折断。 \r\n不可能抓兔子和猫的方法，抓住龙猫颈项后的毛去把他提起，因为龙猫会因此而受惊，并多会以脱毛的方法来求脱身，而令他大量脱毛。 \r\n穿上长袖衣服，可避免你在抱龙猫时，手臂被抓疼或抓伤。因为龙猫的爪子其实挺锋利的。\r\n切记怀孕中的母猫如果要抱的话一定要抱抱好避免不小心摔到地上万一流产就不好了。\r\n刚开始抱的时候可以直接把手伸在笼子里抱不要把他们抱出来 等他们熟悉了你才将他们抱出笼子来。\r\n', '', '', 1333725776, 0),
(20, '如何训练你的龙猫简单小动作', '训练前要注意什么？\r\n在训练时，若龙猫做对了动作，便应给与奖励，如美味的零食，但若龙猫做不到动作，也应耐心的再训练，决不可打骂龙猫，打骂龙猫只会令他害怕你！ \r\n主人发出的"指令"要简短、清楚。如"握手""坐起来" 。\r\n不要一下子发出太多指令或训练太多动作，以免令龙猫混乱。而且动作要简单，不要太复杂，不可叫龙猫帮你开门呢！ \r\n训练只适宜在室内及较小的房间进行，并紧记关好门窗，堵塞所有龙猫可匿藏的暗角，收起龙猫吃下会有害的物件。 \r\n每次训练只适宜进行一段短时间，忌不断的训练，要让龙猫休息。其实，若龙猫觉得疲倦，很可能不做他已懂的动作 。\r\n就算在宠物店时龙贸已学懂站立，握手，但也不要期望龙猫在回家后也一样会做动作！因为，能否训练龙猫做动作，要看主人有多少时间给予照顾龙猫。在宠物店，店员每天也花很多时间和龙猫玩，龙猫自然也较听话。一般来说，主人很难每天花很多时间去照顾龙猫，所以自然需要较长的时间才能成功训练龙猫，主人要有耐心哦！\r\n怎样训练龙猫做一些简单的动作：站立，握手？\r\n在此要申明，虽然龙猫有灵性有聪明，可以教一些简单的动作，但你决不要想把龙猫训练成狗般听话。因为龙猫独立性很强，若他不喜欢听你的话，那就不要再勉强了。没有学会做动作的龙猫也一样可爱的！体罚或是责骂龙猫是最不赞成的！况且，打骂龙猫只会让龙猫害怕你，变得更不听话！ 甚至会讨厌你这个主人的。\r\n站立\r\n假若你的龙猫已经熟悉你，那就可以尝试教龙猫站起来。首先，抱起你的龙猫，用你的左手掌托着他的屁屁，让他双脚安全的站在你的掌心，以食指和中指夹着龙猫尾巴的根部，再以右手撑着龙猫的腋下将他扶起，并说：站好。最重要的是，以左手手指扶稳他的背部，以免他因恐惧向后跌而不敢站起来，反复尝试，做对了便给予零食奖励。\r\n握手\r\n同样，用你的左手掌托着他的臀部，让他的双脚安全的站在你的掌心，然后轻触他的手背，并说"握手"，当他提起手时便给予奖励，久而久之，当你说"握手"时，即使你没有轻触他的手背，他也会自动把手提起。要记住，能否训练龙猫很多时取决他的性格，有些聪明又听话的龙猫不需要一会儿就能学会站立和握手，有些龙猫你怎么教他都学不会。 \r\n各位主人要记住：请爱护你们的龙猫，不要勉强龙猫做一些他们不喜欢的事或动作。还是顺其自然吧！看见你的龙猫健康快乐的成长已经是最好的回报了。\r\n', '', '', 1333725844, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_totorotalk_photo`
--

CREATE TABLE IF NOT EXISTS `tp_totorotalk_photo` (
  `pid` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `ip` char(20) NOT NULL,
  `title` char(255) NOT NULL,
  `imgtype` char(40) NOT NULL,
  `size` int(10) NOT NULL,
  `thumb` tinyint(1) NOT NULL,
  `filepath` char(255) NOT NULL,
  `filename` char(30) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_totorotalk_photo`
--

INSERT INTO `tp_totorotalk_photo` (`pid`, `ip`, `title`, `imgtype`, `size`, `thumb`, `filepath`, `filename`, `dateline`) VALUES
(1, '218.247.229.21', 'totoroPhoto', 'image/jpeg', 654806, 1, '201204/233718ign7gvi11kkec8zy.jpg', '233718ign7gvi11kkec8zy.jpg', 1333553838),
(2, '218.247.229.21', 'totoroPhoto', 'image/jpeg', 549770, 1, '201204/233739plfpf5ifmi9f8kp5.jpg', '233739plfpf5ifmi9f8kp5.jpg', 1333553859),
(3, '218.247.229.21', 'totoroPhoto', 'image/jpeg', 586039, 1, '201204/234108e0emb8bl0bn8j0lz.jpg', '234108e0emb8bl0bn8j0lz.jpg', 1333554068),
(4, '218.247.229.21', 'totoroPhoto', 'image/jpeg', 519323, 1, '201204/002157292hadn5yn63ia6w.jpg', '002157292hadn5yn63ia6w.jpg', 1333556517),
(5, '218.247.229.21', 'totoroPhoto', 'image/jpeg', 576334, 1, '201204/084614yawmw2804y22yj8y.jpg', '084614yawmw2804y22yj8y.jpg', 1333586774);

ALTER TABLE `tp_totorotalk_article` ADD `views` INT( 10 ) NOT NULL COMMENT '浏览量' AFTER `thumbimg` 

CREATE TABLE `timepic`.`tp_totorotalk_category` (
`catid` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '分类id',
`upid` INT( 10 ) NOT NULL COMMENT '所属分类id 顶级为0',
`catname` VARCHAR( 255 ) NOT NULL COMMENT '分类名称'
) ENGINE = InnoDB COMMENT = 'totorotalk 分类表';

ALTER TABLE `tp_totorotalk_article` ADD `catid` INT( 10 ) NOT NULL COMMENT '分类' AFTER `displayorder` 
CREATE TABLE IF NOT EXISTS `tp_like` (
  `lid` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `times` int(10) NOT NULL COMMENT '喜欢次数',
  `typeid` int(10) NOT NULL COMMENT '喜欢来源类型id唯一标识',
  `type` char(20) NOT NULL COMMENT '喜欢来源的类型',
  PRIMARY KEY (`lid`),
  KEY `typeid` (`typeid`,`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

ALTER TABLE `tp_totorotalk_photo` ADD `views` INT( 8 ) NOT NULL COMMENT '浏览次数' AFTER `filename` 
--member table
CREATE TABLE IF NOT EXISTS `tp_member` (
  `uid` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'uid',
  `username` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `openID` char(30) NOT NULL,
  `openIDType` smallint(2) NOT NULL COMMENT '0 timepic 1sina 2qq',
  `accessToken` char(255) NOT NULL,
  `lastlogin` int(10) NOT NULL,
  `avatar` char(255) NOT NULL,
  `ip` char(15) NOT NULL,
  `dateline` int(10) NOT NULL COMMENT 'register date',
  PRIMARY KEY (`uid`),
  KEY `openID` (`openID`,`openIDType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- when user cancel the authorisation, we can get a flag.
ALTER TABLE  `tp_member` ADD  `isAuth` TINYINT( 1 ) NOT NULL COMMENT  '0未授权 1授权' AFTER  `dateline`
-- --------------------------------------------------------

--
-- Table structure for table `tp_chinchilla_market_trade`
--

CREATE TABLE IF NOT EXISTS `tp_chinchilla_market_trade` (
  `tradeId` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `uid` mediumint(8) NOT NULL COMMENT 'poster',
  `breed` mediumint(6) NOT NULL COMMENT 'color code',
  `gender` tinyint(1) NOT NULL COMMENT '0 maile 1 female',
  `birthday` int(10) NOT NULL COMMENT 'birthday',
  `weight` smallint(7) NOT NULL,
  `white` tinyint(1) NOT NULL COMMENT '白色 0无 1有',
  `black` tinyint(1) NOT NULL COMMENT '黑色 0无 1浅 2中 3深 4纯',
  `beige` tinyint(1) NOT NULL COMMENT '0无 1 米色 2金色',
  `velvet` tinyint(1) NOT NULL COMMENT '丝绒 0 无 1有',
  `violet` tinyint(1) NOT NULL COMMENT '紫色 0 无 3紫灰 5带紫灰基因',
  `sapphire` tinyint(1) NOT NULL COMMENT '蓝色 0 无 1蓝灰 4带蓝灰基因',
  `ip` char(15) NOT NULL,
  `contact` char(60) NOT NULL COMMENT 'contact',
  `title` char(60) NOT NULL COMMENT 'title',
  `description` text NOT NULL,
  `price` int(10) NOT NULL,
  `pic` char(150) NOT NULL COMMENT 'trade cover',
  `expiredDate` int(10) NOT NULL,
  `mode` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0classic 1advanced',
  `dateline` int(10) NOT NULL COMMENT 'post time',
  `displayorder` tinyint(2) NOT NULL COMMENT '-1 done -2 expired 0 normal 1 2 3',
  PRIMARY KEY (`tradeId`),
  KEY `displayorder` (`displayorder`,`dateline`),
  KEY `uid` (`uid`),
  KEY `breed` (`breed`),
  KEY `gender` (`gender`),
  KEY `birthday` (`birthday`),
  KEY `weight` (`weight`),
  KEY `white` (`white`),
  KEY `black` (`black`),
  KEY `beige` (`beige`),
  KEY `velvet` (`velvet`),
  KEY `violet` (`violet`),
  KEY `sapphire` (`sapphire`),
  KEY `price` (`price`),
  KEY `expiredDate` (`expiredDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='chinchilla market trade';

--
-- Table structure for table `tp_chinchilla_market_trade_pic`
--

CREATE TABLE IF NOT EXISTS `tp_chinchilla_market_trade_pic` (
  `picid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `tradeId` mediumint(8) NOT NULL,
  `ip` char(15) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` char(10) NOT NULL,
  `size` int(10) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `thumb` tinyint(1) NOT NULL COMMENT '0 no thumb 1 thumb',
  `status` tinyint(1) NOT NULL COMMENT '-1 delete',
  `dateline` int(10) NOT NULL COMMENT 'post time',
  PRIMARY KEY (`picid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='trade pictures';

--
-- Table structure for table `tp_totoro_color`
--

CREATE TABLE IF NOT EXISTS `tp_totoro_color` (
  `imageid` char(10) NOT NULL COMMENT '图片id',
  `color` char(100) NOT NULL COMMENT '颜色'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE  `tp_chinchilla_market_trade` ADD  `views` INT( 10 ) NOT NULL COMMENT  '浏览数' AFTER  `dateline`


--
-- Table structure for table `tp_ieltseye_weibo`
--

CREATE TABLE IF NOT EXISTS `tp_ieltseye_weibo` (
  `eid` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` bigint(255) NOT NULL COMMENT '用户uid',
  `uidstr` char(255) NOT NULL COMMENT 'uid字符串',
  `screen_name` char(100) NOT NULL COMMENT '用户名',
  `wbid` bigint(255) NOT NULL COMMENT '微博id',
  `wbmid` bigint(255) NOT NULL COMMENT '微博mid',
  `text` text NOT NULL COMMENT '微博内容',
  `created_at` int(10) NOT NULL COMMENT '微博创建时间',
  `keywords` char(100) DEFAULT NULL COMMENT '搜搜关键字',
  `dateline` int(10) NOT NULL COMMENT '入库时间',
  `status` tinyint(1) NOT NULL COMMENT '-1失败0正常',
  `source` tinyint(1) NOT NULL COMMENT '来源 0搜索 1@我的微博',
  PRIMARY KEY (`eid`),
  UNIQUE KEY `wbid` (`wbid`),
  KEY `status` (`status`),
  KEY `source` (`source`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='雅思口语回忆记录库';
ALTER TABLE  `tp_ieltseye_weibo` CHANGE  `source`  `source` TINYINT( 1 ) NOT NULL COMMENT  '来源 0搜索 1@我的微博 2名人微博采集';


--
-- Table structure for table `tp_ieltseye_speaking_topic_card`
--

CREATE TABLE IF NOT EXISTS `tp_ieltseye_speaking_topic_card` (
  `cardid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `question` char(255) NOT NULL COMMENT 'question',
  `description` text NOT NULL COMMENT 'description for part 2 question',
  `type` tinyint(4) NOT NULL COMMENT '1 part 1 2part2 3part3',
  `dateline` int(10) NOT NULL COMMENT 'generation time',
  PRIMARY KEY (`cardid`),
  UNIQUE KEY `question` (`question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='topic card including part 1 ,part2 and part3';

--
-- Table structure for table `tp_ieltseye_speaking_topic_sample`
--

CREATE TABLE IF NOT EXISTS `tp_ieltseye_speaking_topic_sample` (
  `sampleid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT 'sample content',
  `author` char(30) NOT NULL DEFAULT '' COMMENT 'author name',
  `dateline` int(10) NOT NULL COMMENT 'generation time',
  `source` text NOT NULL COMMENT 'the url of fetching website',
  `displayorder` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-1 invisible',
  `cardid` mediumint(8) NOT NULL COMMENT 'cardid',
  PRIMARY KEY (`sampleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE  `tp_ieltseye_speaking_topic_sample` ADD  `email` CHAR( 60 ) NOT NULL AFTER  `author`;
ALTER TABLE  `tp_ieltseye_speaking_topic_card` ADD  `tags` CHAR( 255 ) NOT NULL COMMENT  'tag' AFTER  `type`;

CREATE TABLE IF NOT EXISTS `tp_ieltseye_tag` (
  `tagid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  KEY `tagname` (`tagname`),
  KEY `status` (`status`,`tagid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `tp_ieltseye_tagitem`
--

CREATE TABLE IF NOT EXISTS `tp_ieltseye_tagitem` (
  `tagid` smallint(6) NOT NULL DEFAULT '0',
  `tagname` varchar(20) NOT NULL DEFAULT '',
  `itemid` mediumint(8) NOT NULL DEFAULT '0',
  `idtype` varchar(255) NOT NULL DEFAULT '',
  KEY `tagid` (`tagid`,`idtype`),
  KEY `idtype` (`idtype`,`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE  `tp_ieltseye_tag` ADD  `aliasWords` VARCHAR( 255 ) NOT NULL COMMENT  '同义词逗号分割' AFTER  `tagname`;
ALTER TABLE  `tp_ieltseye_tagitem` ADD  `tid` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
ALTER TABLE  `tp_ieltseye_weibo` ADD INDEX (    `status`, `created_at` ) ;
ALTER TABLE  `tp_ieltseye_weibo` CHANGE  `status`  `status` TINYINT( 1 ) NOT NULL COMMENT  '-1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示';
