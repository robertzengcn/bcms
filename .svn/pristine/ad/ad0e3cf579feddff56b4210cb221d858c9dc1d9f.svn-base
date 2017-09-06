    function addcart(id,quantity){
    	
    $.ajax({url:"./cart.php?method=addcart",
    	    dataType:'json',
    	    data:{'commodity_id':id,'quantity':quantity},
    	    type: "POST",
    	    success: function(data){
    	    	if(data.statu){
                   
                   $('#thecontent').html('添加购物车成功');
				   $('#myModal').modal('show');
    	    	}else{
    	    		  $('#thecontent').html(data.msg);
					   $('#myModal').modal('show');
    	    	}
    	    }
 	    
    	});
    }
    
    function deletecart(id){
        $.ajax({url:"./cart.php?method=delete",
    	    dataType:'json',
    	    data:{'cart_id':id},
    	    type: "POST",
    	    success: function(data){
    	    	if(data.statu){
                   //alert('删除商品成功');
    	    		location.reload();
    	    	}else{
    	    		alert(data.msg);
    	    	}
    	    }
 	    
    	});
    }
    
    function addandjumptocart(id){
        $.ajax({url:"./cart.php?method=addcart",
    	    dataType:'json',
    	    data:{'commodity_id':id,'quantity':1},
    	    type: "POST",
    	    success: function(data){
    	    	if(data.statu){
    	    		window.location.href="./cart.php"; 
    	    	}else{
    	    		alert(data.msg);
    	    	}
    	    }
 	    
    	});
    	
    }
    
    
    
//    $('body').on('click','.addcart',function(){
//    	alert(comid);
//    	var comid=$(this).attr('dataid');
//    	
//    	addcart(id);
//    });
