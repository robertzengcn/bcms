<?php /* Smarty version Smarty-3.1.8, created on 2016-09-29 14:40:16
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Cart\list.html" */ ?>
<?php /*%%SmartyHeaderCode:2457657ecb750338919-15229453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c633aa38318444731dab4a2785bc8a708f513190' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Cart\\list.html',
      1 => 1466490410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2457657ecb750338919-15229453',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'RESOURCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57ecb750757512_41972774',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ecb750757512_41972774')) {function content_57ecb750757512_41972774($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">

  function checkSearchForm() {
    if (document.getElementById('keyword').value) {
      return true;
    } else {
      alert("请输入搜索关键词！");
      return false;
    }
  }
  
   //搜索框下拉框效果
  $(".form-control").mousedown(function() {

    $(".j-search-history").show();

  });

  $("form[name='searchForm']").mouseleave(function() {

    $(".j-search-history").hide();

  })

  function clear_search() {

    $.post('search.php?act=clear', '', clear_searchhtml, 'JSON');

  }

  function clear_searchhtml() {

    $('.history-items').html('');

  }
</script>
<div class="container jiesuan">

  <div id="thescorealert" class="alert alert-danger">
    <h3>积分不足</h3>
    您的积分不足，您可以将部分礼品<a> 删除 </a>，然后再进行兑换操作，当前积分缺少 <span id="lesscore">40799</span> 分。
    <h4>重要提示：兑换后请到医院凭手机生成二维码到院领取物品</h4>
    </div>
   <form id="cartcheck" action="./order.php?method=checkout" method="post">
  <h3>全部礼品</h3>
  <table class="table table-striped" id="cartTable">
    <thead>
      <tr class="danger">
        <th><label>
            <input class="check-all check" type="checkbox"/>
            &nbsp;全选</label></th>
        <th>商品</th>
        <th>单价</th>
        <th>数量</th>
        <th>总价</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>

    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['plist'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['name'] = 'plist';
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['list']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total']);
?>
      <tr>
        <td class="checkbox_1"><input class="check-one check" type="checkbox" name="cartid" value="<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->id;?>
" /></td>
        <td class="goods"><img src="<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->pic;?>
" alt=""/><span><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->name;?>
</span></td>
        <td class="price">
        <?php if ($_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->exchange==1){?>      
        积分：<span class="scorenum"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->score;?>
</span> 
<?php }else{ ?> 
  积分：<span class="scorenum"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->score;?>
</span>  现金：<span class="priceamount"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->price;?>
</span>
<?php }?>
        </td>
        <td class="count"><span class="reduce">-</span>
          <input class="count-input" type="text" value="<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->quantity;?>
" id="num_<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->id;?>
"/>
          <span class="add">+</span></td>
        <td class="subtotal"><?php if ($_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->exchange==1){?>积分：<span class="subscorenum"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->quantity*$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->score;?>
</span><?php }else{ ?>积分：<span class="subscorenum"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->quantity*$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->score;?>
</span> 现金：<span class="subpriceamount"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->quantity*$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->price;?>
</span><?php }?></td>
        <td class="operation"><span onclick="deletecart(<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->id;?>
)" class="delete cartdelete">删除</span></td>
      </tr>
      <?php endfor; endif; ?>
 
    </tbody>
  </table>
  <div class="foot" id="foot">
    <label class=" pull-left select-all">
      <input type="checkbox" class="check-all check"/>
      &nbsp;&nbsp;全选</label>
    <a class=" pull-left delete" id="deleteAll"  href="javascript:;">删除</a>
    <div class=" pull-right closing" id="checkout">结 算</div>
    <input type="hidden" id="cartTotalPrice" />
    <div class="pull-right total">合计 积分：<span id="scoreTotal">0</span> 现金：￥<span id="priceTotal">0。00</span></div>
    <div class="pull-right selected" id="selected">已选商品<span id="selectedTotal">0</span>件<span class="arrow up">︽</span><span class="arrow down">︾</span></div>
    <div class="selected-view">
      <div id="selectedViewList" class="clearfix">
        <div><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/1.jpg"><span>取消选择</span></div>
      </div>
      <span class="arrow">◆<span>◆</span></span> </div>
  </div>
  </form>
   
  
</div>

<script>
window.onload = function () {
    if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (cls) {
            var ret = [];
            var els = document.getElementsByTagName('*');
            for (var i = 0, len = els.length; i < len; i++) {

                if (els[i].className.indexOf(cls + ' ') >=0 || els[i].className.indexOf(' ' + cls + ' ') >=0 || els[i].className.indexOf(' ' + cls) >=0) {
                    ret.push(els[i]);
                }
            }
            return ret;
        }
    }

    var table = document.getElementById('cartTable'); // 购物车表格
    var selectInputs = document.getElementsByClassName('check'); // 所有勾选框
    var checkAllInputs = document.getElementsByClassName('check-all'); // 全选框
    var tr = table.children[1].rows; //行
    var selectedTotal = document.getElementById('selectedTotal'); //已选商品数目容器
    var priceTotal = document.getElementById('priceTotal'); //总计
    var scoreTotal = document.getElementById('scoreTotal'); //总计
    var deleteAll = document.getElementById('deleteAll'); // 删除全部按钮
    var selectedViewList = document.getElementById('selectedViewList'); //浮层已选商品列表容器
    var selected = document.getElementById('selected'); //已选商品
    var checkbtn = document.getElementById('checkout');
    var foot = document.getElementById('foot');
    getscore();


    // 更新总数和总价格，已选浮层
    function getTotal() {
		var seleted = 0;
		var price = 0;
		var scorenum=0;
		var quantity=0;
		var HTMLstr = '';
		var trscoretotal=0;
		var trpricetotal=0;
		
		for (var i = 0, len = tr.length; i < len; i++) {
			if (tr[i].getElementsByTagName('input')[0].checked) {
				tr[i].className = 'on';
				seleted += parseInt(tr[i].getElementsByTagName('input')[1].value);
				quantity = parseInt(tr[i].getElementsByTagName('input')[1].value);				
				scorenum = parseInt(tr[i].cells[2].getElementsByClassName('scorenum')[0].innerText);
				if(tr[i].cells[2].getElementsByClassName('priceamount')[0]){
				pricenum = parseInt(tr[i].cells[2].getElementsByClassName('priceamount')[0].innerText);
				trpricetotal+=pricenum*quantity;				
				}
				trscoretotal+=scorenum*quantity;
				//tr[i].cells[4].getElementsByClassName('subscorenum')[0].innerText=scoretotal;
								
				HTMLstr += '<div><img src="' + tr[i].getElementsByTagName('img')[0].src + '"><span class="del" index="' + i + '">取消选择</span></div>'
			}
			else {
				tr[i].className = '';
			}
		}	
		selectedTotal.innerHTML = seleted;
		priceTotal.innerHTML = trpricetotal.toFixed(2);
		scoreTotal.innerHTML=trscoretotal;
		selectedViewList.innerHTML = HTMLstr;
	
		if (seleted == 0) {
			foot.className = 'foot';
		}
	}
    // 计算单行价格
    function getSubtotal(tr) {
        var cells = tr.cells;
        var pricecell = cells[2]; //单价
        var pricenum=parseInt(pricecell.getElementsByClassName('scorenum')[0].innerText);                
        var quantity = parseInt(tr.getElementsByTagName('input')[1].value);
        //var dollarnum=parseInt(pricecell.getElementsByClassName('priceamount')[0].innerText);        
        var subsoretotal=pricenum*quantity;
        var subscore = cells[4]; //小计td
        var countInput = tr.getElementsByTagName('input')[1]; //数目input
        var span = tr.getElementsByTagName('span')[1]; //-号
        if(pricecell.getElementsByClassName('priceamount')[0]){
        var price=parseInt(pricecell.getElementsByClassName('priceamount')[0].innerText);        
        var subprice=price*quantity;
        subscore.getElementsByClassName('subpriceamount')[0].innerText=subprice.toFixed(2);
        
        }
        //console.log(quantity);
        //写入HTML
        subscore.getElementsByClassName('subscorenum')[0].innerHTML = subsoretotal;
        //如果数目只有一个，把-号去掉
/*         if (countInput.value == 1) {
            span.innerHTML = '';
        }else{
            span.innerHTML = '-';
        } */
    }

    // 点击选择框
    for(var i = 0; i < selectInputs.length; i++ ){
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
            getTotal();//选完更新总计
            getscore();
        }
    }

    // 显示已选商品弹层
    selected.onclick = function () {
        if (selectedTotal.innerHTML != 0) {
            foot.className = (foot.className == 'foot' ? 'foot show' : 'foot');
        }
    }

    //已选商品弹层中的取消选择按钮
    selectedViewList.onclick = function (e) {
        var e = e || window.event;
        var el = e.srcElement;
        if (el.className=='del') {
            var input =  tr[el.getAttribute('index')].getElementsByTagName('input')[0]
            input.checked = false;
            input.onclick();
        }
    }

    //为每行元素添加事件
    for (var i = 0; i < tr.length; i++) {
    	
        //将点击事件绑定到tr元素
        tr[i].onclick = function (e) {
            var e = e || window.event;
            var el = e.target || e.srcElement; //通过事件对象的target属性获取触发元素
            var cls = el.className; //触发元素的class
            var countInout = this.getElementsByTagName('input')[1]; // 数目input
            var itemidin = this.getElementsByTagName('input')[0];
            var cartid=parseInt(itemidin.value);
            var value = parseInt(countInout.value); //数目
            //通过判断触发元素的class确定用户点击了哪个元素
            switch (cls) {
                case 'add': //点击了加号
                    countInout.value = value + 1;
                    getSubtotal(this);
                    updatequantity(cartid,countInout.value);
                    break;
                case 'reduce': //点击了减号
                    if (value > 1) {
                        countInout.value = value - 1;
                        getSubtotal(this);
                        //updatequantity(cartid,countInout.value);
                    }
                    updatequantity(cartid,countInout.value);
                    break;
                case 'delete': //点击了删除
                    var conf = confirm('确定删除此商品吗？');
                    if (conf) {
                        this.parentNode.removeChild(this);
                    }
                    break;
            }
            
            getTotal();
            getscore();
        }
        // 给数目输入框绑定keyup事件
           
        tr[i].getElementsByTagName('input')[1].onkeyup = function (e) {
            var val = parseInt(this.value);
            var itemidin = this.parentNode.parentNode.getElementsByTagName('input')[0];
            
            var cartids=parseInt(itemidin.value);

            if (isNaN(val) || val <= 0) {
                val = 1;
            }
            if (this.value != val) {
                this.value = val;
            }
            
            getSubtotal(this.parentNode.parentNode); //更新小计
            updatequantity(cartids,val);
            getTotal(); //更新总数
            
        }
    }
    // 点击全部删除
    deleteAll.onclick = function () {
        if (selectedTotal.innerHTML != 0) {
            var con = confirm('确定删除所选商品吗？'); //弹出确认框
            if (con) {
                for (var i = 0; i < tr.length; i++) {
                    // 如果被选中，就删除相应的行
                    if (tr[i].getElementsByTagName('input')[0].checked) {
                        tr[i].parentNode.removeChild(tr[i]); // 删除相应节点
                        i--; //回退下标位置
                    }
                }
            }
        } else {
            alert('请选择商品！');
        }
        getTotal(); //更新总数
    }
    
    checkbtn.onclick = function () {
    	var arr = new Array();
		for (var i = 0, len = tr.length; i < len; i++) {
			if (tr[i].getElementsByTagName('input')[0].checked) {
				var cardid=tr[i].getElementsByTagName('input')[0].value;
				arr.push(cardid);
								
				}
			}
		
		var jsonval=JSON.stringify(arr);
		$.ajax({url:"./order.php?method=checkout",
			   dataType:'json',
			   data:{'cart_id':jsonval},
			   type: "POST",
			   success: function(data){
				   if(data.statu){
					   if(data.code==arr.length){
						   $('#thecontent').html('商品结算成功');
						   $('#myModal').modal('show');
						  
					   }else{
						   $('#thecontent').html(data.msg);
						   $('#myModal').modal('show');
					   }
					   
				   }else{
					   alert(data.msg);
				   }
				   
			   }
				
				
				});
    }
    
    
    
	
    // 默认全选
    checkAllInputs[0].checked = true;
    checkAllInputs[0].onclick();
    function getscore(){
    	var currentscore=parseInt(document.getElementById('scoreTotal').innerHTML);
    	//console.log(currentscore);
    $.ajax({url:"./cart.php?method=getscore",
    	    dataType:'json',
    	    data:{'score':currentscore},
    	    type: "POST",
    	    success: function(data){
    	    	if(data.stute){
    	    		if(currentscore>data.score){
    	    			var num=currentscore-data.score;
    	    			$('#lesscore').html(num);
    	    			$('#thescorealert').show();
    	    		}else{
    	    			$('#thescorealert').hide();
    	    		}
    	    	}
    	    }
 	    
    	});
    }
    function updatequantity(id,quantity){
        $.ajax({url:"./cart.php?method=itemquantity",
    	    dataType:'json',
    	    data:{'cart_id':id,'quantity':quantity},
    	    type: "POST",
    	    success: function(data){
    	    	if(data.stute){
    	    		
                    
    	    	}else{
    	    		
    	    		alert(data.msg);
    	    	}
    	    }
 	    
    	});
    	
    }

    
}
</script>

<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>