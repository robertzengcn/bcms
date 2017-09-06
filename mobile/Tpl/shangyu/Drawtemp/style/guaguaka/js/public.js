// JavaScript Document
	var gua = 1,re = 2;
	/*var imgSrc = 'img/aa.png';*/
	
	function showdiv() { 
		 document.getElementById("bg1").style.display ="block";
		 document.getElementById("show").style.display ="block";
	}
	
	function hidediv() {
		 document.getElementById("bg1").style.display ='none';
		 document.getElementById("show").style.display ='none';
	}

	$(function(){
		var width = $("#show_img").width();
	    var height = $("#show_img").height();
		var winheight=$(window).height();
		var winwidth=$(window).width();
		$("#show").css({"width":300+"px","height":160+"px","overflow":"hidden","margin-left":(winwidth-320)/2+"px","margin-top":-(winheight)/2+"px"});
		$("#show_btn").css({"width":176*0.5+"px","height":76*0.5+"px"});
		$("#gua_div").html("x"+gua);
		$("#re_div").html("x"+re);
		
		if(gua == 0){
			showdiv();
		}
	})
	
	
	function bodys(height,width){
		bodys.mozUserSelect = 'none';
        bodys.webkitUserSelect = 'none';
		var img = new Image();         
		var canvas = document.querySelector('canvas');
		canvas.style.backgroundColor='transparent';         
		canvas.style.position = 'absolute';  
		var imgs = ['img/prize.png'];//'img/prize.jpg','img/prize2.jpg'
		var num = Math.floor(Math.random()*2);
		img.src = imgs[num];
		
		
		         
		img.addEventListener('load',function(e){  
			var ctx;
			var w = width, h = height;             
			var offsetX = canvas.offsetLeft, offsetY = canvas.offsetTop;             
			var mousedown = false;               
			function layer(ctx){                 
				var img=document.getElementById("lamp2");
				var pat=ctx.createPattern(img,"repeat");                
  
				ctx.fillStyle = pat;
				
				ctx.fillRect(0, 0, w, h);           
			}   
			function eventDown(e){                 
				e.preventDefault();                 
				mousedown=true;   
				$(".sjmes").css({"display":"block"});  
				     
			}   
			function eventUp(e){            
				e.preventDefault();                 
				mousedown=false; 
				 
				
				
				 var data = ctx.getImageData(0,0,w,h).data;   
			     for(var i=0,j=0;i<data.length;i+=4){
  	  		    if(data[i] && data[i+1] && data[i+2]&& data[i+3] ){
 	   	        j++;
      	  }
    }
    //当图层被擦除剩余80%时触发
    if(j<=w*h*0.6){
        ctx.clearRect(0,0,w,h);
    }            
			}               
			function eventMove(e){                 
				e.preventDefault();                 
				if(mousedown){                     
					if(e.changedTouches){                         
						e=e.changedTouches[e.changedTouches.length-1];                     
					}                     
					var x = (e.clientX + document.body.scrollLeft || e.pageX) - offsetX || 0,                         
					y = (e.clientY + document.body.scrollTop || e.pageY) - offsetY || 0;                     
					with(ctx){                    
						beginPath()                     
						arc(x, y, 15, 0, Math.PI * 2);                         
						fill();                     
					}                
				}             
			}               
			canvas.width=w;             
			canvas.height=h; 
			
			canvas.style.backgroundImage='url('+img.src+')';              
			ctx=canvas.getContext('2d');         
			ctx.fillStyle='b9b9b9';             
			ctx.fillRect(0, 0, w, h);

			layer(ctx);               
			ctx.globalCompositeOperation = 'destination-out';               
			canvas.addEventListener('touchstart', eventDown);             
			canvas.addEventListener('touchend', eventUp);             
			canvas.addEventListener('touchmove', eventMove);             
			canvas.addEventListener('mousedown', eventDown);             
			canvas.addEventListener('mouseup', eventUp);             
			canvas.addEventListener('mousemove', eventMove);       
		});
		
		/*img.src = imgSrc;*/
		(document.body.style);}
