/**
 * 医院简介
 * */
function Hospital() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function init()
	this.init = function() {
		$(function(){
			self.onloadCss();
		});
	}

	
	// }}}
	// {{{ function introduce()
	/**
	 * 医院简介
	 * */
	this.introduce = function(para){
			self.cmd(gHttp,{controller:'Introduce',method:'getInfo'},function(result1){
				if(result1.statu){
					$('#id').val(result1.data.id);
					$('#seo_desc').val(result1.data.description);
					$('#pic').val(result1.data.pic);
					editor.ready(function(){
						editor.setContent(result1.data.content);
					});			
					//self.getImgSize('hospitalsize');
					if(result1.data.src != undefined){
						$('#img').attr('src',result1.data.src);
						$('#pic').val(result1.data.pic);
						//self.setImgSize('hospitalsize');
					}
					
				}else{
					layer.alert(result1.msg);
				}
			});

			//保存
			$('#save').click(function(){
				$('#frm_post').frmPost({controller:'Introduce',method:'save'},function(result1){
					if(result1.statu){
						layer.msg('操作成功!',{icon: 1});
					}else{
						layer.alert(result1.msg,{icon:2});
					}
					return false;
				});
			});

			$('#frm_post').on('click','.del_pic',function(){
				$('#img').removeAttr('src');
				$('#pic').val('');
				$(this).remove();
			});
			
	}
	// }}}
}
