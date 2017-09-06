

function tabletCheck() {
	var a = /ipad|android|android 3.0|xoom|sch-i800|playbook|tablet|kindle/i.test(navigator.userAgent.toLowerCase());
	return a;
}

function isWeixin() {
	var a = navigator.userAgent.toLowerCase();
	return "micromessenger" == a.match(/MicroMessenger/i) ? !0 : !1
}
function countCharacters(a) {
	for (var b = 0, c = 0; c < a.length; c++) {
		var d = a.charCodeAt(c);
		d >= 1 && 126 >= d || d >= 65376 && 65439 >= d ? b++ : b += 2
	}
	return b
}
function mobilecheck() {
	var a = !1;
	a = /ipad|android|android 3.0|xoom|sch-i800|playbook|tablet|kindle/i.test(navigator.userAgent.toLowerCase());
	if(a){
		return a;
	}else{
		return function(b) {
		(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(b) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(b.substr(0, 4))) && (a = !0)
		}(navigator.userAgent || navigator.vendor || window.opera), a
	}
	
	
}
function playVideo(a) {
	if (a && a.bgAudio) {
        var b = $("#media"),
        c = $("#audio_btn"),
        d = $("#yinfu"),
        e = "1" == a.bgAudio.type ? a.bgAudio.url: PREFIX_FILE_HOST + a.bgAudio.url;
        b.attr("src", e),
        c.addClass("video_exist"),
        b.bind("canplay", 
        function() {
            b.get(0).play()
        }).bind("play", 
        function() {
            c.addClass("play_yinfu").removeClass("off"),
            d.addClass("rotate")
        }).bind("pause", 
        function() {
            c.addClass("off").removeClass("play_yinfu"),
            d.removeClass("rotate")
        }),
        c.show().click(function(a) {
            a.stopPropagation(),
            $(this).hasClass("off") ? (b.get(0).play(), utilSound.pause()) : b.get(0).pause()
        })
    }
}
function renderPage(a, b, c) {
	function d(a, b) {
		var c, d, e, f, g, h = window.scene ? scene.pageMode : 0,
			i = 0,
			j = {
				touchPos: 0,
				pLen: -486 * (b - 1),
				contain: $("#page" + a),
				cH: mobilecheck() ? $(document).height() : 486,
				stopInertiaMove: !1
			};
		0 == h || 1 == h || 2 == h || 6 == h || 7 == h || 8 == h || 11 == h || 12 == h ? h = "NS" : (h = "WE", $('<section class="u-arrow-bottom"><div class="pre-wrap"><div class="pre-box1"><div class="pre1"></div></div><div class="pre-box2"><div class="pre2"></div></div></div></section>').appendTo("#page" + a));
		var k = 0,
			l = 0;
		j.contain.on("mousedown touchstart", function(a) {
			return "button" == a.target.tagName.toLowerCase() || a.target.getAttribute("data") || a.target.getAttribute("href") || "8" == a.target.getAttribute("ctype") ? void a.stopPropagation() : (a.stopPropagation(), a.preventDefault(), void(j.touchPos < j.pLen || j.touchPos > 0 || (c = !0, e = 0, j.stopInertiaMove = !0, d = a.originalEvent.touches ? a.originalEvent.changedTouches[0].clientY : a.clientY, "WE" == h && (f = a.originalEvent.touches ? a.originalEvent.changedTouches[0].clientX : a.clientX), l = j.touchPos, k = Date.now())))
		}), j.contain.on("mousemove touchmove", function(a) {
			if (a.stopPropagation(), c) {
				if (e = j.touchPos + (a.originalEvent.touches ? a.originalEvent.changedTouches[0].clientY : a.clientY) - d, "WE" == h && (g = (a.originalEvent.touches ? a.originalEvent.touches[0].clientX : a.clientX) - f, Math.abs(g) > Math.abs(e - j.touchPos) && !scene.property.forbidHandFlip)) {
					if (g > 0) {
						if (5 > g) return;
						eqxiu.prePage()
					} else eqxiu.nextPage();
					return void(c = !1)
				}
				if (e < j.pLen || e > 5) return c = !1, e > 0 && "NS" == h && (scene.property.forbidHandFlip ? j.touchPos = 0 : eqxiu.prePage()), void(0 > e && "NS" == h && (scene.property.forbidHandFlip ? j.touchPos = j.pLen : eqxiu.nextPage()));
				if (e > 0) return;
				j.stopInertiaMove = !0, $(this).find(".edit_area").css("transform", "translate3d(0," + (e - i) + "px,0)"), $(this).find(".edit_area").css("-webkit-transform", "translate3d(" + (e - i) + "px,0)");
				var b = Date.now();
				$(document).trigger("pageScrollPos", [e - j.cH]), b - k > 300 && (k = b, l = e), j.stopInertiaMove = !1
			}
		}), j.contain.on("mouseup touchend mouseleave", function(a) {
			if (a.stopPropagation(), c) {
				if (c = !1, mobilecheck() && 0 === e) return void $(a.target).trigger("click");
				if (!(0 > e && e > j.pLen)) return e >= 0 ? void(j.touchPos = 0) : void(j.touchPos = j.pLen);
				j.touchPos = e, "WE" == h && j.contain.find(".u-arrow-bottom").hide();
				var b = Date.now(),
					d = (e - l) / (b - k);
				!
				function(a, b, c, d) {
					function e() {
						if (!d.stopInertiaMove) {
							var h = Date.now(),
								j = h - b,
								k = a + j * g;
							if (!(0 > f * k)) {
								var l = (a + k) / 2 * j,
									m = c + l;
								m > 0 || m < d.pLen || (d.timmer = null, d.contain.find(".edit_area").css("transform", "translate3d(0," + (m - i) + "px,0)"), d.contain.find(".edit_area").css("-webkit-transform", "translate3d(0," + (m - i) + "px,0)"), d.touchPos = m, $(document).trigger("pageScrollPos", [m - d.cH]), setTimeout(e, 10))
							}
						}
					}
					var f = 0 > a ? -1 : 1,
						g = f * -6e-4;
					e()
				}(d, b, e, j)
			}
		}), $(document).on("clearTouchPos", function() {
			j.touchPos = 0
		})
	}
	a.templateParser("jsonParser").parse({
		def: c[b - 1],
		appendTo: "#page" + b,
		mode: "view"
	});
	var e, f, g = 1,
		h = $(".z-current").width(),
		i = $(".z-current").height();
	imageWidth = $(".m-img").width(), imageHeight = $(".m-img").height(), h / i >= 320 / 486 ? (g = i / 486, e = (h / g - 320) / 2) : (g = h / 320, f = (i / g - 486) / 2), window != window.top && $(".phoneBox .nr").css({
		width: "100%",
		height: "100%",
		overflow: "hidden",
		"transform-origin": "top left",
		transform: "scale(" + g + ")"
	}), f && $(".edit_area").css({
		marginTop: f
	}), e && $(".edit_area").css({
		marginLeft: e
	}), tplCount == c.length && $("#eqMobileViewport").attr("content", "width=320, initial-scale=" + g + ", maximum-scale=" + g + ", user-scalable=no"), c[b - 1].properties && c[b - 1].properties.longPage && d(b, c[b - 1].properties.longPage)
}!function(a) {
		function b() {
			var a = {};
			this.addInterval = function(b, c) {
				a[b] = c
			}, this.deleteInterval = function(b) {
				a[b] && (clearInterval(a[b]), delete a[b])
			}, this.clearInterval = function() {
				for (var b in a) this.deleteInterval(b)
			};
			var b = [{
				value: 1,
				desc: "轮播",
				name: "slide"
			}, {
				value: 2,
				desc: "下落",
				name: "bars"
			}, {
				value: 3,
				desc: "百页窗",
				name: "blinds"
			}, {
				value: 5,
				desc: "渐变",
				name: "blocks2"
			}, {
				value: 9,
				desc: "梳理",
				name: "zip"
			}, {
				value: 11,
				desc: "翻转",
				name: "bars3d"
			}, {
				value: 13,
				desc: "立方体",
				name: "cube"
			}];
			this.getPicStyle = function(a) {
				if (void 0 === a) return b;
				for (var c = 0; c < b.length; c++)
					if (a === b[c].value) return b[c]
			}
		}
		a.utilPictures = new b
	}(window),
	function(a) {
		function b() {
			var a = {
					CLICK: {
						name: "click",
						value: 1
					}
				},
				b = {
					SHOW: {
						name: "show",
						value: 1
					}
				};
			this.getSendType = function(b) {
				if (void 0 === b) return a;
				for (var c in a)
					if (b === a[c].value) return a[c];
				return null
			}, this.getHandleType = function(a) {
				if (void 0 === a) return b;
				for (var c in b)
					if (a === b[c].value) return b[c];
				return null
			}
		}
		a.utilTrigger = new b
	}(window),
	function(a, b) {
		function c(a) {
			function b(a, b, c) {
				return a[b] || (a[b] = c())
			}
			var c = b(a, "eqShow", Object);
			return b(c, "templateParser", function() {
				var a = {};
				return function(c, d) {
					if ("hasOwnProperty" === c) throw new Error("hasOwnProperty is not a valid name");
					return d && a.hasOwnProperty(c) && (a[c] = null), b(a, c, d)
				}
			})
		}

		function d(b) {
			templateParser = c(a)
		}
		var e = a.eqShow || (a.eqShow = {});
		d(e)
	}(window, document),
	function(a) {
		function b(a, b, c, d) {
			var e = {},
				f = a / b,
				g = c / d;
			return f > g ? (e.width = c, e.height = c / f) : (e.height = d, e.width = d * f), e
		}

		function c(a, b) {
			if (b.trigger) {
				var c = $(a);
				b.trigger.sends && b.trigger.sends.length && $.each(b.trigger.sends, function(a, b) {
					c.bind(utilTrigger.getSendType(b.type).name, function() {
						$.each(b.handles, function(a, b) {
							var c = utilTrigger.getHandleType(b.type).name;
							$.each(b.ids, function(a, b) {
								var d = $("#inside_" + b);
								d.trigger(c)
							})
						})
					})
				}), b.trigger.receives && b.trigger.receives.length && b.trigger.receives[0].ids.length && $.each(b.trigger.receives, function(a, b) {
					var d = utilTrigger.getHandleType(b.type).name;
					"show" == d && c.hide(), c.bind(d, function() {
						"show" == d && $(this).show()
					})
				})
			}
		}
		var d = a.templateParser("jsonParser", function() {
			function a(a) {
				return function(b, c) {
					a[b] = c
				}
			}

			function b(a, b) {
				var c = j[("" + a.type).charAt(0)](a);
				if (c) {
					var d = $('<li comp-drag comp-rotate class="comp-resize comp-rotate inside" id="inside_' + c.id + '" num="' + a.num + '" ctype="' + a.type + '"></li>');
					 3 != ("" + a.type).charAt(0) && 1 != ("" + a.type).charAt(0) && d.attr("comp-resize", ""),
                    "p" == ("" + a.type).charAt(0) && d.removeAttr("comp-rotate"),
                    1 == ("" + a.type).charAt(0) && d.removeAttr("comp-drag"),
                    2 == ("" + a.type).charAt(0) && d.addClass("wsite-text"),
                    4 == ("" + a.type).charAt(0) && (a.properties.imgStyle && $(c).css(a.properties.imgStyle), d.addClass("wsite-image")),
                    5 == ("" + a.type).charAt(0) && d.addClass("wsite-input"),
                    6 == ("" + a.type).charAt(0) && d.addClass("wsite-button"),
                    8 == ("" + a.type).charAt(0) && d.addClass("wsite-button"),
					"r" == ("" + a.type).charAt(0) && d.addClass("wsite-button"),
                    "v" == ("" + a.type).charAt(0) && d.addClass("wsite-video"), d.mouseenter(function() {
						$(this).addClass("inside-hover")
					}), d.mouseleave(function() {
						$(this).removeClass("inside-hover")
					});
					var e = $('<div class="element-box">').append($('<div class="element-box-contents">').append(c));
					if (d.append(e), 5 != ("" + a.type).charAt(0) && 6 != ("" + a.type).charAt(0) || "edit" != b || $(c).before($('<div class="element" style="position: absolute; height: 100%; width: 100%;">')), a.css) {
						var f = 320 - parseInt(a.css.left);
						d.css({
							width: f
						}), "p" == a.type && d.css({
							height: f / 2
						}), d.css({
							width: a.css.width,
							height: a.css.height,
							left: a.css.left,
							top: a.css.top,
							zIndex: a.css.zIndex,
							bottom: a.css.bottom,
							transform: a.css.transform
						}), e.css(a.css).css({
							width: "100%",
							height: "100%",
							transform: "none"
						}), e.children(".element-box-contents").css({
							width: "100%",
							height: "100%"
						}), 4 != ("" + a.type).charAt(0) && "p" != ("" + a.type).charAt(0) && $(c).css({
							width: a.css.width,
							height: a.css.height
						})
					}
					return d
				}
			}

			function d(a) {
				for (var b = 0; b < a.length - 1; b++)
					for (var c = b + 1; c < a.length; c++)
						if (parseInt(a[b].css.zIndex, 10) > parseInt(a[c].css.zIndex, 10)) {
							var d = a[b];
							a[b] = a[c], a[c] = d
						}
				for (var e = 0; e < a.length; e++) a[e].css.zIndex = e + 1 + "";
				return a
			}

			function e(a, e, f) {
				e = e.find(".edit_area").css({
					overflow: "hidden"
				});
				var g, h = a.elements;
				if (h)
					for (h = d(h), g = 0; g < h.length; g++)
						if (3 == h[g].type) {
							var i = j[("" + h[g].type).charAt(0)](h[g]);
							"edit" == f && k[("" + h[g].type).charAt(0)] && k[("" + h[g].type).charAt(0)](i, h[g])
						} else {
							var n = b(h[g], f);
							if (!n) continue;
							e.append(n);
							for (var o = 0; o < m.length; o++) m[o](n, h[g], f);
							l[("" + h[g].type).charAt(0)] && (l[("" + h[g].type).charAt(0)](n, h[g]), "edit" != f && c(n, h[g])), "edit" == f && k[("" + h[g].type).charAt(0)] && k[("" + h[g].type).charAt(0)](n, h[g])
						}
			}

			function f() {
				return k
			}

			function g() {
				return j
			}

			function h(a) {
				m.push(a)
			}

			function i() {
				return m
			}
			var j = {},
				k = {},
				l = {},
				m = [],
				n = containerWidth = 320,
				o = containerHeight = 486,
				p = 1,
				q = 1,
				r = {
					getComponents: g,
					getEventHandlers: f,
					addComponent: a(j),
					bindEditEvent: a(k),
					bindAfterRenderEvent: a(l),
					addInterceptor: h,
					getInterceptors: i,
					wrapComp: b,
					mode: "view",
					parse: function(a) {
						var b = $('<div class="edit_wrapper"><ul eqx-edit-destroy id="edit_area' + a.def.id + '" comp-droppable paste-element class="edit_area weebly-content-area weebly-area-active"></div>'),
							c = this.mode = a.mode;
						this.def = a.def, "view" == c && tplCount++;
						var d = $(a.appendTo);
						return containerWidth = d.width(), containerHeight = d.height(), p = n / containerWidth, q = o / containerHeight, e(a.def, b.appendTo($(a.appendTo)), c)
					}
				};
			return r
		});
		d.addInterceptor(function(a, b, c) {
			eqxCommon.animation(a, b, c)
		}), d.addComponent("1", function(a) {
			var b = document.createElement("div");
			if (b.id = a.id, b.setAttribute("class", "element comp_title"), a.content && (b.textContent = a.content), a.css) {
				var c, d = a.css;
				for (c in d) b.style[c] = d[c]
			}
			if (a.properties.labels)
				for (var e = a.properties.labels, f = 0; f < e.length; f++) $('<a class = "label_content" style = "display: inline-block;">').appendTo($(b)).html(e[f].title).css(e[f].color).css("width", 100 / e.length + "%");
			return b
		}), d.addComponent("2", function(a) {
			var b = document.createElement("div");
			return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_paragraph editable-text"), a.content && (b.innerHTML = a.content), b.style.cursor = "default", b
		}), d.addComponent("3", function(a) {
			var b = $("#nr .edit_area")[0];
			"view" == d.mode && (b = document.getElementById("edit_area" + d.def.id)), b = $(b).parent()[0];
			var c, e = new Image;
			return a.properties.imgSrc && (c = a.properties.imgSrc, /^http.*/.test(c) ? (e.src = c, b.style.backgroundImage = "url(" + c + ")") : (e.src = PREFIX_FILE_HOST + "/" + c, b.style.backgroundImage = "url(" + PREFIX_FILE_HOST + "/" + c + ")"), b.style.backgroundOrigin = "element content-box", b.style.backgroundSize = "cover", b.style.backgroundPosition = "50% 50%"), a.properties.bgColor && (b.style.backgroundColor = a.properties.bgColor), b
		}), d.addComponent("4", function(a) {
			var b = document.createElement("img");
			return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_image editable-image"), /^http.*/.test(a.properties.src) ? b.src = a.properties.src : b.src = PREFIX_FILE_HOST + a.properties.src, b
		}), d.addComponent("v", function(a) {
			var b = document.createElement("a");
			return b.setAttribute("class", "element video_area"), b.id = a.id, b.setAttribute("ctype", a.type), a.properties.src && b.setAttribute("videourl", a.properties.src), b
		}), d.addComponent("5", function(a) {
			var b = document.createElement("textarea");
			return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_input editable-text"), a.properties.required && b.setAttribute("required", a.properties.required), a.properties.placeholder && b.setAttribute("placeholder", a.properties.placeholder), b.setAttribute("name", "eq[f_" + a.id + "]"), b.style.width = "100%", b
		}), d.addComponent("p", function(a) {
			if (a.properties && a.properties.children) {
				var c = 320,
					d = a.css.width || c - parseInt(a.css.left),
					e = a.css.height || d / 2;
				a.css.width = a.css.width || d, a.css.height = a.css.height || e;
				var f = $('<div id="' + a.id + '" class="slider element" ctype="' + a.type + '"></div>');
				return a.properties.bgColor && f.css("backgroundColor", a.properties.bgColor), $.each(a.properties.children, function(a, c) {
					var g = b(c.width, c.height, d, e),
						h = $('<img src="' + PREFIX_FILE_HOST + c.src + '">');
					h.css({
						margin: (e - g.height) / 2 + "px " + (d - g.width) / 2 + "px",
						width: g.width,
						height: g.height
					}), f.append(h)
				}), utilPictures.deleteInterval(a.id), f.get(0)
			}
		}), d.addComponent("6", function(a) {
			var b = document.createElement("button");
			if (b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_button editable-text"), a.properties.title) {
				var c = a.properties.title.replace(/ /g, "&nbsp;");
				b.innerHTML = c
			}
			return b.style.width = "100%", b
		}), d.addComponent("8", function(a) {
			var b = document.createElement("a");
			if (b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_anchor editable-text"), a.properties.title) {
				var c = a.properties.title.replace(/ /g, "&nbsp;");
				$(b).html(c), "view" == d.mode && $(b).attr("href", "tel:" + a.properties.number)
			}
			return b.style.cursor = "default", b.style.width = "100%", b
		}), d.addComponent("r", function (a) {
        var b = document.createElement("a");
        if (b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_anchor editable-text"), a.properties.title) {
            var d = a.properties.title.replace(/ /g, "&nbsp;");
            $(b).html(d), "view" == c.mode && $(b).attr("onclick",  a.properties.number)
        }
        return b.style.cursor = "default", b.style.width = "100%", b
    }),
		 d.addComponent("7", function(a) {
			var b = document.createElement("div");
			if (b.id = "map_" + a.id, b.setAttribute("class", "element comp_map_wrapper"), a.content && (b.textContent = a.content), a.css) {
				var c, d = a.css;
				for (c in d) b.style[c] = d[c]
			}
			return b.style.height = "250px", b
		}), d.bindAfterRenderEvent("1", function(a, b) {
			if (a = $("div", a)[0], "view" == d.mode && 1 == b.type) {
				var c = b.properties.labels;
				for (key in c) ! function(b) {
					$($(a).find(".label_content")[b]).on("click", function() {
						pageScroll(c[b])
					})
				}(key)
			}
		}), d.bindAfterRenderEvent("8", function(a, b) {
			a = $("a", a)[0];
			var c = {
				id: b.sceneId,
				num: b.properties.number
			};
			if ("view" == d.mode) {
				var e = function() {
					$.ajax({
						cache: !0,
						type: "POST",
						url: PREFIX_URL + "eqs/dial",
						data: $.param(c),
						async: !1,
						error: function(a) {
							
						},
						success: function(a) {}
					})
				};
				a.addEventListener("click", e)
			}
		}), d.bindAfterRenderEvent("4", function(a, b) {
			"view" == d.mode && b.properties.url && $(a).click(function(a) {
				{
					var c = b.properties.url;
					isNaN(c) ? window.open(c) : eqxiu.pageScroll(c)
				}
			})
		}), d.bindAfterRenderEvent("v", function(a, b) {
			"view" == d.mode && $(a).click(function() {
				$("#report_btn").hide(), $(a).hide(), $("#audio_btn").hasClass("video_exist") && ($("#audio_btn").hide(), $("#media")[0].pause()), $('<div class="video_mask page_effect lock" id="mask_' + b.id + '"></div>').appendTo($(a).closest(".m-img")), $('<a class = "close_mask" id="close_' + b.id + '"></a>').appendTo($(a).closest(".m-img")), $(b.properties.src).appendTo($("#mask_" + b.id)).attr("style", "position: absolute;top:0; min-height: 45%; max-height: 100%; top: 20%;").attr("width", "100%").removeAttr("height"), $("#close_" + b.id).bind("click", function() {
					$("#report_btn").show(), $(a).show(), $("#mask_" + b.id).remove(), $("#close_" + b.id).remove(), $("#audio_btn").hasClass("video_exist") && $("#audio_btn").show(function() {
						$(this).hasClass("off") || $("#media")[0].play()
					})
				})
			})
		}), d.bindAfterRenderEvent("2", function(a, b) {
			for (var c = $(a).find("a[data]"), e = 0; e < c.length; e++)
				if (c[e] && "view" == d.mode) {
					$(c[e]).css("color", "#428bca").css("cursor", "pointer");
					var f = $(c[e]).attr("data");
					! function(a) {
						$(c[e]).click(function(b) {
							eqxiu.pageScroll(a)
						})
					}(f)
				}
		}), d.bindAfterRenderEvent("7", function(a, b) {
			var c = new BMap.Map("map_" + b.id, {
					enableMapClick: !1
				}),
				d = new BMap.Point(b.properties.x, b.properties.y),
				e = new BMap.Marker(d);
			c.addOverlay(e);
			var f = new BMap.Label(b.properties.markTitle, {
				offset: new BMap.Size(20, -10)
			});
			e.setLabel(f), c.disableDoubleClickZoom(), c.centerAndZoom(d, 15)
		}), d.bindAfterRenderEvent("p", function(a, b) {
			$(a).closest(".page_tpl_container ").length || ($(a).children(".element-box").css("overflow", "visible"), utilPictures.deleteInterval(b.id), new flux.slider("#" + b.id, {
				autoplay: b.properties.autoPlay,
				delay: b.properties.interval,
				pagination: !1,
				transitions: [utilPictures.getPicStyle(b.properties.picStyle).name],
				width: b.css.width,
				height: b.css.height,
				bgColor: b.properties.bgColor,
				onStartEnd: function(a) {
					utilPictures.addInterval(b.id, a)
				}
			}))
		})
	}(window.eqShow);
var tplCount = 0,
	eqxCommon = function() {
		var a = function(a) {
				var b, c, d = a.type;
				return 0 === d && (b = "fadeIn"), 1 === d && (c = a.direction, 0 === c && (b = "fadeInLeft"), 1 === c && (b = "fadeInDown"), 2 === c && (b = "fadeInRight"), 3 === c && (b = "fadeInUp")), 6 === d && (b = "wobble"), 5 === d && (b = "rubberBand"), 7 === d && (b = "rotateIn"), 8 === d && (b = "flip"), 9 === d && (b = "swing"), 2 === d && (c = a.direction, 0 === c && (b = "bounceInLeft"), 1 === c && (b = "bounceInDown"), 2 === c && (b = "bounceInRight"), 3 === c && (b = "bounceInUp")), 3 === d && (b = "bounceIn"), 4 === d && (b = "zoomIn"), 10 === d && (b = "fadeOut"), 11 === d && (b = "flipOutY"), 12 === d && (b = "rollIn"), 13 === d && (b = "lightSpeedIn"), b
			},
			b = function(a, b, c) {
				function d(a, b, f) {
					if (f.length && e < f.length) {
						a.css("animation", "");
						var g = a.get(0);
						g.offsetWidth = g.offsetWidth, a.css("animation", b[e] + " " + f[e].duration + "s ease " + f[e].delay + "s " + (f[e].countNum ? f[e].countNum : "")), "view" == c ? (f[e].count && e == f.length - 1 && a.css("animation-iteration-count", "infinite"), a.css("animation-fill-mode", "both")) : (a.css("animation-iteration-count", "1"), a.css("animation-fill-mode", "backwards")), f[e].linear && a.css("animation-timing-function", "linear"), a.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
							e++, d(a, b, f)
						})
					}
				}
				var e = 0;
				if (b.properties && b.properties.anim) {
					var f = [];
					b.properties.anim.length ? f = b.properties.anim : f.push(b.properties.anim);
					var g = $(".element-box", a);
					g.attr("element-anim", "");
					for (var h, i = [], j = [], k = 0, l = f.length; l > k; k++) null != f[k].type && -1 != f[k].type && (h = eqxCommon.convertType(f[k]), i.push(h), j.push(f[k]));
					b.properties.anim.trigger ? a.click(function() {
						d(g, h, b.properties.anim)
					}) : d(g, i, j)
				}
			};
		return {
			convertType: a,
			animation: b
		}
	}();
! function() {
	window.eqx = {}, window.eqx.money = {
		config: {
			mode: 3,
			effectCallback: "editMoney",
			imageCallback: "countMoney",
			resources: [
			
		            {url: PUBLIC_URL + "countMoney.js", type: "js"},
       			 {url: PUBLIC_URL + "images/money/moneybg.png", type: "image"},
       		 {url: PUBLIC_URL + "images/money/moremoney.png", type: "image"},
      		  {url: PUBLIC_URL + "images/money/flymoney.png", type: "image"},
      		  {url: PUBLIC_URL + "images/money/float.png", type: "image"},
      		  {url: PUBLIC_URL + "images/money/float2.png", type: "image"},
      			  {url: PUBLIC_URL + "images/money/float3.png", type: "image"}
			
			]
		}
	}
}(),
function() {
	function a(a) {
		resources.loaded = !0, a instanceof Array ? a.forEach(function(a) {
			b(a)
		}) : b(a)
	}

	function b(a) {
		if ("loading" != f[a.url]) {
			if (f[a.url]) return f[a.url];
			if (f[a.url] = !1, "image" == a.type) {
				var b = new Image;
				f[a.url] = "loading", b.onload = function() {
					f[a.url] = b, d() && g.forEach(function(a) {
						a()
					})
				}, b.src = a.url
			} else "js" == a.type && (f[a.url] = "loading", $.getScript(a.url, function(b, c, e) {
				f[a.url] = !0, d() && g.forEach(function(a) {
					a()
				})
			}))
		}
	}

	function c(a) {
		return f[a]
	}

	function d() {
		var a = !0;
		for (var b in f)
			if (f.hasOwnProperty(b) && (!f[b] || "loading" == f[b])) return !1;
		return a
	}

	function e(a) {
		g.push(a)
	}
	var f = {},
		g = [];
	window.resources = {
		load: a,
		get: c,
		onReady: e,
		isReady: d
	}
}();
var eqxiu = function() {
	function a(a) {
		n = !0;
		for (var d, f = 0, g = e._pageData.length; g > f; f++) a == e._pageData[f].id && (d = e._pageData[f].num);
		d || (d = a);
		var h = $(e.$currentPage).find(".m-img").attr("id").charAt(4),
			i = $(e.$currentPage).siblings(".main-page").find("#page" + d);
		i && (e.$activePage = $(i).parent(".main-page").get(0), h > d ? b() : d > h && c())
	}

	function b() {
		var a = 0;
		f();
		var b = setInterval(function() {
			a += 2, "0" == e._scrollMode || "1" == e._scrollMode || "2" == e._scrollMode ? s = a : ("3" == e._scrollMode || "4" == e._scrollMode || "5" == e._scrollMode) && (r = a), g(), a >= 21 && (clearInterval(b), h())
		}, 1)
	}

	function c() {
		k = !1;
		var a = 0;
		f();
		var b = setInterval(function() {
			a -= 2, "0" == e._scrollMode || "1" == e._scrollMode || "2" == e._scrollMode ? s = a : ("3" == e._scrollMode || "4" == e._scrollMode || "5" == e._scrollMode) && (r = a), g(), -21 >= a && (clearInterval(b), h())
		}, 1)
	}

	function d() {
		k = !0
	}
	var e, f, g, h, i, j, k, l = $(window),
		m = !0,
		n = !1,
		o = mobilecheck(),
		x = tabletCheck(),
		p = 0,
		q = 0,
		r = 0,
		s = 0,
		t = !1,
		u = !1,
		v = !0,
		w = function(a, b, c, d) {
			function k(a, b, c) {
				for (var d = ["", "webkit", "moz"], e = 0, f = d.length; f > e; e++) {
					0 != e || mobilecheck() || (b = b.substring(0, 1).toLowerCase() + b.substring(1, b.length));
					var g = c instanceof Array ? c[e] : c,
						h = d[e] + b;
					a[h] = g
				}
			}

			function w() {
				return $(e.$currentPage).find(".page_effect.lock").get(0) ? !1 : !0
			}

			function x() {
				if (u)
					if (k(e.$currentPage.style, "Transform", "scale(1)"), "0" == b || "1" == b || "2" == b || "6" == b) {
						var a = s > 0 ? "" : "-";
						k(e.$activePage.style, "Transform", "translateY(" + a + "100%)")
					} else {
						var a = r > 0 ? "" : "-";
						k(e.$activePage.style, "Transform", "translateX(" + a + "100%)")
					}
				setTimeout(function() {
					e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move"), e._isDisableFlipPage = !1
				}, 500)
			}

			function y() {
				if (Math.abs(s) > Math.abs(r) && w())
					if (s > 0) {
						if (e._isDisableFlipPrevPage) return;
						u || v ? (u = !1, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.previousElementSibling && e.$currentPage.previousElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.previousElementSibling : (e.$activePage = e._$pages.last().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateY(-" + window.innerHeight + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateY(-" + window.innerHeight + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateY(-" + window.innerHeight + "px)", $(e.$activePage).trigger("active"), e.$currentPage.style.webkitTransformOrigin = "bottom center", e.$currentPage.style.mozTransformOrigin = "bottom center", e.$currentPage.style.transformOrigin = "bottom center") : (e.$currentPage.style.webkitTransform = "translateY(0px) scale(1)", e.$currentPage.style.mozTransform = "translateY(0px) scale(1)", e.$currentPage.style.transform = "translateY(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateY(-" + (window.innerHeight - s) + "px)", e.$activePage.style.mozTransform = "translateY(-" + (window.innerHeight - s) + "px)", e.$activePage.style.transform = "translateY(-" + (window.innerHeight - s) + "px)", "1" == e._scrollMode && (e.$currentPage.style.webkitTransform = "scale(" + (window.innerHeight / (window.innerHeight + s)).toFixed(3) + ")", e.$currentPage.style.mozTransform = "scale(" + (window.innerHeight / (window.innerHeight + s)).toFixed(3) + ")", e.$currentPage.style.transform = "scale(" + (window.innerHeight / (window.innerHeight + s)).toFixed(3) + ")"))
					} else if (0 > s) {
					if (e._isDisableFlipNextPage) return;
					!u || v ? (u = !0, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.nextElementSibling && e.$currentPage.nextElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.nextElementSibling : (e.$activePage = e._$pages.first().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateY(" + window.innerHeight + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateY(" + window.innerHeight + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateY(" + window.innerHeight + "px)", $(e.$activePage).trigger("active"), e.$currentPage.style.webkitTransformOrigin = "top center", e.$currentPage.style.mozTransformOrigin = "top center", e.$currentPage.style.transformOrigin = "top center") : (e.$currentPage.style.webkitTransform = "translateY(0px) scale(1)", e.$currentPage.style.mozTransform = "translateY(0px) scale(1)", e.$currentPage.style.transform = "translateY(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateY(" + (window.innerHeight + s) + "px)", e.$activePage.style.mozTransform = "translateY(" + (window.innerHeight + s) + "px)", e.$activePage.style.transform = "translateY(" + (window.innerHeight + s) + "px)", "1" == e._scrollMode && (e.$currentPage.style.webkitTransform = "scale(" + ((window.innerHeight + s) / window.innerHeight).toFixed(3) + ")", e.$currentPage.style.mozTransform = "scale(" + ((window.innerHeight + s) / window.innerHeight).toFixed(3) + ")", e.$currentPage.style.transform = "scale(" + ((window.innerHeight + s) / window.innerHeight).toFixed(3) + ")"))
				}
			}

			function z() {
				childTouched = !1, Math.abs(s) > Math.abs(r) && Math.abs(s) > 20 ? ("1" == e._scrollMode ? (e.$currentPage.style.webkitTransform = "scale(0.2)", e.$activePage.style.webkitTransform = "translateY(0px)", e.$currentPage.style.mozTransform = "scale(0.2)", e.$activePage.style.mozTransform = "translateY(0px)", e.$currentPage.style.transform = "scale(0.2)", e.$activePage.style.transform = "translateY(0px)") : (e.$currentPage.style.webkitTransform = "scale(1)", e.$activePage.style.webkitTransform = "translateY(0px)", e.$currentPage.style.mozTransform = "scale(1)", e.$activePage.style.mozTransform = "translateY(0px)", e.$currentPage.style.transform = "scale(1)", e.$activePage.style.transform = "translateY(0px)"), w() || $("#audio_btn").css("opacity", 0), setTimeout(function() {
					$(e.$activePage).removeClass("z-active z-move").addClass("z-current"), $(e.$currentPage).removeClass("z-current z-move"), e._isDisableFlipPage = !1, e.$currentPage = $(e.$activePage).trigger("current"), $(e.$currentPage).trigger("hide")
				}, 500)) : (e._isDisableFlipPage = !1, x())
			}

			function A() {
				if (Math.abs(r) > Math.abs(s) && w())
					if (r > 0) {
						if (e._isDisableFlipPrevPage) return;
						u || v ? (u = !1, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.previousElementSibling && e.$currentPage.previousElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.previousElementSibling : (e.$activePage = e._$pages.last().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateX(-" + window.innerWidth + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateX(-" + window.innerWidth + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateX(-" + window.innerWidth + "px)", $(e.$activePage).trigger("active"), e.$currentPage.style.webkitTransformOrigin = "center right", e.$currentPage.style.mozTransformOrigin = "center right", e.$currentPage.style.transformOrigin = "center right") : (e.$currentPage.style.webkitTransform = "translateX(0px) scale(1)", e.$currentPage.style.mozTransform = "translateX(0px) scale(1)", e.$currentPage.style.transform = "translateX(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateX(-" + (window.innerWidth - r) + "px)", e.$activePage.style.mozTransform = "translateX(-" + (window.innerWidth - r) + "px)", e.$activePage.style.transform = "translateX(-" + (window.innerWidth - r) + "px)", "3" == e._scrollMode && (e.$currentPage.style.webkitTransform = "scale(" + (window.innerWidth / (window.innerWidth + r)).toFixed(3) + ")", e.$currentPage.style.mozTransform = "scale(" + (window.innerWidth / (window.innerWidth + r)).toFixed(3) + ")", e.$currentPage.style.transform = "scale(" + (window.innerWidth / (window.innerWidth + r)).toFixed(3) + ")"))
					} else if (0 > r) {
					if (e._isDisableFlipNextPage) return;
					!u || v ? (u = !0, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.nextElementSibling && e.$currentPage.nextElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.nextElementSibling : (e.$activePage = e._$pages.first().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateX(" + window.innerWidth + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateX(" + window.innerWidth + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateX(" + window.innerWidth + "px)", $(e.$activePage).trigger("active"), e.$currentPage.style.webkitTransformOrigin = "center left", e.$currentPage.style.mozTransformOrigin = "center left", e.$currentPage.style.transformOrigin = "center left") : (e.$currentPage.style.webkitTransform = "translateX(0px) scale(1)", e.$currentPage.style.mozTransform = "translateX(0px) scale(1)", e.$currentPage.style.transform = "translateX(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateX(" + (window.innerWidth + r) + "px)", e.$activePage.style.mozTransform = "translateX(" + (window.innerWidth + r) + "px)", e.$activePage.style.transform = "translateX(" + (window.innerWidth + r) + "px)", "3" == e._scrollMode && (e.$currentPage.style.webkitTransform = "scale(" + ((window.innerWidth + r) / window.innerWidth).toFixed(3) + ")", e.$currentPage.style.mozTransform = "scale(" + ((window.innerWidth + r) / window.innerWidth).toFixed(3) + ")", e.$currentPage.style.transform = "scale(" + ((window.innerWidth + r) / window.innerWidth).toFixed(3) + ")"))
				}
			}

			function B() {
				childTouched = !1, Math.abs(r) > Math.abs(s) && Math.abs(r) > 20 ? ("3" == e._scrollMode ? (e.$currentPage.style.webkitTransform = "scale(0.2)", e.$activePage.style.webkitTransform = "translateX(0px)", e.$currentPage.style.mozTransform = "scale(0.2)", e.$activePage.style.mozTransform = "translateX(0px)", e.$currentPage.style.transform = "scale(0.2)", e.$activePage.style.transform = "translateX(0px)") : (e.$currentPage.style.webkitTransform = "scale(1)", e.$activePage.style.webkitTransform = "translateX(0px)", e.$currentPage.style.mozTransform = "scale(1)", e.$activePage.style.mozTransform = "translateX(0px)", e.$currentPage.style.transform = "scale(1)", e.$activePage.style.transform = "translateX(0px)"), w() || $("#audio_btn").css("opacity", 0), setTimeout(function() {
					$(e.$activePage).removeClass("z-active z-move").addClass("z-current"), $(e.$currentPage).removeClass("z-current z-move"), e._isDisableFlipPage = !1, e.$currentPage = $(e.$activePage).trigger("current"), $(e.$currentPage).trigger("hide")
				}, 500)) : (e._isDisableFlipPage = !1, x())
			}

			function C() {
				if (Math.abs(r) > Math.abs(s) && w())
					if (r > 0) {
						if (e._isDisableFlipPrevPage) return;
						u || v ? (u = !1, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.previousElementSibling && e.$currentPage.previousElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.previousElementSibling : (e.$activePage = e._$pages.last().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateX(-" + i + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateX(-" + i + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateX(-" + i + "px)", $(e.$activePage).trigger("active")) : (e.$currentPage.style.webkitTransform = "translateX(0px) scale(1)", e.$currentPage.style.mozTransform = "translateX(0px) scale(1)", e.$currentPage.style.transform = "translateX(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateX(-" + (i - r) + "px)", e.$activePage.style.mozTransform = "translateX(-" + (i - r) + "px)", e.$activePage.style.transform = "translateX(-" + (i - r) + "px)", e.$currentPage.style.webkitTransform = "translateX(" + r + "px)", e.$currentPage.style.mozTransform = "translateX(" + r + "px)", e.$currentPage.style.transform = "translateX(" + r + "px)")
					} else if (0 > r) {
					if (e._isDisableFlipNextPage) return;
					!u || v ? (u = !0, v = !1, e.$activePage && (e.$activePage.classList.remove("z-active"), e.$activePage.classList.remove("z-move")), n ? m = !0 : e.$currentPage.nextElementSibling && e.$currentPage.nextElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.nextElementSibling : (e.$activePage = e._$pages.first().get(0), m = !0), e.$activePage && e.$activePage.classList.contains("main-page") ? (e.$activePage.classList.add("z-active"), e.$activePage.classList.add("z-move"), e.$activePage.style.webkitTransition = "none", e.$activePage.style.webkitTransform = "translateX(-" + i + "px)", e.$activePage.style.mozTransition = "none", e.$activePage.style.mozTransform = "translateX(-" + i + "px)", e.$activePage.style.transition = "none", e.$activePage.style.transform = "translateX(-" + i + "px)", $(e.$activePage).trigger("active")) : (e.$currentPage.style.webkitTransform = "translateX(0px) scale(1)", e.$currentPage.style.mozTransform = "translateX(0px) scale(1)", e.$currentPage.style.transform = "translateX(0px) scale(1)", e.$activePage = null)) : (e.$activePage.style.webkitTransform = "translateX(" + (i + r) + "px)", e.$activePage.style.mozTransform = "translateX(" + (i + r) + "px)", e.$activePage.style.transform = "translateX(" + (i + r) + "px)", e.$currentPage.style.webkitTransform = "translateX(" + r + "px)", e.$currentPage.style.mozTransform = "translateX(" + r + "px)", e.$currentPage.style.transform = "translateX(" + r + "px)")
				}
			}

			function D() {
				childTouched = !1, Math.abs(r) > Math.abs(s) && Math.abs(r) > 20 ? (r > 0 ? (e.$currentPage.style.webkitTransform = "translateX(" + i + "px)", e.$currentPage.style.mozTransform = "translateX(" + i + "px)", e.$currentPage.style.transform = "translateX(" + i + "px)") : (e.$currentPage.style.webkitTransform = "translateX(-" + i + "px)", e.$currentPage.style.mozTransform = "translateX(-" + i + "px)", e.$currentPage.style.transform = "translateX(-" + i + "px)"), e.$activePage.style.webkitTransform = "translateX(0px)", e.$activePage.style.mozTransform = "translateX(0px)", e.$activePage.style.transform = "translateX(0px)", w() || $("#audio_btn").css("opacity", 0), setTimeout(function() {
					$(e.$activePage).removeClass("z-active z-move").addClass("z-current"), $(e.$currentPage).removeClass("z-current z-move"), e._isDisableFlipPage = !1, e.$currentPage = $(e.$activePage).trigger("current"), $(e.$currentPage).trigger("hide")
				}, 500)) : (e._isDisableFlipPage = !1, x())
			}

			function E() {
				if (Math.abs(s) > Math.abs(r) && w())
					if (s > 0) {
						if (e._isDisableFlipNextPage) return;
						!u || v ? (u = !0, v = !1, e.$activePage && $(e.$activePage).removeClass("z-move z-active"), n ? m = !0 : e.$currentPage.previousElementSibling && e.$currentPage.previousElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.previousElementSibling : (e.$activePage = e._$pages.last().get(0), m = !0), k(e.$activePage.style, "Transform", "rotateX(90deg) translateY(-" + window.innerHeight / 2 + "px) translateZ(" + window.innerHeight / 2 + "px)"), k($("#con")[0].style, "Perspective", "700px"), k($("#con")[0].style, "TransformStyle", "preserve-3d")) : m = !0, e.$activePage && e.$activePage.classList.contains("main-page") && ($(e.$activePage).addClass("z-active z-move").trigger("active").css("zIndex", 1), k(e.$currentPage.style, "Transform", "rotateX(-" + s / window.innerHeight * 90 + "deg) translateY(" + s / 2 + "px) translateZ(" + s / 2 + "px)"), k(e.$activePage.style, "Transform", "rotateX(" + (90 - s / window.innerHeight * 90) + "deg) translateY(" + (-(window.innerHeight / 2) + s / 2) + "px) translateZ(" + (window.innerHeight / 2 - s / 2) + "px)"))
					} else if (0 > s) {
					if (e._isDisableFlipNextPage) return;
					!u || v ? (u = !0, v = !1, e.$activePage && $(e.$activePage).removeClass("z-move z-active"), n ? m = !0 : e.$currentPage.nextElementSibling && e.$currentPage.nextElementSibling.classList.contains("main-page") ? e.$activePage = e.$currentPage.nextElementSibling : (e.$activePage = e._$pages.first().get(0), m = !0), k(e.$activePage.style, "Transform", "rotateX(-90deg) translateY(-" + window.innerHeight / 2 + ") translateZ(-" + window.innerHeight / 2 + "px)"), k($("#con")[0].style, "Perspective", "700px"), k($("#con")[0].style, "TransformStyle", "preserve-3d")) : m = !0, e.$activePage && e.$activePage.classList.contains("main-page") ? ($(e.$activePage).addClass("z-active z-move").trigger("active").css("zIndex", 0), k(e.$currentPage.style, "Transform", "rotateX(" + -s / window.innerHeight * 90 + "deg) translateY(" + s / 2 + "px) translateZ(" + -s / 2 + "px)"), k(e.$activePage.style, "Transform", "rotateX(" + (-90 - s / window.innerHeight * 90) + "deg) translateY(" + (window.innerHeight / 2 + s / 2) + "px) translateZ(" + (window.innerHeight / 2 + s / 2) + "px)")) : (k(e.$currentPage.style, "Transform", "translateX(0px) scale(1)"), e.$activePage = null)
				}
			}

			function F() {
				Math.abs(s) > Math.abs(r) && Math.abs(s) > 20 ? (s > 0 ? (k(e.$currentPage.style, "Transform", "rotateX(-90deg) translateY(" + window.innerHeight / 2 + "px) translateZ(" + window.innerHeight / 2 + "px)"), k(e.$currentPage.style, "zIndex", "0"), k(e.$activePage.style, "Transform", "rotateX(0deg) translateY(0px) translateZ(0px)"), k(e.$activePage.style, "zIndex", "2")) : (k(e.$currentPage.style, "Transform", "rotateX(90deg) translateY(-" + window.innerHeight / 2 + "px) translateZ(" + window.innerHeight / 2 + "px)"), k(e.$currentPage.style, "zIndex", "0"), k(e.$activePage.style, "Transform", "rotateX(0deg) translateY(0px) translateZ(0px)"), k(e.$activePage.style, "zIndex", "2")), w() || $("#audio_btn").css("opacity", 0), setTimeout(function() {
					k(e.$currentPage.style, "Transition", "none"), $(e.$activePage).removeClass("z-active z-move").addClass("z-current"), $(e.$currentPage).removeClass("z-current z-move"), e._isDisableFlipPage = !1, e.$currentPage = $(e.$activePage).trigger("current"), $(e.$currentPage).trigger("hide")
				}, 500)) : (k(e.$currentPage.style, "Transition", "none"), k(e.$activePage.style, "Transition", "none"), e._isDisableFlipPage = !1, x())
			}
			this._$app = a, this._$pages = this._$app.find(".main-page"), this.$currentPage = this._$pages.eq(0), this.$activePage = null, this._isFirstShowPage = !0, this._isInitComplete = !1, this._isDisableFlipPage = !1, this._isDisableFlipPrevPage = !1, this._isDisableFlipNextPage = !1, this._scrollMode = b, this._pageData = c, this.pageData = d, b = b, e = this, i = o || x ? window.innerWidth : $(".nr").width(), j = o || x ? window.innerHeight : $(".nr").height(),
				function() {
					l.on("scroll.elasticity", function(a) {
						a.preventDefault()
					}).on("touchmove.elasticity", function(a) {
						a.preventDefault()
					}), l.delegate("img", "mousemove", function(a) {
						a.preventDefault()
					})
				}(), e._$app.on("mousedown touchstart", function(a) {
					f(a)
				}).on("mousemove touchmove", function(a) {
					g(a)
				}).on("mouseup touchend mouseleave", function(a) {
					h(a)
				});
			var G = !1;
			f = function(a) {
				G = !1, o && a && (a = event), e._isDisableFlipPage || (e.$currentPage = e._$pages.filter(".z-current").get(0), n || (e.$activePage = null), e.$currentPage && w() && (t = !0, u = !1, v = !0, r = 0, s = 0, a && "mousedown" == a.type ? (p = a.pageX, q = a.pageY) : a && "touchstart" == a.type && (p = a.touches[0].pageX, q = a.touches[0].pageY), e.$currentPage.classList.add("z-move"), k(e.$currentPage.style, "Transition", "none")))
			}, g = function(a) {
				if (o && a && (a = event), t && e._$pages.length > 1) {
					if (a && "mousemove" == a.type ? (r = a.pageX - p, s = a.pageY - q) : a && "touchmove" == a.type && (r = a.touches[0].pageX - p, s = a.touches[0].pageY - q), !G && (Math.abs(r) > 20 || Math.abs(s) > 20)) {
						if (e.$activePage) {
							var d = $(e.$activePage).find(".m-img").attr("id").charAt(4);
							$(e.$activePage).find("li").each(function(a) {
								for (var b = 0; b < e._pageData[d - 1].elements.length; b++) e._pageData[d - 1].elements[b].id == parseInt($(this).attr("id").substring(7), 10) && eqxCommon.animation($(this), c[d - 1].elements[b], "view")
							})
						}
						G = !0
					}
					"0" == b || "2" == b || "1" == b ? y() : "4" == b || "3" == b ? A() : "5" == b ? C() : "6" == b && E()
				}
			}, h = function(a) {
				t && w() && (t = !1, e.$activePage ? (e._isDisableFlipPage = !0, e.$currentPage.style.webkitTransition = "-webkit-transform .4s linear", e.$activePage.style.webkitTransition = "-webkit-transform .4s linear", e.$currentPage.style.mozTransition = "-moz-transform .4s linear", e.$activePage.style.mozTransition = "-moz-transform .4s linear", e.$currentPage.style.transition = "transform .4s linear", e.$activePage.style.transition = "transform .4s linear", "0" == b || "2" == b || "1" == b ? z() : "4" == b || "3" == b ? B() : "5" == b ? D() : "6" == b && F()) : e.$currentPage.classList.remove("z-move")), n = !1
			}
		};
	return {
		pageScroll: a,
		nextPage: c,
		prePage: b,
		app: w,
		setEndCount: d
	}
}();
! function($) {
	function bindWeixin() {
		function a() {
			WeixinJSBridge.invoke("sendAppMessage", {
				appid: e,
				img_url: imgUrl,
				img_width: "200",
				img_height: "200",
				link: d,
				url: d,
				desc: descContent,
				title: shareTitle
			}, function(a) {})
		}

		function b() {
			WeixinJSBridge.invoke("shareTimeline", {
				img_url: imgUrl,
				img_width: "200",
				img_height: "200",
				url: d,
				link: d,
				desc: descContent,
				title: shareTitle
			}, function(a) {})
		}

		function c() {
			WeixinJSBridge.invoke("shareWeibo", {
				content: descContent,
				url: d
			}, function(a) {})
		}
		imgUrl = "", descContent = "", shareTitle = "";
		var d = window.location.href,
			e = "";
		document.addEventListener("WeixinJSBridgeReady", function() {
			WeixinJSBridge.on("menu:share:appmessage", function(b) {
				a()
			}), WeixinJSBridge.on("menu:share:timeline", function(a) {
				b()
			}), WeixinJSBridge.on("menu:share:weibo", function(a) {
				c()
			}), $("#media").get(0).play()
		}, !1)
	}

	function getRequestUrl() {
		var a;
		return preview ? (a = PREFIX_URL + "controller/?controller=Show&method=view&id=" + sceneId + "&preview=preview", branchid && (a += (/\?/.test(a) ? "&" : "?") + "user=" + branchid)) : a = mobileview ? PREFIX_URL + "controller/?controller=Show&method=view&id=" + sceneId : PREFIX_URL + "controller/?controller=Show&method=view&id=" + sceneId, a += (/\?/.test(a) ? "&" : "?") + "time=" + (new Date).getTime()
		
	}

	function bindShare(data) {
		if (mobilecheck() || tabletCheck()) isWeixin() && (imgUrl = PREFIX_FILE_HOST + data.obj.image.imgSrc, shareTitle = data.obj.name, descContent = data.obj.description, descContent || (descContent = ""));
		else with(window._bd_share_config = {
			common: {
				bdSnsKey: {},
				bdText: data.obj.name,
				bdSign: "on",
				bdSnsKey: {},
				bdDesc: data.obj.name,
				bdUrl: PREFIX_URL + "v-" + sceneId,
				bdStyle: "0",
				bdSize: "32"
			},
			share: {}
		}, document) 0[(getElementsByTagName("head")[0] || body).appendChild(createElement("script")).src = "http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=" + ~(-new Date / 36e5)]
	}


	function parsePage(a, b) {
		for (var c = [], d = !1, e = b.obj.image, f = 1; f <= a.length; f++)
			if ($('<section class="main-page" ><div class="m-img" id="page' + f + '"></div></section>').appendTo(".nr"), a.length > 1 && (0 == pageMode || 1 == pageMode || 2 == pageMode ? $('<section class="u-arrow-bottom"><img src="' + PUBLIC_URL + 'images/btn01_arrow.png" /></section>').appendTo("#page" + f) : (3 == pageMode || 4 == pageMode || 5 == pageMode) && $('<section class="u-arrow-right"><img src="' + PUBLIC_URL + 'images/btn01_arrow_right.png" /></section>').appendTo("#page" + f)), 1 == f && ($(".loading").hide(), $(".main-page").eq(0).addClass("z-current")), a[f - 1].properties && !$.isEmptyObject(a[f - 1].properties) ? a[f - 1].properties.image || a[f - 1].properties.scratch ? scriptLoaded.scratch ? addScratchEffect(a, f) : ! function(b) {
				$.getScript(PUBLIC_URL + "/js/scratch_effect.js", function(c, d, f) {
					scriptLoaded.scratch = !0, addScratchEffect(e, a, b)
				})
			}(f) : a[f - 1].properties.finger ? (c.push({
				num: f,
				finger: a[f - 1].properties.finger
			}), d || (d = !0, $.getScript(PUBLIC_URL + "/js/lock_effect.js", function(b, d, f) {
				test(e, a, c, $(".m-img").width(), $(".m-img").height())
			}))) : a[f - 1].properties.fallingObject ? scriptLoaded.fallingObject ? fallingObject(a, f) : ! function(b) {
				$.getScript(PUBLIC_URL + "/js/falling_object.js", function(c, d, f) {
					scriptLoaded.fallingObject = !0, fallingObject(a, b), 1 == b && playVideo(e)
				})
			}(f) : a[f - 1].properties.effect ? ! function(b) {
				resources.load(window.eqx[a[b - 1].properties.effect.name].config.resources), resources.onReady(function() {
					window[a[b - 1].properties.effect.name].doEffect(e, b, a, renderPage)
				})
			}(f) : renderPage(eqShow, f, a) : (renderPage(eqShow, f, a), 1 == f && playVideo(e)), f == a.length) {
				{
					eqxiu.app($(".nr"), b.obj.pageMode, a, b)
				}
				if ($("img").on("dragstart", function(a) {
					a.preventDefault()
				}), !preview) {
					var g = PREFIX_URL + "controller/?controller=Show&method=addpv&id=" + b.obj.id;
					param && (g += "?1=1", g += /\?.*/.test(param) ? "&" + param.substring(1) : /\&.*/.test(param) ? param : "&" + param), g += (/\?/.test(g) ? "&" : "?") + "ad=" + ad, $.ajax({
						type: "GET",
						url: g,
						xhrFields: {
							withCredentials: !0
						},
						crossDomain: !0
					})
				}
			}
	}

	function appendLastPage(a, b) { 
		var c = '{"id":"","sceneId":"","num":2,"name":null,"properties":null,"elements":[{"id":439880,"pageId":129810,"sceneId":16060,"num":0,"type":"3","isInput":0,"title":null,"content":null,"status":1,"css":{},"properties":{"imgSrc":""}},{"id":439881,"pageId":129810,"sceneId":16060,"num":1,"type":"2","isInput":0,"title":null,"content":"<div style=\\"text-align: center;\\"><span style=\\"line-height: 1; background-color: initial;\\"><font size=\\"4\\" color=\\"#fff\\"><b>场景名称</b></font></span></div>","status":1,"css":{"height":"36","zIndex":"10","width":"320","left":"0px","top":"77px"},"properties":{}},{"id":439882,"pageId":129810,"sceneId":16060,"num":1,"type":"4","isInput":0,"title":null,"content":null,"status":1,"css":{"borderRadius":"10px","borderStyle":"solid","zIndex":"9","borderColor":"rgba(0,0,0,1)","paddingTop":"0px","height":"141","backgroundColor":"","color":"","boxShadow":"0px 0px 0px #333333","borderWidth":"0px","width":"142.13709677419354","left":"92px","paddingBottom":"0px","top":"177px"},"properties":{"height":"100px","imgStyle":{"width":142,"height":142,"marginTop":"-0.5px","marginLeft":"0px"},"width":"100px","src":""}},{"id":439883,"pageId":129810,"sceneId":16060,"num":1,"type":"4","isInput":0,"title":null,"content":null,"status":1,"css":{"height":"16","zIndex":"11","width":"280","left":"21px","top":"130px"},"properties":{"height":"100px","imgStyle":{"width":280,"height":73,"marginTop":"-24px","marginLeft":"0px"},"width":"100px","src":"' + PUBLIC_URL + 'images/line.png"}},{"content":"<div></div>","css":{"top":"420px","left":"20px","zIndex":"101"},"id":672,"num":1,"pageId":155671,"properties":[],"sceneId":267236,"title":null,"type":2}]}', d = '{"id":480292,"pageId":136042,"sceneId":16060,"num":1,"type":"2","isInput":0,"title":null,"content":"<div style=\\"text-align: center;transform: none;-webkit-animation: fadeIn 2s ease 1s both;-webkit-animation-play-state: initial;\\"><a href=\\"\\" style=\\"font-size: x-small;display:block;line-height: 10px;\\"><font color=\\"#ffffff\\"></font></a></div>","status":1,"css":{"zIndex":"1000","height":"20","width":"129","left":"97px","top":"418px","backgroundColor":"rgba(0,0,0,0.6)","borderRadius":"20px"},"properties":{"anim":{"type":0,"direction":0,"duration":2,"delay":"0"}}}',
			e = '{"id":81395,"pageId":"","sceneId":"","num":1,"type":"4","isInput":0,"title":null,"content":null,"status":1,"css":{"borderRadius":"%","borderStyle":"solid","height":"136","zIndex":"1000","paddingTop":"0px","borderColor":"rgba(0,0,0,1)","boxShadow":"0 0px 0px #333333","color":"#000000","backgroundColor":"rgba(0,0,0,0)","borderWidth":"0px","width":"143","left":"93px","paddingBottom":"0px","top":"182px"},"properties":{"height":"100px","imgStyle":{"width":139,"height":136,"marginTop":"0px","marginLeft":"0px"},"width":"100px","src":"group1/M00/01/30/yq0JCFQpOR-AOULFAAFBPO1yzBQ984.jpg"}}',
			f = '{"id":81465,"pageId":"","sceneId":"","num":1,"type":"2","isInput":0,"title":null,"content":"<div style=\\"text-align: center;\\"><font color=\\"#ffffff\\" size=\\"3\\">击此处进行编辑</font></div>","status":1,"css":{"zIndex":"102","height":"36","width":"320","left":"0px","top":"70px"},"properties":{}}';
		if ((a.obj.createTime > 14165028e5) && (1== IS_SHOW))
			if (a.obj.image.hideEqAd) parsePage(b, a);
			else if (a.obj.image.isAdvancedUser) {
			ad = 2;
			var g = function() {
				var c = b[b.length - 1].elements;
				d = d.replace(/id=16060/, "id=" + a.obj.id), c || (c = []), c.push(JSON.parse(d)), parsePage(b, a)
			};
			a.obj.property && a.obj.property.bottomLabel && a.obj.property.bottomLabel.id ? $.ajax({
				type: "GET",
				url: PREFIX_URL + "eqs/pageTpl/" + a.obj.property.bottomLabel.id,
				xhrFields: {
					withCredentials: !0
				},
				crossDomain: !0,
				success: function(c) {
					if (!c.obj) return void g();
					var d = c.obj.elements,
						e = 0;
					for (d.length; e < d.length; e++) {
						var f = d[e];
						if (f.sceneId = a.obj.id, f.pageId = b[b.length - 1].id, a.obj.property.bottomLabel.name && a.obj.property.bottomLabel.url && "http://" != a.obj.property.bottomLabel.url) 2 == f.type && f.content.indexOf("科技公司") > 0 && (f.content = f.content.replace(/科技公司/, '<a href="' + PREFIX_URL + "main-jumpgo?url=" + encodeURIComponent(a.obj.property.bottomLabel.url) + '" target=_blank>' + a.obj.property.bottomLabel.name + "</a>"));
						else if (a.obj.property.bottomLabel.name) 2 == f.type && f.content.indexOf("科技公司") > 0 && (f.content = f.content.replace(/科技公司/, a.obj.property.bottomLabel.name));
						else if (/技术支持/.test(f.content)) {
							f.content = '<div style="text-align: center;">' + f.content + "</div>";
							var h = {
								zIndex: "1000",
								height: "33",
								width: "129",
								left: "97px"
							};
							$.extend(f.css, h)
						} else 2 == f.type && f.content && (f.content = "");
						a.list[a.list.length - 1].elements.push(f), customLastPage = !0
					}
					parsePage(b, a)
				}
			}) : g()
		} 
		else {
			c = c.replace(/id=16060/, "id=" + a.obj.id);
			var h = JSON.parse(c);
			h.num = a.list.length + 1, h.elements[2].properties.src = a.obj.image.imgSrc, h.elements[1].content = h.elements[1].content.replace(/场景名称/, a.obj.name), a.list.push(h), parsePage(b, a)
		} else parsePage(b, a)
	}
	var url, preview, mobileview, pageMode, branchid, ad = 0,
		customLastPage = !1,
		scriptLoaded = {};
   url = /[http|https]:\/\/.*\/v-/.test(window.location.href) ? window.location.href.split("/v-")[1] : window.location.href.split("id=")[1];
	var sceneId = url.split("#")[0].split("&")[0].split("?")[0],
		param = url.split(sceneId)[1];
	if (param.indexOf("preview=preview") > 0 && (preview = !0), param.indexOf("branchid=") > 0 && (branchid = param.substring(param.indexOf("branchid=") + 9)), param.indexOf("mobileview=mobileview") > 0 && (mobileview = !0), !(mobilecheck() || tabletCheck() && window == window.top)) {
			addElmentsForPc = function(a) {
				var b = document.getElementsByTagName("head")[0],
					c = document.createElement("link");
				c.href = PUBLIC_URL + "css/pcviewer.css", c.rel = "stylesheet", b.appendChild(c), window != window.top ? $("body").css("background-image", "none") : ($.getScript(PUBLIC_URL + "js/qrcode.js", function() {
					$.getScript(PUBLIC_URL + "js/jquery.qrcode.js", function() {
						$("#con").before('<div id="code"><div style="text-align: center;background:#fff;padding: 10px;" id="codeImg"></div><div style="text-align:center">扫一扫，分享给朋友！</div><div id="view_share" class="bdsharebuttonbox"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_more" data-cmd="more"></a></div><div class="newlink">场景链接：<input value="' + PREFIX_URL + "addons/show.php?method=preview&id=" + a + '"></div><a id="view_reg" target="_blank" href="'+PREFIX_URL+'hcc/main.html" style="color:#fff;">我要制作</a></div>'),$("#codeImg").qrcode({
								render: "canvas",
								width: 200,
								height: 200,
								text: PREFIX_URL + "addons/show.php?method=preview&id=" + a
							})
					})
				}), $(".p-index").wrap('<div class = "phone_panel"></div>'), $('<div class = "ctrl_panel"></div>').appendTo($(".phone_panel")), setTimeout(function() {
					window.scene && 100 == window.scene.bizType ? ($(".phone_menubar").addClass("hypefolio"), $('<a id = "pre_page" type = "button" class = "pre_btn btn" onclick = "eqxiu.prePage()">\n    <span style="transform: rotateZ(90deg);display: inline-block;font-size: 36px;">&lt;</span>\n</a>').prependTo($(".ctrl_panel")), $('<a id = "next_page" type = "button" class = "next_btn btn" onclick = "eqxiu.nextPage()">\n    <span style="transform: rotateZ(90deg);display: inline-block;font-size: 36px;margin-top: 5px;">&gt;</span>\n</a>').appendTo($(".ctrl_panel"))) : ($('<a id = "pre_page" type = "button" class = "pre_btn btn" onclick = "eqxiu.prePage()">上一页</a>').prependTo($(".ctrl_panel")), $('<a id = "next_page" type = "button" class = "next_btn btn" onclick = "eqxiu.nextPage()">下一页</a>').appendTo($(".ctrl_panel")))
				}, 100))
			};
		addElmentsForPc(sceneId)
	}
	var requestUrl = getRequestUrl();
	jQuery.support.cors = !0, $.ajax({
		type: "GET",
		url: requestUrl,
		dataType: "json",
		xhrFields: {
			withCredentials: !0
		},
		crossDomain: !0,
		success: function(a) {
			if(a.success==true){
				document.title = a.obj.name, $("#metaDescription").attr("content", a.obj.name + ", " + a.obj.description), $(".scene_title").html(a.obj.name), pageMode = a.obj.pageMode;
				var b = [];
				return a.obj.property && (a.obj.property = JSON.parse(a.obj.property)), b = a.list, b.length <= 0 ? (alert("此场景不存在!"), void(window.location.href = PREFIX_URL)) : (appendLastPage(a, b), void bindShare(a))
			}
		}
	})
	
	var imgUrl, descContent, shareTitle
}(jQuery), $(".main").show(), $.easing.jswing = $.easing.swing, $.extend($.easing, {
	def: "easeOutQuad",
	swing: function(a, b, c, d, e) {
		return $.easing[$.easing.def](a, b, c, d, e)
	},
	easeInQuad: function(a, b, c, d, e) {
		return d * (b /= e) * b + c
	},
	easeOutQuad: function(a, b, c, d, e) {
		return -d * (b /= e) * (b - 2) + c
	},
	easeInOutQuad: function(a, b, c, d, e) {
		return (b /= e / 2) < 1 ? d / 2 * b * b + c : -d / 2 * (--b * (b - 2) - 1) + c
	},
	easeInCubic: function(a, b, c, d, e) {
		return d * (b /= e) * b * b + c
	},
	easeOutCubic: function(a, b, c, d, e) {
		return d * ((b = b / e - 1) * b * b + 1) + c
	},
	easeInOutCubic: function(a, b, c, d, e) {
		return (b /= e / 2) < 1 ? d / 2 * b * b * b + c : d / 2 * ((b -= 2) * b * b + 2) + c
	},
	easeInQuart: function(a, b, c, d, e) {
		return d * (b /= e) * b * b * b + c
	},
	easeOutQuart: function(a, b, c, d, e) {
		return -d * ((b = b / e - 1) * b * b * b - 1) + c
	},
	easeInOutQuart: function(a, b, c, d, e) {
		return (b /= e / 2) < 1 ? d / 2 * b * b * b * b + c : -d / 2 * ((b -= 2) * b * b * b - 2) + c
	},
	easeInQuint: function(a, b, c, d, e) {
		return d * (b /= e) * b * b * b * b + c
	},
	easeOutQuint: function(a, b, c, d, e) {
		return d * ((b = b / e - 1) * b * b * b * b + 1) + c
	},
	easeInOutQuint: function(a, b, c, d, e) {
		return (b /= e / 2) < 1 ? d / 2 * b * b * b * b * b + c : d / 2 * ((b -= 2) * b * b * b * b + 2) + c
	},
	easeInSine: function(a, b, c, d, e) {
		return -d * Math.cos(b / e * (Math.PI / 2)) + d + c
	},
	easeOutSine: function(a, b, c, d, e) {
		return d * Math.sin(b / e * (Math.PI / 2)) + c
	},
	easeInOutSine: function(a, b, c, d, e) {
		return -d / 2 * (Math.cos(Math.PI * b / e) - 1) + c
	},
	easeInExpo: function(a, b, c, d, e) {
		return 0 == b ? c : d * Math.pow(2, 10 * (b / e - 1)) + c
	},
	easeOutExpo: function(a, b, c, d, e) {
		return b == e ? c + d : d * (-Math.pow(2, -10 * b / e) + 1) + c
	},
	easeInOutExpo: function(a, b, c, d, e) {
		return 0 == b ? c : b == e ? c + d : (b /= e / 2) < 1 ? d / 2 * Math.pow(2, 10 * (b - 1)) + c : d / 2 * (-Math.pow(2, -10 * --b) + 2) + c
	},
	easeInCirc: function(a, b, c, d, e) {
		return -d * (Math.sqrt(1 - (b /= e) * b) - 1) + c
	},
	easeOutCirc: function(a, b, c, d, e) {
		return d * Math.sqrt(1 - (b = b / e - 1) * b) + c
	},
	easeInOutCirc: function(a, b, c, d, e) {
		return (b /= e / 2) < 1 ? -d / 2 * (Math.sqrt(1 - b * b) - 1) + c : d / 2 * (Math.sqrt(1 - (b -= 2) * b) + 1) + c
	},
	easeInElastic: function(a, b, c, d, e) {
		var f = 1.70158,
			g = 0,
			h = d;
		if (0 == b) return c;
		if (1 == (b /= e)) return c + d;
		if (g || (g = .3 * e), h < Math.abs(d)) {
			h = d;
			var f = g / 4
		} else var f = g / (2 * Math.PI) * Math.asin(d / h);
		return -(h * Math.pow(2, 10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g)) + c
	},
	easeOutElastic: function(a, b, c, d, e) {
		var f = 1.70158,
			g = 0,
			h = d;
		if (0 == b) return c;
		if (1 == (b /= e)) return c + d;
		if (g || (g = .3 * e), h < Math.abs(d)) {
			h = d;
			var f = g / 4
		} else var f = g / (2 * Math.PI) * Math.asin(d / h);
		return h * Math.pow(2, -10 * b) * Math.sin(2 * (b * e - f) * Math.PI / g) + d + c
	},
	easeInOutElastic: function(a, b, c, d, e) {
		var f = 1.70158,
			g = 0,
			h = d;
		if (0 == b) return c;
		if (2 == (b /= e / 2)) return c + d;
		if (g || (g = .3 * e * 1.5), h < Math.abs(d)) {
			h = d;
			var f = g / 4
		} else var f = g / (2 * Math.PI) * Math.asin(d / h);
		return 1 > b ? -.5 * h * Math.pow(2, 10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g) + c : h * Math.pow(2, -10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g) * .5 + d + c
	},
	easeInBack: function(a, b, c, d, e, f) {
		return void 0 == f && (f = 1.70158), d * (b /= e) * b * ((f + 1) * b - f) + c
	},
	easeOutBack: function(a, b, c, d, e, f) {
		return void 0 == f && (f = 1.70158), d * ((b = b / e - 1) * b * ((f + 1) * b + f) + 1) + c
	},
	easeInOutBack: function(a, b, c, d, e, f) {
		return void 0 == f && (f = 1.70158), (b /= e / 2) < 1 ? d / 2 * b * b * (((f *= 1.525) + 1) * b - f) + c : d / 2 * ((b -= 2) * b * (((f *= 1.525) + 1) * b + f) + 2) + c
	},
	easeInBounce: function(a, b, c, d, e) {
		return d - $.easing.easeOutBounce(a, e - b, 0, d, e) + c
	},
	easeOutBounce: function(a, b, c, d, e) {
		return (b /= e) < 1 / 2.75 ? 7.5625 * d * b * b + c : 2 / 2.75 > b ? d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c : 2.5 / 2.75 > b ? d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c : d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c
	},
	easeInOutBounce: function(a, b, c, d, e) {
		return e / 2 > b ? .5 * $.easing.easeInBounce(a, 2 * b, 0, d, e) + c : .5 * $.easing.easeOutBounce(a, 2 * b - e, 0, d, e) + .5 * d + c
	}
});