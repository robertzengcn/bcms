// JavaScript Document

$(document).ready(function(){
	var num=$("div.subnav").find("li").length;
	if(num>14){
		
		var datelist="";
		var datemore="";
		$("li.navlist:lt(13)").each(function(){
			datelist+="<li class='navlist'>"+$(this).html()+"</li>";
			});
		$("li.navlist:gt(12)").each(function(){
			datemore+="<li>"+$(this).html()+"</li>";
			});
			$("ul#listbox").html(" ");
			datelist+="<li class='morelist'>更多<ul>"+datemore+"</ul></li>";
		$("ul#listbox").html(datelist);
		
	}
	$("li.morelist").mouseover(	function(){$(this).find("ul").show();}).mouseout(function(){$(this).find("ul").hide();});
	});