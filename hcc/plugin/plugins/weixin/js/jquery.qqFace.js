// QQ表情插件
(function($){  
	$.fn.qqFace = function(options){
		var defaults = {
			id : 'facebox',
			path : 'face/',
			assign : 'content',
			tip : '',
			emotion : ''
		};
		var option = $.extend(defaults, options);
		var assign = $('#'+option.assign);
		var id = option.id;
		var path = option.path;
		var tip = option.tip;
		var emotion = {"1":"微笑","2":"撇嘴","3":"色","4":"发呆","5":"流泪","6":"害羞","7":"闭嘴","8":"睡","9":"大哭","10":"尴尬",
			    "11":"发怒","12":"调皮","13":"呲牙","14":"惊讶","15":"难过","16":"冷汗","17":"抓狂","18":"吐","19":"偷笑","20":"愉快",
			    "21":"白眼","22":"傲慢","23":"饥饿","24":"困","25":"惊恐","26":"流汗","27":"憨笑","28":"悠闲","29":"奋斗","30":"咒骂",
			    "31":"疑问","32":"嘘","33":"晕","34":"疯了","35":"衰","36":"敲打","37":"再见","38":"擦汗","39":"抠鼻","40":"糗大了",
			    "41":"坏笑","42":"左哼哼","43":"右哼哼","44":"哈欠","45":"鄙视","46":"委屈","47":"快哭了","48":"阴险","49":"亲亲","50":"吓",
			    "51":"可怜","52":"拥抱","53":"月亮","54":"太阳","55":"炸弹","56":"骷髅","57":"菜刀","58":"猪头","59":"西瓜","60":"咖啡",
			    "61":"饭","62":"爱心","63":"强","64":"弱","65":"握手","66":"胜利","67":"抱拳","68":"勾引","69":"OK","70":"NO",
			    "71":"玫瑰","72":"凋谢","73":"嘴唇","74":"爱情","75":"爱你"
	    };
		
		if(assign.length<=0){
			alert('缺少表情赋值对象。');
			return false;
		}
		
		$(this).click(function(e){
			var strFace, labFace;
			if($('#'+id).length<=0){
				strFace = '<div id="'+id+'" style="position:absolute;display:none;z-index:1000;" class="qqFace">' +
							  '<table border="0" cellspacing="0" cellpadding="0"><tr>';
				if (emotion != '') {
					for(var i in emotion){
						i = parseInt(i);
						labFace = '['+emotion[i]+']';
						strFace += '<td><img src="'+path+i+'.gif" onclick="$(\'#'+option.assign+'\').setCaret();$(\'#'+option.assign+'\').insertAtCaret(\'' + labFace + '\');" /></td>';
						if( i % 15 == 0 ) strFace += '</tr><tr>';
					}
				}
				strFace += '</tr></table></div>';
			}
			$(this).parent().append(strFace);
			var offset = $(this).position();
			var top = offset.top + $(this).outerHeight();
			$('#'+id).css('top',top);
			$('#'+id).css('left',offset.left);
			$('#'+id).show();
			e.stopPropagation();
		});

		$(document).click(function(){
			$('#'+id).hide();
			$('#'+id).remove();
		});
	};

})(jQuery);

jQuery.extend({ 
unselectContents: function(){ 
	if(window.getSelection) 
		window.getSelection().removeAllRanges(); 
	else if(document.selection) 
		document.selection.empty(); 
	} 
}); 
jQuery.fn.extend({ 
	selectContents: function(){ 
		$(this).each(function(i){ 
			var node = this; 
			var selection, range, doc, win; 
			if ((doc = node.ownerDocument) && (win = doc.defaultView) && typeof win.getSelection != 'undefined' && typeof doc.createRange != 'undefined' && (selection = window.getSelection()) && typeof selection.removeAllRanges != 'undefined'){ 
				range = doc.createRange(); 
				range.selectNode(node); 
				if(i == 0){ 
					selection.removeAllRanges(); 
				} 
				selection.addRange(range); 
			} else if (document.body && typeof document.body.createTextRange != 'undefined' && (range = document.body.createTextRange())){ 
				range.moveToElementText(node); 
				range.select(); 
			} 
		}); 
	}, 

	setCaret: function(){ 
		if(!$.browser.msie) return; 
		var initSetCaret = function(){ 
			var textObj = $(this).get(0); 
			textObj.caretPos = document.selection.createRange().duplicate(); 
		}; 
		$(this).click(initSetCaret).select(initSetCaret).keyup(initSetCaret); 
	}, 

	insertAtCaret: function(textFeildValue){ 
		var textObj = $(this).get(0); 
		if(document.all && textObj.createTextRange && textObj.caretPos){ 
			var caretPos=textObj.caretPos; 
			caretPos.text = caretPos.text.charAt(caretPos.text.length-1) == '' ? 
			textFeildValue+'' : textFeildValue; 
		} else if(textObj.setSelectionRange){ 
			var rangeStart=textObj.selectionStart; 
			var rangeEnd=textObj.selectionEnd; 
			var tempStr1=textObj.value.substring(0,rangeStart); 
			var tempStr2=textObj.value.substring(rangeEnd); 
			textObj.value=tempStr1+textFeildValue+tempStr2; 
			textObj.focus(); 
			var len=textFeildValue.length; 
			textObj.setSelectionRange(rangeStart+len,rangeStart+len); 
			textObj.blur(); 
		}else{ 
			textObj.value+=textFeildValue; 
		} 
	} 
});