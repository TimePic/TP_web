
// 分享函数
function shareTo(shareId, url, title, pic){
	switch (shareId){
	   case 'sina':
                        var _w = 16 , _h = 16;
			var param = {
				url: url,
				type:'3',
				count:'0', /**是否显示分享数，1显示(可选)*/
				appkey:'3706708774', /**您申请的应用appkey,显示分享来源(可选)*/
				title:title, /**分享的文字内容(可选，默认为所在页面的title)*/
				pic:pic, /**分享图片的路径(可选)*/
				ralateUid:'2734978073', /**关联用户的UID，分享微博会@该用户(可选)*/
                                language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
				rnd:new Date().valueOf()
			}
                        var temp = [];
                        for( var p in param ){
                            temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
                        }
                        document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
	     break
	   case 'qq':
		     var param = {
				title:title,
				url:encodeURIComponent(url),
				appkey:encodeURI("17e735fcbd6b49ada84bcd32301aed0f"),
				pic:encodeURI(pic),
				site:'http://www.6block.com'
			}
			var api = 'http://v.t.qq.com/share/share.php?';
	     break
	   case 'qzone':
			var param = {
				url:url,
				desc:'',/*默认分享理由(可选)*/
				summary:'',/*摘要(可选)*/
				title:title,/*分享标题(可选)*/
				site:'http://www.6block.com',/*分享来源 如：腾讯网(可选)*/
				pics:pic /*分享图片的路径(可选)*/
			}
			var api = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?';
	     break
	   case 'kaixin001':
			var param = {
				rtitle:title,
				rcontent:title,/*默认分享理由(可选)*/
				rurl:url/*摘要(可选)*/
			}
			var api = 'http://www.kaixin001.com/repaste/bshare.php?';
	     break
	   case 'douban':
			var param = {
				url:url,
				title:title,/*默认分享理由(可选)*/
				sel:encodeURIComponent(title),
				v:1
			}
			var api = 'http://www.douban.com/recommend/?';
	     break
	   default:
		var param = {}
		var api = '';
	}
//	if (param && api) {
//		var urlparam = [];
//		for( var p in param ){
//			urlparam.push(p + '=' + encodeURIComponent( param[p] || '' ) )
//		}
//		var shareapi = api+ urlparam.join('&');
//		window.open( shareapi,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );		
//	};
}