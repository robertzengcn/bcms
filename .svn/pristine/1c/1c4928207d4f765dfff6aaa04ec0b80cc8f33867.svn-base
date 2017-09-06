! function(a, b, c) {
	function d(a) {
		this.mode = j.MODE_8BIT_BYTE, this.data = a
	}

	function e(a, b) {
		this.typeNumber = a, this.errorCorrectLevel = b, this.modules = null, this.moduleCount = 0, this.dataCache = null, this.dataList = new Array
	}

	function f(a, b) {
		if (a.length == c) throw new Error(a.length + "/" + b);
		for (var d = 0; d < a.length && 0 == a[d];) d++;
		this.num = new Array(a.length - d + b);
		for (var e = 0; e < a.length - d; e++) this.num[e] = a[e + d]
	}

	function g(a, b) {
		this.totalCount = a, this.dataCount = b
	}

	function h() {
		this.buffer = new Array, this.length = 0
	}! function(a, b) {
			function c(a) {
				function b(a, b, c) {
					return a[b] || (a[b] = c())
				}
				var c = b(a, "SS", Object);
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
			var e = a.SS || (a.SS = {});
			d(e)
		}(a, document), 
		function(a) {
			a.fn.swipeSlide = function(b, c) {
				function d(a, b) {
					a.css({
						"-webkit-transition": "all " + b + "s " + C.transitionType,
						transition: "all " + b + "s " + C.transitionType
					})
				}

				function e(a, b) {
					a.css(C.axisX ? {
						"-webkit-transform": "translate3d(" + b + "px,0,0)",
						transform: "translate3d(" + b + "px,0,0)"
					} : {
						"-webkit-transform": "translate3d(0," + b + "px,0)",
						transform: "translate3d(0," + b + "px,0)"
					})
				}

				function f(a) {
					if (C.lazyLoad) {
						var b = C.ul.find("[data-src]");
						if (b.length > 0) {
							var c = b.eq(a);
							c.data("src") && (c.is("img") ? c.attr("src", c.data("src")).data("src", "") : c.css({
								"background-image": "url(" + c.data("src") + ")"
							}).data("src", ""))
						}
					}
				}

				function g(a) {
					a.touches || (a.touches = a.originalEvent.touches)
				}

				function h(a) {
					r = a.touches[0].pageX, s = a.touches[0].pageY
				}

				function i(a) {
					if (a.preventDefault(), C.autoSwipe && p && clearInterval(p), w = a.touches[0].pageX, x = a.touches[0].pageY, t = w - r, u = x - s, d(C.ul, 0), C.axisX) {
						if (!C.continuousScroll) {
							if (0 == q && t > 0) return t = 0, o();
							if (q + 1 >= F && 0 > t) return t = 0, o()
						}
						e(C.ul, -(D * parseInt(q) - t))
					} else {
						if (!C.continuousScroll) {
							if (0 == q && u > 0) return u = 0, o();
							if (q + 1 >= F && 0 > u) return u = 0, o()
						}
						e(C.ul, -(E * parseInt(q) - u))
					}
				}

				function j() {
					v = C.axisX ? t : u, Math.abs(v) <= y ? k(.3) : v > y ? n() : -y > v && m(), o(), t = 0, u = 0
				}

				function k(a) {
					d(C.ul, a), C.axisX ? e(C.ul, -q * D) : e(C.ul, -q * E)
				}

				function l() {
					C.continuousScroll ? q >= F ? (k(.3), q = 0, setTimeout(function() {
						k(0)
					}, 300)) : 0 > q ? (k(.3), q = F - 1, setTimeout(function() {
						k(0)
					}, 300)) : k(.3) : (q >= F ? q = 0 : 0 > q && (q = F - 1), k(.3)), c(q)
				}

				function m() {
					q++, l(), C.lazyLoad && f(C.continuousScroll ? q + 2 : q + 1)
				}

				function n() {
					if (q--, l(), A && C.lazyLoad) {
						var a = F - 1;
						for (a; F + 1 >= a; a++) f(a);
						return void(A = !1)
					}!A && C.lazyLoad && f(q)
				}

				function o() {
					C.autoSwipe && (p = setInterval(function() {
						m()
					}, C.speed))
				}
				var p, q = 0,
					r = 0,
					s = 0,
					t = 0,
					u = 0,
					v = 0,
					w = 0,
					x = 0,
					y = 50,
					z = 0,
					A = !0,
					B = a(this),
					C = a.extend({}, {
						ul: B.children("ul"),
						li: B.children().children("li"),
						continuousScroll: !1,
						autoSwipe: !0,
						speed: 4e3,
						axisX: !0,
						transitionType: "ease",
						lazyLoad: !1,
						clone: !0,
						width: 0,
						length: 0
					}, b || {}),
					D = C.width || C.li.width(),
					E = C.li.height(),
					F = C.length || C.li.length;
				c = c || function() {},
					function() {
						if (C.continuousScroll && (C.clone && C.ul.prepend(C.li.last().clone()).append(C.li.first().clone()), C.axisX ? (e(C.ul.children().first(), -1 * D), e(C.ul.children().last(), D * F)) : (e(C.ul.children().first(), -1 * E), e(C.ul.children().last(), E * F))), C.lazyLoad) {
							var b = 0;
							for (z = C.continuousScroll ? 3 : 2, b; z > b; b++) f(b)
						}
						C.li.each(C.axisX ? function(b) {
							e(a(this), D * b)
						} : function(b) {
							e(a(this), E * b)
						}), o(), c(q, p), B.on("touchstart", function(a) {
							a.stopPropagation(), g(a), h(a)
						}), B.on("touchmove", function(a) {
							a.stopPropagation(), g(a), i(a)
						}), B.on("touchend", function(a) {
							a.stopPropagation(), j()
						})
					}()
			}
		}(a.Zepto || a.jQuery),
		function(b) {
			function c(a, b, c, d) {
				var e = {},
					f = a / b,
					g = c / d;
				return f > g ? (e.width = c, e.height = c / f) : (e.height = d, e.width = d * f), e
			}

			function d(a, b) {
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
			var e = b.templateParser("jsonParser", function() {
				function a(a) {
					return function(b, c) {
						a[b] = c
					}
				}

				function b(a, b) {
					var c = j[("" + a.type).charAt(0)](a);
					if (c) {
						var d = $('<li comp-drag comp-rotate class="comp-resize comp-rotate inside" id="inside_' + c.id + '" num="' + a.num + '" ctype="' + a.type + '"></li>');
						3 != ("" + a.type).charAt(0) && 1 != ("" + a.type).charAt(0) && d.attr("comp-resize", ""), "p" == ("" + a.type).charAt(0) && d.removeAttr("comp-rotate"), 1 == ("" + a.type).charAt(0) && d.removeAttr("comp-drag"), 2 == ("" + a.type).charAt(0) && d.addClass("wsite-text"), 4 == ("" + a.type).charAt(0) && (a.properties.imgStyle && $(c).css(a.properties.imgStyle), d.addClass("wsite-image")), 5 == ("" + a.type).charAt(0) && d.addClass("wsite-input"), 6 == ("" + a.type).charAt(0) && d.addClass("wsite-button"), 8 == ("" + a.type).charAt(0) && d.addClass("wsite-button"), "v" == ("" + a.type).charAt(0) && d.addClass("wsite-video"), d.mouseenter(function() {
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

				function c(a) {
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
						for (h = c(h), g = 0; g < h.length; g++)
							if (3 == h[g].type) {
								var i = j[("" + h[g].type).charAt(0)](h[g]);
								"edit" == f && k[("" + h[g].type).charAt(0)] && k[("" + h[g].type).charAt(0)](i, h[g])
							} else {
								var n = b(h[g], f);
								if (!n) continue;
								e.append(n);
								for (var o = 0; o < m.length; o++) m[o](n, h[g], f);
								l[("" + h[g].type).charAt(0)] && (l[("" + h[g].type).charAt(0)](n, h[g]), "edit" != f && d(n, h[g])), "edit" == f && k[("" + h[g].type).charAt(0)] && k[("" + h[g].type).charAt(0)](n, h[g])
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
					q = 1,
					r = 1,
					s = {
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
							this.def = a.def, "view" == c && p++;
							var d = $(a.appendTo);
							return containerWidth = d.width(), containerHeight = d.height(), q = n / containerWidth, r = o / containerHeight, e(a.def, b.appendTo($(a.appendTo)), c)
						}
					};
				return s
			});
			e.addInterceptor(function(a, b, c) {
				q.animation(a, b, c)
			}), e.addComponent("1", function(a) {
				var b = document.createElement("div");
				if (b.id = a.id, b.setAttribute("class", "element comp_title"), a.content && (b.textContent = a.content), a.css) {
					var c, d = a.css;
					for (c in d) b.style[c] = d[c]
				}
				if (a.properties.labels)
					for (var e = a.properties.labels, f = 0; f < e.length; f++) $('<a class = "label_content" style = "display: inline-block;">').appendTo($(b)).html(e[f].title).css(e[f].color).css("width", 100 / e.length + "%");
				return b
			}), e.addComponent("2", function(a) {
				var b = document.createElement("div");
				return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_paragraph editable-text"), a.content && (b.innerHTML = a.content), b.style.cursor = "default", b
			}), e.addComponent("3", function(a) {
				var b = $("#nr .edit_area")[0];
				"view" == e.mode && (b = document.getElementById("edit_area" + e.def.id)), b = $(b).parent()[0];
				var c, d = new Image;
				return a.properties.imgSrc && (c = a.properties.imgSrc, /^http.*/.test(c) ? (d.src = c, b.style.backgroundImage = "url(" + c + ")") : (d.src = PREFIX_FILE_HOST + c, b.style.backgroundImage = "url(" + PREFIX_FILE_HOST + c + ")"), b.style.backgroundOrigin = "element content-box", b.style.backgroundSize = "cover", b.style.backgroundPosition = "50% 50%"), a.properties.bgColor && (b.style.backgroundColor = a.properties.bgColor), b
			}), e.addComponent("4", function(a) {
				var b = document.createElement("img");
				return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_image editable-image"), /^http.*/.test(a.properties.src) ? b.src = a.properties.src : b.src = PREFIX_FILE_HOST + a.properties.src, b
			}), e.addComponent("v", function(a) {
				var b = document.createElement("a");
				return b.setAttribute("class", "element video_area"), b.id = a.id, b.setAttribute("ctype", a.type), a.properties.src && b.setAttribute("videourl", a.properties.src), b
			}), e.addComponent("5", function(a) {
				var b = document.createElement("textarea");
				return b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_input editable-text"), a.properties.required && b.setAttribute("required", a.properties.required), a.properties.placeholder && b.setAttribute("placeholder", a.properties.placeholder), b.setAttribute("name", "eq[f_" + a.id + "]"), b.style.width = "100%", b
			}), e.addComponent("p", function(a) {
				if (a.properties && a.properties.children) {
					var b = 320,
						d = a.css.width || b - parseInt(a.css.left),
						e = a.css.height || d / 2;
					a.css.width = a.css.width || d, a.css.height = a.css.height || e;
					var f = $('<div id="' + a.id + '" class="slider element" ctype="' + a.type + '"></div>');
					return a.properties.bgColor && f.css("backgroundColor", a.properties.bgColor), $.each(a.properties.children, function(a, b) {
						var g = c(b.width, b.height, d, e),
							h = $('<img src="' + PREFIX_FILE_HOST + b.src + '">');
						h.css({
							margin: (e - g.height) / 2 + "px " + (d - g.width) / 2 + "px",
							width: g.width,
							height: g.height
						}), f.append(h)
					}), utilPictures.deleteInterval(a.id), f.get(0)
				}
			}), e.addComponent("6", function(a) {
				var b = document.createElement("button");
				if (b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_button editable-text"), a.properties.title) {
					var c = a.properties.title.replace(/ /g, "&nbsp;");
					b.innerHTML = c
				}
				return b.style.width = "100%", b
			}), e.addComponent("8", function(a) {
				var b = document.createElement("a");
				if (b.id = a.id, b.setAttribute("ctype", a.type), b.setAttribute("class", "element comp_anchor editable-text"), a.properties.title) {
					var c = a.properties.title.replace(/ /g, "&nbsp;");
					$(b).html(c), "view" == e.mode && $(b).attr("href", "tel:" + a.properties.number)
				}
				return b.style.cursor = "default", b.style.width = "100%", b
			}), e.addComponent("7", function(a) {
				var b = document.createElement("div");
				if (b.id = "map_" + a.id, b.setAttribute("class", "element comp_map_wrapper"), a.content && (b.textContent = a.content), a.css) {
					var c, d = a.css;
					for (c in d) b.style[c] = d[c]
				}
				return b.style.height = "250px", b
			}), e.bindAfterRenderEvent("1", function(a, b) {
				if (a = $("div", a)[0], "view" == e.mode && 1 == b.type) {
					var c = b.properties.labels;
					for (key in c) ! function(b) {
						$($(a).find(".label_content")[b]).on("click", function() {
							pageScroll(c[b])
						})
					}(key)
				}
			}), e.bindAfterRenderEvent("4", function(b, c) {
				"view" == e.mode && c.properties.url && $(b).click(function(b) {
					{
						var d = c.properties.url;
						isNaN(d) ? a.open(d) : eqxiu.pageScroll(d)
					}
				})
			}), e.bindAfterRenderEvent("v", function(a, b) {
				"view" == e.mode && $(a).click(function() {
					$(a).hide(), $("#audio_btn").hasClass("video_exist") && ($("#audio_btn").hide(), $("#media")[0].pause()), $('<div class="video_mask page_effect lock" id="mask_' + b.id + '"></div>').appendTo($(a).closest(".m-img")), $('<a class = "close_mask" id="close_' + b.id + '"></a>').appendTo($(a).closest(".m-img")), $(b.properties.src).appendTo($("#mask_" + b.id)).attr("style", "position: absolute;top:0; min-height: 45%; max-height: 100%; top: 20%;").attr("width", "100%").removeAttr("height"), $("#close_" + b.id).bind("click", function() {
						$(a).show(), $("#mask_" + b.id).remove(), $("#close_" + b.id).remove(), $("#audio_btn").hasClass("video_exist") && $("#audio_btn").show(function() {
							$(this).hasClass("off") || $("#media")[0].play()
						})
					})
				})
			}), e.bindAfterRenderEvent("2", function(a, b) {
				for (var c = $(a).find("a[data]"), d = 0; d < c.length; d++)
					if (c[d] && "view" == e.mode) {
						$(c[d]).css("color", "#428bca").css("cursor", "pointer");
						var f = $(c[d]).attr("data");
						! function(a) {
							$(c[d]).click(function(b) {
								eqxiu.pageScroll(a)
							})
						}(f)
					}
			}), e.bindAfterRenderEvent("7", function(a, b) {
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
			}), e.bindAfterRenderEvent("p", function(a, b) {
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
		}(a.SS),
		function(a) {
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
					if (a === c) return b;
					for (var d = 0; d < b.length; d++)
						if (a === b[d].value) return b[d]
				}
			}
			a.utilPictures = new b
		}(a),
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
					if (b === c) return a;
					for (var d in a)
						if (b === a[d].value) return a[d];
					return null
				}, this.getHandleType = function(a) {
					if (a === c) return b;
					for (var d in b)
						if (a === b[d].value) return b[d];
					return null
				}
			}
			a.utilTrigger = new b
		}(a);
	var p = 0,
		q = function() {
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
						for (var h, i = [], j = [], k = 0, l = f.length; l > k; k++) null != f[k].type && -1 != f[k].type && (h = q.convertType(f[k]), i.push(h), j.push(f[k]));
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
	b.module("app", ["ngRoute", "home", "sample", "main", "reg", "scene", "my", "data", "data.edit", "error", "usercenter", "ui.bootstrap", "ui.grid", "ui.grid.selection", "ngSanitize", "ui.select", "services.i18nNotifications", "services.httpRequestTracker", "services.sample", "services.config", "security", "app.upload", "templates-app", "templates-common", "ui.sortable", "I18N.MESSAGES", "app.directives.keymap", "app.directives.notification"]), b.module("app").config(["$routeProvider", "$locationProvider", "securityAuthorizationProvider", "uiSelectConfig",
			function(a, b, c, d) {
				d.theme = "bootstrap", a.when("/scene/create/:sceneId", {
					templateUrl: "scene/create.tpl.html",
					controller: "CreateSceneCtrl",
					reloadOnSearch: !1,
					resolve: {
						authenticatedUser: c.requireAuthenticatedUser
					}
				})
			}
		]), b.module("app").run(["security", "$rootScope", "configService",
			function(a, b, c) {
				
				b.web_logo = web_logo;
				b.web_copyright = web_copyright;
				b.web_qq = web_qq;
				b.web_mail = web_mail;
				b.web_phone = web_phone;
				b.web_address = web_address;
				b.web_ipc = web_ipc;
				
				b.CLIENT_CDN = CLIENT_CDN, b.PREFIX_FILE_HOST = PREFIX_FILE_HOST, b.PREFIX_SERVER_HOST = PREFIX_URL, b.PREFIX_CLIENT_HOST = PREFIX_HOST
			}
		]), b.module("app").run(["$route", "$rootScope", "$location",
			function(a, b, c) {
				b.$on("$locationChangeStart", function() {
					b.branchid && c.search("branchid", b.branchid), $(".modal").remove(), $(".modal-backdrop").remove()
				});
				var d = c.path;
				c.path = function(e, f) {
					if (f === !1) var g = a.current,
						h = b.$on("$locationChangeSuccess", function() {
							a.current = g, h()
						});
					return d.apply(c, [e])
				}
			}
		]), b.module("app").controller("AppCtrl", ["SpreadService", "$window", "$scope", "$rootScope", "$location", "$modal", "security", "sceneService", "$routeParams", "$timeout", "i18nNotifications", "usercenterService",
			function(a, c, d, e, f, g, h, i, j, k, l, m) {
				function n() {
					var a = 1,
						c = 50;
					m.getBranches(c, a).then(function(a) {
						d.userbranches = a.data.list;
						var c = f.search().branchid;
						c && b.forEach(d.userbranches, function(a, b) {
							a.id == c && (e.global.branch = a)
						})
					}, function(a) {})
				}
				d.notifications = l, d.removeNotification = function(a) {
					l.remove(a)
				}, d.$on("$locationChangeStart", function(a) {
					if ("/home/login" != f.path() || h.currentUser ? "/home/register" != f.path() || h.currentUser || h.showRegister() : h.showLogin(), /\/scene\/create/.test(f.path()) || (e.lastRoute = f.path()), f.search().resetToken) {
						var b = f.search().resetToken;
						h.requestResetPassword(b)
					}
				});
				var o = new RegExp("token"),
					p = new RegExp("uid"),
					q = c.location.hash;
				if (f.absUrl().indexOf("WECHAT_STATE") > 0 && (d.weiChatCode = f.absUrl().split("&")[0].split("=")[1]), p.test(q)) {
					var r = q.split("=");
					d.weiboAccessToken = r[1].split("&")[0], d.weiboRemindIn = r[2].split("&")[0], d.weiboExpires = r[3].split("&")[0], d.weiboUId = r[4].split("&")[0]
				} else o.test(q) && (d.accessToken = q.split("&")[0].split("=")[1], d.expiresIn = q.split("&")[1].split("=")[1]);
				d.openLogin = function() {
					f.path("/home/login", !1)
				}, d.openRegister = function() {
					f.path("/home/register", !1)
				}, d.isAuthenticated = h.isAuthenticated, f.search().branchid && (e.branchid = f.search().branchid), d.$watch(function() {
					return h.currentUser
				}, function(b) {
					b && (d.user = b, e.user = b, d.userProperty = b, d.isEditor = h.isEditor(), e.isEditor = h.isEditor(), d.isAdvancedUser = h.isAdvancedUser(), e.isAdvancedUser = h.isAdvancedUser(), d.isVendorUser = h.isVendorUser(), e.isVendorUser = h.isVendorUser(), d.$broadcast("currentUser", b), 2 == e.user.type && n())
				}, !0), d.$on("addBranch", function(a, b) {
					d.userbranches.unshift(b)
				}), e.global = {}, d.selectBranch = function() {
					e.global.branch ? (e.branchid = e.global.branch.id, f.search({
						branchid: e.branchid
					})) : (e.branchid = "", f.search("branchid", null))
				}, d.$watch("branchid", function() {
					d.hideOpea = !!e.branchid
				}), d.openReg = function() {
					g.open({
						windowClass: "request_contain",
						templateUrl: "usercenter/request_reg.tpl.html",
						controller: "UsercenterrequestCtrl",
						resolve: {}
					}).result.then(function() {}, function() {})
				}, d.login = function() {
					h.showLogin()
				}, d.register = function() {
					h.showRegister()
				}, d.showToolBar = function() {
					return f.$$path.indexOf("/scene/create") < 0
				}, d.showPanel = function() {
					$("#helpPanel").stop().animate({
						right: "0"
					}, 500)
				}, d.hidePanel = function() {
					$("#helpPanel").stop().animate({
						right: "-120"
					}, 500)
				}, d.safeApply = function(a) {
					var b = this.$root.$$phase;
					"$apply" == b || "$digest" == b ? a && "function" == typeof a && a() : this.$apply(a)
				}
			}
		]).filter("fixnum", function() {
			return function(a) {
				var b = a;
				return a >= 1e4 && 1e8 > a ? b = (a / 1e4).toFixed(1) + "万" : a >= 1e8 && (b = (a / 1e8).toFixed(1) + "亿"), b
			}
		}), b.module("data.associate", []), b.module("data.associate").controller("AssociateFieldCtrl", ["$scope", "dataService",
			function(a, b) {
				a.staticFileds = [{
					id: "name",
					name: "姓名"
				}, {
					id: "mobile",
					name: "手机"
				}, {
					id: "email",
					name: "邮箱"
				}, {
					id: "sex",
					name: "性别"
				}, {
					id: "company",
					name: "公司"
				}, {
					id: "job",
					name: "职位"
				}, {
					id: "address",
					name: "地址"
				}, {
					id: "tel",
					name: "电话"
				}, {
					id: "website",
					name: "个人网站"
				}, {
					id: "qq",
					name: "QQ"
				}, {
					id: "weixin",
					name: "微信"
				}, {
					id: "remark",
					name: "其它"
				}], a.associateMap = [], a.person = {}, a.selectScene = function(c) {
					b.getSceneField(c).then(function(b) {
						a.fields = b.data.list
					})
				}, a.associate = function(b) {
					for (var c = 0; c < a.associateMap.length; c++) c != b && a.associateMap[c].id == a.associateMap[b].id && (a.associateMap[c] = null)
				}, a.confirm = function() {
					for (var c = {}, d = 0, e = a.associateMap; d < e.length; d++) e[d] && (c[e[d].id] = a.fields[d].id);
					b.mergeSceneData(a.person.selected.ID, c).then(function() {
						a.$close()
					}, function() {
						a.$dismiss()
					})
				}, a.cancel = function() {
					a.$dismiss()
				}, b.getPremergeScenes().then(function(b) {
					a.PremergeScenes = b.data.list
				})
			}
		]).filter("propsFilter", function() {
			return function(a, c) {
				var d = [];
				return b.isArray(a) ? a.forEach(function(a) {
					for (var b = !1, e = Object.keys(c), f = 0; f < e.length; f++) {
						var g = e[f],
							h = c[g].toLowerCase();
						if (-1 !== a[g].toString().toLowerCase().indexOf(h)) {
							b = !0;
							break
						}
					}
					b && d.push(a)
				}) : d = a, d
			}
		}), b.module("data", ["data.associate"]), b.module("data.edit", ["services.usercenter", "services.i18nNotifications"]), b.module("data.edit").controller("EditDataCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "dataService", "i18nNotifications",
			function(a, b, c, d, e, f, g, h, i, j, k) {
				b.sceneId = d.sceneId, b.sexOptions = [{
					id: 0,
					name: "请选择性别"
				}, {
					id: 1,
					name: "男"
				}, {
					id: 2,
					name: "女"
				}], b.sex = b.sexOptions[0], b.isAllowedToAccessGrouping = f.isAllowToAccess(f.accessDef.GROUP_CUSTOMER);
				var l = a.branchid,
					m = {};
				b.getDataDetail = function(a) {
					j.getDataDetail(b.sceneId, l).then(function(a) {
						b.dataDetail = a.data.obj, m = a.data.obj, b.groupNames = b.dataDetail.group;
						var c = b.dataDetail.email,
							d = b.dataDetail.sex,
							e = b.dataDetail.mobile,
							f = b.dataDetail.tel;
						c ? b.formEmails = c.split(",") : b.formEmails = [""], e ? b.formMobiles = e.split(",") : b.formMobiles = [""], f ? b.formTels = f.split(",") : b.formTels = [""], d && ("男" == d ? b.sex = b.sexOptions[1] : b.sex = b.sexOptions[2])
					})
				}, b.getDataDetail(b.sceneId), b.updateData = function(a, c, d) {
					var e = a.name,
						f = {};
					if ("email" == e || "mobile" == e || "tel" == e) {
						f[e] = "";
						var g, h = [];
						for (g = 0; g < c.length; g++) c[g] && h.push(c[g]);
						for (g = 0; g < h.length - 1; g++) f[e] += h[g] + ",";
						f[e] += h[g]
					} else f[e] = b.dataDetail[e];
					m[e] = f[e]
				}, b.updateSex = function(a) {
					var c = {};
					c.id = b.sceneId, 0 !== a.id ? c.sex = a.name : c.sex = "", m.sex = c.sex
				}, b.formEmails = [""], b.formMobiles = [""], b.formTels = [""], b.removeInputs = function(a, c, d) {
					if (d.length > 1) {
						if (!d[a]) return void d.splice(a, 1);
						d.splice(a, 1), b.updateData({
							name: c
						}, d)
					} else 1 === d.length && "" !== d[0] && (d[a] = "", b.updateData({
						name: c
					}, d))
				}, b.addInputs = function(a) {
					a.push("")
				}, b.saveData = function(a) {
					delete a.group, j.saveData($.param(a)).then(function(a) {
						a.data.success && (alert("保存成功"), i.path("/main/customer"))
					})
				}, b.cancel = function() {
					i.path("/main/customer")
				}, b.groups = [], b.getGroups = function() {
					b.groups.length > 0 || j.getGroups().then(function(a) {
						b.groups = a.data.list
					}, function(a) {
						//alert("服务器异常！")
					})
				}, b.getGroups(), b.deleteAssociation = function(a, c, d) {
					var e = {
						cId: a,
						gId: c
					};
					h.openConfirmDialog({
						msg: "确定解除组关联?"
					}, function() {
						j.deleteAssociation(e).then(function(a) {
							if (a.data.success)
								for (var d = 0; d < b.groupNames.length; d++) b.groupNames[d].id == c && b.groupNames.splice(d, 1)
						}, function(a) {
							alert("服务器异常!")
						})
					})
				}, b.addGroup = function() {
					g.open({
						windowClass: "group-console",
						templateUrl: "main/console/group.tpl.html",
						controller: "AddGroupCtrl"
					}).result.then(function(a) {
						b.groups.push(a)
					}, function() {})
				};
				var n = [];
				b.assignGroup = function() {
					for (var a = [], c = 0, d = b.groups.length; d > c; c++)
						if (b.groups[c].selected) {
							n.push(b.groups[c].id);
							var e = {
								id: b.groups[c].id,
								name: b.groups[c].name
							};
							a.push(e)
						}
					if (!n.length) return void alert("您还没有选择分组!");
					var f = {
						cIds: b.dataDetail.id,
						gIds: n
					};
					j.assignGroup(f).then(function(c) {
						if (c.data.success) {
							o();
							for (var d = 0; d < a.length; d++)
								if (b.groupNames.length > 0)
									for (var e = 0; e < b.groupNames.length && b.groupNames[e].id != a[d].id; e++) e == b.groupNames.length - 1 && b.groupNames.push(a[d]);
								else b.groupNames.push(a[d]);
							k.pushForCurrentRoute("data.assign.success", "notify.success")
						}
					}, function() {})
				}, b.deleteGroup = function(a, c) {
					h.openConfirmDialog({
						msg: "确定删除此分组?"
					}, function() {
						j.deleteGroup(a.id).then(function(d) {
							if (d.data.success) {
								o(), b.groups.splice(c, 1);
								for (var e = 0; e < b.groupNames.length; e++) b.groupNames[e].id == a.id && b.groupNames.splice(e, 1)
							}
						}, function(a) {
							alert("服务器异常!")
						})
					})
				};
				var o = function() {
					for (var a = 0, c = b.groups.length; c > a; a++) b.groups[a].selected = !1
				}
			}
		]), b.module("bindemail-dialog", []).controller("BindEmailDialogCtrl", ["$scope",
			function(a) {}
		]), b.module("confirm-dialog", []).controller("ConfirmDialogCtrl", ["$scope", "confirmObj",
			function(a, b) {
				a.confirmObj = b, a.ok = function() {
					a.$close()
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("message-dialog", []).controller("MessageDialogCtrl", ["$scope", "msgObj",
			function(a, b) {
				a.msgObj = b, a.close = function() {
					a.$close()
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("error", ["services.sample"]), b.module("error").controller("ErrorCtrl", ["$rootScope", "$http", "$scope", "$timeout", "security", "$window", "sampleService",
			function(a, b, c, d, e, f, g) {}
		]), b.module("home", ["services.sample", "app.directives.addelement", "services.scene", "app.directives.qrcode", "app.directives.loading"]), b.module("home").controller("HomeCtrl", ["$rootScope", "$http", "$scope", "$timeout", "security", "$window", "sampleService", "sceneService", "$routeParams", "$route", "$location", "configService",
			function(a, b, c, d, e, f, g, h, i, j, k, l) {
				c.showCode = !1, c.isAuthenticated = e.isAuthenticated, c.PREFIX_FILE_HOST = PREFIX_FILE_HOST, c.PREFIX_CLIENT_HOST = PREFIX_HOST, c.PREFIX_SERVER_HOST = PREFIX_URL, c.scene || (c.scene = {}), c.weiChatCode && e.weiChatLogin(c.weiChatCode).then(function(a) {
					200 == a.data.code && (k.path("main"), e.setLoginSuccess(!0))
				}), c.typeindex = "all", c.pageSize = 9, c.pageNo = 1, c.getHomes = function(a, b, d, e) {
					c.typeindex = a, g.getSamples(b, d, e).then(function(a) {
						c.homes = a.data.list
					}, function(a) {})
				}, c.getSceneType = function() {
					h.getSceneType().then(function(a) {
						c.sceneTypes = a.data.list
					})
				}, c.getSceneType(), c.getHomes("all", null, 1, 9);
				if (c.accessToken && c.expiresIn) {
					var m = "https://graph.qq.com/oauth2.0/me?access_token=" + c.accessToken;
					$.ajax({
						type: "get",
						url: m,
						dataType: "jsonp",
						jsonp: "jsoncallback",
						jsonpCallback: "callback",
						xhrFields: {
							withCredentials: !0
						},
						success: function(a) {
							c.openId = a.openid, c.appId = a.client_id;
							var b = {
								email: "",
								password: "",
								openId: c.openId,
								accessToken: c.accessToken,
								type: "qq",
								expires: c.expiresIn
							};
							e.thirdPartLogin(b)
						}
					})
				}
				if (c.weiboAccessToken && c.weiboRemindIn && c.weiboExpires && c.weiboUId) {
					var n = {
						email: "",
						password: "",
						type: "weibo",
						openId: c.weiboUId,
						accessToken: c.weiboAccessToken,
						expires: c.weiboExpires
					};
					e.thirdPartLogin(n)
				}
				c.getBannerStyle = function() {
					return {
						width: 255 * c.imgArr.length + "px"
					}
				}, c.goLeft = function() {
					$(".img_box").is(":animated") || $(".img_box").css("left").split("px")[0] >= 0 || $(".img_box").animate({
						left: "+=255"
					}, 1e3)
				}, c.goRight = function() {
					$(".img_box").is(":animated") || parseInt($(".img_box").css("left").split("px")[0], 10) <= -($(".img_box").width() - 20 - 1e3) || $(".img_box").animate({
						left: "-=255"
					}, 1e3)
				}, d(function() {
					$(".banner1").animate({
						right: "0px"
					}, 200)
				}, 700), d(function() {
					$(".banner2").animate({
						right: "0px"
					}, 200)
				}, 1e3), d(function() {
					$(".banner3").animate({
						right: "0px"
					}, 200, function() {
						$(".banner_left").fadeIn(800)
					})
				}, 1300), c.load2 = function() {
					$("#eq_main").scroll(function() {
						s = $("#eq_main").scrollTop(), s > 100 ? $(".scroll").css("display", "block") : $(".scroll").css("display", "none")
					})
				}, c.getSamplesPV = function() {
					g.getSamplesPV().then(function(a) {
						c.SamplesPVs = a.data, c.dayTop = c.SamplesPVs.obj.dayTop, c.monthTop = c.SamplesPVs.obj.monthTop, c.weekTop = c.SamplesPVs.obj.weekTop, c.page = "month"
					}, function(a) {})
				}
			}
		]), b.module("customer.group", ["services.data"]), b.module("customer.group").controller("AddGroupCtrl", ["$rootScope", "$scope", "dataService",
			function(a, b, c) {
				b.group = {}, b.confirm = function() {
					if (!b.group.name) return void alert("请输入分组名称");
					var a = i(b.group.name);
					if (a > 12) return void alert("分组名称不能大于12个字符！");
					var d = {
						name: b.group.name
					};
					c.createGroup(d).then(function(a) {
						a.data.success && b.$close({
							id: a.data.obj,
							name: b.group.name
						})
					}, function() {})
				}, b.cancel = function() {
					b.$dismiss()
				}
			}
		]), b.module("main.transferScene", ["services.usercenter"]), b.module("main.transferScene").controller("TransferSceneCtrl", ["$scope", "$rootScope", "sceneService", "sceneId",
			function(a, b, c, d) {
				a.model = {
					toUser: ""
				}, a.confirm = function() {
					return a.model.toUser ? a.model.toUser == b.user.email ? void(a.actionerror = "不能转送自己") : void c.transferScene(d.sceneId, a.model.toUser).then(function(b) {
						200 == b.data.code ? a.$close() : a.actionerror = b.data.msg
					}) : void(a.actionerror = "账号不能为空")
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("main.data", ["app.directives.dataDraggable", "customer.group", "services.i18nNotifications", "app.directives.customer"]), b.module("main.data").controller("CustomerCtrl", ["$scope", "$route", "$location", "dataService", "$modal", "ModalService", "i18nNotifications", "security", "$rootScope",
			function(a, b, c, d, e, f, g, h, i) {
				a.PREFIX_URL = PREFIX_URL, a.isActive = "customer", a.select = 0, a.showBranchSelect = !0;
				var j = i.branchid;
				a.toPage = 1, a.model = {}, a.downLoad = function(a, b) {
					var c;
					c = PREFIX_S1_URL + "m/c/exp" + (j ? "?user=" + j : ""), b && (c += (/\?/.test(c) ? "&" : "?") + "origin=" + b), a && (c += (/\?/.test(c) ? "&" : "?") + "groupId=" + a), location.href = c
				}, a.staticFileds = [{
					id: "name",
					name: "姓名"
				}, {
					id: "mobile",
					name: "手机"
				}, {
					id: "email",
					name: "邮箱"
				}, {
					id: "sex",
					name: "性别"
				}, {
					id: "company",
					name: "公司"
				}, {
					id: "job",
					name: "职位"
				}, {
					id: "address",
					name: "地址"
				}, {
					id: "tel",
					name: "电话"
				}, {
					id: "website",
					name: "个人网站"
				}, {
					id: "qq",
					name: "QQ"
				}, {
					id: "weixin",
					name: "微信"
				}, {
					id: "remark",
					name: "其它"
				}], a.selectScene = function(b, c) {
					a.selectedSceneId = b, d.getSceneField(b).then(function(b) {
						a.fields = b.data.list, a.select = c, $(".list_attribute").html("拖拽到此处")
					})
				}, a.clickScene = function() {
					c.path("main")
				}, a.clickSpread = function() {
					c.path("main/spread")
				}, a.clickCustomer = function() {
					c.path("main/customer")
				}, a.editCustomer = function(b) {
					a.getDataDetail(b.id), a.editData = !0
				}, a.removeCustomer = function(b) {
					f.openConfirmDialog({
						msg: "确定删除此条数据?"
					}, function() {
						d.deleteDataById(b.id).then(function() {
							a.getDataBySceneId(1 === a.customerDatas.length && a.model.currentPage > 1 ? a.model.currentPage - 1 : a.model.currentPage), l()
						})
					})
				}, a.addColor = function(b) {
					a.trIndex = b
				}, a.removeColor = function() {
					a.trIndex = -1
				}, a.totalItems = 0, a.model.currentPage = 0, a.toPage = "", a.pageChanged = function(b, c, d, e) {
					return 1 > b || b > a.totalItems / 10 + 1 ? void alert("此页超出范围") : void a.getDataBySceneId(b, c, d, e)
				}, a.getDataBySceneId = function(b, c, e, f) {
					b || (b = 1), d.getAllData(b, c, e, f).then(function(b) {
						a.customerDatas = b.data.list, a.totalItems = b.data.map.count, a.model.currentPage = b.data.map.pageNo, a.toPage = ""
					})
				}, a.getDataBySceneId(1, j, null, null), a.editCustom = function(a, b) {
					c.path("/main/customer/" + a.id)
				};
				var k = function() {
						d.getProspectDataAccount(j).then(function(b) {
							a.prospectDataAccount = b.data.obj
						})
					},
					l = function() {
						d.getAllDataCount(j).then(function(b) {
							a.allDataCount = b.data.obj
						})
					};
				a.importDatas = function() {
					d.getPremergeScenes(j).then(function(b) {
						a.importDatas = b.data.list, b.data.list.length > 0 && a.selectScene(b.data.list[0].ID, 0)
					})
				}, a.associateData = {};
				var m = !0;
				if (a.confirm = function() {
					m ? jQuery.isEmptyObject(a.associateData, {}) ? (alert("请导入数据！"), m = !0) : (d.mergeSceneData(a.selectedSceneId, a.associateData).then(function() {
						alert("你已成功导入客户！"), b.reload()
					}, function() {}), m = !1) : alert("请不要重复提交！")
				}, a.importDatas(), k(), l(), a.isAllowedToAccessGrouping = h.isAllowToAccess(h.accessDef.GROUP_CUSTOMER), a.isAllowedToAccessGrouping) {
					a.allImages = {
						selected: !1
					}, a.selectAll = function() {
						for (var b = 0, c = a.customerDatas.length; c > b; b++) a.customerDatas[b].selected = a.allImages.selected
					}, a.selectCustomer = function(b) {
						b.selected || (a.allImages.selected = !1)
					}, a.groups = [], a.getGroups = function() {
						a.groups.length > 0 || d.getGroups().then(function(b, c) {
							a.groups = b.data.list
						}, function(a) {})
					}, a.getGroups(), a.getOrigins = function() {
						d.getOrigin().then(function(b) {
							a.origins = b.data.list
						}, function(a) {
							alert("服务器异常！")
						})
					}, a.getOrigins(), a.addGroup = function() {
						e.open({
							windowClass: "group-console",
							templateUrl: "main/console/group.tpl.html",
							controller: "AddGroupCtrl"
						}).result.then(function(b) {
							a.groups.unshift(b), q(), g.pushForCurrentRoute("group.create.success", "notify.success")
						}, function() {})
					};
					var n = [],
						o = [];
					a.assignGroup = function() {
						n = [], o = [];
						for (var b = 0, c = a.customerDatas.length; c > b; b++) a.customerDatas[b].selected && n.push(a.customerDatas[b].id);
						for (b = 0, c = a.groups.length; c > b; b++) a.groups[b].selected && o.push(a.groups[b].id);
						if (!n.length) return void alert("您还没有选择客户!");
						if (!o.length) return void alert("您还没有选择分组!");
						var e = {
							cIds: n,
							gIds: o
						};
						d.assignGroup(e).then(function(b) {
							b.data.success && (q(), a.allImages.selected = !1, p(), g.pushForCurrentRoute("data.assign.success", "notify.success"))
						}, function() {})
					}, a.deleteCustomer = function(b) {
						n = [];
						var c, e;
						if (b) c = {
							ids: b.id
						}, e = "确认删除此条数据？";
						else {
							for (var h = 0, i = a.customerDatas.length; i > h; h++) a.customerDatas[h].selected && n.push(a.customerDatas[h].id);
							if (!n.length) return void alert("您还没有选择客户！");
							c = {
								ids: n
							}, e = "确认删除选中数据？"
						}
						f.openConfirmDialog({
							msg: e
						}, function() {
							d.deleteCustomer(c).then(function(b) {
								b.data.success && (a.allImages.selected = !1, p(), q(), g.pushForCurrentRoute("data.delete.success", "notify.success"))
							}, function(a) {
								alert("服务器异常！")
							})
						})
					}, a.deleteGroup = function(b, c) {
						f.openConfirmDialog({
							msg: "确定删除此分组?"
						}, function() {
							d.deleteGroup(b.id).then(function(b) {
								b.data.success && (a.groups.splice(c, 1), q(), g.pushForCurrentRoute("group.delete.success", "notify.success"))
							}, function(a) {
								alert("服务器异常!")
							})
						})
					};
					var p = function() {
							a.getDataBySceneId(1 === a.customerDatas.length && a.model.currentPage > 1 ? a.model.currentPage - 1 : a.model.currentPage)
						},
						q = function() {
							for (var b = 0, c = a.groups.length; c > b; b++) a.groups[b].selected = !1
						}
				}
				a.$watch("model.currentPage", function(b, c) {
					b && b != c && (a.model.toPage = b)
				}, !0)
			}
		]), b.module("main", ["services.mine", "services.data", "app.directives.pageTplTypes", "app.directives.addelement", "main.spread", "main.data", "main.transferScene", "services.usercenter", "main.userGuide", "app.directives.qrcode", "services.i18nNotifications"]), b.module("main").controller("MainCtrl", ["$rootScope", "$scope", "$location", "security", "MineService", "dataService", "sceneService", "ModalService", "$modal", "usercenterService", "i18nNotifications",
			function(a, b, c, d, e, f, g, h, i, j, k) {
				function l() {
					return sessionStorage.getItem("sysMsgHasRead")
				}

				function m(a, c, d, e) {
					j.getNewMessage(a, c, d, e).then(function(a) {
						b.sysMsgs = a.data.list
					})
				}
				b.PREFIX_URL = PREFIX_URL, b.PREFIX_CLIENT_HOST = PREFIX_HOST, b.client_cdn = CLIENT_CDN, b.scene = {
					type: {}
				}, b.pageSize = 12, b.showCloseStatus = [], b.showOpenStatus = [], b.isActive = "main", b.loginSuccess = d.isLoginSuccess, b.showBranchSelect = !0, b.$watch("user.loginName", function(a, c) {
					if (a) {
						var d = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
						b.loginSuccess && "eqs" == a.substr(0, 3) && !d.test(a) && k.pushForCurrentRoute("rel.tip", "notify.tip")
					}
				});
				var n = a.branchid;
				b.editScene = function(a) {
					c.path("scene/create/" + a).search("pageId", 1)
				}, b.openScene = function(a, b) {
					n || (b ? g.openScene(a.id).then(function(b) {
						b.data.success && (a.status = 1)
					}) : g.closeScene(a.id).then(function(b) {
						b.data.success && (a.status = 2)
					}))
				}, b.addColor = function(a) {
					b.trIndex = a
				}, b.removeColor = function() {
					b.trIndex = -1
				}, b.sceneSettings = function(a) {
					c.path("my/sceneSetting/" + a)
				}, b.clickScene = function() {
					c.path("main")
				}, b.clickSpread = function() {
					c.path("main/spread")
				}, b.creatCompanyTpl = function(a, c) {
					g.createCompanyTpls(a).then(function(a) {
						a.data.success && (b.myScenes[c].isTpl = 3, k.pushForCurrentRoute("scene.save.success.companyTpl", "notify.success"))
					})
				}, b.clearCompanyTpl = function(a, c) {
					g.clearCompanyTpls(a).then(function(a) {
						a.data.success && (b.myScenes[c].isTpl = 0, k.pushForCurrentRoute("scene.clear.success.companyTpl", "notify.success"))
					})
				}, b.clickCustomer = function() {
					c.path("main/customer")
				}, b.register = d.getRegisterInfo(), b.logout = function() {
					d.logout()
				}, b.copyScene = function(a) {
					h.openConfirmDialog({
						msg: "确定复制此场景?"
					}, function() {
						g.copySceneById(a).then(function(a) {
							c.path("scene/create/" + a.data.obj).search("pageId", 1)
						})
					})
				}, b.isAllowedToAccessTransfer = d.isAllowToAccess(d.accessDef.TRANSFER_SCENE), b.isAllowedToAccessTransfer && (b.transferScene = function(c) {
					"eqs" == a.user.loginName.substr(0, 3) && null == a.user.email ? h.openBindEmailDialog() : i.open({
						windowClass: "six-contain",
						templateUrl: "main/console/transferscene.tpl.html",
						controller: "TransferSceneCtrl",
						resolve: {
							sceneId: function() {
								return {
									sceneId: c
								}
							}
						}
					}).result.then(function() {
						b.getMyScenes()
					}, function() {})
				}), b.deleteScene = function(a) {
					h.openConfirmDialog({
						msg: "确定删除此场景?"
					}, function() {
						g.deleteSceneById(a).then(function() {
							b.getMyScenes(b.currentPage)
						})
					})
				}, b.getStyle = function(a) {
					return {
						"background-image": "url(" + PREFIX_FILE_HOST + a + ")"
					}
				}, b.totalItems = 0, b.currentPage = 0, b.toPage = "", b.getMyScenes = function(a) {
					e.getMyScenes(b.scene.type ? b.scene.type.value : "0", a, b.pageSize, n).then(function(a) {
						a.data.list && a.data.list.length > 0 ? (b.myScenes = a.data.list, b.totalItems = a.data.map.count, b.currentPage = a.data.map.pageNo, b.allPageCount = a.data.map.count, b.toPage = "") : b.currentPage > 1 ? b.getMyScenes(--b.currentPage) : (b.myScenes = [], b.allPageCount = 0)
					})
				}, b.pageChanged = function(a) {
					return 1 > a || a > b.totalItems / 10 + 1 ? void alert("此页超出范围") : void b.getMyScenes(a)
				}, b.getTdStyle = function(a) {
					var b = $(".header_table td:eq(" + a + ")").outerWidth();
					return {
						width: b + "px",
						maxWidth: b + "px"
					}
				};
				var o = function() {
						f.getAllDataCount(n).then(function(a) {
							b.allDataCount = a.data.obj
						})
					},
					p = function() {
						f.getAllSceneDataCount(n).then(function(a) {
							b.allSceneDataCount = a.data.obj
						})
					};
				p(), b.getMyScenes(), o(), g.getSceneType().then(function(a) {
					b.scene.types = a.data.list
				}), b.dataDetail = {};
				var q = function() {
					f.getProspectDataAccount(n).then(function(a) {
						b.prospectDataAccount = a.data.obj
					})
				};
				q();
				var r = function() {
					f.getAllPageView(n).then(function(a) {
						b.allPageView = a.data.obj
					})
				};
				r(), b.showDetail = function(a) {
					c.path("my/scene/" + a)
				}, b.$on("$destroy", function() {
					d.setLoginSuccess(!1)
				}), b.publishScene = function(a, b) {
					b && b.stopPropagation(), g.publishScene(a.id).then(function(b) {
						b.data.success && (a.publishTime = (new Date).getTime(), k.pushForCurrentRoute("scene.publish.success", "notify.success"))
					})
				}, b.openSysMsg = !1, b.openSysMsgDialog = !l(), b.closeSysMsgDialog = function() {
					b.openSysMsgDialog = !b.openSysMsgDialog, sessionStorage.setItem("sysMsgHasRead", "true")
				}, b.sysMsgs = [], m(1, 4, !0, !0)
			}
		]).directive("sysMsgAdjust", function() {
			return function(a, b, c) {
				a.isSysMsgVeryShort = !1;
				var d = a.$watch(function() {
					return $(".messages", b).css("height")
				}, function(b) {
					"44px" === b && (a.isSysMsgVeryShort = !0)
				});
				b.bind("$destroy", function() {
					d()
				})
			}
		}), b.module("main.spread", ["app.directives.pieChart", "app.directives.numChangeAnim", "main.scene.statistic", "main.spread.Method"]), b.module("main.spread").controller("SpreadCtrl", ["$scope", "$rootScope", "$location", "$routeParams", "MineService", "dataService",
			function(a, b, c, d, e, f) {
				a.isActive = "spread", b.showSpreadTable = !0, a.tabid = d.tabid, a.showBranchSelect = !0, a.spreadStatic = function() {
					b.showSpreadTable = !0, c.path("main/spread/statistics", !1), a.tabid = "statistics", a.showBranchSelect = !0
				}, a.spreadExpand = function() {
					c.path("main/spread/expand", !1), a.tabid = "expand", a.showBranchSelect = !0
				};
				var g = b.branchid;
				f.getOpenCount(g).then(function(b) {
					a.openCount = b.data.obj
				}), f.getAllPageView(g).then(function(b) {
					a.allPageView = b.data.obj, f.getAllSceneDataCount(g).then(function(b) {
						a.allSceneDataCount = b.data.obj, a.dataRatio = 0 === a.allPageView ? 0 : 100 * (a.allSceneDataCount / a.allPageView).toFixed(2)
					})
				}), a.getMyScenes = function(b) {
					e.getMyScenes(null, b, 10, g).then(function(b) {
						b.data.list && b.data.list.length > 0 && (a.allPageCount = b.data.map.count, (!b.data.list || b.data.list.length <= 0) && c.path("scene"), a.spreadDatas = b.data.list, a.totalItems = b.data.map.count, a.currentPage = b.data.map.pageNo, a.toPage = "")
					})
				}, a.pageChanged = function(b) {
					return 1 > b || b > a.totalItems / 10 + 1 ? void alert("此页超出范围") : void a.getMyScenes(b)
				}, a.totalItems = 0, a.currentPage = 0, a.toPage = "", a.getMyScenes()
			}
		]), b.module("main.spread.detail", ["services.spread", "app.directives.lineChart", "app.directives.pieChart", "app.directives.numChangeAnim"]), b.module("main.spread.detail").controller("SpreadDetailCtrl", ["$scope", "$location", "$routeParams", "sceneService", "SpreadService", "$rootScope", "MineService",
			function(a, b, c, d, e, f, g) {
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.PREFIX_CLIENT_HOST = PREFIX_HOST, a.PREFIX_SERVER_HOST = PREFIX_URL;
				f.branchid, c.sceneId
			}
		]), b.module("main.spread.detail", ["services.spread", "app.directives.lineChart", "app.directives.pieChart", "app.directives.numChangeAnim"]), b.module("main.spread.detail").controller("DataDetailCtrl", ["$scope", "$location", "$routeParams", "sceneService", "SpreadService", "$rootScope", "MineService",
			function(a, b, c, d, e, f, g) {
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.PREFIX_CLIENT_HOST = PREFIX_HOST, a.PREFIX_SERVER_HOST = PREFIX_URL, a.spreadViewGridOptions = {}, a.spreadMobileGridOptions = {}, a.spreadClickGridOptions = {}, a.expandWebs = [];
				var h = f.branchid;
				a.sceneShow = "num", a.obj = {
					mobileInfo: "friendsGroup"
				}, a.viewStyle = "line", a.staticSpread = "tel", a.showMobile = !0, a.showLine = function() {
					a.viewStyle = "line", a.obj.mobileInfo || (a.obj.mobileInfo = "friendsGroup"), a.showMobile = !0
				}, a.showPie = function() {
					a.viewStyle = "pie", a.obj.mobileInfo = "", a.showMobile = !1
				}, a.$on("scene.detail", function(b, c, d) {
					a.scene = c, a.scene && (101 == a.scene.type ? a.sceneType = "行业" : 102 == a.scene.type ? a.sceneType = "个人" : 103 == a.scene.type ? a.sceneType = "企业" : 104 == a.scene.type ? a.sceneType = "节假" : 105 == a.scene.type && (a.sceneType = "风格"))
				}), a.$on("scene.data", function(b, c, d, e, f, g) {
					a.stats = c, i(d, e, f, g)
				});
				var i = function(b, c, d, e) {
					a.pageView = 0, a.spreadViewGridOptions.data = a.stats, a.spreadMobileGridOptions.data = a.stats, a.spreadClickGridOptions.data = a.stats, a.viewLineChartData = {
						labels: [],
						datasets: [{
							label: "1",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataLineChartData = {
						labels: [],
						datasets: [{
							label: "2",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataLineChartFriendGroup = {
						labels: [],
						datasets: [{
							label: "3",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataLineChartFriends = {
						labels: [],
						datasets: [{
							label: "4",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataLineChartFriend = {
						labels: [],
						datasets: [{
							label: "5",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataLineChartOther = {
						labels: [],
						datasets: [{
							label: "6",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.viewLineTel = {
						labels: [],
						datasets: [{
							label: "7",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.viewLineTab = {
						labels: [],
						datasets: [{
							label: "8",
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "rgba(220,220,220,1)",
							pointStrokeColor: "#ffff00",
							pointHighlightFill: "#ffff00",
							pointHighlightStroke: "#ffff00",
							data: []
						}]
					}, a.dataPieChart = [{
						value: 0,
						color: "#9ad64b"
					}, {
						value: 0,
						color: "#af9ae1"
					}, {
						value: 0,
						color: "#74caf6"
					}, {
						value: 0,
						color: "#08a1ef"
					}];
					for (var f = 0, g = 0, h = 0, i = 0, j = 0, k = 0; k < a.stats.length; k++) a.viewLineChartData.labels.push(a.stats[k].STAT_DATE), a.viewLineChartData.datasets[0].data.push(a.stats[k].SHOW), a.dataLineChartData.labels.push(a.stats[k].STAT_DATE), a.dataLineChartData.datasets[0].data.push(a.stats[k].DATA), a.dataLineChartFriendGroup.labels.push(a.stats[k].STAT_DATE), a.dataLineChartFriendGroup.datasets[0].data.push(a.stats[k].S_WX_TIMELINE), a.dataLineChartFriends.labels.push(a.stats[k].STAT_DATE), a.dataLineChartFriends.datasets[0].data.push(a.stats[k].S_WX_GROUP), a.dataLineChartFriend.labels.push(a.stats[k].STAT_DATE), a.dataLineChartFriend.datasets[0].data.push(a.stats[k].S_WX_SINGLE), a.viewLineTel.labels.push(a.stats[k].STAT_DATE), a.viewLineTel.datasets[0].data.push(a.stats[k].TEL), a.viewLineTab.labels.push(a.stats[k].STAT_DATE), a.viewLineTab.datasets[0].data.push(a.stats[k].LINK), a.dataLineChartOther.labels.push(a.stats[k].STAT_DATE), a.dataOthers = a.stats[k].S_MOBILE - a.stats[k].S_WX_TIMELINE - a.stats[k].S_WX_SINGLE - a.stats[k].S_WX_GROUP, a.dataLineChartOther.datasets[0].data.push(a.dataOthers), a.pageView += a.stats[k].SHOW, f += a.stats[k].S_MOBILE, g += a.stats[k].S_WX_TIMELINE, h += a.stats[k].S_WX_SINGLE, i += a.stats[k].S_WX_GROUP;
					if (a.viewLineChartData.labels && 1 == a.viewLineChartData.labels.length && (a.viewLineChartData.labels.push(a.viewLineChartData.labels[0]), a.viewLineChartData.datasets[0].data.push(a.viewLineChartData.datasets[0].data[0])), a.dataLineChartData.labels && 1 == a.dataLineChartData.labels.length && (a.dataLineChartData.labels.push(a.dataLineChartData.labels[0]), a.dataLineChartData.datasets[0].data.push(a.dataLineChartData.datasets[0].data[0])), a.dataLineChartFriendGroup.labels && 1 == a.dataLineChartFriendGroup.labels.length && (a.dataLineChartFriendGroup.labels.push(a.dataLineChartFriendGroup.labels[0]), a.dataLineChartFriendGroup.datasets[0].data.push(a.dataLineChartFriendGroup.datasets[0].data[0])), a.dataLineChartFriends.labels && 1 == a.dataLineChartFriends.labels.length && (a.dataLineChartFriends.labels.push(a.dataLineChartFriends.labels[0]), a.dataLineChartFriends.datasets[0].data.push(a.dataLineChartFriends.datasets[0].data[0])), a.dataLineChartFriend.labels && 1 == a.dataLineChartFriend.labels.length && (a.dataLineChartFriend.labels.push(a.dataLineChartFriend.labels[0]), a.dataLineChartFriend.datasets[0].data.push(a.dataLineChartFriend.datasets[0].data[0])), a.viewLineTel.labels && 1 == a.viewLineTel.labels.length && (a.viewLineTel.labels.push(a.viewLineTel.labels[0]), a.viewLineTel.datasets[0].data.push(a.viewLineTel.datasets[0].data[0])), a.viewLineTab.labels && 1 == a.viewLineTab.labels.length && (a.viewLineTab.labels.push(a.viewLineTab.labels[0]), a.viewLineTab.datasets[0].data.push(a.viewLineTab.datasets[0].data[0])),
						a.dataLineChartOther.labels && 1 == a.dataLineChartOther.labels.length && (a.dataLineChartOther.labels.push(a.dataLineChartOther.labels[0]), a.dataLineChartOther.datasets[0].data.push(a.dataLineChartOther.datasets[0].data[0])), a.spreadMobile = !0, f > 0) {
						j = f - g - h - i;
						var l = i / f * 100,
							m = g / f * 100,
							n = h / f * 100,
							o = j / f * 100;
						a.dataPieChart[0].value = l, a.dataPieChart[1].value = m, a.dataPieChart[2].value = n, a.dataPieChart[3].value = o, a.dataOhter = (j / f * 100).toFixed(2), a.timelineData = (g / f * 100).toFixed(2), a.weixinData = (h / f * 100).toFixed(2), a.weixinGroupData = (i / f * 100).toFixed(2)
					} else a.spreadMobile = !1;
					$(".myGrid1").height(50 * (a.stats.length + 1) + 1), $(".myGrid1 .ui-grid-viewport").height(50 * a.stats.length + 1)
				};
				a.getAllStats = function(b, c, d) {
					e.getSceneData(b, c, d, h, a.expandId)
				}, a.$on("webs.update", function(b) {
					a.expandWebs = e.expandWebs
				}), a.viewExpandDetail = function(b, c) {
					a.selectIndex = c, a.expandId = b, a.getAllStats(a.scene.id, -6, 1)
				}, c.sceneId && e.getWebList(c.sceneId)
			}
		]), b.module("main.spread.detail.qrcode", ["services.spread", "services.scene", "services.mine"]), b.module("main.spread.detail.qrcode").controller("QrCodeCtrl", ["$scope", "$rootScope", "SpreadService", "sceneService", "MineService",
			function(a, c, d, e, f) {
				a.expandWebs = [];
				var g, h, i = 10,
					j = c.branchid,
					k = function(d, e) {
						f.getMyScenes(d, e, i, j).then(function(d) {
							b.forEach(d.data.list, function(a, b) {
								a.link = c.PREFIX_CLIENT_HOST + "v-" + a.code
							}), a.myScenes = d.data.list, a.totalItems = d.data.map.count, a.currentPage = d.data.map.pageNo
						}, function(a) {})
					};
				k(null, 1), a.select = function(b) {
					a.open = !1, g = a.selectedUrl = b.link, h = a.selectedCode = b.code, sceneId = b.id, m()
				}, a.addWeb = function(a) {
					a.push({
						url: g
					})
				};
				var l;
				a.checkChange = function(a) {
					l = a
				};
				a.updateName = function(a) {
					if (l != a.name) {
						var b = {
							sceneId: sceneId,
							name: a.name
						};
						a.id && (b.id = a.id), d.updateName(b).then(function(b) {
							b.data.success && (a.id || (a.id = b.data.obj.id, a.url = g + "?qrc=" + a.id))
						}, function(a) {
							alert("服务器异常！")
						})
					}
				};
				var m = function() {
					d.getWebList(sceneId)
				};
				a.deleteWeb = function(b, c) {
					var e = {
						id: c.id,
						index: b
					};
					c.id ? d.deleteWeb(e) : a.expandWebs.splice(b, 1)
				}, a.$on("webs.update", function(c) {
					a.expandWebs = d.expandWebs, b.forEach(a.expandWebs, function(a, b) {
						a.url = g + "?qrc=" + a.id
					})
				}), a.pageChanged = function(b) {
					k(null, b), a.currentPage = b
				}, a.$watch("currentPage", function(b, c) {
					b != c && k(null, b), a.toPage = b
				})
			}
		]), b.module("main.scene.statistic", ["services.spread", "main.spread.detail"]), b.module("main.scene.statistic").controller("SceneStatisticCtrl", ["$scope", "$location", "$routeParams", "sceneService", "SpreadService", "$rootScope", "MineService",
			function(a, b, c, d, e, f, g) {
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.PREFIX_CLIENT_HOST = PREFIX_HOST, a.PREFIX_SERVER_HOST = PREFIX_URL;
				var h = f.branchid;
				a.viewDetail = function(c) {
					f.showSpreadTable = !1, a.$parent.showBranchSelect = !1, b.path("/main/spread/statistics/" + c.id, !1), e.getSceneDetail(c.id, h), e.getSceneData(c.id, -6, 1, h), e.getWebList(c.id)
				};
				var i = c.sceneId;
				i && (f.showSpreadTable = !1, a.$parent.showBranchSelect = !1, e.getSceneDetail(i, h)), a.addColor = function(b) {
					a.trIndex = b
				}, a.removeColor = function() {
					a.trIndex = -1
				}
			}
		]), b.module("main.spread.Method", ["services.spread", "app.directives.lineChart", "app.directives.pieChart", "app.directives.numChangeAnim", "main.spread.detail.qrcode"]), b.module("main.spread.Method").controller("SpreadMethodCtrl", ["$scope", "$location", "$routeParams", "sceneService", "SpreadService", "$rootScope", "MineService",
			function(a, b, c, d, e, f, g) {
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.PREFIX_CLIENT_HOST = PREFIX_HOST, a.PREFIX_SERVER_HOST = PREFIX_URL
			}
		]),
		function() {
			b.module("main.userGuide", []).controller("userGuideCtrl", ["$rootScope", "$scope",
				function(b, c) {
					if (a.localStorage) {
						var d = JSON.parse(localStorage.getItem("loginInfo"));
						d && d[b.user.id] ? c.firstLogin = !1 : (c.firstLogin = !0, d = d || {}, d[b.user.id] = 1, localStorage.setItem("loginInfo", JSON.stringify(d)))
					}
				}
			])
		}(), b.module("my", ["my.scene", "my.scenesetting"]), b.module("my.scene", ["services.scene", "services.mine", "services.data", "scene.create.console", "app.directives.addelement", "services.usercenter", "app.directives.qrcode"]), b.module("my.scene").controller("MySceneCtrl", ["$anchorScroll", "$route", "$location", "$rootScope", "$window", "$scope", "$routeParams", "sceneService", "MineService", "dataService", "$sce", "$modal", "usercenterService", "security", "pageTplService",
			function(b, c, d, e, f, g, h, i, j, k, l, m, n, o, p) {
				function q(a, b, c) {
					k.getDataBySceneId(a, b, c, r).then(function(a) {
						g.dataHeader = a.data.list.shift(), g.dataList = a.data.list, g.totalItems = a.data.map.count, g.currentPage = a.data.map.pageNo
					})
				}
				g.loading = !1, g.url = "", g.sceneId = h.sceneId, g.isVendorUser = e.isVendorUser, g.isAllowToAccessLastPageSetting = o.isAllowToAccess(o.accessDef.SCENE_HIDE_LASTPAGE_SETTING);
				var r = e.branchid;
				g.exportUrl = "m/scene/excel/" + g.sceneId + (r ? "?user=" + r : "");
				var s = 0;
				g.PREFIX_FILE_HOST = PREFIX_FILE_HOST, g.PREFIX_URL = PREFIX_URL, g.alwaysOpen = !0;
				g.scene || (g.scene = {});
				var t, u;
				document.getElementById("sharescript") ? ($("#sharescript").remove(), t = document.getElementsByTagName("head")[0], u = document.createElement("script"), u.id = "sharescript", u.src = "http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=" + ~(-new Date / 36e5), t.appendChild(u)) : (t = document.getElementsByTagName("head")[0], u = document.createElement("script"), u.id = "sharescript", u.src = "http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=" + ~(-new Date / 36e5), t.appendChild(u)), g.getSceneDetail = function() {
					i.getSceneDetail(g.sceneId, r).then(function(b) {
						g.scene = b.data.obj, g.scene.applyPromotion = "" + g.scene.applyPromotion, g.scene.applyTemplate = "" + g.scene.applyTemplate, g.code = PREFIX_URL + "eqs/qrcode/" + g.scene.code + ".png", g.url = SHOW_URL + "v-" + g.scene.code, g.customUrl = l.trustAsResourceUrl(SHOW_URL + "v-" + g.scene.id + "&preview=preview"), r && (g.customUrl += "&branchid=" + r), a._bd_share_config = {
							common: {
								bdText: g.scene.name,
								bdDesc: g.scene.name,
								bdUrl: g.url,
								bdSign: "on",
								bdSnsKey: {}
							},
							share: [{
								bdSize: 32
							}],
							slide: [{
								bdImg: 0,
								bdPos: "right",
								bdTop: 100
							}]
						}, s = g.scene.pageCount, 2 == g.scene.status ? (g.showOpenSceneBtn = !0, g.showCloseSceneBtn = !1) : 1 == g.scene.status && (g.showOpenSceneBtn = !1, g.showCloseSceneBtn = !0)
					})
				}, g.getSceneDetail(), g.publishScene = function(a) {
					g.scene.publishTime && g.scene.publishTime >= g.scene.updateTime ? alert("场景已发布！") : i.publishScene(a).then(function(a) {
						a.data.success && alert("场景发布成功")
					})
				}, g.closeScene = function(a) {
					i.closeScene(a).then(function(a) {
						g.showOpenSceneBtn = !0, g.showCloseSceneBtn = !1
					})
				}, g.openScene = function(a) {
					i.openScene(a).then(function(a) {
						g.showOpenSceneBtn = !1, g.showCloseSceneBtn = !0
					})
				}, g.totalItems = 0, g.currentPage = 1, g.toPage = "", g.pageChanged = function(a) {
					return 1 > a || a > g.totalItems / 10 + 1 ? void alert("此页超出范围") : void q(g.sceneId, a, 10)
				}, g.getTdStyle = function(a) {
					var b = $(".header_table td:eq(" + a + ")").outerWidth();
					return {
						width: b + "px",
						maxWidth: b + "px"
					}
				}, q(g.sceneId, g.currentPage, 10);
				var v = new ZeroClipboard(document.getElementById("copy-button"), {
					moviePath: "/assets/ZeroClipboard.swf"
				});
				v.on("dataRequested", function(a, b) {
					a.setText(g.url), setTimeout(function() {
						alert("复制成功")
					}, 500)
				}), g.goData = function() {
					d.hash("collectData"), b()
				}
			}
		]), b.module("my.scenesetting", ["services.scene", "services.mine", "services.data", "scene.create.console", "app.directives.addelement", "services.usercenter", "services.i18nNotifications"]), b.module("my.scenesetting").controller("SceneSettingCtrl", ["$route", "$location", "$rootScope", "$window", "$scope", "$routeParams", "sceneService", "MineService", "dataService", "$sce", "$modal", "usercenterService", "security", "pageTplService", "i18nNotifications",
			function(a, c, d, e, f, g, h, j, k, l, m, n, o, p, q) {
				f.loading = !1, f.url = "", f.sceneId = g.sceneId, f.isVendorUser = d.isVendorUser, f.isAllowToAccessLastPageSetting = o.isAllowToAccess(o.accessDef.SCENE_HIDE_LASTPAGE_SETTING);
				var r = d.branchid,
					s = 0;
				f.PREFIX_FILE_HOST = PREFIX_FILE_HOST, f.alwaysOpen = !0;
				var t;
				f.scene || (f.scene = {}), f.switchOpen = function() {
					f.alwaysOpen && (f.startDate = null, f.endDate = null)
				}, f.openImageModal = function() {
					m.open({
						windowClass: "img_console console",
						templateUrl: "scene/console/bg.tpl.html",
						controller: "BgConsoleCtrl",
						resolve: {
							obj: function() {
								return {
									fileType: 1,
									elemDef: null,
									coverImage: "coverImage"
								}
							}
						}
					}).result.then(function(a) {
						f.newCoverImage = a, f.newCoverImage.tmbPath = a.data, f.newCoverImage.path = a.data, f.coverImages.unshift(f.newCoverImage), f.scene.image.imgSrc = f.newCoverImage.path
					}, function(a) {})
				}, f.chooseCover = function(a) {
					f.scene.image.imgSrc = a.path
				}, f.openmin = function(a) {
					a.preventDefault(), a.stopPropagation(), f.openedmax = !1, f.openedmin = !0, f.minDateStart = new Date, f.maxDateStart = f.endDate ? new Date(new Date(f.endDate).getTime() - 864e5) : null
				}, f.openmax = function(a) {
					a.preventDefault(), a.stopPropagation(), f.openedmin = !1, f.openedmax = !0, f.minDateEnd = f.startDate ? new Date(new Date(f.startDate).getTime() + 864e5) : new Date
				}, f.dateOptions = {
					formatYear: "yy",
					startingDay: 1
				}, f.formats = ["dd-MMMM-yyyy", "yyyy/MM/dd", "dd.MM.yyyy", "shortDate"], f.format = f.formats[1], f.saveSceneSettings = function(a) {
					if (f.startDate && !f.endDate) return void(f.invalidText = "请选择结束时间");
					if (f.endDate && !f.startDate) return void(f.invalidText = "请选择结束时间");
					if (f.scene.description && f.scene.description.trim().length > 30) return void(f.invalidText = "场景描述不能超过30个字");
					if (!f.scene.name || !f.scene.name.trim()) return void(f.invalidText = "请填写场景名称");
					var e = i(f.scene.name.trim());
					return e > 48 ? void alert("场景名称不能超过48个字符或24个汉字") : f.scene.property && f.scene.property.bottomLabel && f.scene.property.bottomLabel.name && i(f.scene.property.bottomLabel.name) > 16 ? void alert("自定义名称不能超过16个字符") : f.scene.property && f.scene.property.bottomLabel && !f.scene.property.bottomLabel.name && f.scene.property.bottomLabel.url && "http://" != f.scene.property.bottomLabel.url ? void alert("请输入自定义底标名称") : (f.startDate && f.endDate && (f.scene.startDate = f.startDate.getTime(), f.scene.endDate = f.endDate.getTime()), f.startDate && f.endDate || (f.scene.startDate = null, f.scene.endDate = null), f.scene.type = f.scene.type.value, f.scene.pageMode = f.scene.pageMode.id, f.scene.property = b.toJson(f.scene.property), void h.saveSceneSettings(f.scene).then(function(a) {
						q.pushForNextRoute("scene.setting.success", "notify.success"), c.path("my/scene/" + f.sceneId).search({}), d.showSetScenePanel = !1
					}, function(a) {}))
				}, f.getSceneDetail = function() {
					h.getSceneDetail(f.sceneId, r).then(function(a) {
						f.scene = a.data.obj, f.scene.applyPromotion = "" + f.scene.applyPromotion, f.scene.applyTemplate = "" + f.scene.applyTemplate, f.scene.isTpl = "" + f.scene.isTpl, 2 == a.data.obj.pageMode && (a.data.obj.pageMode = 0), f.scene.property ? f.scene.property = JSON.parse(f.scene.property) : f.scene.property = {}, b.forEach(f.pagemodes, function(b, c) {
							a.data.obj.pageMode == b.id && (f.scene.pageMode = b)
						}), f.code = PREFIX_URL + "eqs/qrcode/" + f.scene.code + ".png", f.url = PREFIX_HOST + "v-" + f.scene.code, f.customUrl = l.trustAsResourceUrl(PREFIX_HOST + "v-" + f.scene.id + "&preview=preview"), r && (f.customUrl += (/\?/.test(url) ? "&" : "?") + "user=" + r), f.scene.image.hideEqAd ? f.hideAd = !0 : f.hideAd = !1, s = f.scene.pageCount, f.scene.startDate && f.scene.endDate && (f.startDate = new Date(f.scene.startDate), f.endDate = new Date(f.scene.endDate), f.alwaysOpen = !1), h.getSceneType().then(function(a) {
							f.types = a.data.list, b.forEach(f.types, function(a, b) {
								a.value == f.scene.type || a.sort == f.scene.type ? f.scene.type = a : f.scene.type = f.types[0]
							})
						}), h.getCoverImages().then(function(a) {
							f.coverImages = a.data.list;
							for (var b, c = 0; c < f.coverImages.length; c++) {
								if (f.scene.image.imgSrc == f.coverImages[c].path) {
									t = f.coverImages[c], f.coverImages.splice(c, 1), b = 0;
									break
								}
								t = {
									tmbPath: f.scene.image.imgSrc,
									path: f.scene.image.imgSrc
								}, b = 1
							}
							f.coverImages.unshift(t)
						})
					})
				}, f.getSceneDetail(), f.pagemodes = [{
					id: 0,
					name: "上下翻页"
				}, {
					id: 1,
					name: "上下惯性翻页"
				}, {
					id: 4,
					name: "左右翻页"
				}, {
					id: 3,
					name: "左右惯性翻页"
				}, {
					id: 5,
					name: "左右连续翻页"
				}], f.scene.pageMode = f.pagemodes[0], f.getUserXd = function() {
						f.userXd = 1314
				}, f.getUserXd(), f.hideAdd = function(a) {
					return (f.scene.image.hideEqAd || a) ? (alert("!"), void(f.scene.image.hideEqAd = !1)) : void(a && (f.scene.property.bottomLabel = {}, f.scene.image.hideEqAd = !0))
				}, p.getPageTpls(1301).then(function(a) {
					a.data.list && a.data.list.length > 0 ? f.pageTpls = a.data.list : f.pageTpls = []
				}), p.getPageTpls(1311).then(function(a) {
					a.data.list && a.data.list.length > 0 ? f.bottomPageTpls = a.data.list : f.bottomPageTpls = []
				}), f.chooseLastPage = function(a) {
					f.scene.image.lastPageId = a
				}, f.chooseBottomLabel = function(a) {
					f.scene.image.hideEqAd = !1, f.scene.property.bottomLabel || (f.scene.property.bottomLabel = {}), f.scene.property.bottomLabel.id = a, a || (f.scene.property.bottomLabel = {})
				}
			}
		]), b.module("scene.my.upload", ["angularFileUpload"]), b.module("scene.my.upload").controller("UploadCtrl", ["$scope", "FileUploader", "fileService", "category", "$timeout", "$interval",
			function(a, b, c, d, e, f) {
				a.category = d;
				var g;
				var m="素材上传成功";
				g = a.category.scratch || a.category.headerImage || a.category.companyImg ? a.uploader = new b({
					url: CONTROLLER_URL + "?controller=Show&method=upload&ID=" + d.categoryId + "&fileType=" + d.fileType,
					withCredentials: !0,
					queueLimit: 1,
					onSuccessItem: function(b, c, d, e) {
						function g() {
							f.cancel(h), alert(b.msg), a.$close(c.obj.path)
						}
						a.progressNum = 0;
						var h = f(function() {
							a.progressNum < 100 ? a.progressNum += 15 : g()
						}, 100)
					}
				}) : a.uploader = new b({
					url: CONTROLLER_URL + "?controller=Show&method=upload&ID=" + d.categoryId + "&fileType=" + d.fileType,
					withCredentials: !0,
					queueLimit: 5,
					onErrorItem : function (i, r, s, h){
						if(r.success != true){
							m = "上传失败：" + r.msg
						}
					},
					onCompleteAll: function() {
						function g() {
							f.cancel(h), alert(m), a.$close()
						}
						a.progressNum = 0;
						var h = f(function() {
							a.progressNum < 100 ? a.progressNum += 15 : g()
						}, 100)
					}
				});
				var h;
				("0" == d.fileType || "1" == d.fileType) && (h = "|jpg|png|jpeg|bmp|gif|", limitSize = 1048576), "2" == d.fileType && (h = "|mp3|", limitSize = 2097152), g.filters.push({
					name: "imageFilter",
					fn: function(a, b) {
						var c = "|" + a.type.slice(a.type.lastIndexOf("/") + 1) + "|";
						return -1 !== h.indexOf(c)
					}
				}), g.filters.push({
					name: "imageSizeFilter",
					fn: function(a, b) {
						var c = a.size;
						return c >= limitSize && alert("上传文件大小限制在" + limitSize / 1024 / 1024 + "M以内"), c < limitSize
					}
				}), g.filters.push({
					name: "fileNameFilter",
					fn: function(a, b) {
						return a.name.length > 50 && alert("文件名应限制在50字符以内"), a.name.length <= 50
					}
				});
				var i = function() {
					c.listFileCategory().then(function (b) {
		                a.categoryList = b.data.list, a.categoryList || (a.categoryList = []), a.categoryList.push({name: "我的背景", value: "0"})
		            })
				};
				i(), a.removeQueue = function() {}
			}
		]), b.module("reg", []), b.module("reg").controller("TestLoginCtrl", ["$rootScope", "$scope",
			function(a, b) {
				b.weiChatUrl = "https://open.weixin.qq.com/connect/qrconnect?appid=wx1f0c48fcb51be203&redirect_uri=http://www.hjtmt.com/testlogin.html&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect"
			}
		]), b.module("sample", ["services.sample", "services.mine", "services.scene", "app.directives.addelement", "app.directives.qrcode"]), b.module("sample").controller("SampleCtrl", ["$rootScope", "$http", "$scope", "$timeout", "security", "$window", "sampleService", "MineService", "sceneService", "$routeParams",
			function(a, b, c, d, e, f, g, h, i, j) {
				c.PREFIX_FILE_HOST = PREFIX_FILE_HOST, c.PREFIX_SERVER_HOST = PREFIX_URL, c.PREFIX_CLIENT_HOST = PREFIX_HOST, c.load = function() {
					t = $(".fixed").offset().top, mh = $(".mains").height(), fh = $(".fixed").height(), $("#eq_main").scroll(function() {
						s = $("#eq_main").scrollTop(), s > t - 10 ? ($(".fixed").css("position", "fixed"), s + fh > mh && $(".fixed").css("top", "0px")) : $(".fixed").css("position", "")
					})
				}, c.$on("$destroy", function() {
					$("#eq_main").unbind("scroll")
				}), c.pageNo = 1, c.pageSize = 9, c.scene || (c.scene = {}), c.typeindex = "all", c.getHomes = function(a, b, d, e) {
					c.pageNo = 1, c.typeindex = a, c.currentType = b, c.showMoreButton = !0, g.getSamples(b, d, e).then(function(a) {
						c.homes = a.data.list
					}, function(a) {})
				}, c.getSceneType = function() {
					i.getSceneType().then(function(a) {
						c.sceneTypes = a.data.list
					})
				}, c.showMore = function() {
					c.pageNo++, g.getSamples(c.currentType, c.pageNo, c.pageSize).then(function(a) {
						a.data.list.length > 0 ? c.homes = c.homes.concat(a.data.list) : c.showMoreButton = !1
					}, function(a) {})
				}, c.getSceneType(), c.getHomes("all", null, 1, 9), c.getSamplesPV = function() {
					g.getSamplesPV().then(function(a) {
						c.SamplesPVs = a.data, c.dayTop = c.SamplesPVs.obj.dayTop, c.monthTop = c.SamplesPVs.obj.monthTop, c.weekTop = c.SamplesPVs.obj.weekTop, c.page = "month"
					}, function(a) {})
				}
			}
		]), b.module("scene.create.console", ["scene.create.console.bg", "scene.create.console.map", "scene.create.console.input", "scene.create.console.button", "scene.create.console.setting", "scene.create.console.audio", "scene.create.console.tel", "scene.create.console.fake", "scene.create.console.pictures", "scene.create.console.micro", "scene.create.console.link", "scene.create.console.video", "scene.create.console.category", "scene.create.console.cropImage"]), b.module("scene.create.console").controller("ConsoleCtrl", ["$scope",
			function(a) {}
		]), b.module("scene.create.console.setting.anim", ["app.directives.uislider", "app.directives.limitInput"]), b.module("scene.create.console.setting.anim").controller("AnimConsoleCtrl", ["$scope", "$rootScope", "sceneService",
			function(a, c, d) {
				function e(b, d) {
					var e = {
						anim: b,
						animClasses: j,
						count: d,
						elemId: a.elemDef.id
					};
					c.$broadcast("previewCurrentChange", e)
				}

				function f(b, d) {
					var e = {
						animations: b,
						animClasses: d,
						count: i,
						elemId: a.elemDef.id
					};
					c.$broadcast("previewAllChanges", e)
				}
				var g = a.elemDef = d.currentElemDef;
				a.animations = [], a.types = [], a.directions = [];
				var h, i, j = [];
				a.animTypeEnum = [{
					id: -1,
					name: "无"
				}, {
					id: 0,
					name: "淡入",
					cat: "进入"
				}, {
					id: 1,
					name: "移入",
					cat: "进入"
				}, {
					id: 2,
					name: "弹入",
					cat: "进入"
				}, {
					id: 3,
					name: "中心弹入",
					cat: "进入"
				}, {
					id: 4,
					name: "中心放大",
					cat: "进入"
				}, {
					id: 12,
					name: "翻滚进入",
					cat: "进入"
				}, {
					id: 13,
					name: "光速进入",
					cat: "进入"
				}, {
					id: 6,
					name: "摇摆",
					cat: "强调"
				}, {
					id: 5,
					name: "抖动",
					cat: "强调"
				}, {
					id: 7,
					name: "旋转",
					cat: "强调"
				}, {
					id: 8,
					name: "翻转",
					cat: "强调"
				}, {
					id: 9,
					name: "悬摆",
					cat: "强调"
				}, {
					id: 10,
					name: "淡出",
					cat: "退出"
				}, {
					id: 11,
					name: "翻转消失",
					cat: "退出"
				}], a.animDirectionEnum = [{
					id: 0,
					name: "从左向右"
				}, {
					id: 1,
					name: "从上到下"
				}, {
					id: 2,
					name: "从右向左"
				}, {
					id: 3,
					name: "从下到上"
				}];
				var k;
				if (g.properties.anim)
					if (g.properties.anim instanceof Array) {
						if (g.properties.anim.length)
							for (k = 0; k < g.properties.anim.length; k++)
								if (null != g.properties.anim[k].type && -1 != g.properties.anim[k].type) {
									a.animations.push(g.properties.anim[k]);
									for (var l = 0, m = a.animTypeEnum.length; m > l; l++) a.animations[k].type == a.animTypeEnum[l].id && (a.types[k] = a.animTypeEnum[l]);
									for (l = 0, m = a.animDirectionEnum.length; m > l; l++) a.animations[k].direction == a.animDirectionEnum[l].id && (a.directions[k] = a.animDirectionEnum[l])
								} else g.properties.anim.splice(k, 1), k--
					} else {
						for (k = 0; k < a.animTypeEnum.length; k++) a.animTypeEnum[k].id == g.properties.anim.type && (a.types[0] = a.animTypeEnum[k]);
						null != g.properties.anim.direction ? a.directions[0] = a.animDirectionEnum[g.properties.anim.direction] : a.directions[0] = a.animDirectionEnum[0], g.properties.anim.duration = parseFloat(g.properties.anim.duration), g.properties.anim.delay = parseFloat(g.properties.anim.delay), g.properties.anim.countNum = parseInt(g.properties.anim.countNum, 10) || 1, a.animations.push(g.properties.anim)
					}
				g.properties || (g.properties = {});
				var n = {
					type: null,
					direction: null,
					duration: 2,
					delay: 0,
					countNum: 1,
					count: null
				};
				a.addAnim = function() {
					var c = b.copy(n);
					c.type = a.animTypeEnum[0].id, c.direction = a.animDirectionEnum[0].id, a.animations.push(c);
					var d = a.animations.length;
					a.types[d - 1] = a.animTypeEnum[0], a.directions[d - 1] = a.animDirectionEnum[0]
				}, a.removeAnim = function(b, c) {
					c.stopPropagation(), a.animations.splice(b, 1), a.types.splice(b, 1), a.directions.splice(b, 1)
				}, a.clear = function() {
					a.animations = []
				}, a.$watch("animations", function(b, c) {
					b != c && (g.properties.anim = a.animations)
				}, !0), a.$watch("types", function(b, c) {
					if (b && b != c)
						for (var d = 0; d < b.length; d++) c[d] && b[d].id != c[d].id && e(a.animations[d], d)
				}, !0), a.$watch("directions", function(b, c) {
					if (b && b != c)
						for (var d = 0; d < b.length; d++) c[d] && b[d].id != c[d].id && e(a.animations[d], d)
				}, !0), a.previewAnim = function() {
					for (var c = b.copy(a.animations), d = [], e = [], g = 0; g < c.length; g++) null != c[g].type && -1 != c[g].type ? (d.push(c[g]), e[g] = q.convertType(c[g])) : (c.splice(g, 1), g--);
					i = 0, f(d, e)
				}, a.changeAnimation = function(b, c) {
					 h = q.convertType(b), j[c] = h
				}
			}
		]), b.module("scene.create.console.audio", []), b.module("scene.create.console.audio").controller("AudioConsoleCtrl", ["$scope", "$sce", "$timeout", "$modal", "fileService", "obj",
			function(a, b, c, d, e, f) {
				function g() {
					e.getFileByCategory(1, 30, "1", "2").then(function(b) {
						a.reservedAudios = b.data.list;
						for (var c = 0; c < a.reservedAudios.length; c++) "3" == a.model.bgAudio.type && PREFIX_FILE_HOST + a.reservedAudios[c].path == a.model.type3 && (a.model.selectedAudio = a.reservedAudios[c])
					})
				}

				function h() {
					e.getFileByCategory(1, 10, "0", "2").then(function(b) {
						a.myAudios = b.data.list;
						for (var c = 0; c < a.myAudios.length; c++) "2" == a.model.bgAudio.type && PREFIX_FILE_HOST + a.myAudios[c].path == a.model.type2 && (a.model.selectedMyAudio = a.myAudios[c])
					})
				}
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.model = {
					bgAudio: {
						url: f.url ? f.url : "",
						type: f.type ? f.type : "3"
					},
					compType: "bgAudio"
				}, c(function() {
					"1" == f.type && f.url && (a.model.type1 = f.url), "2" == f.type && f.url && (a.model.type2 = b.trustAsResourceUrl(PREFIX_FILE_HOST + f.url)), "3" == f.type && f.url && (a.model.type3 = b.trustAsResourceUrl(PREFIX_FILE_HOST + f.url))
				}), a.categoryList = [{
					name: "音乐库",
					value: "3"
				}, {
					name: "外部链接",
					value: "1"
				},{
					name: "我的音乐",
					value: "2"
				}], a.goUpload = function() {
					d.open({
						windowClass: "upload-console",
						templateUrl: "my/upload.tpl.html",
						controller: "UploadCtrl",
						resolve: {
							category: function() {
								return {
									categoryId: 0,
									fileType: 2
								}
							}
						}
					}).result.then(function(a) {
						h()
					})
				}, a.selectAudio = function(c) {
					"3" == c && (a.model.selectedAudio ? a.model.type3 = b.trustAsResourceUrl(PREFIX_FILE_HOST + a.model.selectedAudio.path) : a.model.type3 = null), "2" == c && (a.model.selectedMyAudio ? a.model.type2 = b.trustAsResourceUrl(PREFIX_FILE_HOST + a.model.selectedMyAudio.path) : a.model.type2 = null)
				}, a.playAudio = function(a) {
					$("#audition" + a)[0].play()
				}, a.pauseAudio = function(a) {
					$("#audition" + a)[0].pause()
				}, a.confirm = function() {
					if ("1" == a.model.bgAudio.type) {
						if (!a.model.type1) return void alert("链接地址不能为空");
						a.model.bgAudio.url = a.model.type1
					}
					"2" == a.model.bgAudio.type && (a.model.bgAudio.url = a.model.selectedMyAudio.path), "3" == a.model.bgAudio.type && (a.model.bgAudio.url = a.model.selectedAudio.path), a.$close(a.model)
				}, a.cancel = function() {
					a.$dismiss()
				}, g(), h()
			}
		]), b.module("scene.create.console.bg", ["services.file", "scene.my.upload", "app.directives.responsiveImage", "app.directives.rightclick"]), b.module("scene.create.console.bg").controller("BgConsoleCtrl", ["$scope", "$timeout", "$rootScope", "$modal", "ModalService", "sceneService", "fileService", "localizedMessages", "obj",
			function(a, c, d, e, f, g, h, i, j) {
				a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.first = !0, a.categoryList = [], a.imgList = [], a.otherCategory = [], a.categoryId = "1", a.fileType = j.fileType, a.pageSize = i.get("file.bg.pageSize"), a.myTags = [], a.selectedImgs = [], a.selectedImages = [], a.toPage = 1;
				var k = [];
				a.isEditor = d.isEditor;
				var l = function() {
					h.listFileCategory(a.fileType).then(function(b) {
						a.categoryList = b.data.list, a.changeCategory("0", 1)
					})
				};
				a.totalItems = 0, a.currentPage = 1;
				var m = function(b, c) {
					if ("c" == b) {
						a.numPages = 2, a.totalItems = 35;
						var d = [{
							color: "#6366C3"
						}, {
							color: "#29A1D6"
						}, {
							color: "#332E42"
						}, {
							color: "#DBF3FF"
						}, {
							color: "#434A54"
						}, {
							color: "#000000"
						}, {
							color: "#F1F03E"
						}, {
							color: "#FCF08E"
						}, {
							color: "#972D53"
						}, {
							color: "#724192"
						}, {
							color: "#967BDC"
						}, {
							color: "#EC87C1"
						}, {
							color: "#D870AF"
						}, {
							color: "#F6F7FB"
						}, {
							color: "#666C78"
						}, {
							color: "#ABB1BD"
						}, {
							color: "#CCD0D9"
						}, {
							color: "#E6E9EE"
						}, {
							color: "#48CFAE"
						}, {
							color: "#36BC9B"
						}, {
							color: "#3BAEDA"
						}, {
							color: "#50C1E9"
						}, {
							color: "#AC92ED"
						}, {
							color: "#4B89DC"
						}, {
							color: "#4B89DC"
						}, {
							color: "#5D9CEC"
						}, {
							color: "#8DC153"
						}, {
							color: "#ED5564"
						}, {
							color: "#DB4453"
						}, {
							color: "#FB6E52"
						}, {
							color: "#FFCE55"
						}, {
							color: "#F6BB43"
						}, {
							color: "#E9573E"
						}, {
							color: "#9FF592"
						}, {
							color: "#A0D468"
						}];
						a.toPage = c, a.imgList = c && 1 != c ? d.slice(18) : d.slice(0, 18), a.currentPage = c
			            } else"all" == b && (b = ""), h.getFileByCategory(c ? c : 1, a.pageSize, b, a.fileType).then(function (b) {
			                a.imgList = b.data.list, a.totalItems = b.data.map.count, a.currentPage = b.data.map.pageNo, a.allPageCount = b.data.map.count, a.toPage = b.data.map.pageNo, a.numPages = Math.ceil(a.totalItems / a.pageSize)
			            })
				};
				a.replaceImage = function() {
					var c = {};
					if ("p" != j.type) {
						if (a.selectedImages.length > 1) return alert("只能选择一张图片进行替换！"), !1;
						if (!a.selectedImages.length) return alert("还没有选择替换图片"), !1
					} else {
						var d = j.count + a.selectedImages.length;
						if (d > 6) return alert("最多还可选择" + (6 - j.count) + "张图片"), !1;
						c.selectedImages = k
					} if ("c" != a.categoryId) {
						var e = {};
						if ("p" != j.type) {
							var f = a.selectedImages[0].path,
								g = $(".hovercolor").children("img")[0];
							e = {
								type: "imgSrc",
								data: f,
								width: g.width,
								height: g.height
							}
						}
						b.extend(c, e), a.$close(c)
					} else {
						var h = a.selectedImages[0].color;
						a.$close({
							type: "backgroundColor",
							color: h
						})
					}
				}, a.getImagesByPage = function(b, c) {
					a.currentPage = c, 0 === b ? isNaN(a.tagIndex) || -1 == a.tagIndex ? a.changeCategory(b, c) : a.getImagesByTag(a.myTags[a.tagIndex].id, a.tagIndex, c) : isNaN(a.sysTagIndex) || -1 == a.sysTagIndex ? a.changeCategory(b, c) : a.getImagesBySysTag(a.childCatrgoryList[a.sysTagIndex].id, a.sysTagIndex, c, b)
				}, a.replaceBgImage = function(b, c) {
					var d, e = c.target;
					d = "IMG" == e.nodeName.toUpperCase() ? e : $("img", e)[0], a.$close({
						type: "imgSrc",
						data: b,
						width: d.width,
						height: d.height
					})
				}, a.replaceBgColor = function(b, c) {
					a.$close({
						type: "backgroundColor",
						color: b
					})
				}, a.changeCategory = function(b, c) {
					return ("c" == b || "all" == b || "0" == b) && (a.allImages.checked = !1, a.sysTagIndex = -1), a.selectedImages = [], k = [], 1 > c || c > a.totalItems / a.pageSize + 1 ? void alert("此页超出范围") : (a.imgList = [], b || (b = "0"), a.categoryId = b, void("0" === b ? (a.pageSize = i.get("file.bg.pageSize") - 1, a.getImagesByTag("", a.tagIndex, c), a.tagIndex = -1) : (a.pageSize = i.get("file.bg.pageSize"), m(b, c))))
				};
				var n = null;
				a.createCategory = function() {
					return a.myTags.length >= 8 ? void alert("最多能创建8个自定义标签！") : void(n = e.open({
						windowClass: "console",
						templateUrl: "scene/console/category.tpl.html",
						controller: "CategoryConsoleCtrl"
					}).result.then(function(b) {
						a.myTags.push(b)
					}, function() {}))
				}, a.getCustomTags = function() {
					h.getCustomTags().then(function(b) {
						a.myTags = b.data.list
					}, function(a) {
						alert("服务器异常")
					})
				}, a.getCustomTags(), a.deleteTag = function(b, c) {
					h.deleteTag(b).then(function(b) {
						a.myTags.splice(c, 1)
					}, function(a) {
						alert("服务器异常")
					})
				}, a.hover = function(a) {
					a.showOp = !a.showOp
				}, a.systemImages = !1, a.switchToSystemImages = function(b) {
					a.systemImages = "true" === b
				}, a.switchSelect = function(c, d) {
					if (d.target.id != c.id)
						if (c.selected = !c.selected, c.selected) {
							var e, f = d.target;
							e = "IMG" == f.nodeName.toUpperCase() ? $(f) : $("img", f);
							var g = new Image;
							g.src = e.attr("src"), c.width = g.width, c.height = g.height, a.systemImages && (b.forEach(a.selectedImages, function(a, b) {
								a.selected = !1
							}), k.splice(0, k.length), a.selectedImages.splice(0, a.selectedImages.length)), k.push({
								width: g.width,
								height: g.height,
								src: c.path
							}), a.selectedImages.push(c)
						} else
							for (var h in a.selectedImages) a.selectedImages[h] == c && (a.selectedImages.splice(h, 1), k.splice(h, 1))
				}, a.selectTag = function(b, c) {
					a.dropTagIndex = c, a.id = a.myTags[c].id
				}, a.setCategory = function(b, c) {
					a.dropTagIndex = -1;
					var d = [];
					if (!c)
						for (var e in a.selectedImages) d.push(a.selectedImages[e].id);
					var f = c ? c : d.join(",");
					h.setCategory(a.id, f).then(function(a) {}, function(a) {})
				}, a.hoverTag = function(a) {
					a.hovered = !a.hovered
				}, a.prevent = function(b, c) {
					b.selected || (b.selected = !0, a.selectedImages.push(b))
				}, a.unsetTag = function() {
					var b = [];
					for (var c in a.selectedImages) b.push(a.selectedImages[c].id);
					h.unsetTag(a.myTags[a.tagIndex].id, b.join(",")).then(function(b) {
						a.getImagesByTag(a.myTags[a.tagIndex].id, a.tagIndex, a.currentPage)
					}, function(a) {})
				}, a.setIndex = function(b) {
					a.dropTagIndex = -1, a.selectedImages.length || (alert("请您选中图片再进行分类！"), b.stopPropagation())
				}, a.getChildCategory = function(b) {
					h.getChildCategory(b).then(function(b) {
						a.sysTagIndex = -1, 200 == b.data.code && (a.childCatrgoryList = b.data.list)
					}, function(a) {})
				}, a.goUpload = function() {
					e.open({
						windowClass: "upload-console",
						templateUrl: "my/upload.tpl.html",
						controller: "UploadCtrl",
						resolve: {
							category: function() {
								return {
									categoryId: a.categoryId,
									fileType: a.fileType,
									coverImage: j.coverImage
								}
							}
						}
					}).result.then(function() {
						a.changeCategory(a.categoryId)
					}, function() {})
				}, a.allImages = {
					checked: !1
				}, a.selectAll = function() {
					for (var b in a.imgList) a.allImages.checked ? (a.imgList[b].selected = !0, a.selectedImages.push(a.imgList[b])) : (a.imgList[b].selected = !1, a.selectedImages = [])
				}, a.getImagesByTag = function(b, c, d) {
					return 1 > d || d > a.totalItems / a.pageSize + 1 ? void alert("此页超出范围") : (a.allImages.checked = !1, a.selectedImages = [], a.tagIndex = c, void h.getImagesByTag(b, a.fileType, d, a.pageSize).then(function(b) {
						a.imgList = b.data.list, a.totalItems = b.data.map.count, a.currentPage = b.data.map.pageNo, a.allPageCount = b.data.map.count, a.toPage = b.data.map.pageNo, a.numPages = Math.ceil(a.totalItems / a.pageSize)
					}, function(a) {
						alert("服务器异常")
					}))
				}, a.getImagesBySysTag = function(b, c, d, e) {
					return 1 > d || d > a.totalItems / a.pageSize + 1 ? void alert("此页超出范围") : (a.allImages.checked = !1, a.selectedImages = [], a.sysTagIndex = c, void h.getImagesBySysTag(b, a.fileType, d, a.pageSize, e).then(function(b) {
						a.imgList = b.data.list, a.totalItems = b.data.map.count, a.currentPage = b.data.map.pageNo, a.allPageCount = b.data.map.count, a.toPage = b.data.map.pageNo, a.numPages = Math.ceil(a.totalItems / a.pageSize)
					}, function(a) {
						alert("服务器异常")
					}))
				}, a.deleteImage = function(b, c) {
					var d = [];
					if (c && c.stopPropagation(), !b && 0 === a.selectedImages.length) return void alert("请您选中图片后再进行删除操作！");
					var e = b ? "确定删除此图片？" : "确定删除所选图片？";
					if (!b)
						for (var g in a.selectedImages) d.push(a.selectedImages[g].id);
					var i = b ? b : d.join(",");
					f.openConfirmDialog({
						msg: e
					}, function() {
						h.deleteFile(i).then(function() {
							k = [], isNaN(a.tagIndex) || -1 == a.tagIndex ? a.changeCategory("0", a.currentPage) : a.getImagesByTag(a.myTags[a.tagIndex].id, a.tagIndex, a.currentPage)
						})
					})
				}, l()
			}
		]), b.module("scene.create.console.button", []), b.module("scene.create.console.button").controller("ButtonConsoleCtrl", ["$scope", "$timeout", "localizedMessages", "obj",
			function(a, b, c, d) {
				a.model = {
					title: d.properties.title
				}, a.authError = "", a.confirm = function() {
					return a.model.title && 0 !== a.model.title.length ? void a.$close(a.model) : (a.authError = "按钮名称不能为空", void $('.bg_console input[type="text"]').focus())
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("scene.create.console.category", ["services.file"]), b.module("scene.create.console.category").controller("CategoryConsoleCtrl", ["$scope", "$timeout", "localizedMessages", "fileService",
			function(a, c, d, e) {
				a.category = {}, a.confirm = function() {
					return a.category.name && a.category.name.trim() ? i(a.category.name) > 16 ? void alert("类别字数不能超过16个字符！") : void e.createCategory(b.copy(a.category.name)).then(function(c) {
						a.category.id = c.data.obj, a.$close(b.copy(a.category))
					}, function(a) {
						alert("创建失败")
					}) : void alert("类别不能为空！")
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("scene.create.console.cropImage", ["services.file"]).directive("cropImage", ["sceneService", "fileService", "$compile",
			function(a, b, c) {
				return {
					restrict: "EAC",
					scope: {},
					replace: !0,
					templateUrl: "scene/console/cropimage.tpl.html",
					link: function(c, d, e) {
						function f() {
							o.css.width / o.css.height > m / n ? (k = parseInt(o.css.width * m / o.css.width, 10), l = parseInt(o.css.height * m / o.css.width, 10)) : (k = parseInt(o.css.width * n / o.css.height, 10), l = parseInt(o.css.height * n / o.css.height, 10));
							var a = (m - k) / 2,
								b = (n - l) / 2,
								c = (m - k) / 2 + k,
								d = (n - l) / 2 + l;
							j = [0, 0, m, n], r = o.css.width / o.css.height, i = [a, b, c, d]
						}

						function g(a) {
							$(".cropWidth").html(parseInt(a.w, 10)), $(".cropHeight").html(parseInt(a.h, 10))
						}
						c.PREFIX_FILE_HOST = PREFIX_FILE_HOST;
						var h, i, j, k, l, m, n, o = a.currentElemDef,
							p = a.currentElemDef.properties.src,
							q = $("#target"),
							r = o.css.width / o.css.height;
						c.fit = !0, c.lockRatio = !1, c.$on("changeElemDef", function(a, b) {
							o = b, c.fit = !0, c.lockRatio = !1, o.properties.src != p ? (p = o.properties.src, h.setImage(PREFIX_FILE_HOST + p), q.unbind("load").attr("src", PREFIX_FILE_HOST + p).load(function() {
								m = this.width, n = this.height, c.preSelectImage(p), c.$apply()
							})) : (c.preSelectImage(p), c.$apply())
						}), c.preSelectImage = function(a) {
							h ? (f(), h.setOptions({
								aspectRatio: r,
								setSelect: i
							})) : q.attr("src", PREFIX_FILE_HOST + a).load(function() {
								m = this.width, n = this.height, q.Jcrop({
									onChange: g,
									keySupport: !1,
									setSelect: [0, 0, 100, 100],
									boxHeight: 320,
									boxWidth: 680
								}, function() {
									h = this
								}), a && (f(), h.setOptions({
									aspectRatio: r,
									setSelect: i
								}))
							})
						}, c.preSelectImage(p), c.$watch("lockRatio", function(a, b) {
							if (h) {
								var c = h.tellSelect();
								c.w = parseInt(c.w, 10), c.h = parseInt(c.h, 10), h.setOptions(a ? {
									aspectRatio: c.w / c.h
								} : {
									aspectRatio: null
								})
							}
						}), c.$watch("fit", function(a, b) {
							if (h)
								if (a) {
									var c = h.tellSelect();
									c.x = parseInt(c.x, 10), c.y = parseInt(c.y, 10), c.x2 = parseInt(c.x2, 10), c.y2 = parseInt(c.y2, 10), j = [c.x, c.y, c.x2, c.y2], h.setOptions({
										aspectRatio: r,
										setSelect: i
									})
								} else h.setOptions({
									aspectRatio: null,
									setSelect: j
								})
						}), c.crop = function() {
							var c = a.currentElemDef,
								e = h.tellSelect();
							return 0 === e.w || 0 === e.h ? void $(d).hide() : (e.x = parseInt(e.x, 10), e.y = parseInt(e.y, 10), e.w = parseInt(e.w, 10), e.h = parseInt(e.h, 10), e.x2 = parseInt(e.x2, 10), e.y2 = parseInt(e.y2, 10), e.src = $("#target").attr("src").split(PREFIX_FILE_HOST)[1], void b.cropImage(e).then(function(a) {
								var b = {
									type: "imgSrc",
									data: a.data.obj,
									width: e.w,
									height: e.h
								};
								c.properties.src = b.data;
								var f = b.width / b.height,
									g = $("#" + c.id),
									h = $("#inside_" + c.id).width(),
									i = $("#inside_" + c.id).height(),
									j = h / i;

								f >= j ? (i = h / f, $("#inside_" + c.id).height(i), c.css.height = i, c.properties.height = i, g.outerHeight(i), g.outerWidth(h), g.css("marginLeft", 0), g.css("marginTop", 0)) : (h = i * f, $("#inside_" + c.id).width(h), c.css.width = h, c.properties.width = h, g.outerWidth(h), g.outerHeight(i), g.css("marginTop", 0), g.css("marginLeft", 0)), g.attr("src", PREFIX_FILE_HOST + b.data), c.properties.imgStyle = {}, c.properties.imgStyle.width = g.outerWidth(), c.properties.imgStyle.height = g.outerHeight(), c.properties.imgStyle.marginTop = g.css("marginTop"), c.properties.imgStyle.marginLeft = g.css("marginLeft"), $(d).hide()
							}, function(b) {
								c.properties.src || a.deleteElement(c.id)
							}))
						}, c.cancel = function() {
							$(d).hide()
						}
					}
				}
			}
		]), b.module("scene.create.console.fake", []), b.module("scene.create.console.fake").controller("FakeConsoleCtrl", ["$scope", "type",
			function(a, b) {
				a.type = b
			}
		]), b.module("scene.create.console.input", []), b.module("scene.create.console.input").controller("InputConsoleCtrl", ["$scope", "$timeout", "localizedMessages", "obj",
			function(a, b, c, d) {
				a.model = {
					title: d.title,
					type: d.type,
					required: d.properties.required
				}, a.confirm = function() {
					return a.model.title && 0 !== a.model.title.length ? void a.$close(a.model) : (alert("输入框名称不能为空"), void $('.bg_console input[type="text"]').focus())
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("scene.create.console.link", ["services.scene"]), b.module("scene.create.console.link").controller("LinkConsoleCtrl", ["$scope", "$timeout", "obj", "sceneService",
			function(a, c, d, e) {
				a.url = {}, a.url.externalLink = "http://";
				var f;
				a.confirm = function() {
					"external" == a.url.link ? f = a.url.externalLink : "internal" == a.url.link && (f = a.url.internalLink.id), a.$close(f)
				}, a.cancel = function() {
					a.$dismiss()
				}, a.removeLink = function(b) {
					"external" == b ? a.url.externalLink = "http://" : "internal" == b && (a.url.internalLink = a.pageList[0]), a.url.link = ""
				}, a.changed = function() {
					"external" == a.url.link ? a.url.internalLink = a.pageList[0] : a.url.externalLink = "http://"
				}, a.selectRadio = function(b) {
					a.url.link || ("external" == b ? a.url.link = "external" : "internal" == b && (a.url.link = "internal"))
				}, a.getPageNames = function() {
					var c = d.sceneId;
					e.getPageNames(c).then(function(c) {
						a.pageList = c.data.list, a.pageList.unshift({
							id: 0,
							name: "无"
						}), a.url.internalLink = a.pageList[0], b.forEach(a.pageList, function(b, c) {
							b.name || (b.name = "第" + b.num + "页"), d.properties.url && d.properties.url == b.id && (a.url.link = "internal", a.url.internalLink = b)
						}), d.properties.url && isNaN(d.properties.url) && (a.url.link = "external", a.url.externalLink = decodeURIComponent(d.properties.url.split("=")[2]))
					})
				}, a.getPageNames()
			}
		]), b.module("scene.create.console.map", ["app.directives.comp.editor"]), b.module("scene.create.console.map").controller("MapConsoleCtrl", ["$scope", "sceneService", "$timeout",
			function(a, b, c) {
				var d = null,
					e = null;
				a.address = {
					address: "",
					lat: "",
					lng: ""
				}, a.search = {
					address: ""
				}, a.searchResult = [], c(function() {
					d = new BMap.Map("l-map"), d.addControl(new BMap.NavigationControl), d.centerAndZoom(new BMap.Point(116.404, 39.915), 12);
					var b = {
						onSearchComplete: function(b) {
							e.getStatus() == BMAP_STATUS_SUCCESS && (a.searchResult = b.Fn, a.$apply())
						}
					};
					e = new BMap.LocalSearch(d, b)
				}), a.searchAddress = function() {
					e.search(a.search.address)
				}, a.setPoint = function(b, c, e) {
					a.address.address = e, a.address.lat = b, a.address.lng = c, d.clearOverlays();
					var f = new BMap.Point(c, b),
						g = new BMap.Marker(f);
					d.addOverlay(g);
					var h = new BMap.Label(e, {
						offset: new BMap.Size(20, -10)
					});
					g.setLabel(h), d.centerAndZoom(f, 12)
				}, a.resetAddress = function() {
					a.$close(a.address)
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("scene.create.console.micro", ["app.directives.addelement", "services.scene"]), b.module("scene.create.console.micro").controller("MicroConsoleCtrl", ["$scope", "$timeout", "localizedMessages", "obj", "sceneService",
			function(a, c, d, e, f) {
				a.model || (a.model = {});
				var g = [];
				a.isSelected = [], a.backgroundColors = [{
					backgroundColor: "#D34141"
				}, {
					backgroundColor: "#000"
				}, {
					backgroundColor: "#23A3D3"
				}, {
					backgroundColor: "#79C450"
				}, {
					backgroundColor: "#fafafa"
				}], a.labelNames = [{
					id: 1,
					title: "栏目一",
					color: {
						backgroundColor: ""
					}
				}, {
					id: 2,
					title: "栏目二",
					color: {
						backgroundColor: ""
					}
				}, {
					id: 3,
					title: "栏目三",
					color: {
						backgroundColor: ""
					}
				}, {
					id: 4,
					title: "栏目四",
					color: {
						backgroundColor: ""
					}
				}], a.model.color = e.properties.labels[0].color.backgroundColor, a.selectColor = function(c) {
					a.model.color = c.backgroundColor, b.forEach(a.labelNames, function(a, b) {
						a.color.backgroundColor && (a.color.backgroundColor = c.backgroundColor)
					})
				}, b.forEach(e.properties.labels, function(c, d) {
					b.forEach(a.labelNames, function(a, b) {
						c.id == a.id && (a.title = c.title, a.color.backgroundColor = c.color.backgroundColor, a.link = c.link, a.selected = !0, c.mousedown = !1)
					})
				}), a.confirm = function() {
					g = [];
					var c = 0,
						d = 0;
					b.forEach(a.labelNames, function(a, b) {
						a.selected && (a.link ? g.push(a) : d++, c++)
					}), 2 > c ? alert("导航标签不能少于两个！") : d > 0 ? alert("每个导航必须有链接页面！") : a.$close(g)
				}, a.cancel = function() {
					a.$dismiss()
				}, a.switchLabel = function(b, c) {
					a.label = b, b.selected ? a.labelIndex == c ? (b.color.backgroundColor = "", b.selected = !1, b.mousedown = !1) : (a.labelIndex = c, b.mousedown = !0) : (b.color.backgroundColor = a.model.color, a.labelIndex = c, b.selected = !0, b.mousedown = !0), b.mousedown ? (a.model.title = b.title, b.link ? a.model.link = a.pageList[b.link] : a.model.link = a.pageList[0]) : (a.model.title = "", a.model.link = a.pageList[0])
				}, a.selectLink = function(b) {
					a.label.mousedown && (a.label.link = b.num, console.log(a.labelNames))
				}, a.changeLabelName = function() {
					a.label.mousedown && (a.label.title = a.model.title)
				}, a.getPageNames = function() {
					var c = e.sceneId;
					f.getPageNames(c).then(function(c) {
						a.pageList = c.data.list, a.pageList.unshift({
							id: 0,
							name: "无"
						}), b.forEach(a.pageList, function(a, b) {
							a.name || (a.name = "第" + a.num + "页")
						}), a.model.link = a.pageList[0]
					})
				}, a.getPageNames()
			}
		]), b.module("scene.create.console.pictures", ["services.file"]).controller("picturesCtrl", ["$scope", "$timeout", "$rootScope", "$modal", "picturesService", "obj",
			function(a, c, d, e, f, g) {
				var h = 530,
					i = 265,
					j = a.picStyles = utilPictures.getPicStyle();
				a.currentImageIndex = -1;
				var k = b.copy(g),
					l = a.position = k.css;
				if (null != l.width && null != l.height) {
					var m = l.width / l.height,
						n = h / i;
					m > n ? (l.width = h, l.height = h / m) : (l.height = i, l.width = i * m)
				}
				var o = a.properties = k.properties;
				o.autoPlay = null == o.autoPlay ? !0 : o.autoPlay, o.interval = null == o.interval ? 4e3 : o.interval, o.picStyle = null == o.picStyle ? j[0] : utilPictures.getPicStyle(o.picStyle), o.bgColor = null == o.bgColor ? "rgba(255,255,255,1)" : o.bgColor, o.children = null == o.children ? [] : o.children, f.setImages(o.children), a.choosePic = function() {
					return o.children.length >= 6 ? void alert("最多可选择6张图片") : void e.open({
						windowClass: "console img_console",
						templateUrl: "scene/console/bg.tpl.html",
						controller: "BgConsoleCtrl",
						resolve: {
							obj: function() {
								return {
									fileType: 1,
									type: "p",
									count: o.children.length,
									elemDef: g
								}
							}
						}
					}).result.then(function(a) {
						$.each(a.selectedImages, function(a, b) {
							f.addImages({
								src: b.src,
								desc: "",
								height: b.height,
								width: b.width
							})
						})
					}, function() {})
				}, a.ok = function() {
					return 0 === o.children.length ? void alert("请选择图片") : (o.picStyle = o.picStyle.value, g.properties = o, void a.$close(o))
				}, a.cancel = function() {
					a.$dismiss()
				}, a.$on("currentImage.update", function(b, c) {
					a.currentImageIndex = c
				}), a.$on("images.add", function(a, b) {
					o.children = b
				}), a.$on("images.update", function(a, b) {
					o.children = b
				})
			}
		]).factory("picturesService", ["$rootScope", "fileService",
			function(a, b) {
				var c, d, e = {},
					f = [];
				return e.setJcrop = function(b) {
					a.$broadcast("jcrop.update", b)
				}, e.setImageSize = function(b) {
					a.$broadcast("image.update", b)
				}, e.setCurrentImage = function(b) {
					d = b, a.$broadcast("currentImage.update", b)
				}, e.getCurrentImage = function() {
					return d
				}, e.addImages = function(b) {
					f.push(b), a.$broadcast("images.add", f)
				}, e.updateImages = function(b, c) {
					f.splice(b, 1, c), a.$broadcast("images.update", f)
				}, e.deleteImages = function(b) {
					f.splice(b, 1), a.$broadcast("images.update", f)
				}, e.setImages = function(a) {
					return f = a
				}, e.getImages = function() {
					return f
				}, e.setProperties = function(a) {
					c = a
				}, e.getProperties = function() {
					return c
				}, e.cropImage = function(c) {
					b.cropImage(c).success(function(b) {
						if (b.success) {
							var d = {
								width: c.w,
								height: c.h,
								desc: "",
								src: b.obj
							};
							a.$broadcast("crop.success", d)
						} else alert(b.msg)
					}).error(function() {
						alert("网络连接超时，请稍后重试")
					})
				}, e
			}
		]).directive("eqxPicturesImageCrop", ["$compile", "picturesService",
			function(a, b) {
				return {
					link: function(c, d) {
						var e = $(d),
							f = $(".pic-preview"),
							g = {
								width: f.width(),
								height: f.height()
							};
						c.showOperation = !0;
						var h, i = '<div class="operation" ng-show="!showOperation"><a class="quxiao" ng-click="cropCancel()">取消</a><a class="finish" ng-click="cropOk()">完成</a></div>';
						c.$on("image.update", function(a, b) {
							h = {
								width: b.width,
								height: b.height
							}
						}), c.$on("jcrop.update", function(d, j) {
							f.append(a(i)(c)), c.showOperation = !0, c.$apply();
							var k = f.children("img"),
								l = {
									width: k.width(),
									height: k.height()
								};
							e.removeClass("hover").unbind("click").click(function() {
								var a = b.getImages();
								0 !== a.length && (c.showOperation = $(this).hasClass("hover"), c.showOperation ? ($(this).removeClass("hover"), j.release(), j.disable()) : ($(this).addClass("hover"), j.setSelect([0, 0, l.width, l.height]), j.enable()))
							}), c.cropOk = function() {
								var a = j.tellSelect();
								if (!(a.w === g.width && a.h === g.height || 0 === a.w && 0 === a.h)) {
									var c = h.width / l.width;
									a.w = parseInt(a.w * c, 10), a.h = parseInt(a.h * c, 10), a.x = parseInt(a.x * c, 10), a.y = parseInt(a.y * c, 10), a.x2 = parseInt((a.w + a.x) * c, 10), a.y2 = parseInt((a.h + a.y) * c, 10), a.src = k.attr("src").split(PREFIX_FILE_HOST)[1], b.cropImage(a)
								}
							}, c.cropCancel = function() {
								c.showOperation = !0, e.removeClass("hover"), j.release(), j.disable()
							}
						})
					}
				}
			}
		]).directive("eqxPicturesImagePreview", ["picturesService",
			function(a) {
				return {
					link: function(b, c) {
						var d, e, f = $(c),
							g = $(".pic-preview"),
							h = {
								width: g.width(),
								height: g.height()
							},
							i = h.width / h.height;
						f.hide(), f.load(function() {
							f.show(), e = {
								width: this.width,
								height: this.height
							}, a.setImageSize(e);
							var b, c = e.width / e.height;
							c > i ? ($(this).css({
								width: h.width,
								height: h.width / c
							}), b = {
								position: "absolute",
								top: "50%",
								marginTop: -h.width / c / 2
							}) : ($(this).css({
								width: h.height * c,
								height: h.height
							}), b = {
								margin: "auto"
							}), f.Jcrop({
								keySupport: !1,
								aspectRatio: i
							}, function() {
								d = this
							}), $(".jcrop-holder").css(b), a.setJcrop(d), d.disable()
						})
					}
				}
			}
		]).directive("eqxPicturesImageClick", ["$compile", "picturesService",
			function(a, b) {
				function c(b, c) {
					$(".pic-preview").html(a('<img eqx-pictures-image-preview ng-src="' + c + '" />')(b))
				}
				return {
					link: function(a, d) {
						var e = $(d);
						e.click(function() {
							if (!e.hasClass("hover")) {
								var d = e.index();
								b.setCurrentImage(d), c(a, $(this).find(".pic-img").attr("src"))
							}
						}), e.children(".delete-img").click(function(c) {
							c.stopPropagation(), e.hasClass("hover") && $(".pic-preview").empty();
							var d = e.index();
							b.deleteImages(d);
							var f = b.getCurrentImage();
							f > d ? b.setCurrentImage(--f) : d === f && b.setCurrentImage(-1), a.$apply()
						}), a.$on("crop.success", function(d, f) {
							if (e.hasClass("hover")) {
								var g = PREFIX_FILE_HOST + f.src;
								c(a, g);
								var h = e.index();
								b.updateImages(h, f)
							}
						})
					}
				}
			}
		]), b.module("scene.create.console.setting", ["scene.create.console.setting.style", "scene.create.console.setting.anim"]), b.module("scene.create.console.setting").directive("styleModal", ["sceneService", "$compile",
			function(a, b) {
				return {
					restrict: "AE",
					replace: !0,
					scope: {},
					templateUrl: "scene/console/setting.tpl.html",
					link: function(a, b, c) {
						b.bind("keydown", function(a) {
							a.stopPropagation()
						});
						var d = "style";
						a.$on("showStylePanel", function(b, c) {
							d = a.activeTab, a.activeTab = "", a.$apply(), c && c.activeTab ? a.activeTab = c.activeTab : a.activeTab = d, a.$apply()
						}), a.activeTab = c.activeTab, a.cancel = function() {
							$(b).hide()
						}, a.$on("$locationChangeStart", function() {
							a.cancel()
						})
					},
					controller: ["$scope",
						function(a) {}
					]
				}
			}
		]), b.module("scene.create.console.setting.style", ["colorpicker.module", "app.directives.style", "app.directives.uislider", "app.directives.limitInput"]), b.module("scene.create.console.setting.style").controller("StyleConsoleCtrl", ["$scope", "sceneService",
			function(a, b) {
				var c = a.elemDef = b.currentElemDef;
				delete c.css.borderTopLeftRadius, delete c.css.borderTopRightRadius, delete c.css.borderBottomLeftRadius, delete c.css.borderBottomRightRadius, delete c.css.border;
				var d = c.css,
					e = $("#inside_" + a.elemDef.id + " > .element-box");
				if (a.model = {
					backgroundColor: d.backgroundColor || "",
					opacity: 100 - 100 * d.opacity || 0,
					color: d.color || "#676767",
					borderWidth: parseInt(d.borderWidth, 10) || 0,
					borderStyle: d.borderStyle || "solid",
					borderColor: d.borderColor || "rgba(0,0,0,1)",
					paddingBottom: parseInt(d.paddingBottom, 10) || 0,
					paddingTop: parseInt(d.paddingTop, 10) || 0,
					lineHeight: +d.lineHeight || 1,
					borderRadius: parseInt(d.borderRadius, 10) || 0,
					transform: d.transform && parseInt(d.transform.replace("rotateZ(", "").replace("deg)", ""), 10) || 0
				}, a.maxRadius = Math.min(e.outerWidth(), e.outerHeight()) / 2 + 10, d.borderRadiusPerc ? a.model.borderRadiusPerc = parseInt(d.borderRadiusPerc, 10) : d.borderRadius ? "999px" == d.borderRadius ? a.model.borderRadiusPerc = 100 : (a.model.borderRadiusPerc = parseInt(100 * parseInt(d.borderRadius, 10) * 2 / Math.min(e.outerWidth(), e.outerHeight()), 10), a.model.borderRadiusPerc > 100 && (a.model.borderRadiusPerc = 100)) : a.model.borderRadiusPerc = 0, a.tmpModel = {
					boxShadowDirection: 0,
					boxShadowX: 0,
					boxShadowY: 0,
					boxShadowBlur: 0,
					boxShadowSize: 0,
					boxShadowColor: "rgba(0,0,0,0.5)"
				}, d.boxShadow) {
					var f = d.boxShadow.split(" ");
					a.tmpModel.boxShadowX = parseInt(f[0], 10), a.tmpModel.boxShadowY = parseInt(f[1], 10), a.tmpModel.boxShadowDirection = parseInt(d.boxShadowDirection, 10) || 0, a.tmpModel.boxShadowBlur = parseInt(f[2], 10), a.tmpModel.boxShadowColor = f[3], a.tmpModel.boxShadowSize = parseInt(d.boxShadowSize, 10) || 0
				}
				a.clear = function() {
					a.model = {
						backgroundColor: "",
						opacity: 0,
						color: "#676767",
						borderWidth: 0,
						borderStyle: "solid",
						borderColor: "rgba(0,0,0,1)",
						paddingBottom: 0,
						paddingTop: 0,
						lineHeight: 1,
						borderRadius: 0,
						transform: 0
					}, a.tmpModel = {
						boxShadowDirection: 0,
						boxShadowX: 0,
						boxShadowY: 0,
						boxShadowBlur: 0,
						boxShadowSize: 0,
						boxShadowColor: "rgba(0,0,0,0.5)"
					}
				}, a.$watch("tmpModel", function(b, d) {
					var e = {};
					$.extend(!0, e, a.model), e.borderRadius += "px", e.borderTopLeftRadius = e.borderTopRightRadius = e.borderBottomLeftRadius = e.borderBottomRightRadius = e.borderRadius, e.opacity = (100 - a.model.opacity) / 100, e.boxShadow = Math.round(a.tmpModel.boxShadowX) + "px " + Math.round(a.tmpModel.boxShadowY) + "px " + a.tmpModel.boxShadowBlur + "px " + a.tmpModel.boxShadowColor, e.boxShadowDirection = a.tmpModel.boxShadowDirection, e.boxShadowSize = a.tmpModel.boxShadowSize, e.transform = "rotateZ(" + a.model.transform + "deg)", $.extend(!0, c.css, e)
				}, !0), a.$watch("model", function(b, d) {
					var e = {};
					$.extend(!0, e, a.model), e.borderRadius += "px", e.borderTopLeftRadius = e.borderTopRightRadius = e.borderBottomLeftRadius = e.borderBottomRightRadius = e.borderRadius, e.opacity = (100 - a.model.opacity) / 100, e.boxShadow = Math.round(a.tmpModel.boxShadowX) + "px " + Math.round(a.tmpModel.boxShadowY) + "px " + a.tmpModel.boxShadowBlur + "px " + a.tmpModel.boxShadowColor, e.boxShadowDirection = a.tmpModel.boxShadowDirection, e.boxShadowSize = a.tmpModel.boxShadowSize, e.transform = "rotateZ(" + a.model.transform + "deg)", $.extend(!0, c.css, e)
				}, !0)
			}
		]).directive("styleInput", function() {
			return {
				restrict: "AE",
				link: function(a, b, c) {
					var d = $("#inside_" + a.elemDef.id + " > .element-box");
					a.$watch(function() {
						return $(b).val()
					}, function() {
						if ("borderWidth" == c.cssItem) {
							d.css({
								borderStyle: a.model.borderStyle,
								borderWidth: $(b).val()
							});
							var e = {
								width: d.width(),
								height: d.height()
							};
							if (4 == a.elemDef.type) {
								var f = d.find("img"),
									g = f.width() / f.height(),
									h = e.width / e.height;
								g >= h ? (f.outerHeight(e.height), f.outerWidth(e.height * g), f.css("marginLeft", -(f.outerWidth() - e.width) / 2), f.css("marginTop", 0)) : (f.outerWidth(e.width), f.outerHeight(e.width / g), f.css("marginTop", -(f.outerHeight() - e.height) / 2), f.css("marginLeft", 0)), a.elemDef.properties.imgStyle.marginTop = f.css("marginTop"), a.elemDef.properties.imgStyle.marginLeft = f.css("marginLeft"), a.elemDef.properties.imgStyle.width = f.outerWidth(), a.elemDef.properties.imgStyle.height = f.outerHeight()
							}
						}
						"borderRadius" == c.cssItem && d.css({
							borderRadius: a.model.borderRadius
						}), "opacity" == c.cssItem && d.css({
							opacity: (100 - $(b).val()) / 100
						}), "backgroundColor" == c.cssItem && d.css({
							backgroundColor: $(b).val()
						}), "color" == c.cssItem && d.css({
							color: $(b).val()
						}), "borderStyle" == c.cssItem && d.css({
							borderStyle: a.model.borderStyle
						}), "borderColor" == c.cssItem && d.css({
							borderColor: a.model.borderColor
						}), "padding" == c.cssItem && d.css({
							paddingTop: a.model.paddingTop,
							marginTop: -a.model.paddingBottom
						}), "lineHeight" == c.cssItem && d.css({
							lineHeight: a.model.lineHeight
						}), "transform" == c.cssItem && d.parents("li").css({
							transform: "rotateZ(" + a.model.transform + "deg)"
						}), "boxShadow" == c.cssItem && (a.tmpModel.boxShadowX = -Math.sin(a.tmpModel.boxShadowDirection * Math.PI / 180) * a.tmpModel.boxShadowSize, a.tmpModel.boxShadowY = Math.cos(a.tmpModel.boxShadowDirection * Math.PI / 180) * a.tmpModel.boxShadowSize, d.css({
							boxShadow: Math.round(a.tmpModel.boxShadowX) + "px " + Math.round(a.tmpModel.boxShadowY) + "px " + a.tmpModel.boxShadowBlur + "px " + a.tmpModel.boxShadowColor
						}))
					})
				}
			}
		}).directive("angleKnob", function() {
			return {
				restrict: "AE",
				templateUrl: "scene/console/angle-knob.tpl.html",
				link: function(a, b, c) {
					function d(a, b) {
						var c = Math.sqrt((a - 28) * (a - 28) + (b - 28) * (b - 28)) / 28,
							d = 28 + (a - 28) / c,
							e = 28 + (b - 28) / c;
						g.css({
							top: Math.round(e),
							left: Math.round(d)
						})
					}

					function e(a, b) {
						var c = a - 28,
							d = 28 - b,
							e = 180 * Math.atan(c / d) / Math.PI;
						return b > 28 && (e += 180), 28 >= b && 28 > a && (e += 360), Math.round(e)
					}
					var f = $(b).find(".sliderContainer"),
						g = $(b).find(".sliderKnob");
					a.$watch(function() {
						return a.tmpModel.boxShadowDirection
					}, function(a) {
						g.css({
							top: 28 - 28 * Math.cos(a * Math.PI / 180),
							left: 28 + 28 * Math.sin(a * Math.PI / 180)
						})
					}), 0 !== a.tmpModel.boxShadowDirection && g.css({
						top: 28 - 28 * Math.cos(a.tmpModel.boxShadowDirection * Math.PI / 180),
						left: 28 + 28 * Math.sin(a.tmpModel.boxShadowDirection * Math.PI / 180)
					}), f.bind("mousedown", function(b) {
						b.stopPropagation();
						var c = f.offset().left,
							g = f.offset().top;
						d(b.pageX - c, b.pageY - g);
						var h = e(b.pageX - c, b.pageY - g);
						a.tmpModel.boxShadowDirection = h, a.$apply(), $(this).bind("mousemove", function(b) {
							b.stopPropagation(), d(b.pageX - c, b.pageY - g);
							var f = e(b.pageX - c, b.pageY - g);
							a.tmpModel.boxShadowDirection = f, a.$apply()
						}), $(this).bind("mouseup", function(a) {
							$(this).unbind("mousemove"), $(this).unbind("mouseup")
						})
					})
				}
			}
		}), b.module("scene.create.console.tel", ["app.directives.addelement"]), b.module("scene.create.console.tel").controller("TelConsoleCtrl", ["$scope", "$timeout", "localizedMessages", "obj",
			function(a, c, d, e) {
				a.model = {
					title: e.properties.title,
					number: e.properties.number
				}, a.confirm = function() {
					if (!a.model.title || 0 === a.model.title.length) return alert("按钮名称不能为空"), void $('.bg_console input[type="text"]').focus();
					if (!a.model.number || 0 === a.model.title.number) return alert("电话号码不能为空"), void $('.bg_console input[type="text"]').focus();
					var b = new RegExp(/(\d{11})|^((\d{7,8})|(^400[0-9]\d{6})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/g);
					return b.test(a.model.number) ? void a.$close(a.model) : void alert("手机号码格式错误")
				}, a.cancel = function() {
					a.$dismiss()
				}, a.removePlaceHolder = function(a) {
					$(".tel-button").attr("placeholder", "")
				}, a.addPlaceHolder = function() {
					$(".tel-button").attr("placeholder", "010-88888888")
				}, a.chooseTelButton = function(b, c, d) {
					a.model.title = b.text, "A" == d.target.nodeName && (a.model.btnStyle = b.btnStyle), a.btnIndex = c
				}, a.buttons = [{
					id: 1,
					text: "一键拨号",
					btnStyle: {
						width: "90px",
						backgroundColor: "rgb(244, 113, 31)",
						height: "30px",
						"text-algn": "center",
						"line-height": "30px",
						color: "rgb(255, 255, 255)",
						"-webkit-border-radius": "5px",
						"-moz-border-radius": "5px",
						"border-radius": "3px"
					}
				}, {
					id: 2,
					text: "热线电话",
					btnStyle: {
						width: "90px",
						backgroundColor: "rgb(253, 175, 7)",
						height: "30px",
						"text-algn": "center",
						"line-height": "30px",
						color: "rgb(255, 255, 255)",
						"-webkit-border-radius": "40px",
						"-moz-border-radius": "40px",
						"border-radius": "3px"
					}
				}, {
					id: 3,
					text: "拨打电话",
					btnStyle: {
						width: "90px",
						backgroundColor: "rgb(121, 196, 80)",
						height: "30px",
						"text-algn": "center",
						"line-height": "30px",
						color: "rgb(255, 255, 255)",
						"-webkit-border-radius": "5px",
						"-moz-border-radius": "5px",
						"border-radius": "3px"
					}
				}, {
					id: 4,
					text: "一键拨号",
					btnStyle: {
						width: "90px",
						height: "30px",
						backgroundColor: "#fff",
						"text-algn": "center",
						border: "1px solid #3FB816",
						"line-height": "30px",
						color: "rgb(0, 0, 0)",
						"-webkit-border-radius": "5px",
						"-moz-border-radius": "5px",
						"border-radius": "3px"
					}
				}], b.forEach(a.buttons, function(b, c) {
					e.css.background && e.css.background == b.btnStyle.background && (a.btnIndex = c)
				})
			}
		]), b.module("scene.create.console.video", []), b.module("scene.create.console.video").controller("VideoCtrl", ["$scope", "$timeout", "obj",
			function(a, b, c) {
				function d(a) {
					var b = a.substring(a.indexOf("src=") + 4),
						c = b.substring(b.indexOf("://") + 3),
						d = c.substring(0, c.indexOf("/"));
					return d.indexOf("v.qq") >= 0 || d.indexOf("tudou") >= 0 || d.indexOf("youku") >= 0 ? !0 : !1
				}
				a.model || (a.model = {}), a.model.src = c.properties.src, a.confirm = function() {
					if (!a.model.src) return void alert("请输入视频地址");
					var b = d(a.model.src);
					return b ? void a.$close(a.model.src) : void alert("暂不支持添加此视频！")
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]), b.module("scene.create", ["app.directives.editor", "services.scene", "confirm-dialog", "services.modal", "app.directives.component", "services.pagetpl", "scene.create.console", "app.directives.comp.editor", "app.directives.addelement", "scene.my.upload", "services.i18nNotifications", "services.history", "security.service", "scene.edit.select", "scene.edit.common", "scene.edit.keymap"]), b.module("scene.create").controller("CreateSceneCtrl", ["$timeout", "$compile", "$rootScope", "$scope", "$routeParams", "$route", "$location", "sceneService", "pageTplService", "$modal", "ModalService", "security", "$window", "i18nNotifications", "historyService", "panStateTracker",
			function(c, d, e, f, g, h, j, k, l, m, n, o, p, q, r, s) {
				function t(a, c, d, g) {
					f.loading = !0, $("#editBG").hide(), f.pageId = f.pages[a - 1].id, k.getSceneByPage(f.pageId, c, d).then(function(g) {
						f.loading = !1, f.tpl = g.data, y = JSON.stringify(f.tpl), f.sceneId = f.tpl.obj.sceneId, f.tpl.obj.properties && (f.tpl.obj.properties.image || f.tpl.obj.properties.scratch) ? (f.tpl.obj.properties.scratch ? f.scratch = f.tpl.obj.properties.scratch : f.tpl.obj.properties.image && (f.scratch.image = f.tpl.obj.properties.image, f.scratch.percentage = f.tpl.obj.properties.percentage, f.tpl.obj.properties.tip && (f.scratch.tip = f.tpl.obj.properties.tip)), f.effectName = "涂抹", b.forEach(f.scratches, function(a, b) {
							a.path == f.scratch.image.path && (f.scratch.image = a)
						}), b.forEach(f.percentages, function(a, b) {
							a.value == f.scratch.percentage.value && (f.scratch.percentage = a)
						})) : (f.scratch = {}, f.scratch.image = f.scratches[0], f.scratch.percentage = f.percentages[0]), f.tpl.obj.properties && f.tpl.obj.properties.finger ? (f.finger = f.tpl.obj.properties.finger, f.effectName = "指纹", b.forEach(f.fingerZws, function(a, b) {
							a.path == f.finger.zwImage.path && (f.finger.zwImage = a)
						}), b.forEach(f.fingerBackgrounds, function(a, b) {
							a.path == f.finger.bgImage.path && (f.finger.bgImage = a)
						})) : (f.finger = {}, f.finger.zwImage = f.fingerZws[0], f.finger.bgImage = f.fingerBackgrounds[0]), f.tpl.obj.properties && f.tpl.obj.properties.effect && "money" == f.tpl.obj.properties.effect.name && (f.effectName = "数钱", f.money = {
							tip: f.tpl.obj.properties.effect.tip
						}), f.tpl.obj.properties && f.tpl.obj.properties.fallingObject ? (f.falling = f.tpl.obj.properties.fallingObject, b.forEach(f.fallings, function(a, b) {
							a.path == f.falling.src.path && (f.falling.src = a)
						}), f.effectName = "环境") : f.falling = {
							src: f.fallings[0],
							density: 2
						}, (c || d) && (j.$$search = {}, j.search("pageId", ++a), f.getPageNames()), f.pageNum = a, x = f.tpl.obj.scene.name, $("#nr").empty();
						var h = b.copy(f.tpl.obj);
						h.elements = r.addPage(h.id, h.elements), k.templateEditor.parse({
							def: f.tpl.obj,
							appendTo: "#nr",
							mode: "edit"
						}), e.$broadcast("dom.changed")
					}, function() {
						f.loading = !1
					})
				}

				function u() {
					j.path(e.lastRoute ? e.lastRoute : "main")
				}

				function v() {
					q.pushForCurrentRoute("scene.save.success.nopublish", "notify.success")
				}
				f.loading = !1, f.PREFIX_FILE_HOST = PREFIX_FILE_HOST, f.tpl = {};
				var w, x = "",
					y = "",
					z = "";
				f.templateType = 1, f.categoryId = -1, f.isEditor = e.isEditor, f.createComp = k.createComp, f.createCompGroup = k.createCompGroup, f.updateCompPosition = k.updateCompPosition, f.updateCompAngle = k.updateCompAngle, f.updateCompSize = k.updateCompSize, f.openAudioModal = k.openAudioModal;
				var A = null;
				f.scratch || (f.scratch = {}), f.finger || (f.finger = {}), f.effectList = [{
					type: "scratch",
					name: "涂抹",
					src: CLIENT_CDN + "addons/Market/Show/public/images/create/waterdrop.jpg"
				}, {
					type: "finger",
					name: "指纹",
					src: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/zhiwen1.png"
				}, {
					type: "money",
					name: "数钱",
					src: CLIENT_CDN + "addons/Market/Show/public/images/create/money_thumb1.jpg"
				}, {
					type: "fallingObject",
					name: "环境",
					src: CLIENT_CDN + "addons/Market/Show/public/images/create/falling.png"
				}], f.oneEffect = {
					type: "fallingObject",
					name: "环境",
					src: CLIENT_CDN + "addons/Market/Show/public/images/create/falling.png"
				}, f.scratches = [{
					name: "水滴",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/waterdrop.jpg"
				}, {
					name: "细沙",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/sand.jpg"
				}, {
					name: "花瓣",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/flowers.jpg"
				}, {
					name: "金沙",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/goldsand.jpg"
				}, {
					name: "白雪",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/snowground.jpg"
				}, {
					name: "模糊",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/mohu.jpg"
				}, {
					name: "落叶",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/leaves.jpg"
				}, {
					name: "薄雾",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/smoke.png"
				}], f.percentages = [{
					id: 1,
					value: .15,
					name: "15%"
				}, {
					id: 2,
					value: .3,
					name: "30%"
				}, {
					id: 3,
					value: .6,
					name: "60%"
				}], f.fingerZws = [{
					name: "粉色指纹",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/zhiwen1.png"
				}, {
					name: "白色指纹",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/zhiwen2.png"
				}, {
					name: "蓝色指纹",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/zhiwen3.png"
				}], f.fingerBackgrounds = [{
					name: "粉红回忆",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg1.jpg"
				}, {
					name: "深蓝花纹",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg2.jpg"
				}, {
					name: "淡绿清新",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg3.jpg"
				}, {
					name: "深紫典雅",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg4.jpg"
				}, {
					name: "淡紫水滴",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg5.jpg"
				}, {
					name: "蓝白晶格",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg6.jpg"
				}, {
					name: "蓝色水滴",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg7.jpg"
				}, {
					name: "朦胧绿光",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg8.jpg"
				}, {
					name: "灰色金属",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fingers/bg9.jpg"
				}], f.fallings = [{
					name: "福字",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fallings/fuzi1.png",
					rotate: 180,
					vy: 3
				}, {
					name: "红包",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fallings/hongbao2.png",
					rotate: 180,
					vy: 3
				}, {
					name: "绿枫叶",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fallings/lvfengye.png",
					rotate: 180,
					vy: 3
				}, {
					name: "星星",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fallings/xing.png",
					rotate: 180,
					vy: 3
				}, {
					name: "雪花",
					path: CLIENT_CDN + "addons/Market/Show/public/images/create/fallings/snow.png",
					rotate: 0,
					vy: 1
				}], f.scratch.image = f.scratches[0], f.scratch.percentage = f.percentages[0], f.finger.zwImage = f.fingerZws[0], f.finger.bgImage = f.fingerBackgrounds[0], f.$on("dom.changed", function(a) {
					d($("#nr"))(f)
				}), f.openUploadModal = function() {
					A || (A = m.open({
						windowClass: "upload-console",
						templateUrl: "my/upload.tpl.html",
						controller: "UploadCtrl",
						resolve: {
							category: function() {
								return {
									categoryId: "0",
									fileType: "1",
									scratch: "scratch"
								}
							}
						}
					}).result.then(function(a) {
						f.scratch.image.path = f.PREFIX_FILE_HOST + a, f.scratch.image.name = "", A = null
					}, function() {
						A = null
					}))
				}, f.cancel = function() {}, f.cancelEffect = function() {
					f.effectType = "", $("#modalBackdrop1").remove()
				};
				var B = null;
				f.$on("showCropPanel", function(a, b) {
					var c = $(".content").eq(0);
					B ? (e.$broadcast("changeElemDef", b), B.show()) : B = d("<div crop-image></div>")(f), c.append(B)
				}), f.saveEffect = function(a) {
					if (f.tpl.obj.properties = {}, "scratch" == f.effectType) f.tpl.obj.properties.scratch = a, f.effectName = "涂抹";
					else if ("finger" == f.effectType) f.tpl.obj.properties.finger = a, f.effectName = "指纹";
					else if ("money" == f.effectType) {
						if (a && a.tip && i(a.tip) > 24) return alert("提示文字不能超过24个字符！"), void(f.tpl.obj.properties = null);
						a || (a = {
							tip: "握紧钱币，数到手抽筋吧！"
						}), f.tpl.obj.properties.effect = {
							name: "money",
							tip: a.tip
						}, f.effectName = "数钱"
					}
					"fallingObject" == f.effectType && (f.tpl.obj.properties.fallingObject = a, f.effectName = "环境"), f.cancelEffect()
				};
				var C = null;
				f.$on("showStylePanel", function(a, b) {
					var c = $(".content").eq(0);
					C ? C.show() : "style" == b.activeTab ? C = d('<div style-modal active-tab="style"></div>')(f) : "anim" == b.activeTab && (C = d('<div style-modal active-tab="anim"></div>')(f)), c.append(C)
				}), f.$on("hideStylePanel", function(a) {
					C && C.hide()
				}), f.refreshPage = function(a, b) {
					parseInt(b, 10);
					$("#nr").empty(), k.templateEditor.parse({
						def: f.tpl.obj,
						appendTo: "#nr",
						mode: "edit"
					}), e.$broadcast("dom.changed")
				}, f.navTo = function(a, b) {
					f.pageList = !0, !f.isEditor || 1101 !== f.sceneId && 1102 !== f.sceneId && 1103 !== f.sceneId || (f.pageLabelAll.length = 0, f.pageIdTag = a.id, f.getPageTagLabel()), a.id != f.tpl.obj.id && (f.saveScene(null, function() {
						t(b + 1), j.$$search = {}, j.search("pageId", a.num)
					}), s.clear())
				}, f.stopCopy = function() {
					copied = !1
					
				}, f.getOriginPageName = function(a) {
					z = a.name
				}, f.getPageNames = function() {
					var a = g.sceneId;
					k.getPageNames(a).then(function(a) {
						f.pages = a.data.list, b.forEach(f.pages, function(a, b) {
							a.name || (a.name = "第" + (b + 1) + "页")
						}), t(j.search().pageId ? j.search().pageId : f.pages[0].num)
					})
				}, f.getPageNames(), f.editableStatus = [], f.savePageNames = function(a, b) {
					a.name || (a.name = "第" + (b + 1) + "页"), f.tpl.obj.name = a.name, z != a.name && k.savePageNames(f.tpl.obj).then(function(a) {
						q.pushForCurrentRoute("page.change.success", "notify.success")
					})
				}, f.removeScratch = function(a) {
					a.stopPropagation(), f.tpl.obj.properties = null
				}, f.$on("text.click", function(a, b) {
					$("#btn-toolbar").remove(), $("body").append(d("<toolbar></toolbar>")(f));
					var e = $(b).offset().top;
					c(function() {
						$("#btn-toolbar").css("top", e - 50), $("#btn-toolbar").show(), $("#btn-toolbar").bind("click mousedown", function(a) {
							a.stopPropagation()
						}), $(b).wysiwyg_destroy(), $(b).wysiwyg(), b.focus()
					})
				}), f.updatePosition = function(a) {
					var b, c, d = f.tpl.obj.elements,
						e = [];
					for (c = 0; c < d.length; c++)
						if ("3" == d[c].type) {
							d[c].num = 0, e.push(d[c]), d.splice(c, 1);
							break
						}
					for (b = 0; b < a.length; b++)
						for (c = 0; c < d.length; c++)
							if (d[c].num == a[b]) {
								d[c].num = b + 1, e.push(d[c]), d.splice(c, 1);
								break
							}
					f.tpl.obj.elements = e
				}, f.updateEditor = function() {
					$("#nr").empty(), k.templateEditor.parse({
						def: f.tpl.obj,
						appendTo: "#nr",
						mode: "edit"
					}), d($("#nr"))(f)
				};
				var D = !1;
				f.saveScene = function(a, c) {
					if (!D) {
						if (D = !0, y == JSON.stringify(f.tpl)) return c && c(), a && (!f.tpl.obj.scene.publishTime || f.tpl.obj.scene.updateTime > f.tpl.obj.scene.publishTime ? v() : q.pushForCurrentRoute("scene.save.success.published", "notify.success")), void(D = !1);
						"" === f.tpl.obj.scene.name && (f.tpl.obj.scene.name = x), f.tpl.obj.scene.name = f.tpl.obj.scene.name.replace(/(<([^>]+)>)/gi, ""), k.getSceneObj().obj.scene.image && k.getSceneObj().obj.scene.image.bgAudio && (f.tpl.obj.scene.image || (f.tpl.obj.scene.image = {}), f.tpl.obj.scene.image.bgAudio = k.getSceneObj().obj.scene.image.bgAudio), k.resetCss(), k.saveScene(f.tpl.obj).then(function() {
							D = !1, f.tpl.obj.scene.updateTime = (new Date).getTime(), y = b.toJson(f.tpl), w && (k.recordTplUsage(w), w = null), c && c(), a && v()
						}, function() {
							D = !1
						})
					}
				}, f.publishScene = function() {
					return f.tpl.obj.scene.publishTime && f.tpl.obj.scene.updateTime <= f.tpl.obj.scene.publishTime && w == b.toJson(f.tpl) ? (location.href=PREFIX_HOST + "addons/show.php?method=preview&id=" + f.sceneId) : void f.saveScene(null, function() {
						k.publishScene(f.tpl.obj.sceneId).then(function(a) {
							a.data.success && (q.pushForNextRoute("scene.publish.success", "notify.success"), (location.href=PREFIX_HOST + "addons/show.php?method=preview&id=" + f.sceneId))
						})
					})
				}, f.exitScene = function() {
					JSON.parse(y);
					y == b.toJson(f.tpl) ? u() : n.openConfirmDialog({
						msg: "是否保存更改内容？",
						confirmName: "保存",
						cancelName: "不保存"
					}, function() {
						f.saveScene(), u()
					}, function() {
						u()
					})
				}, f.duplicatePage = function() {
					f.saveScene(null, function() {
						t(f.pageNum, !1, !0)
					})
				}, f.insertPage = function() {
					f.saveScene(null, function() {
						t(f.pageNum, !0, !1)
					}), $("#pageList").height() >= 360 && c(function() {
						var a = document.getElementById("pageList");
						a.scrollTop = a.scrollHeight
					}, 200)
				}, f.deletePage = function(a) {
					a.stopPropagation(), f.loading || (f.loading = !0, k.deletePage(f.tpl.obj.id).then(function() {
						f.loading = !1, j.$$search = {}, f.pages.length == f.pageNum ? (f.pages.pop(), j.search("pageId", --f.pageNum), t(f.pageNum, !1, !1)) : (f.pages.splice(f.pageNum - 1, 1), j.search("pageId", f.pageNum), t(f.pageNum, !1, !1))
					}, function() {
						f.loading = !1
					}))
				}, f.removeBG = function(a) {
					a.stopPropagation();
					var b, c = f.tpl.obj.elements;
					for (b = 0; b < c.length; b++)
						if (3 == c[b].type) {
							c.splice(b, 1);
							var d;
							for (d = b; d < c.length; d++) c[d].num--;
							break
						}
					$("#nr .edit_area").parent().css({
						backgroundColor: "transparent",
						backgroundImage: "none"
					}), $("#editBG").hide()
				}, f.removeBGAudio = function(a) {
					a.stopPropagation(), delete f.tpl.obj.scene.image.bgAudio
				}, $(".scene_title").on("paste", function(a) {
					a.preventDefault();
					var b = (a.originalEvent || a).clipboardData.getData("text/plain") || prompt("Paste something..");
					document.execCommand("insertText", !1, b)
				}), f.showPageEffect = !1, f.openPageSetPanel = function() {
					f.showPageEffect || (f.showPageEffect = !0, $('<div id="modalBackdrop" class="modal-backdrop fade in" ng-class="{in: animate}" ng-style="{\'z-index\': 1040 + (index &amp;&amp; 1 || 0) + index*10}" modal-backdrop="" style="z-index: 1040;"></div>').appendTo("body").click(function() {
						f.showPageEffect = !1, f.$apply(), $(this).remove()
					}))
				}, f.openOneEffectPanel = function(a) {
					f.showPageEffect = !1, $("#modalBackdrop").remove(), a.type ? f.effectType = a.type : a.image || a.scratch ? f.effectType = "scratch" : a.finger ? f.effectType = "finger" : a.fallingObject ? f.effectType = "fallingObject" : f.effectType = a.effect.name, $('<div id="modalBackdrop1" class="modal-backdrop fade in" ng-class="{in: animate}" ng-style="{\'z-index\': 1040 + (index &amp;&amp; 1 || 0) + index*10}" modal-backdrop="" style="z-index: 1040;"></div>').appendTo("body").click(function() {
						f.effectType = "", f.$apply(), $(this).remove()
					})
				}, f.myName = [{
					name: "我的"
				}], f.myCompany = [{
					name: "企业"
				}], f.creatCompanyTemplate = function() {
					var a = $.extend(!0, {}, f.tpl.obj);
					if (e.user) {
						var b = parseInt(e.user.companyTplId, 10);
						b ? a.sceneId = b : e.companySceneId ? a.sceneId = e.companySceneId : a.sceneId = null, k.saveCompanyTpl(a).then(function(a) {
							a.data.success && (alert("成功生成企业模板"), e.companySceneId = a.data.obj, f.getPageTplsByCompanyType())
						})
					} else f.myCompanyTpls = []
				};
				var E = null;
				f.getPageTplsByCompanyType = function() {
					if (f.myCompany[0].active = !0, !E)
						if (e.companySceneId) E = e.companySceneId;
						else {
							var a = parseInt(e.user.companyTplId, 10);
							a && (E = e.companySceneId = a)
						}
					E ? k.previewScene(E).then(function(a) {
						f.myCompanyTpls = a.data.list
					}) : f.myCompanyTpls = []
				}, f.creatMyTemplate = function() {
					var a = $.extend(!0, {}, f.tpl.obj);
					if (e.user) {
						var b = JSON.parse(e.user.property);
						b && b.myTplId ? a.sceneId = b.myTplId : e.mySceneId ? a.sceneId = e.mySceneId : a.sceneId = null, k.saveMyTpl(a).then(function(a) {
							alert("成功生成我的模板");
							e.mySceneId = a.data.obj, f.getPageTplsByMyType()
						})
					} else f.myPageTpls = []
				};
				var F = null;
				f.getPageTplsByMyType = function() {
					if (f.myName[0].active = !0, !F)
						if (e.mySceneId) F = e.mySceneId;
						else {
							var a = JSON.parse(e.user.property);
							a && a.myTplId && (F = e.mySceneId = a.myTplId)
						}
					F ? k.previewScene(F).then(function(a) {
						f.myPageTpls = a.data.list
					}) : f.myPageTpls = []
				}, f.$on("myPageList.update", function(a, b, c) {
					"my-tpl" == b && f.getPageTplsByMyType(), "company-tpl" == b && f.getPageTplsByCompanyType()
				}), f.$on("myPageList.delete", function(a, b, c) {
					"company-tpl" == b && 21 == e.user.type && (c.context.firstElementChild.outerHTML = "")
				});
				var G = function() {
						var a = "1" == f.type ? 3 : 4;
						f.childCatrgoryList && f.childCatrgoryList.length > a ? (f.otherCategory = f.childCatrgoryList.slice(a), f.childCatrgoryList = f.childCatrgoryList.slice(0, a)) : f.otherCategory = []
					},
					H = {};
				f.getPageTplsByType = function(a) {
					H[a] ? (f.childCatrgoryList = H[a], f.getPageTplTypestemp(f.childCatrgoryList[0].id, a), G()) : l.getPageTagLabel(a).then(function(b) {
						f.childCatrgoryList = H[a] = b.data.list, f.getPageTplTypestemp(f.childCatrgoryList[0].id, a), G()
					})
				};
				var I = {};
				f.getPageTagLabel = function(a) {
					I[a] ? (f.pageLabel = I[a], K()) : l.getPageTagLabel(a).then(function(b) {
						f.pageLabel = I[a] = b.data.list, K()
					})
				}, f.pageLabelAll = [];
				var J, K = function(a) {
					l.getPageTagLabelCheck(f.pageIdTag).then(function(a) {
						J = a.data.list;
						for (var b = 0; b < f.pageLabel.length; b++) {
							for (var c = {
								id: f.pageLabel[b].id,
								name: f.pageLabel[b].name
							}, d = 0; d < J.length; d++) {
								if (J[d].id === f.pageLabel[b].id) {
									c.ischecked = !0;
									break
								}
								c.ischecked = !1
							}
							f.pageLabelAll.push(c)
						}
					})
				};
				f.pageChildLabel = function() {
					var a, b = [];
					for (a = 0; a < f.pageLabelAll.length; a++) f.pageLabelAll[a].ischecked && b.push(f.pageLabelAll[a].id);
					l.updataChildLabel(b, f.pageIdTag).then(function() {
						alert("分配成功！"), h.reload()
					}, function() {})
				}, f.getPageTplTypestemp = function(a, b) {
					l.getPageTplTypestemp(a, b).then(function(b) {
						if (f.categoryId = a, b.data.list && b.data.list.length > 0 ? f.pageTpls = b.data.list : f.pageTpls = [], f.otherCategory.length > 0) {
							var c;
							c = f.childCatrgoryList[0];
							for (var d = 0; d < f.otherCategory.length; d++) f.categoryId == f.otherCategory[d].id && (f.childCatrgoryList[0] = f.otherCategory[d], f.otherCategory[d] = c)
						}
					})
				}, f.getBigTab = function() {
					l.getPageTplTypes().then(function(a) {
						a.data.list && a.data.list.length > 0 ? f.pageTplTypes = a.data.list.splice(0, 3) : f.pageTplTypes = []
					}).then(function() {
						f.getPageTplsByType(f.pageTplTypes[0].value)
					})
				}, f.getBigTab(), f.exitPageTplPreview = function() {
					$("#nr").empty(), k.templateEditor.parse({
						def: f.tpl.obj,
						appendTo: "#nr",
						mode: "edit"
					}), e.$broadcast("dom.changed")
				}, f.insertPageTpl = function(a) {
					f.loading = !0;
					var b = function(a) {
						k.getSceneTpl(a).then(function(a) {
							f.loading = !1, w = a.data.obj.id, f.tpl.obj.elements = k.getElements(), $("#nr").empty(), r.addPageHistory(f.tpl.obj.id, f.tpl.obj.elements), k.templateEditor.parse({
								def: f.tpl.obj,
								appendTo: "#nr",
								mode: "edit"
							}), e.$broadcast("dom.changed")
						}, function() {
							f.loading = !1
						})
					};
					f.tpl.obj.elements && f.tpl.obj.elements.length > 0 ? n.openConfirmDialog({
						msg: "页面模板会覆盖编辑区域已有组件，是否继续？",
						confirmName: "是",
						cancelName: "取消"
					}, function() {
						b(a)
					}) : b(a)
				}, f.chooseThumb = function() {
					m.open({
						windowClass: "console",
						templateUrl: "scene/console/bg.tpl.html",
						controller: "BgConsoleCtrl",
						resolve: {
							obj: function() {
								return {
									fileType: "0"
								}
							}
						}
					}).result.then(function(a) {
						f.tpl.obj.properties || (f.tpl.obj.properties = {}), f.tpl.obj.properties.thumbSrc = a.data
					}, function() {
						f.tpl.obj.properties.thumbSrc = null
					})
				}, $(a).bind("beforeunload", function() {
					return "请确认您的场景已保存"
				}), f.$on("$destroy", function() {
					$(a).unbind("beforeunload"), r.clearHistory(), k.setCopy(!1), utilPictures.clearInterval()
				}), f.sortableOptions = {
					placeholder: "ui-state-highlight ui-sort-position",
					containment: "#containment",
					update: function(a, b) {
						var c = b.item.sortable.dropindex + 1,
							d = f.pages[b.item.sortable.index].id;
						f.saveScene(null, function() {
							k.changePageSort(c, d).then(function(a) {
								t(c, !1, !1, !0), j.$$search = {}, j.search("pageId", c), f.pageNum = c
							})
						})
					}
				}, f.$on("history.changed", function() {
					f.canBack = r.canBack(f.tpl.obj.id), f.canForward = r.canForward(f.tpl.obj.id)
				}), f.back = function() {
					k.historyBack()
				}, f.forward = function() {
					k.historyForward()
				}
			}
		]).directive("changeColor", function() {
			return {
				link: function(a, b, c) {
					b.bind("click", function() {
						$(b).addClass("current")
					})
				}
			}
		}).directive("thumbTpl", ["sceneService", "ModalService",
			function(a, b) {
				return {
					scope: {
						myTpl: "="
					},
					replace: !1,
					template: '<div class="delete-element" ng-click="deleteMyTpl($event)" title="删除此模板"><img ng-src="/addons/Market/Show/public/images/bg_07.png" /></div>',
					link: function(c, d, e) {
						c.$emit("myPageList.delete", e.id, d), c.deleteMyTpl = function(f) {
							f.stopPropagation(), b.openConfirmDialog({
								msg: "确定删除此模板?"
							}, function() {
								a.deletePage(c.myTpl.id).then(function() {
									c.$emit("myPageList.update", e.id, d)
								}, function(a) {
									alert("服务器异常!")
								})
							})
						}, a.templateEditor.parse({
							def: c.myTpl,
							appendTo: d,
							mode: "view"
						}), $(".edit_area", d).css("transform", "scale(0.25) translateX(-480px) translateY(-729px)")
					}
				}
			}
		]), b.module("scene.create.new", ["services.scene"]), b.module("scene.create.new").controller("SceneNewCtrl", ["$scope", "$location", "sceneService", "items",
			function(a, c, d, e) {
				a.scene = {
					name: ""
				}, e && (a.scene.name = e.name), d.getSceneType().then(function(c) {
					if (a.scene.types = c.data.list, e) {
						var d = !0;
						b.forEach(a.scene.types, function(b, f) {
							if (d) {
								var g = "" + e.type;
								b.value === g ? (a.scene.type = b, d = !1) : a.scene.type = c.data.list[0]
							}
						})
					} else a.scene.type = c.data.list[0]
				}), a.create = function() {
					if ("" === a.scene.name.trim()) return void alert("请输入场景名称");
					var b = i(a.scene.name.trim());
					if (b > 48) return void alert("场景名称不能超过48个字符或24个汉字");
					if (e) {
						var f = {
							id: e.id,
							name: a.scene.name,
							type: a.scene.type.value,
							pageMode: a.scene.pageMode.id
						};
						d.createByTpl(f).then(function(a) {
                   if(a.data.code == 1006){
								alert("抱歉您的"+a.data.msg+"次创建场景次数已经用完，请联系管理员！")
								return false;
							}
							c.path("scene/create/" + a.data.obj), c.search("pageId", 1)
						}, function(a) {})
					} else d.createBlankScene(a.scene.name, a.scene.type.value, a.scene.pageMode.id).then(function(a) {
               if(a.data.code == 1006){
								alert("您的"+a.data.msg+"次创建场景次数已经用完，请联系管理员！")
								return false;
							}
						c.path("scene/create/" + a.data.obj), c.search("pageId", 1)
					});
					a.$close()
				}, a.cancel = function() {
					a.$dismiss()
				}, a.pagemodes = [{
					id: 2,
					name: "上下翻页"
				}, {
					id: 1,
					name: "左右翻页"
				}], a.scene.pageMode = a.pagemodes[0]
			}
		]),
		function() {
			function a(a, b, c, d, e) {
				function f(a, c, e) {
					function f() {
						g(i)
					}
					a.$on("element.delete", function(a) {
						i = b.getElements();
						for (var c = 0, e = i.length; e > c; c++) {
							var h = $("#nr").find("#inside_" + i[c]).attr("ctype");
							if ("5" == h.charAt(0)) return void d.openConfirmDialog({
								msg: "将删除已收集的数据!",
								confirmName: "删除",
								cancelName: "取消"
							}, f)
						}
						g(i)
					}), a.$on("element.selectall", function(a) {
						h()
					})
				}

				function g(d) {
					var f = a.getSceneObj();
					c.addPageHistory(f.obj.id, f.obj.elements), $.each(d, function(b, c) {
						$("#nr").find("#inside_" + c).remove(), a.deleteElement(c)
					}), b.clearElements(), c.addPageHistory(f.obj.id, f.obj.elements), e.$broadcast("hideStylePanel"), $("#popMenu").hide()
				}

				function h() {
					b.clearElements();
					var a = $("#nr").find("ul").find("li");
					a.children(".bar").show(), a.each(function(a, c) {
						b.addElement($(c).attr("id").split("_")[1])
					})
				}
				var i;
				return {
					restrict: "EA",
					link: f
				}
			}
			b.module("scene.edit.common", ["services.scene", "services.select", "services.history"]).directive("editCommon", ["sceneService", "selectService", "historyService", "ModalService", "$rootScope", a])
		}(),
		function() {
			function a(a, b, c, d) {
				function e(c, e, f, g) {
					var h = $(document);
					c.$on("$destroy", function() {
						h.unbind("keydown")
					});
					var i, j = {
						deltaX: 0,
						deltaY: 0
					};
					h.unbind("keydown").keydown(function(e) {
						if (8 == e.keyCode || 46 == e.keyCode) {
							if ($(".modal-dialog").length) return;
							d.getElements().length && (e.preventDefault(), a.$broadcast("element.delete"))
						}
						if ((37 == e.keyCode || 38 == e.keyCode || 39 == e.keyCode || 40 == e.keyCode) && (d.getElements().length && e.preventDefault(), i || (i = !0, g.compDragStart(j)), 37 == e.keyCode && (j.deltaX -= 1, g.compDragMove(j)), 38 == e.keyCode && (j.deltaY -= 1, g.compDragMove(j)), 39 == e.keyCode && (j.deltaX += 1, g.compDragMove(j)), 40 == e.keyCode && (j.deltaY += 1, g.compDragMove(j))), (e.ctrlKey || e.metaKey) && 65 == e.keyCode) {
							if ($(".modal-dialog").length) return;
							if (e.preventDefault(), i) return;
							i = !0, a.$broadcast("element.selectall")
						}
						if ((e.ctrlKey || e.metaKey) && 90 == e.keyCode && b.historyBack(), (e.ctrlKey || e.metaKey) && 89 == e.keyCode && b.historyForward(), (e.ctrlKey || e.metaKey) && 67 == e.keyCode) {
							if ($(".modal-dialog").length) return;
							b.copyElement()
						}
						if ((e.ctrlKey || e.metaKey) && 86 == e.keyCode) {
							if ($(".modal-dialog").length) return;
							b.getCopy() && b.pasteElement()
						}
						c.$apply()
					}).unbind("keyup").keyup(function(a) {
						i = !1, (j.deltaX || j.deltaY) && g.compDragEnd(j), j.deltaX = 0, j.deltaY = 0, c.$apply()
					})
				}
				return {
					restrict: "A",
					link: e,
					require: "^multiCompDrag"
				}
			}
			b.module("scene.edit.keymap", ["services.scene", "services.history", "services.select"]).directive("editKeymap", ["$rootScope", "sceneService", "historyService", "selectService", a])
		}(), b.module("scene.edit.select", ["services.history", "services.scene"]).controller("selectCtrl", ["$scope",
			function(a) {
				a.pasteOpacity = .3, a.$on("select.more", function() {
					a.safeApply(function() {
						a.showSelectPanel = !0
					})
				}), a.$on("select.less", function() {
					a.safeApply(function() {
						a.showSelectPanel = !1
					})
				}), a.$on("copyState.update", function(b, c) {
					a.safeApply(function() {
						a.pasteOpacity = c ? 1 : .3
					})
				})
			}
		]).directive("eqxAlignLeft", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e = 320,
								f = [],
								g = a.getElements();
							$.each(g, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								f.push({
									element: c,
									position: d
								});
								var g = d.left;
								e > g && (e = g)
							}), $.each(f, function(a, c) {
								c.position.left = e, c.element.css(c.position), b.updateCompPosition("inside_" + g[a], c.position, !0)
							});
							var h = b.getSceneObj();
							c.addPageHistory(h.obj.id, h.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxAlignHorizontalCenter", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e, f = 0,
								g = [],
								h = a.getElements();
							$.each(h, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								g.push({
									element: c,
									position: d
								});
								var h = c.width();
								h > f && (f = h, e = d.left)
							}), $.each(g, function(a, c) {
								c.position.left = e + f / 2 - c.element.width() / 2, c.element.css(c.position), b.updateCompPosition("inside_" + h[a], c.position, !0)
							});
							var i = b.getSceneObj();
							c.addPageHistory(i.obj.id, i.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxAlignRight", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e = 320,
								f = [],
								g = a.getElements();
							$.each(g, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								f.push({
									element: c,
									position: d
								});
								var g = 320 - (d.left + c.width());
								e > g && (e = g)
							}), $.each(f, function(a, c) {
								c.position.left = 320 - (c.element.width() + e), c.element.css(c.position), b.updateCompPosition("inside_" + g[a], c.position, !0)
							});
							var h = b.getSceneObj();
							c.addPageHistory(h.obj.id, h.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxAlignTop", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e = 320,
								f = [],
								g = a.getElements();
							$.each(g, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								f.push({
									element: c,
									position: d
								});
								var g = d.top;
								e > g && (e = g)
							}), $.each(f, function(a, c) {
								c.position.top = e, c.element.css(c.position), b.updateCompPosition("inside_" + g[a], c.position, !0)
							});
							var h = b.getSceneObj();
							c.addPageHistory(h.obj.id, h.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxAlignVerticalCenter", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e, f = 0,
								g = [],
								h = a.getElements();
							$.each(h, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								g.push({
									element: c,
									position: d
								});
								var h = c.height();
								h > f && (f = h, e = d.top)
							}), $.each(g, function(a, c) {
								c.position.top = e + f / 2 - c.element.height() / 2, c.element.css(c.position), b.updateCompPosition("inside_" + h[a], c.position, !0)
							});
							var i = b.getSceneObj();
							c.addPageHistory(i.obj.id, i.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxAlignBottom", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e = 320,
								f = [],
								g = a.getElements();
							$.each(g, function(a, b) {
								var c = $("#nr").find("#inside_" + b),
									d = c.position();
								f.push({
									element: c,
									position: d
								});
								var g = 320 - (d.top + c.height());
								e > g && (e = g)
							}), $.each(f, function(a, c) {
								c.position.top = 320 - (c.element.height() + e), c.element.css(c.position), b.updateCompPosition("inside_" + g[a], c.position, !0)
							});
							var h = b.getSceneObj();
							c.addPageHistory(h.obj.id, h.obj.elements), d.$apply()
						})
					}
				}
			}
		]).directive("eqxCopy", ["selectService", "sceneService",
			function(a, b) {
				return {
					link: function(a, c) {
						var d = $(c);
						d.click(function() {
							b.copyElement()
						})
					}
				}
			}
		]).directive("eqxPaste", ["sceneService", "historyService",
			function(a, b) {
				return {
					link: function(c, d) {
						var e = $(d);
						e.click(function() {
							if (a.getCopy()) {
								a.pasteElement();
								var d = a.getSceneObj();
								b.addPageHistory(d.obj.id, d.obj.elements), c.$apply()
							}
						})
					}
				}
			}
		]).directive("eqxDeleteMore", ["selectService", "sceneService", "historyService",
			function(a, b, c) {
				return {
					link: function(d, e) {
						var f = $(e);
						f.click(function() {
							var e = a.getElements();
							$.each(e, function(a, c) {
								$("#nr").find("#inside_" + c).remove(), b.deleteElement(c)
							}), a.clearElements();
							var f = b.getSceneObj();
							c.addPageHistory(f.obj.id, f.obj.elements), d.$apply()
						})
					}
				}
			}
		]), b.module("scene.edit.trigger", []).factory("triggerService", function() {
			function a(a, b, c, d) {
				var e = f(a, b, c).ids,
					g = e.indexOf(d);
				g >= 0 || e.push(d)
			}

			function c(a, b, c, d) {
				var e = l[c];
				if (e && e.sends.length) {
					var g = f(a, b, c).ids,
						h = g.indexOf(d);
					0 > h || g.splice(h, d)
				}
			}

			function d(a, b, c) {
				var d = i(a, c).ids;
				index = d.indexOf(b), index >= 0 || d.push(b)
			}

			function e(a, b, c) {
				var d = i(a, c).ids;
				index = d.indexOf(b), index < 0 || d.splice(index, b)
			}

			function f(a, b, c) {
				var d = g(a, c).handles,
					e = j(d, b);
				return e ? e : (d.length || d.push({
					type: b,
					ids: []
				}), d[0])
			}

			function g(a, b) {
				var c = h(b),
					d = c.sends,
					e = j(d, a);
				return e ? e : (d.length || d.push({
					type: a,
					handles: []
				}), d[0])
			}

			function h(a) {
				return l[a] || (l[a] = {
					sends: [],
					receives: []
				}), l[a]
			}

			function i(a, b) {
				var c = h(b),
					d = c.receives,
					e = j(d, a);
				return e ? e : (d.length || d.push({
					type: a,
					ids: []
				}), d[0])
			}

			function j(a, b) {
				for (var c = 0; c < a.length; c++)
					if (b == a[c].type) return a[c];
				return null
			}
			var k = {},
				l = {};
			return k.getTrigger = function(a) {
				return b.copy(l[a])
			}, k.getReceiveIds = function(a, c, d) {
				var e = f(a, c, d).ids;
				return b.copy(e)
			}, k.getSendIds = function(a, c) {
				var d = i(a, c).ids;
				return b.copy(d)
			}, k.setTrigger = function(a, b) {
				"number" == typeof a && "object" == typeof b && (l[a] = b)
			}, k.addTrigger = function(b, c, e, f) {
				"number" == typeof b && "number" == typeof c && "number" == typeof e && "number" == typeof f && (a(b, c, e, f), d(c, e, f))
			}, k.deleteTrigger = function(a, b, d, f) {
				"number" == typeof a && "number" == typeof b && "number" == typeof d && "number" == typeof f && (c(a, b, d, f), e(b, d, f))
			}, k.clearTrigger = function(a) {
				var b = l[a];
				b && (b.sends[0].handles[0].ids.length || b.receives[0].ids.length || delete l[a])
			}, k
		}), b.module("scene", ["scene.create", "services.scene", "scene.create.new", "app.directives.addelement"]), b.module("scene").controller("SceneCtrl", ["$window", "$scope", "$location", "sceneService", "$modal",
			function(b, c, d, e, f) {
				c.PREFIX_FILE_HOST = PREFIX_FILE_HOST, c.PREFIX_CLIENT_HOST = PREFIX_HOST, c.isActive = "scene", c.scene = {
					type: null
				}, c.totalItems = 0, c.currentPage = 1, c.toPage = "", c.tabindex = 0, c.childcat = 0, c.order = "new";
				var g = 12,
					h = 0;
				c.pageNoNum = 1, c.pageChanged = function(a) {
					return i.targetPage = a, c.pageNoNum = a, 1 > a || a > c.totalItems / 11 + 1 ? void alert("此页超出范围") : void(1 == c.childcat ? c.getCompanyTpl(a, c.pageSizeList) : c.getPageTpls(1, i.sceneType, i.tagId, a, c.pageSizeList, c.order))
				}, c.preview = function(b) {
					var c = PREFIX_HOST + "v-" + b;
					a.open(c, "_blank")
				}, c.createScene = function(a) {
					f.open({
						windowClass: "login-container",
						templateUrl: "scene/createNew.tpl.html",
						controller: "SceneNewCtrl",
						resolve: {
							items: function() {
								return a
							}
						}
					})
				}, c.getStyle = function(a) {
					return {
						"background-image": "url(" + PREFIX_FILE_HOST + a + ")"
					}
				}, c.show = function(a) {
					console.log(a.target), $(a.target).children(".cc").css("display", "block")
				}, c.getCompanyTpl = function(a, b) {
					c.childcat = 1;
					var d = 11;
					c.childCatrgoryList = [], e.getCompanyTpls(c.pageNoNum, d).then(function(a) {
						a.data.list && a.data.list.length > 0 ? (c.tpls = a.data.list, c.totalItems = a.data.map.count, c.currentPage = a.data.map.pageNo, c.allPageCount = a.data.map.count, c.toPage = "") : c.tpls = []
					})
				}, e.getSceneType().then(function(a) {
					a.data.list && a.data.list.length > 0 ? c.pageTplTypes = a.data.list : c.pageTplTypes = []
				}).then(function() {}), c.tplnew = function(a) {
					c.order = a, i.orderby = a, i.tagId ? c.getPageTpls(null, i.sceneType, i.tagId, h, g, a) : c.getPageTpls(1)
				};
				var i = {
						sceneType: null,
						tagId: "",
						orderby: "new",
						pageNo: "0",
						targetPage: ""
					},
					j = {};
				c.getPageTplsByType = function(a) {
					i.sceneType = a, c.childcat = a, c.categoryId = 0, j[a] ? (c.childCatrgoryList = j[a], c.getPageTpls(1, i.sceneType, c.childCatrgoryList[0].id, h, g, c.order)) : e.getPageTplTypesTwo(a, a).then(function(b) {
						c.childCatrgoryList = j[a] = b.data.list, c.getPageTpls(1, i.sceneType, c.childCatrgoryList[0].id, h, g, c.order)
					})
				}, c.allpage = function(a) {
					i.sceneType = a, c.childcat = 0, c.getPageTpls(1), c.childCatrgoryList = []
				}, c.getPageTpls = function(a, b, d, f, g, h) {
					c.pageSizeList = 11, c.categoryId = d, i.tagId = d, e.getPageTpls(a, b, d, f, c.pageSizeList, i.orderby).then(function(a) {
						a.data.list && a.data.list.length > 0 ? (c.tpls = a.data.list, c.totalItems = a.data.map.count, c.currentPage = a.data.map.pageNo, c.allPageCount = a.data.map.count, c.toPage = "") : c.tpls = []
					})
				}, c.getPageTpls(1)
			}
		]), b.module("usercenter.branch", ["services.usercenter", "services.i18nNotifications"]), b.module("usercenter.branch").controller("BranchCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "branch", "i18nNotifications",
			function(a, c, d, e, f, g, h, j, k, l, m) {
				c.originData = c.branch = b.copy(l), c.dept = {}, l || (c.branch = {}), c.getDepts = function() {
					f.getDepts().then(function(a) {
						c.depts = a.data.list, (c.branch.deptName || c.branch.deptId) && b.forEach(c.depts, function(a, b) {
							a.id == c.branch.deptId && (c.branch.dept = a)
						})
					}, function() {
						alert("服务器异常!")
					})
				}, c.getDepts(), c.authError = "", c.addDept = function() {
					return c.dept.name ? i(c.dept.name) > 30 ? void(c.authError = "部门名称不能超过30个字符！") : void f.addDept(c.dept).then(function(a) {
						a.data.success && (c.showAddSec = !1, c.depts.unshift({
							id: a.data.obj,
							name: c.dept.name
						}), m.pushForCurrentRoute("dept.create.success", "notify.success"), c.dept = {})
					}, function() {
						c.authError = "服务器异常!"
					}) : (c.authError = "请输入部门名称！", void(c.dept = {}))
				}, c.confirm = function() {
					var a = {};
					return c.branch.loginName ? /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/g.test(c.branch.loginName) ? c.branch.name ? i(c.branch.name) > 30 ? void(c.authError = "用户名不能超过30个字符！") : (c.branch.dept && (a.deptId = c.branch.dept.id, c.branch.deptId = c.branch.dept.id, c.branch.deptName = c.branch.dept.name), void(l ? ($.extend(a, {
						id: c.branch.id,
						name: c.branch.name
					}), f.updateBranch(a).then(function(a) {
						a.data.success && c.$close(c.branch)
					}, function(a) {
						c.authError = "服务器异常！"
					})) : ($.extend(a, {
						loginName: c.branch.loginName,
						name: c.branch.name
					}), f.createBranch(a).then(function(a) {
						a.data.success ? (c.branch.id = a.data.obj.id, c.$close(c.branch)) : 1006 == a.data.code && (c.authError = "你已经创建过该账号！")
					}, function(a) {
						c.authError = "服务器异常！"
					})))) : void(c.authError = "用户名不能为空！") : void(c.authError = "邮箱格式不正确！") : void(c.authError = "账号不能为空!")
				}, c.cancel = function() {
					c.$dismiss()
				}
			}
		]), b.module("usercenter.relAccount", ["services.usercenter", "services.i18nNotifications"]), b.module("usercenter.relAccount").controller("RelAccountCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "userinfo", "i18nNotifications",
			function(a, c, d, e, f, g, h, i, j, k, l) {
				c.relAccount = function() {
					var a = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
					return a.test(c.user.email) ? c.user.password.trim() ? void f.relAccount(k.id, c.user.email, c.user.password).then(function(a) {
						if (200 == a.data.code) {
							l.pushForCurrentRoute("email.save.success", "notify.success"), /qq/gi.test(a.data.msg) && (c.relType = "qq"), /weixin/gi.test(a.data.msg) && (c.relType = "weixin"), /weibo/gi.test(a.data.msg) && (c.relType = "weibo");
							var d = {
								type: c.relType,
								email: b.copy(c.user.email)
							};
							c.$close(d)
						} else c.relErr = a.data.msg
					}, function(a) {
						c.$dismiss()
					}) : void(c.relErr = "密码不能为空！") : void(c.relErr = "请输入正确得邮箱格式")
				}, c.checkUpperCase = function() {
					/[A-Z]/g.test(c.user.email) && (c.user.email = c.user.email.toLowerCase(), c.relErr = "请用小写字母邮箱注册，已将邮箱中的大写字母自动转换成小写")
				}, c.cancel = function() {
					c.$dismiss()
				}
			}
		]), b.module("usercenter.upgrade", ["services.usercenter", "services.i18nNotifications"]), b.module("usercenter.upgrade").controller("UsercenterupgradeCtrl", ["$rootScope", "$scope", "$window", "usercenterService", "security", "$modal", "ModalService", "i18nNotifications",
			function(a, b, c, d, e, f, g, h) {
				b.companyInfo = {}, b.upgradeCompanyMessage = function(c) {
					if (c) {
						var e = /^[0-9]*$/;
						if (c.mobile && !e.test(c.mobile)) return b.authError = "电话格式不正确", void(c.mobile = "");
						var f = /^1\d{10}$/;
						if (c.tel && !f.test(c.tel)) return b.authError = "手机格式不正确", void(c.tel = "");
						var g = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
						if (c.email && !g.test(c.email)) return b.authError = "邮箱格式不正确", void(c.email = "");
						c.scale || (c.scale = {}), c.industry || (c.industry = {});
						var i = {
								name: c.name,
								website: c.website,
								address: c.address,
								contacts: c.contacts,
								tel: c.tel,
								mobile: c.mobile,
								license: c.license,
								email: c.email,
								department: c.department,
								scale: c.scale.value,
								industry: c.industry.value
							},
							j = !0,
							k = function(a, c) {
								return j && !a ? (b.authError = c, void(j = !1)) : void 0
							};
						if (k(c.name, "请填写企业名称"), k(c.website, "请填写网址"), k(c.address, "请填写联系地址"), k(c.contacts, "请填写联系人"), k(c.tel, "请填写手机号"), k(c.mobile, "请填写电话号码"), k(c.email, "请填写企业邮箱"), k(c.department, "请填写所属部门"), k(c.scale.value, "请企业规模"), k(c.industry.value, "请填写所属行业"), !j) return;
						d.saveCompanyInfo(i).then(function(c) {
							c.data.success ? (h.pushForCurrentRoute("account.success", "notify.success"), b.$close(i), a.$broadcast("companyState")) : b.authError = c.data.msg
						})
					} else b.authError = "请填写企业信息"
				}, b.getCompanyInfo = function() {
					d.getCompanyInfo().then(function(a) {
						a.data.obj && (b.companyInfo = a.data.obj), b.getScale(), b.getCompanyIndustry()
					})
				}, b.getCompanyInfo(), b.getScale = function() {
					d.getCompanyScale().then(function(a) {
						b.scales = a.data.list;
						for (var c = 0; c < b.scales.length; c++) b.scales[c].value == b.companyInfo.scale && (b.companyInfo.scale = b.scales[c])
					})
				}, b.getCompanyIndustry = function() {
					d.getCompanyIndustry().then(function(a) {
						b.industries = a.data.list;
						for (var c = 0; c < b.industries.length; c++) b.industries[c].value == b.companyInfo.industry && (b.companyInfo.industry = b.industries[c])
					})
				}, b.goUpload = function() {
					f.open({
						windowClass: "upload-console",
						templateUrl: "my/upload.tpl.html",
						controller: "UploadCtrl",
						resolve: {
							category: function() {
								return {
									categoryId: 0,
									fileType: 1,
									companyImg: "companyImg"
								}
							}
						}
					}).result.then(function(a) {
						b.companyInfo || (b.companyInfo = {}), b.companyInfo.license = a
					}, function() {})
				}, b.quXiao = function() {
					b.$dismiss()
				}
			}
		]), b.module("usercenter.request", ["services.usercenter", "app.directives.qrcode"]), b.module("usercenter.request").controller("UsercenterrequestCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location",
			function(a, b, c, d, e, f, g, h, i) {
				b.PREFIX_CLIENT_HOST = PREFIX_HOST, b.currentUser = f.currentUser, b.cancel = function() {
					b.$dismiss()
				}
			}
		]), b.module("usercenter.transfer", ["services.usercenter"]), b.module("usercenter.transfer").controller("UsercentertransferCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "username",
			function(a, b, c, d, e, f, g, h, i, j) {
				b.actionerror = !1, b.retrieverror = !1, b.transfer = !0, b.userXd = {
					toUser: "",
					xdCount: ""
				}, b.submit = !1, b.getUserXd = function() {
					e.getUserXd().then(function(a) {
						a.data.success && (b.xdCount = a.data.obj)
					})
				}, b.getUserXd(), b.confirm = function() {
					b.submit = !0, b.getgiveXd()
				}, b.getgiveXd = function() {
					return b.userXd.toUser ? b.userXd.toUser == j ? void(b.authError = "不能把秀点转送给自己") : /^\+?[1-9][0-9]*$/.test(b.userXd.xdCount) ? (b.userXd.xdCount > b.xdCount && (b.authError = "秀点不足"), void e.getgiveXd(b.userXd).then(function(a) {
						200 == a.data.code ? b.transfer = !1 : 1003 == a.data.code ? b.authError = a.data.msg : 1010 == a.data.code && (b.authError = a.data.msg)
					})) : void(b.authError = "正确填写秀点数目") : void(b.authError = "账号不能为空")
				}, b.cancel = function() {
					b.$dismiss()
				}
			}
		]), b.module("usercenter", ["usercenter.transfer", "usercenter.upgrade", "usercenter.request", "services.usercenter", "services.localizedMessages", "security.service", "app.directives.addelement", "services.modal", "usercenter.relAccount", "usercenter.branch", "services.i18nNotifications"]), b.module("usercenter").controller("UserCenterCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "$filter", "fixnumFilter", "i18nNotifications",
			function(a, c, d, e, f, g, h, i, j, k, l, m) {
				c.PREFIX_FILE_HOST = PREFIX_FILE_HOST, c.PREFIX_SERVER_HOST = PREFIX_URL, c.PREFIX_CLIENT_HOST = PREFIX_HOST, c.isVendorUser = g.isVendorUser(), c.editInfo = {
					isEditable: !1
				}, c.password = {}, c.pageSize = 5, c.XdpageSize = 10, c.XdpageNo = 1, c.XdtoPage = "", c.pageNo = 1, c.toPage = c.XdcurrentPage = 1, c.branchToPage = 1, c.currentPage = {
					msgCurrentPage: 1,
					branchCurrentPage: 1
				}, c.getUserInfo = function() {
					f.getUserInfo().then(function(a) {
						c.userinfo = a.data.obj, c.master = b.copy(c.userinfo), c.userinfo.headImg ? /^http.*/.test(c.userinfo.headImg) && (c.headImg = c.userinfo.headImg) : c.headImg = CLIENT_CDN + "addons/Market/Show/public/images/defaultuser.jpg";
						var d = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
						"eqs" != c.userinfo.loginName.substr(0, 3) || d.test(c.userinfo.loginName) || (c.userinfo.noRel = "未绑定", c.showRelButton = !0), /qq/gi.test(c.userinfo.relType) && (c.qqRel = !0), /weixin/gi.test(c.userinfo.relType) && (c.wxRel = !0), /weibo/gi.test(c.userinfo.relType) && (c.wbRel = !0), j.search().bindemail && c.relAccount()
					})
				}, c.getUserInfo(), c.emailAccount = !1, c.upgradeCompany = function() {
					"eqs" == c.userinfo.loginName.substr(0, 3) && null == c.userinfo.email ? c.emailAccount = !0 : h.open({
						windowClass: "seven-contain",
						templateUrl: "usercenter/console/upgrade_company.tpl.html",
						controller: "UsercenterupgradeCtrl",
						resolve: {}
					}).result.then(function() {}, function() {})
				}, c.getCompanyInfo = function() {
					f.getCompanyInfo().then(function(a) {
						c.companyInfo = a.data.obj
					})
				}, c.getCompanyInfo(), c.companyMes = !0, c.$on("companyState", function() {
					c.companyInfo || (c.companyInfo = {}), c.companyMes = !1, c.companyInfo.status = 0
				}), c.saveCompanyInfo = function(a) {
					var b = /^[0-9]*$/;
					if (a.mobile && !b.test(a.mobile)) return alert("电话号码格式错误"), void(a.mobile = "");
					var d = /^1\d{10}$/;
					if (a.tel && !d.test(a.tel)) return alert("手机号码格式错误"), void(a.tel = "");
					var e = {
						name: a.name,
						website: a.website,
						address: a.address,
						contacts: a.contacts,
						tel: a.tel,
						mobile: a.mobile
					};
					f.saveCompanyInfo(e).then(function(a) {
						a.data.success && (c.editInfo.isEditable = !1, m.pushForCurrentRoute("save.success", "notify.success"))
					})
				}, c.saveUserInfo = function(a) {
					var b = /^1\d{10}$/;
					if (a.phone && !b.test(a.phone)) return alert("手机号码格式错误"), void(a.phone = "");
					var d = /(^[1-9]\d*$)/;
					if (a.qq && !d.test(a.qq)) return alert("qq号码格式错误"), void(a.qq = "");
					var e = /^[0-9]*$/;
					if (a.tel && !e.test(a.tel)) return alert("电话号码格式错误"), void(a.tel = "");
					var g = {
						id: a.id,
						name: a.name,
						sex: a.sex,
						phone: a.phone,
						tel: a.tel,
						qq: a.qq,
						headImg: a.headImg
					};
					f.saveUserInfo(g).then(function(a) {
						a.data.success && (c.editInfo.isEditable = !1, m.pushForCurrentRoute("save.success", "notify.success"))
					})
				}, c.tabid = e.id, c.getUserXd = function() {
					f.getUserXd().then(function(a) {
						a.data.success && (c.xdCounts = a.data.obj)
					})
				}, c.getUserXd(), c.getXdlog = function(a) {
					var b = a;
					f.getXdlog(b, c.XdpageSize).then(function(a) {
						a.data.success && (c.xdLogs = a.data.list, c.XdCount = a.data.map.count, c.XdcurrentPage = a.data.map.pageNo, c.XdNumPages = Math.ceil(c.XdCount / c.XdpageSize))
					})
				}, c.getXdlog(c.XdpageNo), c.XdpageChanged = function(a) {
					c.XdcurrentPage = a, c.getXdlog(a)
				}, c.getXdStat = function() {
					f.getXdStat().then(function(a) {
						c.getXdStat = a.data.map
					})
				}, c.getXdStat(), c.reset = function() {
					return c.password.newPw != c.password.confirm ? (c.authError = "新密码与重复密码不一致", c.password.newPw = "", c.password.confirm = "", void $('input[name="newPassword"]').focus()) : b.equals(c.master, c.password) ? void(c.authError = "请不要重复提交！") : void g.resetPassword(c.password.old, c.password.newPw).then(function(a) {
						a.data.success ? (c.authError = "", m.pushForCurrentRoute("reset.psw.success", "notify.success"), c.master = b.copy(c.password), c.$close(c.master)) : c.authError = a.data.msg
					})
				}, c.openXd = function() {
					h.open({
						windowClass: "six-contain",
						templateUrl: "usercenter/transfer.tpl.html",
						controller: "UsercentertransferCtrl",
						resolve: {
							username: function() {
								return c.userinfo.loginName
							}
						}
					}).result.then(function() {}, function() {})
				}, c.customerUpload = function() {
					h.open({
						windowClass: "upload-console",
						templateUrl: "my/upload.tpl.html",
						controller: "UploadCtrl",
						resolve: {
							category: function() {
								return {
									categoryId: "0",
									fileType: "1",
									headerImage: "headerImage"
								}
							}
						}
					}).result.then(function(a) {
						$showCustomButton = !1, c.userinfo.headImg = a;
						var b = {
							headImg: a,
							id: c.userinfo.id
						};
						f.saveUserInfo(b).then(function(a) {
							a.data.success && (c.editInfo.isEditable = !1, alert("保存成功"))
						})
					}, function() {})
				}, c.cancel = function() {
					c.userinfo = b.copy(c.master), c.editInfo.isEditable = !1
				}, c.getUserMsg = function(a) {
					var d = a;
					f.getNewMessage(d, c.pageSize).then(function(a) {
						b.forEach(a.data.list, function(a, b) {
							1 == a.bizType ? a.type = "系统通知" : 2 == a.bizType ? a.type = "审核通知" : 3 == a.bizType && (a.type = "活动通知")
						}), c.newMsgs = a.data.list, c.msgCount = a.data.map.count, c.msgNumPages = Math.ceil(c.msgCount / c.pageSize)
					})
				}, c.getUserMsg(c.pageNo), c.$watch("currentPage.msgCurrentPage", function(a, b) {
					a != b && (c.getUserMsg(a), c.toPage = a)
				}), c.pageChanged = function(a, b) {
					c.currentPage[b] = a
				}, c.setRead = function(c) {
					var d = [];
					b.forEach(c, function(a, b) {
						1 == a.status && this.push(a.id)
					}, d);
					var e = d.join();
					f.setRead(e).then(function(e) {
						200 == e.data.code && (a.$broadcast("minusCount", d.length), b.forEach(c, function(a, b) {
							a.status = 2
						}))
					})
				}, c.goBaseInfo = function() {
					j.path("/usercenter/userinfo", !1), c.tabid = "userinfo"
				}, c.goXd = function() {
					j.path("/usercenter/xd", !1), c.tabid = "xd"
				}, c.quXiao = function() {
					c.$dismiss()
				}, c.goReset = function() {
					h.open({
						windowClass: "six-contain",
						templateUrl: "usercenter/tab/reset.tpl.html",
						controller: "UserCenterCtrl",
						resolve: {
							username: function() {
								return c.userinfo.loginName
							}
						}
					}).result.then(function() {}, function() {})
				}, c.goMessage = function() {
					j.path("/usercenter/message", !1), c.tabid = "message"
				}, c.goAccount = function() {
					j.path("/usercenter/account", !1), c.tabid = "account"
				}, c.relAccount = function() {
					c.emailAccount = !1, h.open({
						windowClass: "six-contain",
						templateUrl: "usercenter/console/relAccount.tpl.html",
						controller: "RelAccountCtrl",
						resolve: {
							userinfo: function() {
								return {
									id: c.userinfo.id
								}
							}
						}
					}).result.then(function(a) {
						c.userinfo.noRel = null, c.userinfo.loginName = a.email, /qq/gi.test(a.type) && (c.qqRel = !0), /weixin/gi.test(a.type) && (c.wxRel = !0), /weibo/gi.test(a.type) && (c.wbRel = !0), j.search("bindemail", null)
					}, function() {
						j.search("bindemail", null)
					})
				}, c.getBranches = function(a) {
					f.getBranches(c.XdpageSize, a).then(function(a) {
						c.branches = a.data.list, c.branchesCount = a.data.map.count, c.branchesNumPages = Math.ceil(c.branchesCount / c.XdpageSize)
					}, function() {})
				}, c.getBranches(c.pageNo), c.$watch("currentPage.branchCurrentPage", function(a, b) {
					a != b && (c.getBranches(a), c.branchToPage = a)
				}), c.manageBranch = function(a) {
					var b = a;
					h.open({
						windowClass: "console six-contain",
						templateUrl: "usercenter/console/branch.tpl.html",
						controller: "BranchCtrl",
						resolve: {
							branch: function() {
								return a
							}
						}
					}).result.then(function(d) {
						a || (a = {}), d.dept && (a.deptId = d.dept.id, a.deptName = d.dept.name), a.name = d.name, a.id = d.id, b || (a.loginName = d.loginName, a.status = 1, a.regTime = (new Date).getTime(), c.branches.unshift(a),
							c.branches.length > 10 && c.branches.splice(c.branches.length - 1, 1)), c.$emit("addBranch", a)
					}, function() {})
				}, c.openBranch = function(a, b) {
					f.openBranch(a.id, b).then(function(c) {
						c.data.success && (b ? (a.status = 1, m.pushForCurrentRoute("branch.open.success", "notify.success")) : (a.status = 2, m.pushForCurrentRoute("branch.close.success", "notify.success")))
					}, function() {
						alert("服务器异常！")
					})
				}
			}
		]), b.module("app.directives.addelement", []).directive("addElement", ["$compile",
			function(a) {
				return {
					restrict: "EA",
					link: function(c, d, e) {
						var f = $("#emailAddress"),
							g = $("#emailAddress").size() + 1;
						d.bind("click", function() {
							var d = b.element('<div><input type="text" id="p_scnt" style="width:100%; height: 30px; margin-top: 15px;" ng-model="attrs.addElement" name="p_scnt_' + g + '" placeholder="Input Value" /></div>');
							f.append(d);
							var h = d.find("input");
							console.log(e.addElement), a(h)(c), g++
						})
					}
				}
			}
		]).directive("showIcon", ["$compile", "$timeout",
			function(a, b) {
				return {
					restrict: "EA",
					require: "ngModel",
					scope: {
						check: "&callbackFn"
					},
					link: function(b, c, d, e) {
						var f, g, h = a('<a><span class = "glyphicon glyphicon-ok-circle" ng-show="enabled" style = "margin-top: 8px; color: #9ad64b; font-size: 15px;"></span></a>')(b);
						b.update = function() {
							c[0].blur(), b.check({
								arg1: {
									name: e.$name
								}
							})
						}, c.bind("focus", function() {
							f = e.$viewValue, c.parent().after(h), b.enabled = !0, ("email" === d.name || "mobile" === d.name || "tel" === d.name) && (b.enabled = !1), b.$apply()
						}).bind("blur", function() {
							b.enabled = !1, g = e.$viewValue;
							var a = new RegExp(/(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/g);
							if ("mobile" === d.name && g && !a.test(c.val())) return void alert("手机号码格式错误");
							if ("email" === d.name && g) {
								var h = new RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/g);
								if (!h.test(c.val())) return void alert("邮箱格式错误")
							}(g || f) && f !== g && b.update(), b.$apply()
						})
					}
				}
			}
		]).directive("ngHover", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).hover(function() {
						$(b.children()[0]).css("display", "block"), $(b.children()[3]).css("display", "block"), $(b.children()[4]).css("display", "block")
					}, function() {
						$(b.children()[0]).css("display", "none"), $(b.children()[3]).css("display", "none"), $(b.children()[4]).css("display", "none")
					})
				}
			}
		}).directive("imgClick", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).bind("click", function() {
						$(b).find("img").css("border", "4px solid #F60"), $(b).siblings().find("img").css("border", 0)
					})
				}
			}
		}).directive("customFocus", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).siblings().bind("click", function() {
						b[0].focus()
					})
				}
			}
		}).directive("blurChildren", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).on("click", function(a) {
						(a.target == b[0] || $(a.target).hasClass("badge")) && $(".blurClass").find("input:visible").blur()
					})
				}
			}
		}).directive("forbiddenClose", function() {
			return {
				restrict: "EAC",
				link: function(a, b, c) {
					$(b).on("click", function(a) {
						a.stopPropagation()
					})
				}
			}
		}).directive("customeImage", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).hover(function() {
						$("<div><a></a></div>")
					}, function() {})
				}
			}
		}).directive("slides", ["configService",
			function(a) {
				return {
					restrict: "EA",
					link: function(b, c, d) {
						var e = $(c).find(".slides_container");
					}
				}
			}
		]).directive("addClass", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).closest(".textbox-wrap").find("[autofocus]").focus(), $(b).on("blur", function() {
						$(b).closest(".textbox-wrap").removeClass("focused")
					}).on("focus", function() {
						$(b).closest(".textbox-wrap").addClass("focused")
					})
				}
			}
		}).directive("loadScript", ["$http", "$timeout", "$rootScope",
			function(a, c, d) {
				return {
					link: function(c, d, e) {
						var f = function() {
							c.captchaLoaded = !0
						};
						c.$watch(function() {
							return d[0].getAttribute("src")
						}, function(b, c) {
							b && a.jsonp(d[0].getAttribute("src")).success(f).error(f)
						}), c.$on("$destroy", function() {
							b.element(".gt_widget").remove()
						})
					}
				}
			}
		]), b.module("colorpicker.module", []).factory("Helper", function() {
			return {
				closestSlider: function(a) {
					var b = a.matches || a.webkitMatchesSelector || a.mozMatchesSelector || a.msMatchesSelector;
					return b.bind(a)("I") ? a.parentNode : a
				},
				getOffset: function(a, b) {
					for (var c = 0, d = 0, e = 0, f = 0; a && !isNaN(a.offsetLeft) && !isNaN(a.offsetTop);) c += a.offsetLeft, d += a.offsetTop, b || "BODY" !== a.tagName ? (e += a.scrollLeft, f += a.scrollTop) : (e += document.documentElement.scrollLeft || a.scrollLeft, f += document.documentElement.scrollTop || a.scrollTop), a = a.offsetParent;
					return {
						top: d,
						left: c,
						scrollX: e,
						scrollY: f
					}
				},
				stringParsers: [{
					re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
					parse: function(a) {
						return [a[1], a[2], a[3], a[4]]
					}
				}, {
					re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
					parse: function(a) {
						return [2.55 * a[1], 2.55 * a[2], 2.55 * a[3], a[4]]
					}
				}, {
					re: /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/,
					parse: function(a) {
						return [parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)]
					}
				}, {
					re: /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/,
					parse: function(a) {
						return [parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)]
					}
				}]
			}
		}).factory("Color", ["Helper",
			function(a) {
				return {
					value: {
						h: 1,
						s: 1,
						b: 1,
						a: 1
					},
					rgb: function() {
						var a = this.toRGB();
						return "rgb(" + a.r + "," + a.g + "," + a.b + ")"
					},
					rgba: function() {
						var a = this.toRGB();
						return "rgba(" + a.r + "," + a.g + "," + a.b + "," + a.a + ")"
					},
					hex: function() {
						return this.toHex()
					},
					RGBtoHSB: function(a, b, c, d) {
						a /= 255, b /= 255, c /= 255;
						var e, f, g, h;
						return g = Math.max(a, b, c), h = g - Math.min(a, b, c), e = 0 === h ? null : g === a ? (b - c) / h : g === b ? (c - a) / h + 2 : (a - b) / h + 4, e = (e + 360) % 6 * 60 / 360, f = 0 === h ? 0 : h / g, {
							h: e || 1,
							s: f,
							b: g,
							a: d || 1
						}
					},
					setColor: function(b) {
						b = b.toLowerCase();
						for (var c in a.stringParsers)
							if (a.stringParsers.hasOwnProperty(c)) {
								var d = a.stringParsers[c],
									e = d.re.exec(b),
									f = e && d.parse(e);
								if (f) return this.value = this.RGBtoHSB.apply(null, f), !1
							}
					},
					setHue: function(a) {
						this.value.h = 1 - a
					},
					setSaturation: function(a) {
						this.value.s = a
					},
					setLightness: function(a) {
						this.value.b = 1 - a
					},
					setAlpha: function(a) {
						this.value.a = parseInt(100 * (1 - a), 10) / 100
					},
					toRGB: function(a, b, c, d) {
						a || (a = this.value.h, b = this.value.s, c = this.value.b), a *= 360;
						var e, f, g, h, i;
						return a = a % 360 / 60, i = c * b, h = i * (1 - Math.abs(a % 2 - 1)), e = f = g = c - i, a = ~~a, e += [i, h, 0, 0, h, i][a], f += [h, i, i, h, 0, 0][a], g += [0, 0, h, i, i, h][a], {
							r: Math.round(255 * e),
							g: Math.round(255 * f),
							b: Math.round(255 * g),
							a: d || this.value.a
						}
					},
					toHex: function(a, b, c, d) {
						var e = this.toRGB(a, b, c, d);
						return "#" + (1 << 24 | parseInt(e.r, 10) << 16 | parseInt(e.g, 10) << 8 | parseInt(e.b, 10)).toString(16).substr(1)
					}
				}
			}
		]).factory("Slider", ["Helper",
			function(b) {
				var c = {
						maxLeft: 0,
						maxTop: 0,
						callLeft: null,
						callTop: null,
						knob: {
							top: 0,
							left: 0
						}
					},
					d = {};
				return {
					getSlider: function() {
						return c
					},
					getLeftPosition: function(a) {
						return Math.max(0, Math.min(c.maxLeft, c.left + ((a.pageX || d.left) - d.left)))
					},
					getTopPosition: function(a) {
						return Math.max(0, Math.min(c.maxTop, c.top + ((a.pageY || d.top) - d.top)))
					},
					setSlider: function(e, f) {
						var g = b.closestSlider(e.target),
							h = b.getOffset(g, f);
						c.knob = g.children[0].style, c.left = e.pageX - h.left - a.pageXOffset + h.scrollX, c.top = e.pageY - h.top - a.pageYOffset + h.scrollY, d = {
							left: e.pageX,
							top: e.pageY
						}
					},
					setSaturation: function(a, b) {
						c = {
							maxLeft: 100,
							maxTop: 100,
							callLeft: "setSaturation",
							callTop: "setLightness"
						}, this.setSlider(a, b)
					},
					setHue: function(a, b) {
						c = {
							maxLeft: 0,
							maxTop: 100,
							callLeft: !1,
							callTop: "setHue"
						}, this.setSlider(a, b)
					},
					setAlpha: function(a, b) {
						c = {
							maxLeft: 0,
							maxTop: 100,
							callLeft: !1,
							callTop: "setAlpha"
						}, this.setSlider(a, b)
					},
					setKnob: function(a, b) {
						c.knob.top = a + "px", c.knob.left = b + "px"
					}
				}
			}
		]).directive("colorpicker", ["$document", "$compile", "Color", "Slider", "Helper",
			function(a, c, d, e, f) {
				return {
					require: "?ngModel",
					restrict: "A",
					link: function(g, h, i, j) {
						var k, l = i.colorpicker ? i.colorpicker : "hex",
							m = b.isDefined(i.colorpickerPosition) ? i.colorpickerPosition : "bottom",
							n = b.isDefined(i.colorpickerInline) ? i.colorpickerInline : !1,
							o = b.isDefined(i.colorpickerFixedPosition) ? i.colorpickerFixedPosition : !1,
							p = b.isDefined(i.colorpickerParent) ? h.parent() : b.element(document.body),
							q = b.isDefined(i.colorpickerWithInput) ? i.colorpickerWithInput : !1,
							r = q ? '<input type="text" name="colorpicker-input">' : "",
							s = n ? "" : '<button type="button" class="close close-colorpicker">&times;</button>',
							t = '<div class="colorpicker dropdown"><div class="dropdown-menu"><colorpicker-saturation><i></i></colorpicker-saturation><colorpicker-hue><i></i></colorpicker-hue><colorpicker-alpha><i></i></colorpicker-alpha><colorpicker-preview></colorpicker-preview>' + r + s + "</div></div>",
							u = b.element(t),
							v = d,
							w = u.find("colorpicker-hue"),
							x = u.find("colorpicker-saturation"),
							y = u.find("colorpicker-preview"),
							z = u.find("i");
						if (c(u)(g), q) {
							var A = u.find("input");
							A.on("mousedown", function(a) {
								a.stopPropagation()
							}).on("keyup", function(a) {
								var b = this.value;
								h.val(b), j && g.$apply(j.$setViewValue(b)), a.stopPropagation(), a.preventDefault()
							}), h.on("keyup", function() {
								A.val(h.val())
							})
						}
						var B = function() {
							a.on("mousemove", D), a.on("mouseup", E)
						};
						"rgba" === l && (u.addClass("alpha"), k = u.find("colorpicker-alpha"), k.on("click", function(a) {
							e.setAlpha(a, o), D(a)
						}).on("mousedown", function(a) {
							e.setAlpha(a, o), B()
						})), w.on("click", function(a) {
							e.setHue(a, o), D(a)
						}).on("mousedown", function(a) {
							e.setHue(a, o), B()
						}), x.on("click", function(a) {
							e.setSaturation(a, o), D(a)
						}).on("mousedown", function(a) {
							e.setSaturation(a, o), B()
						}), o && u.addClass("colorpicker-fixed-position"), u.addClass("colorpicker-position-" + m), "true" === n && u.addClass("colorpicker-inline"), p.append(u), j && (j.$render = function() {
							h.val(j.$viewValue)
						}, g.$watch(i.ngModel, function() {
							F()
						})), h.on("$destroy", function() {
							u.remove()
						});
						var C = function() {
								try {
									y.css("backgroundColor", v[l]())
								} catch (a) {
									y.css("backgroundColor", v.toHex())
								}
								x.css("backgroundColor", v.toHex(v.value.h, 1, 1, 1)), "rgba" === l && (k.css.backgroundColor = v.toHex())
							},
							D = function(a) {
								var b = e.getLeftPosition(a),
									c = e.getTopPosition(a),
									d = e.getSlider();
								e.setKnob(c, b), d.callLeft && v[d.callLeft].call(v, b / 100), d.callTop && v[d.callTop].call(v, c / 100), C();
								var f = v[l]();
								return h.val(f), j && g.$apply(j.$setViewValue(f)), q && A.val(f), !1
							},
							E = function() {
								a.off("mousemove", D), a.off("mouseup", E)
							},
							F = function() {
								v.setColor(h.val()), z.eq(0).css({
									left: 100 * v.value.s + "px",
									top: 100 - 100 * v.value.b + "px"
								}), z.eq(1).css("top", 100 * (1 - v.value.h) + "px"), z.eq(2).css("top", 100 * (1 - v.value.a) + "px"), C()
							},
							G = function() {
								var a, c = f.getOffset(h[0]);
								return b.isDefined(i.colorpickerParent) && (c.left = 0, c.top = 0), "top" === m ? a = {
									top: c.top - 147,
									left: c.left
								} : "right" === m ? a = {
									top: c.top,
									left: c.left + 126
								} : "bottom" === m ? a = {
									top: c.top + h[0].offsetHeight + 2,
									left: c.left
								} : "left" === m && (a = {
									top: c.top,
									left: c.left - 150
								}), {
									top: a.top + "px",
									left: a.left + "px"
								}
							},
							H = function() {
								J()
							};
						n === !1 ? h.on("click", function() {
							F(), u.addClass("colorpicker-visible").css(G()), a.on("mousedown", H)
						}) : (F(), u.addClass("colorpicker-visible").css(G())), u.on("mousedown", function(a) {
							a.stopPropagation(), a.preventDefault()
						});
						var I = function(a) {
								j && g.$emit(a, {
									name: i.ngModel,
									value: j.$modelValue
								})
							},
							J = function() {
								u.hasClass("colorpicker-visible") && (u.removeClass("colorpicker-visible"), I("colorpicker-closed"), a.off("mousedown", H))
							};
						u.find("button").on("click", function() {
							J()
						})
					}
				}
			}
		]), b.module("app.directives.rightclick", []).directive("rightClick", ["$compile",
			function(a) {
				return {
					restrict: "EA",
					link: function(b, c, d) {
						var e;
						$(c).on("contextmenu", function(d) {
							if (d.preventDefault(), e && e[0] && e.remove(), "0" == b.categoryId) {
								e = $('<ul class="right-menu dropdown-menu"></ul>'), e.appendTo($(c)), e.css({
									left: d.pageX - $(c).offset().left,
									top: d.pageY - $(c).offset().top
								}).show();
								for (var f in b.myTags) {
									var g = '<li class="tag_list" ng-class="{selected: dropTagIndex == ' + f + '}" ng-click="selectTag(' + b.myTags[f].id + "," + f + ')">' + b.myTags[f].name + "</li>",
										h = a(g)(b);
									e.append(h)
								}
								var i = a('<li class="tag_list add_cate clearfix" style="border-top:1px solid #ccc;margin-bottom:0px;" ng-click="createCategory()"><em>+</em><span>创建分类</span></li>')(b);
								e.append(i);
								var j = a('<li class="btn-main" style="width:100%; padding:0px; border: 0;margin:0px;height:25px; line-height:25px;"><a style="height:25px;line-height:25px;text-indent:0;color:#FFF;padding:0px;text-align:center;" ng-click="setCategory(' + b.dropTagIndex + "," + b.img.id + ')">确定</a></li>')(b);
								e.append(j), $(j).on("click", function() {
									e.hide()
								}), $(document).mousemove(function(a) {
									(a.pageX < e.offset().left - 20 || a.pageX > e.offset().left + e.width() + 20 || a.pageY < e.offset().top - 20 || a.pageY > e.offset().top + e.height() + 20) && (e.hide(), $(this).unbind("mousemove"))
								})
							}
						})
					}
				}
			}
		]), b.module("app.directives.customer", []).directive("forbiddenListClose", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).click(function(a) {
						return !1
					})
				}
			}
		}), b.module("app.directives.dataDraggable", []).directive("itemDraggable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).draggable({
						zIndex: 2700,
						scroll: !1,
						iframeFix: !1,
						revert: !1,
						helper: "clone"
					})
				}
			}
		}).directive("itemDroppable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).droppable({
						hoverClass: "active",
						out: function(a, b) {},
						drop: function(b, c) {
							a.$parent.associateData[$(b.target).attr("item-id")] = c.draggable.attr("item-id");
							var d = $(b.target).find(".list_darggable");
							d.length > 0 && (delete a.$parent.associateData[$(b.target).attr("item-id")], $(".item_remove_droppable").append(d)), c.draggable.css({
								left: 0,
								top: 0
							}).prependTo(this)
						}
					})
				}
			}
		}).directive("itemRemoveDroppable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).droppable({
						hoverClass: "active",
						drop: function(b, c) {
							$(c.draggable).parents(".list_attribute").length > 0 && delete a.$parent.associateData[$(c.draggable).parents(".list_attribute").attr("item-id")], c.draggable.css({
								left: 0,
								top: 0
							}).appendTo(this)
						}
					})
				}
			}
		}), b.module("app.directives.keymap", ["services.scene", "services.history", "services.select"]).directive("eqxKeymap", ["sceneService", "historyService", "selectService",
			function(a, b, c) {
				return {
					restrict: "A",
					link: function(b) {
						var c = $(document);
						b.$on("$destroy", function() {
							c.unbind("keydown")
						}), c.unbind("keydown").keydown(function(c) {
							if ((c.ctrlKey || c.metaKey) && 90 == c.keyCode && a.historyBack(), (c.ctrlKey || c.metaKey) && 89 == c.keyCode && a.historyForward(), (c.ctrlKey || c.metaKey) && 86 == c.keyCode) {
								if ($("#btn-toolbar").length || $(".modal-dialog").length) return;
								a.getCopy() && a.pasteElement()
							}
							if ((c.ctrlKey || c.metaKey) && 67 == c.keyCode) {
								if ($("#btn-toolbar").length || $(".modal-dialog").length) return;
								a.copyElement()
							}
							b.$apply()
						})
					}
				}
			}
		]), b.module("app.directives.limitInput", []).directive("limitInput", function() {
			return {
				require: "ngModel",
				link: function(a, b, c, d) {
					"transform" == c.cssItem && a.$on("updateTransform", function(a, b) {
						d.$setViewValue(parseInt(b, 10)), d.$render()
					}), "borderRadius" == c.cssItem && a.$on("updateMaxRadius", function(b, c) {
						a.maxRadius = parseInt(Math.min($(c).outerWidth(), $(c).outerHeight()) / 2 + 10, 10), a.maxRadius < a.model.borderRadius && (d.$setViewValue(a.maxRadius), d.$render()), a.$apply()
					}), a.$watch(function() {
						return $(b).val()
					}, function(a) {
						+a > c.max && (d.$setViewValue(c.max), d.$render()), +a < c.min && (d.$setViewValue(c.min), d.$render())
					})
				}
			}
		}), b.module("app.directives.lineChart", []).directive("lineChart", ["$compile",
			function(a) {
				return {
					restrict: "EA",
					link: function(a, b, c) {
						var d, e;
						a.$watch(function() {
							return c.data
						}, function() {
							c.data && (d = JSON.parse(c.data)), e ? (e.destroy(), e = new Chart(b[0].getContext("2d")).Line(d, {
								scaleFontColor: "#fff"
							})) : e = new Chart(b[0].getContext("2d")).Line(d, {
								scaleFontColor: "#fff"
							})
						})
					}
				}
			}
		]), b.module("app.directives.loading", []).directive("loginLoading", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					a.$on("loginLoading", function(a, c) {
						var d = $('<div class="homeMask" style="position: absolute;width: 100%;top:0;bottom:0;background-color:#ccc;opacity:0.8;">正在跳转，请稍后...</div>');
						d.appendTo($(b))
					})
				}
			}
		}), b.module("app.directives.comp.editor", []).directive("mapEditor", function() {
			return {
				restrict: "AE",
				templateUrl: "directives/mapeditor.tpl.html",
				link: function(a, b, c) {
					var d = new BMap.Map("l-map");
					d.centerAndZoom(new BMap.Point(116.404, 39.915), 15);
					var e = {
							onSearchComplete: function(a) {
								if (f.getStatus() == BMAP_STATUS_SUCCESS) {
									for (var b = [], c = 0; c < a.getCurrentNumPois(); c++) b.push(a.getPoi(c).title + ", " + a.getPoi(c).address);
									document.getElementById("r-result").innerHTML = b.join("<br/>")
								}
							}
						},
						f = new BMap.LocalSearch(d, e);
					a.searchAddress = function() {
						f.search(a.address)
					}
				}
			}
		}), b.module("app.directives.notification", []).directive("notificationFadeout", ["i18nNotifications",
			function(a) {
				return {
					restrict: "EA",
					link: function(b, c, d) {
						var e = $(c);
						e.fadeOut(4e3, function() {
							a.remove(b.notification)
						})
					}
				}
			}
		]), b.module("app.directives.pageTplTypes", []).directive("pageTplTypes", ["pageTplService",
			function(a) {
				return {
					restrict: "EA",
					replace: !0,
					templateUrl: "directives/page-tpl-types.tpl.html",
					link: function(b, c, d) {
						a.getPageTplTypes().then(function(a) {
							a.data.list && a.data.list.length > 0 ? b.pageTplTypes = a.data.list : b.pageTplTypes = []
						})
					}
				}
			}
		]), b.module("app.directives.pieChart", []).directive("pieChart", ["$compile",
			function(a) {
				return {
					restrict: "EA",
					link: function(a, b, c) {
						var d, e;
						a.$watch(function() {
							return c.data
						}, function() {
							c.data && (e = JSON.parse(c.data)), d ? (d.destroy(), d = new Chart(b[0].getContext("2d")).Pie(e)) : d = new Chart(b[0].getContext("2d")).Pie(e)
						})
					}
				}
			}
		]), b.module("app.directives.qrcode", []).directive("qrCode", function() {
			return {
				restrict: "A",
				scope: {
					qrUrl: "@"
				},
				link: function(a, b, c) {
					a.$watch("qrUrl", function(a, c) {
						$("canvas", b).length > 0 && $("canvas", b).remove(), a && $(b).qrcode({
							render: "canvas",
							width: 200,
							height: 200,
							text: a + (/\?/.test(a) ? "&" : "?") + "eqrcode=1"
						})
					})
				}
			}
		}).directive("downloadCanvas", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					$(b).click(function(b) {
						var c = $(this).parent().find("canvas").get(0),
							d = c.toDataURL("image/png");
						this.href = d;
						var e = a.selectedUrl.substring(a.selectedUrl.lastIndexOf("/") + 1);
						this.download = e + ".png"
					})
				}
			}
		}), b.module("app.directives.register", []).directive("qqButton", function() {
			return {
				restrict: "EA",
				scope: {
					someCtrlFn: "&callbackFn",
					openid: "=",
					accesstoken: "="
				},
				link: function(a, b, c) {
					QC.Login({
						btnId: c.id,
						scope: "all"
					}, function(b, c) {
						var d = b;
						QC.Login.check() && QC.Login.getMe(function(b, c) {
							a.openid = b, a.accesstoken = c, a.someCtrlFn({
								arg1: {
									openId: b,
									accessToken: c,
									type: "qq",
									userInfo: d
								}
							})
						})
					}, function(a) {
						alert("QQ登录 注销成功")
					}), $("#qqLoginBtn a").removeAttr("onclick").click(function() {
						alert("第三方注册功能即将开放")
					})
				}
			}
		}).directive("wbButton", function() {
			return {
				restrict: "EA",
				link: function(a, b, c) {
					WB2.anyWhere(function(a) {
						a.widget.connectButton({
							id: "wb_connect_btn",
							type: "3,2",
							callback: {
								login: function(a) {},
								logout: function() {}
							}
						})
					}), $("#wb_connect_btn").removeAttr("onclick").click(function(a) {
						return a.stopPropagation(), a.preventDefault(), alert("新浪微博注册功能即将开放"), !1
					})
				}
			}
		}), b.module("app.directives.responsiveImage", []).directive("responsiveImage", ["$compile",
			function(a) {
				return {
					restrict: "EA",
					link: function(a, b, c) {
						"0" != a.fileType && $(b).bind("load", function() {
							$(this).removeAttr("style");
							var a = $(this).parent().width(),
								b = $(this).parent().height();
							this.width > this.height ? (this.style.width = a + "px", this.style.height = this.height * a / this.width + "px", this.style.top = "50%", this.style.marginTop = "-" + this.height / 2 + "px") : (this.style.height = b + "px", this.style.width = this.width * b / this.height + "px", this.style.left = "50%", this.style.marginLeft = "-" + this.width / 2 + "px")
						})
					}
				}
			}
		]), b.module("app.directives.numChangeAnim", []).directive("numChangeAnim", ["$filter",
			function(a) {
				return {
					restrict: "A",
					scope: {
						content: "@"
					},
					link: function(b, c, d) {
						function e(a, b) {
							return Math.floor(a + Math.random() * (b - a))
						}

						function f(a, b) {
							a = a > 0 ? a : 1;
							for (var c = Math.floor(Math.log10(a)), d = Math.floor(a / Math.pow(10, c)), f = 0, g = 10, h = function(h) {
								setTimeout(function() {
									if (10 > g) f = h;
									else {
										var i = c > h ? h : c,
											j = Math.pow(10, i) * d;
										j = j.toString().length == a.toString().length ? a : j, f = e(f, j)
									}
									b(f, 9 == h)
								}, (h * h + h + 2) / 2 * 30)
							}, i = 0; g > i; i++) h(i)
						}

						function g(b, c) {
							$(b).children("span").text(a("number")(c))
						}
						b.$watch("content", function(a) {
							if (a) {
								var b = parseInt(a, 10);
								f(b, function(a, d) {
									g(c, a), d && (g(c, b), $(c).addClass("heartbeat").css({
										"animation-duration": "1s"
									}))
								})
							}
						})
					}
				}
			}
		]), b.module("app.directives.style", []).directive("panelDraggable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					a.$on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), b.on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), $(b).draggable()
				}
			}
		}), b.module("app.directives.component", ["services.scene", "services.select", "scene.create.console.pictures", "scene.edit.trigger"]).directive("compDraggable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					a.$on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), b.on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), $(b).draggable({
						revert: !1,
						stack: ".comp-draggable",
						helper: "panel" == c.compDraggable || "page" == c.compDraggable ? "clone" : "",
						appendTo: "parent",
						containment: "panel" == c.compDraggable || "page" == c.compDraggable ? "" : "parent",
						zIndex: 1049,
						opacity: .35,
						stop: function(a, b) {
							$(a.toElement).one("click", function(a) {
								a.stopImmediatePropagation()
							})
						}
					})
				}
			}
		}).directive("compDroppable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					a.$on("$destroy", function() {
						$(b).droppable(), $(b).droppable("destroy"), b = null
					}), b.on("$destroy", function() {
						$(b).droppable(), $(b).droppable("destroy"), b = null
					}), $(b).droppable({
						accept: ".comp-draggable",
						hoverClass: "drop-hover",
						drop: function(b, c) {
							if (3 != c.draggable.attr("ctype")) {
								var d = {
									left: c.offset.left - $(this).offset().left + "px",
									top: c.offset.top - $(this).offset().top + "px"
								};
								"panel" == c.draggable.attr("comp-draggable") ? a.createComp(c.draggable.attr("ctype"), d) : a.updateCompPosition(c.draggable.attr("id"), d)
							} else a.createComp(3)
						}
					})
				}
			}
		}).directive("compSortable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).sortable({
						axis: "y",
						update: function(a, b) {}
					})
				}
			}
		}).directive("compResizable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					$(b).resizable({
						autoHide: !1,
						containment: "parent",
						stop: function(b, c) {
							if ("4" == $(c.element).attr("ctype").charAt(0)) {
								var d = {
									width: c.size.width,
									height: c.size.height,
									imgStyle: {
										width: c.element.find("img").width(),
										height: c.element.find("img").height(),
										marginTop: c.element.find("img").css("marginTop"),
										marginLeft: c.element.find("img").css("marginLeft")
									}
								};
								a.updateCompSize(c.element.attr("id"), d)
							} else a.updateCompSize(c.element.attr("id"), c.size);
							$(b.toElement).one("click", function(a) {
								a.stopImmediatePropagation()
							})
						},
						resize: function(a, c) {
							var d = $(b).find("img").width() / $(b).find("img").height();
							if ("4" == $(c.element).attr("ctype").charAt(0)) {
								var e = c.size.width / c.size.height,
									f = c.element.find("img");
								d >= e ? (f.outerHeight(c.size.height), f.outerWidth(c.size.height * d), f.css("marginLeft", -(f.outerWidth() - c.size.width) / 2), f.css("marginTop", 0)) : (f.outerWidth(c.size.width), f.outerHeight(c.size.width / d), f.css("marginTop", -(f.outerHeight() - c.size.height) / 2), f.css("marginLeft", 0))
							} else c.element.find(".element").outerWidth(c.size.width), c.element.find(".element").outerHeight(c.size.height)
						}
					})
				}
			}
		}).directive("photoDraggable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					a.$on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), b.on("$destroy", function() {
						$(b).draggable(), $(b).draggable("destroy"), b = null
					}), $(b).draggable({
						revert: !1,
						helper: "clone",
						appendTo: ".img_list",
						zIndex: 1049,
						opacity: .35,
						stop: function(a, b) {
							$(a.toElement).one("click", function(a) {
								a.stopImmediatePropagation()
							})
						}
					})
				}
			}
		}).directive("cropDroppable", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					a.$on("$destroy", function() {
						$(b).droppable(), $(b).droppable("destroy"), b = null
					}), b.on("$destroy", function() {
						$(b).droppable(), $(b).droppable("destroy"), b = null
					}), $(b).droppable({
						accept: "li",
						hoverClass: "drop-hover",
						drop: function(b, c) {
							a.preSelectImage(c.draggable.attr("photo-draggable"))
						}
					})
				}
			}
		}).service("editAreaBorderCollisionDetector", function() {
			function a() {
				this.editAreaWidth = 320, this.editAreaHeight = 486, this.detectionBoxs = []
			}

			function c(a) {
				this.element = a, this.init()
			}

			function d(a, b) {
				this.x = a, this.y = b
			}

			function e() {
				this.editArea = new a
			}
			return a.prototype.initDetectBoxWithElements = function(a) {
				this.detectionBoxs = [];
				var d = this;
				b.forEach(a, function(a) {
					d.detectionBoxs.push(new c(a))
				})
			}, c.prototype.init = function() {
				var a = this.element.position();
				this.startPointA = new d(a.left, a.top);
				var b = this.element.get(0);
				this.startPosition = {
					top: parseInt(b.style.top, 10) || 0,
					left: parseInt(b.style.left, 10) || 0
				};
				var c = /[0-9]*[.]*[0-9]*deg/.exec(b.style.transform),
					e = c && c.length ? c[0] : "0";
				this.angle = parseInt(e, 10), this.radian = 2 * this.angle * Math.PI / 360;
				var f = this.element.width(),
					g = this.element.height();
				this.width = Math.abs(f * Math.cos(this.radian)) + Math.abs(g * Math.sin(this.radian)), this.height = Math.abs(f * Math.sin(this.radian)) + Math.abs(g * Math.cos(this.radian)), this.startPointB = this.startPointA.add(this.width, this.height)
			}, d.prototype.add = function(a, b) {
				return new d(this.x + a, this.y + b)
			}, d.prototype.detectionPointA = function(a) {
				this.x = a.x < this.x ? a.x : this.x, this.y = a.y < this.y ? a.y : this.y
			}, d.prototype.detectionPointB = function(a) {
				this.x = a.x > this.x ? a.x : this.x, this.y = a.y > this.y ? a.y : this.y
			}, e.prototype.initWithElements = function(a) {
				this.editArea.initDetectBoxWithElements(a), this.initBigDetectionBoxPoints()
			}, e.prototype.initBigDetectionBoxPoints = function() {
				this.bigDetectionBoxPointA = new d(this.editArea.editAreaWidth, this.editArea.editAreaHeight), this.bigDetectionBoxPointB = new d(0, 0);
				var a = this;
				b.forEach(this.editArea.detectionBoxs, function(b) {
					a.bigDetectionBoxPointA.detectionPointA(b.startPointA), a.bigDetectionBoxPointB.detectionPointB(b.startPointB)
				})
			}, e.prototype.refreshBoxInfo = function() {
				b.forEach(this.editArea.detectionBoxs, function(a) {
					a.init()
				}), this.initBigDetectionBoxPoints()
			}, e.prototype.translateIntoProperMoveDelta = function(a) {
				var b = {
					x: a.deltaX,
					y: a.deltaY
				};
				return this.bigDetectionBoxPointA.x + a.deltaX < 0 && (b.x = -Math.floor(this.bigDetectionBoxPointA.x)), this.bigDetectionBoxPointA.y + a.deltaY < 0 && (b.y = -Math.floor(this.bigDetectionBoxPointA.y)), this.bigDetectionBoxPointB.x + a.deltaX > this.editArea.editAreaWidth && (b.x = Math.floor(this.editArea.editAreaWidth - this.bigDetectionBoxPointB.x)), this.bigDetectionBoxPointB.y + a.deltaY > this.editArea.editAreaHeight && (b.y = Math.floor(this.editArea.editAreaHeight - this.bigDetectionBoxPointB.y)), b
			}, e.prototype.compDragMoveDelta = function(a) {
				return this.translateIntoProperMoveDelta(a)
			}, new e
		}).controller("MultiCompDragController", ["selectService", "$scope", "$element", "editAreaBorderCollisionDetector", "panStateTracker",
			function(a, c, d, e, f) {
				function g(d) {
					if (a.getElements().length) {
						b.forEach(h.selectedComponents, function(a) {
							a.css("opacity", 1)
						});
						var f = e.compDragMoveDelta({
							deltaX: d.deltaX,
							deltaY: d.deltaY
						});
						b.forEach(e.editArea.detectionBoxs, function(a) {
							var b = "translate3d(0, 0, 0) rotateZ(" + a.angle + "deg)",
								d = a.element.get(0);
							d.style.transform = b;
							var e = {
								top: a.startPosition.top + f.y,
								left: a.startPosition.left + f.x
							};
							a.element.css("top", e.top), a.element.css("left", e.left), c.updateCompPosition(a.element.attr("id"), e)
						}), e.refreshBoxInfo()
					}
				}
				f.clear();
				var h = this;
				h.selectedComponents = [], h.initCollisionDetectorWithElements = function() {
					h.selectedComponents = [];
					var c = $("#nr");
					b.forEach(a.getElements(), function(a) {
						h.selectedComponents.push(c.find("#inside_" + a))
					}), e.initWithElements(h.selectedComponents)
				}, h.compDragStart = function(a) {
					h.initCollisionDetectorWithElements(), a || b.forEach(h.selectedComponents, function(a) {
						a.css("opacity", .35)
					})
				}, h.compDragMove = function(a) {
					var c = e.compDragMoveDelta({
						deltaX: a.deltaX,
						deltaY: a.deltaY
					});
					b.forEach(e.editArea.detectionBoxs, function(a) {
						var b = "translate3d(" + c.x + "px, " + c.y + "px, 0) rotateZ(" + a.angle + "deg)",
							d = a.element.get(0);
						d.style.transform = b
					})
				}, h.compDragEnd = function(a) {
					g(a)
				}, c.$on("multiCompDrag", function(a, b, c) {
					h.initCollisionDetectorWithElements(), c ? h.compDragMove(b) : g(b)
				})
			}
		]).directive("multiCompDrag", function() {
			return {
				restrict: "A",
				controller: "MultiCompDragController"
			}
		}).service("panStateTracker", function() {
			var a = {},
				b = {};
			return a.clear = function() {
				b = {}
			}, a.register = function(a) {
				b[a.attr("id")] = "true"
			}, a.isElementHasBeenRegisted = function(a) {
				return "true" === b[a.attr("id")]
			}, a.remove = function(a) {
				delete b[a.attr("id")]
			}, a
		}).directive("compDrag", ["panStateTracker",
			function(a) {
				return {
					require: "^multiCompDrag",
					restrict: "A",
					link: function(b, c, d, e) {
						if (!a.isElementHasBeenRegisted(c)) {
							a.register(c), c.on("$destroy", function() {
								a.remove(c)
							});
							var f = new Hammer(c.find(".element-box-contents").get(0));
							f.get("pan").set({
								threshold: 0
							}), f.on("panstart", function(a) {
								return $(".edit_area").find(".switch").length ? !1 : (a.preventDefault(), a.srcEvent.preventDefault(), $("body").css({
									"user-select": "none",
									cursor: "default"
								}), void e.compDragStart())
							}), f.on("panmove", function(a) {
								return $(".edit_area").find(".switch").length ? !1 : (e.compDragMove(a), a.preventDefault(), void("img" == a.target.tagName.toLowerCase() && (a.target.ondragstart = function() {
									return !1
								})))
							}), f.on("panend", function(a) {
								return $(".edit_area").find(".switch").length ? !1 : (e.compDragEnd(a), $("body").css({
									"user-select": "initial",
									cursor: "default"
								}), void $(a.srcEvent.target).one("click", function(a) {
									return a.stopImmediatePropagation(), a.stopPropagation(), a.preventDefault(), !1
								}))
							})
						}
					}
				}
			}
		]).directive("compRotate", function() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					var d = $(b),
						e = $('<div class="bar bar-rotate bar-radius">');
					d.append(e).append('<div class="bar bar-line">');
					var f, g = {},
						h = new Hammer(e.get(0));
					h.get("pan").set({
						threshold: 0
					}), h.on("panstart", function(a) {
						d.addClass("no-drag"), $("body").css({
							"user-select": "none",
							cursor: 'url("/addons/Market/Show/public/images/mouserotate.ico"), default'
						});
						var b = d.parent();
						g = {
							x: parseFloat(d.css("left")) + b.offset().left + d.width() / 2,
							y: parseFloat(d.css("top")) + b.offset().top + d.height() / 2
						}
					}), h.on("panmove", function(a) {
						var b = a.center,
							c = b.x - g.x,
							e = b.y - g.y,
							h = Math.abs(c / e);
						f = Math.atan(h) / (2 * Math.PI) * 360, c > 0 && 0 > e ? f = 360 + f : c > 0 && e > 0 ? f = 180 - f : 0 > c && e > 0 ? f = 180 + f : 0 > c && 0 > e && (f = 360 - f), f > 360 && (f -= 360), d.css({
							transform: "rotateZ(" + f + "deg)"
						})
					}), h.on("panend", function(b) {
						$("body").css({
							"user-select": "initial",
							cursor: "default"
						}), a.updateCompAngle(d.attr("id"), f), a.$broadcast("updateTransform", f)
					})
				}
			}
		}).directive("compResize", ["selectService", "picturesService", "triggerService",
			function(a, b, c) {
				function d(a) {
					var b = a.children(".element-box"),
						c = {
							width: b.width(),
							height: b.height()
						};
					if ("4" == a.attr("ctype").charAt(0)) {
						var d = a.find("img"),
							e = d.width() / d.height(),
							f = c.width / c.height;
						e >= f ? (d.outerHeight(c.height), d.outerWidth(c.height * e), d.css("marginLeft", -(d.outerWidth() - c.width) / 2), d.css("marginTop", 0)) : (d.outerWidth(c.width), d.outerHeight(c.width / e), d.css("marginTop", -(d.outerHeight() - c.height) / 2), d.css("marginLeft", 0))
					} else "p" == a.attr("ctype").charAt(0) ? a.find(".fluxslider, .images, .image1, .image2").css({
						width: c.width,
						height: c.height
					}) : a.find(".element").css({
						width: c.width,
						height: c.height
					})
				}

				function e(a, c) {
					var d = c.position(),
						e = {
							width: c.width(),
							height: c.height(),
							left: d.left,
							top: d.top
						};
					if ("4" == c.attr("ctype").charAt(0)) {
						var f = c.find("img"),
							g = {
								width: e.width,
								height: e.height,
								left: e.left,
								top: e.top,
								imgStyle: {
									width: f.width(),
									height: f.height(),
									marginTop: f.css("marginTop"),
									marginLeft: f.css("marginLeft")
								}
							};
						a.updateCompSize(c.attr("id"), g)
					} else if ("p" == c.attr("ctype").charAt(0)) {
						var h = b.getProperties();
						if (!h || !h.children) return;
						var i = c.find(".slider"),
							j = i.attr("id");
						i.empty();
						for (var k = 0; k < h.children.length; k++) i.append('<img src="' + PREFIX_FILE_HOST + h.children[k].src + '">');
						utilPictures.deleteInterval(j), new flux.slider("#nr #" + j, {
							autoplay: h.autoPlay,
							delay: h.interval,
							pagination: !1,
							transitions: [utilPictures.getPicStyle(h.picStyle).name],
							width: e.width,
							height: e.height,
							bgColor: h.bgColor,
							onStartEnd: function(a) {
								utilPictures.addInterval(j, a)
							}
						}), a.updateCompSize(c.attr("id"), e)
					} else a.updateCompSize(c.attr("id"), e)
				}

				function f(a, b, c, f) {
					var h, i, j, k, l, m, n, o, p, q, r, s, t, u = $(b),
						v = u.closest("ul"),
						w = parseFloat(u.css("min-width") || 50),
						x = parseFloat(u.css("min-height") || 30),
						y = new Hammer($(c).get(0));
					y.get("pan").set({
						threshold: 0,
						direction: Hammer.DIRECTION_ALL
					}), y.on("panstart", function() {
						u.addClass("no-drag"), h = u.width(), i = u.height(), r = h / i, j = parseFloat(u.css("left")), k = parseFloat(u.css("top")), l = j + h, m = k + i, n = 320 - j, o = 486 - k, v.css("cursor", f), $("body").css({
								"user-select": "none",
								cursor: "default"
							}), s = u.get(0).style.transform, s = s && s.replace("rotateZ(", "").replace("deg)", ""),
							s = s && parseFloat(s), t = 2 * s * Math.PI / 360
					}), y.on("panmove", function(a) {
						switch (f) {
							case g.RESIZE_W:
								if (h - a.deltaX <= w) break;
								if (h - a.deltaX >= l) {
									u.css({
										left: 0,
										width: l
									});
									break
								}
								u.css({
									left: j + a.deltaX,
									width: h - a.deltaX
								});
								break;
							case g.RESIZE_E:
								if (h + a.deltaX >= n) {
									u.css("width", n);
									break
								}
								u.css("width", h + a.deltaX);
								break;
							case g.RESIZE_N:
								if (i - a.deltaY <= x) break;
								if (i - a.deltaY >= m) {
									u.css({
										top: 0,
										height: m
									});
									break
								}
								u.css({
									top: k + a.deltaY,
									height: i - a.deltaY
								});
								break;
							case g.RESIZE_S:
								if (i + a.deltaY >= o) {
									u.css("height", o);
									break
								}
								u.css("height", i + a.deltaY);
								break;
							case g.RESIZE_SE:
								if (p = i + a.deltaY, q = p * r, w >= q || x >= p || q >= n || p >= o) break;
								u.css({
									height: p,
									width: q
								});
								break;
							case g.RESIZE_SW:
								if (p = i + a.deltaY, q = p * r, w >= q || x >= p || q >= l || p >= o) break;
								u.css({
									left: l - q,
									height: p,
									width: q
								});
								break;
							case g.RESIZE_NE:
								if (p = i - a.deltaY, q = p * r, w >= q || x >= p || q >= n || p >= m) break;
								u.css({
									top: m - p,
									height: p,
									width: q
								});
								break;
							case g.RESIZE_NW:
								if (p = i - a.deltaY, q = p * r, w >= q || x >= p || q >= l || p >= m) break;
								u.css({
									top: m - p,
									left: l - q,
									height: p,
									width: q
								})
						}
						d(u)
					}), y.on("panend", function() {
						v.css("cursor", "default"), $("body").css({
							"user-select": "initial",
							cursor: "default"
						}), e(a, u), a.$broadcast("updateMaxRadius", u)
					})
				}
				var g = {
					RESIZE_W: "w-resize",
					RESIZE_E: "e-resize",
					RESIZE_N: "n-resize",
					RESIZE_S: "s-resize",
					RESIZE_SE: "se-resize",
					RESIZE_SW: "sw-resize",
					RESIZE_NE: "ne-resize",
					RESIZE_NW: "nw-resize"
				};
				return {
					restrict: "A",
					link: function(b, d, e) {
						var h = d,
							i = $('<div class="bar bar-n"><div class="bar-radius"></div></div>'),
							j = $('<div class="bar bar-s"><div class="bar-radius"></div></div>'),
							k = $('<div class="bar bar-e"><div class="bar-radius"></div></div>'),
							l = $('<div class="bar bar-w"><div class="bar-radius"></div></div>'),
							m = $('<div class="bar bar-ne bar-radius">'),
							n = $('<div class="bar bar-nw bar-radius">'),
							o = $('<div class="bar bar-se bar-radius">'),
							p = $('<div class="bar bar-sw bar-radius">');
						h.append(i).append(j).append(k).append(l).append(m).append(n).append(o).append(p).unbind("mousedown").mousedown(function(c) {
							var d = !!$(".edit_area").find(".switch").length;
							if (!d) {
								var e = $(this).attr("id").split("_")[1];
								if (c.ctrlKey) "none" != $(this).children(".bar").first().css("display") ? ($(this).children(".bar").hide(), a.deleteElement(e)) : ($(this).children(".bar").show(), a.addElement(e));
								else {
									if ("none" != $(this).children(".bar").first().css("display")) return;
									$(this).children(".bar").show().end().siblings().children(".bar").hide(), a.clearElements(), a.addElement(e)
								}
								b.safeApply(function() {})
							}
						});
						var q = utilTrigger.getSendType(),
							r = utilTrigger.getHandleType();
						h.find(".element-box").unbind("click").bind("click", function(a) {
							var b = $(".edit_area").find(".switch"),
								d = !!b.length;
							if ((a.ctrlKey || d) && a.stopPropagation(), d && !h.children(".switch").length) {
								var f = parseInt(b.parent().attr("id").replace("inside_", ""), 10),
									g = parseInt(e.id.replace("inside_", ""), 10),
									i = h.children(".boom");
								i.length ? (i.remove(), c.deleteTrigger(q.CLICK.value, r.SHOW.value, f, g)) : ($('<div class="boom">').appendTo(h), c.addTrigger(q.CLICK.value, r.SHOW.value, f, g))
							}
						}), h.parent().unbind("mousedown").mousedown(function(c) {
							$(c.target).closest("li").length || ($(this).children("li").children(".bar").hide(), b.$emit("hideStylePanel"), a.clearElements(), b.safeApply(function() {}))
						}), f(b, h, k, g.RESIZE_E), f(b, h, l, g.RESIZE_W), f(b, h, i, g.RESIZE_N), f(b, h, j, g.RESIZE_S), f(b, h, m, g.RESIZE_NE), f(b, h, n, g.RESIZE_NW), f(b, h, o, g.RESIZE_SE), f(b, h, p, g.RESIZE_SW)
					}
				}
			}
		]).directive("pasteElement", ["sceneService",
			function(a) {
				function b() {
					var b = $('<ul id="pasteMenu" class="dropdown-menu" style="min-width: 100px; display: block;" role="menu" aria-labelledby="dropdownMenu1"><li class="paste" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-paste" style="color: #08a1ef;"></div>&nbsp;&nbsp;粘贴</a></li></ul>').css({
						position: "absolute",
						"user-select": "none"
					});
					return b.find(".paste").on("click", function() {
						a.pasteElement(), b.hide()
					}), b
				}
				return {
					restrict: "EA",
					link: function(c, d, e) {
						var f = $(d);
						f.on("contextmenu", function(c) {
							if (a.getCopy()) {
								var d = b(),
									e = $("#eq_main"),
									f = $("#pasteMenu");
								f.length > 0 && f.remove(), e.append(d), d.css({
									left: c.pageX + e.scrollLeft() + 15,
									top: c.pageY + e.scrollTop()
								}).show(), e.mousemove(function(a) {
									var b = $("#pasteMenu");
									(a.pageX < b.offset().left - 20 || a.pageX > b.offset().left + b.width() + 20 || a.pageY < b.offset().top - 20 || a.pageY > b.offset().top + b.height() + 20) && (b.hide(), $(this).unbind("mousemove"))
								})
							}
							return !1
						})
					}
				}
			}
		]).directive("eqxEditDestroy", ["selectService",
			function(a) {
				return {
					link: function(b, c) {
						c.on("$destroy", function() {
							a.clearElements()
						})
					}
				}
			}
		]).directive("elementAnim", ["selectService",
			function(a) {
				function b(a, c, d, e) {
					if (c.length && e < c.length) {
						var f = a.get(0);
						a.css("animation", ""), f.offsetWidth = f.offsetWidth, a.css("animation", d[e] + " " + c[e].duration + "s ease 0s").css("animation-fill-mode", "backwards"), a.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
							e++, b(a, c, d, e)
						})
					}
				}
				return {
					restrict: "EA",
					link: function(a, c) {
						var d;
						a.$on("previewCurrentChange", function(a, b) {
							d = d = $("#inside_" + b.elemId + " .element-box");
							var c = d.get(0);
							c.offsetWidth = c.offsetWidth, d.css("animation", b.animClasses[b.count] + " " + b.anim.duration + "s ease 0s").css("animation-fill-mode", "backwards")
						}), a.$on("previewAllChanges", function(a, c) {
							d = d = $("#inside_" + c.elemId + " .element-box"), b(d, c.animations, c.animClasses, c.count)
						})
					}
				}
			}
		]), b.module("app.directives.editor", []).directive("toolbar", ["$compile", "sceneService",
			function(c, d) {
				return {
					restrict: "EA",
					replace: !0,
					templateUrl: "directives/toolbar.tpl.html",
					link: function(e, f, g) {
						f.bind("keydown", function(a) {
							a.stopPropagation()
						}), e.internalLinks = b.copy(e.pages), e.internalLink || e.externalLink || (e.internalLink = e.internalLinks[0], e.externalLink = "http://");
						var h = ["#000000", "#7e2412", "#ff5400", "#225801", "#0c529e", "#333333", "#b61b52", "#f4711f", "#3bbc1e", "#23a3d3", "#888888", "#d34141", "#f7951e", "#29b16a", "#97daf3", "#cccccc", "#ec7c7c", "#fdea02", "#79c450", "#563679", "#ffffff", "#ffcccc", "#d9ef7f", "#c3f649"],
							i = $(".color-menu"),
							j = $(".bgcolor-menu");
						$.each(h, function(a, b) {
							i.append($('<li><a dropdown-toggle class="btn" data-edit="foreColor ' + b + '" style="background-color: ' + b + '"></a></li>'))
						}), c(i.append($('<li><a dropdown-toggle class="btn glyphicon glyphicon-remove" data-edit="foreColor transparent" style="background-color: transparent"></a></li>')))(e);
						var k = function(a) {
							var b = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
							a = a.replace(b, function(a, b, c, d) {
								return b + b + c + c + d + d
							});
							var c = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a);
							return c ? {
								r: parseInt(c[1], 16),
								g: parseInt(c[2], 16),
								b: parseInt(c[3], 16)
							} : null
						};
						$.each(h, function(a, b) {
							var c = k(b);
							j.append($('<li><a dropdown-toggle class="btn" data-edit="backColor rgba(' + c.r + "," + c.g + "," + c.b + ', 0.3)" style="background-color: rgba(' + c.r + "," + c.g + "," + c.b + ', 0.3)"></a></li>'))
						}), c(j.append($('<li><a dropdown-toggle class="btn glyphicon glyphicon-remove" data-edit="backColor transparent" style="background-color: transparent"></a></li>')))(e), d.currentElemDef.css.lineHeight = (parseFloat(d.currentElemDef.css.lineHeight) || 1).toFixed(1), e.increaseLineHeight = function() {
							var b = a.getSelection(),
								c = b.focusNode,
								e = $(c).parents(".element-box");
							d.currentElemDef.css.lineHeight = (parseFloat(d.currentElemDef.css.lineHeight) + .1).toFixed(1), e.css("line-height", d.currentElemDef.css.lineHeight), $(c.parentNode).focus()
						}, e.decreaseLineHeight = function() {
							var b = a.getSelection(),
								c = b.focusNode,
								e = $(c).parents(".element-box");
							d.currentElemDef.css.lineHeight > .1 && (d.currentElemDef.css.lineHeight = (parseFloat(d.currentElemDef.css.lineHeight) - .1).toFixed(1), e.css("line-height", d.currentElemDef.css.lineHeight)), $(c.parentNode).focus()
						}
					}
				}
			}
		]), b.module("app.directives.uislider", []).value("uiSliderConfig", {}).directive("uiSlider", ["uiSliderConfig", "$timeout",
			function(a, d) {
				return a = a || {}, {
					require: "ngModel",
					compile: function() {
						return function(e, f, g, h) {
							function i(a, b) {
								return b ? parseFloat(a) : parseInt(a, 10)
							}

							function j() {
								f.slider("destroy")
							}
							var k = b.extend(e.$eval(g.uiSlider) || {}, a),
								l = {
									min: null,
									max: null
								},
								m = ["min", "max", "step"],
								n = b.isUndefined(g.useDecimals) ? !1 : !0,
								o = function() {
									b.isArray(h.$viewValue) && k.range !== !0 && (console.warn("Change your range option of ui-slider. When assigning ngModel an array of values then the range option should be set to true."), k.range = !0), b.forEach(m, function(a) {
										b.isDefined(g[a]) && (k[a] = i(g[a], n))
									}), f.slider(k), o = b.noop
								};
							b.forEach(m, function(a) {
								g.$observe(a, function(b) {
									b && (o(), k[a] = i(b, n), f.slider("option", a, i(b, n)), h.$render())
								})
							}), g.$observe("disabled", function(a) {
								o(), f.slider("option", "disabled", !!a)
							}), e.$watch(g.uiSlider, function(a) {
								o(), a !== c && f.slider("option", a)
							}, !0), d(o, 0, !0), f.bind("slide", function(a, b) {
								h.$setViewValue(b.values || b.value), e.$apply()
							}), h.$render = function() {
								o();
								var a = k.range === !0 ? "values" : "value";
								k.range || !isNaN(h.$viewValue) || h.$viewValue instanceof Array ? k.range && !b.isDefined(h.$viewValue) && (h.$viewValue = [0, 0]) : h.$viewValue = 0, k.range === !0 && (b.isDefined(k.min) && k.min > h.$viewValue[0] && (h.$viewValue[0] = k.min), b.isDefined(k.max) && k.max < h.$viewValue[1] && (h.$viewValue[1] = k.max), h.$viewValue[0] > h.$viewValue[1] && (l.min >= h.$viewValue[1] && (h.$viewValue[0] = l.min), l.max <= h.$viewValue[0] && (h.$viewValue[1] = l.max)), l.min = h.$viewValue[0], l.max = h.$viewValue[1]), f.slider(a, h.$viewValue)
							}, e.$watch(g.ngModel, function() {
								k.range === !0 && h.$render()
							}, !0), f.bind("$destroy", j);
							var p = $('<div class="ui-slider-progress-bar"></div>');
							f.append(p);
							var q = e.$watch(g.ngModel, function() {
								setTimeout(function() {
									p.css("width", $(".ui-slider-handle", f).css("left"))
								})
							}, !0);
							f.bind("$destroy", function() {
								q()
							})
						}
					}
				}
			}
		]), b.module("security.authority", []).factory("authority", [
			function() {
				var a = {
						GROUP_CUSTOMER: 1,
						SCENE_HIDE_LASTPAGE_SETTING: 2,
						TRANSFER_SCENE: 4,
						SCENE_EDIT_TRIGGER: 8
					},
					b = {
						1: {
							code: 5,
							name: "普通账号"
						},
						2: {
							code: 7,
							name: "企业账号"
						},
						21: {
							code: 7,
							name: "企业子账号"
						},
						3: {
							code: 15,
							name: "高级用户"
						},
						4: {
							code: 15,
							name: "服务商用户"
						}
					};
				return {
					accessDef: a,
					userRoleDef: b
				}
			}
		]), b.module("security.authorization", ["security.service"]).provider("securityAuthorization", {
			requireAdminUser: ["securityAuthorization",
				function(a) {
					return a.requireAdminUser()
				}
			],
			requireAuthenticatedUser: ["securityAuthorization",
				function(a) {
					return a.requireAuthenticatedUser()
				}
			],
			$get: ["security", "securityRetryQueue",
				function(a, b) {
					var c = {
						requireAuthenticatedUser: function() {
							var d = a.requestCurrentUser().then(function(d) {
								return a.isAuthenticated() ? void 0 : b.pushRetryFn("unauthenticated-client", c.requireAuthenticatedUser)
							});
							return d
						},
						requireAdminUser: function() {
							var d = a.requestCurrentUser().then(function(d) {
								return a.isAdmin() ? void 0 : b.pushRetryFn("unauthorized-client", c.requireAdminUser)
							});
							return d
						}
					};
					return c
				}
			]
		}), b.module("security", ["security.service", "security.interceptor", "security.login", "security.authorization"]), b.module("security.interceptor", ["security.retryQueue"]).factory("securityInterceptor", ["$injector", "$location", "securityRetryQueue",
			function(a, b, c) {
				return function(d) {
					return d.then(null, function(e) {
						if (401 === e.status) {
							if ("/home" == b.path() || "/home/login" == b.path() || "/home/register" == b.path() || "/home/reset" == b.path() || "/agreement" == b.path() || "/reg" == b.path() || "/sample" == b.path() || "/error" == b.path()) return;
							d = c.pushRetryFn("unauthorized-server", function() {
								return a.get("$http")(e.config)
							})
						}
						return 403 === e.status && (alert("对不起，您没有查看此内容的权限"), b.path("/home")), d
					})
				}
			}
		]).config(["$httpProvider",
			function(a) {
				a.responseInterceptors.push("securityInterceptor")
			}
		]), b.module("security.login.form", ["services.localizedMessages", "app.directives.addelement"]).controller("LoginFormController", ["$scope", "$timeout", "security", "localizedMessages", "$location", "$sce",
			function(a, b, c, d, e, f) {
				a.user = {}, a.retrieve = {}, a.showLogin = !0, a.sendPassword = !1, a.unExist = !1, a.weiChatUrl = c.thirdPartyUrl.weiChatUrl, a.qqUrl = c.thirdPartyUrl.qqUrl, a.weiboUrl = c.thirdPartyUrl.weiboUrl, a.openWeibo = function() {
					alert("新浪微博注册功能即将开放!")
				}, a.authError = null, a.isValidateCodeLogin = c.isValidateCodeLogin, a.validateCodeSrc = PREFIX_URL + "servlet/validateCodeServlet", a.authReason = null, c.getLoginReason() && (a.authReason = d.get(c.isAuthenticated() ? "login.reason.notAuthorized" : "login.reason.notAuthenticated")), a.rotate = function(c) {
					$(".modal-content").addClass("flip"), $(".login-form-section").fadeOut(600), b(function() {
						a.showLogin = !c, $(".login-form-section").fadeIn(0), $(".modal-content").removeClass("flip")
					}, 600)
				}, a.login = function() {
					a.authError = null;
					var b = {
						username: a.user.email,
						password: a.user.password,
						rememberMe: a.user.rememberMe
					};
					return !a.isValidateCodeLogin || (b.geetest_challenge = challenge, b.geetest_validate = validate, b.geetest_seccode = seccode, challenge && validate && seccode) ? a.user.email ? a.user.password ? void c.login($.param(b)).then(function(b) {
						challenge = null, validate = null, seccode = null, b ? (selectorA && selectorA(".gt_refresh_button").click(), 1005 === b.code, a.isValidateCodeLogin = b.map.isValidateCodeLogin, a.authReason = "", a.authError = b.msg) : (a.authError = d.get("login.error.invalidCredentials"), submit = !1)
					}, function(b) {
						a.authError = d.get("login.error.serverError", {
							exception: b
						})
					}) : (a.authReason = "", void(a.authError = "密码不能为空")) : (a.authReason = "", void(a.authError = "邮箱不能为空")) : (a.authReason = "", void(a.authError = "验证码不能为空"))
				}, a.openRegister = function() {
					e.path("/home/register", !1)
				}, a.clearForm = function() {
					a.user = {}
				}, a.cancelLogin = function() {
					c.cancelLogin()
				}, a.reset = function() {
					a.user = {}, a.retrieve = {}
				};
				var g = "http://api.geetest.com/get.php?gt=daaddfc771c7324ad7c6098a64580dab&time=" + (new Date).getTime();
				a.validateCodeUrl = f.trustAsResourceUrl(g), b(function() {
					$('input[name="userEmail"]').focus()
				}, 300), a.retrievePassword = function() {
					return a.retrieve.email ? submit ? challenge && validate && seccode ? void c.retrievePassword(a.retrieve.email, challenge, validate, seccode).then(function(b) {
						challenge = "", validate = "", seccode = "", 200 == b.data.code ? (a.sendPassword = !0, submit = !1) : (selectorA && selectorA(".gt_refresh_button").click(), 1003 == b.data.code ? a.retrieveError = "账号不存在" : 1005 == b.data.code && (a.retrieveError = "验证码错误"))
					}) : void(a.retrieveError = "验证码不能为空") : void(a.retrieveError = "验证码匹配错误") : void(a.retrieveError = "邮箱不能为空")
				}
			}
		]), b.module("security.login.reset", ["services.localizedMessages"]).controller("ResetFormController", ["$scope", "security", "localizedMessages", "$location", "resetKey",
			function(a, b, c, d, e) {
				a.password = {}, a.reset = function() {
					return a.password.newPw != a.password.confirm ? (a.authError = c.get("login.reset.notmatch"), a.password.newPw = "", a.password.confirm = "", void $('input[name="newPassword"]').focus()) : void b.resetPassByKey(a.password.newPw, e).then(function(b) {
						200 == b.data.code ? (alert("修改成功"), a.$close(), d.path("/main").search({})) : 1011 == b.data.code && (a.authError = b.data.msg)
					})
				}, a.cancel = function() {
					a.$dismiss()
				}
			}
		]).directive("equals", function() {
			return {
				restrict: "A",
				require: "?ngModel",
				link: function(a, b, c, d) {
					if (d) {
						a.$watch(c.ngModel, function() {
							e()
						}), c.$observe("equals", function(a) {
							e()
						});
						var e = function() {
							var a = d.$viewValue,
								b = c.equals;
							d.$setValidity("equals", a === b)
						}
					}
				}
			}
		}), b.module("security.login", ["security.login.form", "security.login.reset", "security.login.toolbar"]), b.module("security.login.toolbar", ["services.usercenter"]).directive("loginToolbar", ["security", "$rootScope", "usercenterService",
			function(a, b, c) {
				var d = {
					templateUrl: "security/login/toolbar.tpl.html",
					restrict: "E",
					replace: !0,
					scope: !0,
					link: function(d, e, f, g) {
						d.PREFIX_FILE_HOST = PREFIX_FILE_HOST, d.isAuthenticated = a.isAuthenticated, d.login = a.showLogin, d.logout = a.logout, d.requestResetPassword = a.requestResetPassword, d.isAdvancedUser = b.isAdvancedUser, d.isEditor = b.isEditor, d.isVendorUser = b.isVendorUser, d.$watch(function() {
							return a.currentUser
						}, function(a) {
							d.currentUser = a, d.currentUser.headImg ? /^http.*/.test(a.headImg) && (d.headImg = a.headImg) : d.headImg = CLIENT_CDN + "addons/Market/Show/public/images/defaultuser.jpg"
						}), d.$on("minusCount", function(a, b) {
							d.count -= b, d.newMsgCount = d.count > 9 ? "9+" : d.count
						}), d.getNewMessage = function(a, b, e) {
							c.getNewMessage(a, b, e).then(function(a) {
								d.newMsgs = a.data.list, d.count = a.data.map.count, d.newMsgCount = a.data.map.count > 9 ? "9+" : a.data.map.count
							})
						}, d.getNewMessage(1, 4, !0), d.openMsgPanel = function() {
							$(".mes_con").hasClass("open") || d.getNewMessage(1, 4, !0)
						}
					}
				};
				return d
			}
		]), b.module("security.otherregister.form", ["services.localizedMessages", "app.directives.register"]), b.module("security.otherregister.form").controller("OtherRegisterFormController", ["$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window", "otherRegisterInfo",
			function(a, b, c, d, e, f, g, h) {
				a.user = {}, a.user.agreement = !0, a.getUserDetail = function() {
					var b = {
						type: "qq",
						openId: h.openId,
						accessToken: h.accessToken
					};
					c.getUserDetail(b.type, b.openId, b.accessToken).then(function(b) {
						a.otherUserInfo = b.data.obj
					})
				}, a.getUserDetail()
			}
		]), b.module("security.register.form", ["services.localizedMessages", "app.directives.register"]),
            b.module("security.register.form").controller("RegisterFormController", ["$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window",
			function(a, b, c, d, e, f, g) {
				a.user = {}, a.user.agreement = !0, a.weiChatUrl = c.thirdPartyUrl.weiChatUrl, a.qqUrl = c.thirdPartyUrl.qqUrl, a.weiboUrl = c.thirdPartyUrl.weiboUrl;
				var h = !1;
				a.openWeibo = function() {
					alert("新浪微博注册功能即将开放!")
				}, a.register = function() {
					var b = {
							email: a.user.email,
							password: a.user.password
						},
						e = /^([a-zA-Z0-9]+[_|\_|\.|\-]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.|\-]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
					if (!e.test(a.user.email)) return void(a.regErr = "请输入正确的邮箱格式");
					if (a.user.password === a.user.repeatPassword && a.user.agreement) {
						if (h) return;
						h = !0, c.register($.param(b)).then(function(b) {
							h = !1, b && (a.regErr = b.msg)
						}, function(b) {
							h = !1, a.regErr = d.get("register.error.serverError", {
								exception: b
							})
						})
					} else a.user.password != a.user.repeatPassword ? a.regErr = d.get("register.error.match") : a.regErr = d.get("register.error.agreement")
				}, a.checkUpperCase = function() {
					/[A-Z]/g.test(a.user.email) && (a.user.email = a.user.email.toLowerCase(), alert("请用小写字母邮箱注册，已将邮箱中的大写字母自动转换成小写"))
				}, a.openLogin = function() {
					e.path("/home/login", !1)
				}, a.reset = function() {
					a.user = {}
				}
			}
		]).controller("BindingController", ["$rootScope", "$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window",
			function(a, b, c, d, e, f, g, h) {
				b.qq_url = "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101149132&redirect_uri=" + redirect_uri + "&display=pc", b.weibo_url = "https://api.weibo.com/oauth2/authorize?client_id=3508809852&response_type=token&redirect_uri=" + PREFIX_HOST
			}
		]), b.module("security.register", ["security.register.form", "security.otherregister.form"]), b.module("security.retryQueue", []).factory("securityRetryQueue", ["$q", "$log",
			function(a, d) {
				var e = [],
					f = {
						onItemAddedCallbacks: [],
						hasMore: function() {
							return e.length > 0
						},
						push: function(a) {
							e.push(a), b.forEach(f.onItemAddedCallbacks, function(b) {
								try {
									b(a)
								} catch (c) {
									d.error("securityRetryQueue.push(retryItem): callback threw an error" + c)
								}
							})
						},
						pushRetryFn: function(b, d) {
							1 === arguments.length && (d = b, b = c);
							var e = a.defer(),
								g = {
									reason: b,
									retry: function() {
										a.when(d()).then(function(a) {
											e.resolve(a)
										}, function(a) {
											e.reject(a)
										})
									},
									cancel: function() {
										e.reject()
									}
								};
							return f.push(g), e.promise
						},
						retryReason: function() {
							return f.hasMore() && e[0].reason
						},
						cancelAll: function() {
							for (; f.hasMore();) e.shift().cancel()
						},
						retryAll: function() {
							for (; f.hasMore();) e.shift().retry()
						}
					};
				return f
			}
		]), b.module("security.service", ["security.retryQueue", "security.login", "security.register", "security.authority", "ui.bootstrap.modal"]).factory("security", ["$rootScope", "$http", "$q", "$location", "securityRetryQueue", "$modal", "ModalService", "authority",
			function(b, c, d, e, f, g, h, i) {
				function j(b) {
					b = b || "/", a.location.href = b
				}

				function k() {
					if (u && (l(u, !1), u = null), s) throw new Error("Trying to open a dialog that is already open!");
					s = g.open({
						windowClass: "login-container",
						keyboard: !1,
						templateUrl: "security/login/form.tpl.html",
						controller: "LoginFormController"
					}), s.result.then(m, m)
				}

				function l(a, b) {
					a.close(b)
				}

				function m(a) {
					s = null, a ? ("/home/login" == e.path() && e.path("/home", !1), f.retryAll()) : (f.cancelAll(), j())
				}

				function n(a) {
					if (t) throw new Error("Trying to open a dialog that is already open!");
					t = g.open({
						windowClass: "login-container",
						keyboard: !1,
						templateUrl: "security/login/reset.tpl.html",
						controller: "ResetFormController",
						resolve: {
							resetKey: function() {
								return a
							}
						}
					}), t.result.then(function() {
						t = null
					}, function() {
						x.currentUser || e.path("/home", !1).search({}), t = null
					})
				}

				function o() {
					if (s && (l(s, !0), s = null), u) throw new Error("Trying to open a dialog that is already open!");
					u = g.open({
						windowClass: "login-container",
						keyboard: !1,
						templateUrl: "security/register/register.tpl.html",
						controller: "RegisterFormController"
					}), u.result.then(function() {
						u = null
					}, function() {
						"/home/register" == e.path() && e.path("/home", !1), u = null
					})
				}

				function p(a) {
					if (v) throw new Error("Trying to open a dialog that is already open!");
					v = g.open({
						windowClass: "login-container",
						keyboard: !1,
						templateUrl: "security/register/otherregister.tpl.html",
						controller: "OtherRegisterFormController",
						resolve: {
							otherRegisterInfo: function() {
								return a
							}
						}
					})
				}

				function q(a) {
					w = a
				}

				function r() {
					return w
				}
				var s = null,
					t = null,
					u = null,
					v = null;
				f.onItemAddedCallbacks.push(function(a) {
					f.hasMore() && ("unauthorized-server" == f.retryReason() && x.showLogin(), "down-server" == f.retryReason() && h.openMsgDialog({
						msg: "服务器忙碌，请稍后再试！"
					}))
				});
				var w = {},
					x = {
						getLoginReason: function() {
							return f.retryReason()
						},
						showLogin: function() {
							k()
						},
						showRegister: function() {
							o()
						},
						showOtherRegister: function() {
							p()
						},
						getUserDetail: function(a, b, d) {
							var e = PREFIX_URL + "base/relUserInfo?type=" + a + "&openId=" + b + "&accessToken=" + d,
								f = new Date;
							return e += "&date=" + f.getTime(), c({
								method: "GET",
								url: e,
								withCredentials: !0
							})
						},
						addRegisterInfo: q,
						getRegisterInfo: r,
						login: function(a) {
							var b = this,
								d = c.post(JSON_URL + "?c=user&a=login", a, {
									withCredentials: !0,
									headers: {
										"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
									}
								});
							return d.then(function(a) {
								if (200 === a.status) {
									if (b.isValidateCodeLogin = !1, a.data.success !== !0) return a.data;
									("/home" == e.path() || "/home/login" == e.path()) && e.path("main"), x.requestCurrentUser(), l(s, !0)
								} else x.isAuthenticated()
							}, function(a) {
								x.isAuthenticated()
							})
						},
						register: function(a) {
							var b = c.post(JSON_URL + "?c=user&a=register", a, {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							});
							return b.then(function(a) {
								if (200 === a.status) {
									if (a.data.success !== !0) return a.data;
									("/home" == e.path() || "/home/register" == e.path()) && e.path("main"), x.requestCurrentUser(), l(u, !0)
								} else x.isAuthenticated()
							}, function(a) {
								x.isAuthenticated()
							})
						},
						thirdPartLogin: function(a) {
							var b = c.post(PREFIX_URL + "eqs/relAccount", $.param(a), {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							});
							return b.then(function(a) {
								if (200 === a.status) {
									if (a.data.success !== !0) return a.data;
									("/home" == e.path() || "/home/login" == e.path()) && e.path("main"), x.setLoginSuccess(!0), x.requestCurrentUser(), l(v, !0)
								} else x.isAuthenticated()
							}, function(a) {
								x.isAuthenticated()
							})
						},
						weiChatLogin: function(a) {
							return c.post(PREFIX_URL + "eqs/relWechatAccount?code=" + a + "&isMobile=1&time=" + (new Date).getTime(), {}, {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							})
						},
						cancelRegister: function() {
							l(u, !1), j("#/reg")
						},
						hasRel: function(a) {
							u && l(u, !1);
							var b = new Date,
								d = PREFIX_URL + "base/user/hasRel?type=" + a.type + "&openId=" + a.openId + "&time=" + b.getTime(),
								f = c.get(d, {
									withCredentials: !0
								});
							f.then(function(b) {
								200 === b.status ? b.data.success === !0 ? (("/home" == e.path() || "/home/login" == e.path()) && e.path("main"), x.requestCurrentUser()) : "未关联账号" == b.data.msg && p(a) : x.isAuthenticated()
							}, function(a) {
								x.isAuthenticated()
							})
						},
						cancelLogin: function() {
							l(s, !1), j()
						},
						logout: function(a) {
							c({
								withCredentials: !0,
								method: "GET",
								url: JSON_URL + "?c=user&a=logout"
							}).then(function(b) {
								x.currentUser = null, j(a)
							}, function() {
								x.currentUser = null, j(a)
							})
						},
						requestCurrentUser: function() {
							if (x.isAuthenticated()) return d.when(x.currentUser);
							var a = new Date;
							return c.get(CONTROLLER_URL + "?controller=Show&method=check&time=" + a.getTime(), {
								withCredentials: !0
							}).then(function(a) {
								if(a.data.code==25){
									window.location.href= PREFIX_HOST + 'hcc/login.html'
								}
								return a && (x.currentUser = a.data.obj, (!x.currentUser.roleIdList || x.currentUser.roleIdList.length <= 0) && (x.currentUser.roleIdList = [2])), x.currentUser
							})
						},
						resetPassByKey: function(a, b) {
							var d = {
								key: b,
								newPwd: a
							};
							return c.post(JSON_URL + "?c=user&a=reset", $.param(d), {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							})
						},
						currentUser: null,
						isAuthenticated: function() {
							return !!x.currentUser
						},
						isLoginSuccess: !1,
						setLoginSuccess: function(a) {
							x.isLoginSuccess = a
						},
						thirdPartyUrl: {
							weiChatUrl: "https://open.weixin.qq.com/connect/qrconnect?appid=wxc5f1bbae4bb93ced&redirect_uri=http%3A%2F%2Fcdwxlm.com&response_type=code&scope=snsapi_login&state=WECHAT_STATE#wechat_redirect",
							qqUrl: "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101149132&redirect_uri=http%3A%2F%2Fcdwxlm.com&scope=get_user_info",
							weiboUrl: "https://api.weibo.com/oauth2/authorize?client_id=3508809852&response_type=token&redirect_uri=http://cdwxlm.com"
						},
						isAllowToAccess: function(a) {
							var b = i.userRoleDef[x.currentUser.type];
							return !0 
							//return (b.code & a) > 0 ? !0 : !1
						},
						accessDef: i.accessDef,
						isEditor: function() {
							if (!x.currentUser) return !1;
							var a = x.currentUser.roleIdList;
							if (!a) return !1;
							for (var b = 0; b < a.length; b++)
								if ("4" == a[b]) return !0;
							return !1
						},
						isAdvancedUser: function() {
							return x.currentUser && "3" == x.currentUser.type ? !0 : !1
						},
						isVendorUser: function() {
							return x.currentUser && "4" == x.currentUser.type ? !0 : !1
						},
						requestResetPassword: function(a) {
							n(a)
						},
						validateToken: function(a) {
							var b = "changepw?token=" + a;
							return c.get(PREFIX_URL + b, {
								withCredentials: !0
							})
						},
						resetPassword: function(a, b) {
						   var d = JSON_URL + "?c=user&a=changepwd",
								e = {
									oldPwd: a,
									newPwd: b
								};
							return c.post(d, $.param(e), {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							})
						},
						retrievePassword: function(a, b, d, e) {
							var f = JSON_URL + "?c=User&a=retrieve",
								g = {
									email: a,
									geetest_challenge: b,
									geetest_validate: d,
									geetest_seccode: e
								};
							return c.post(f, $.param(g), {
								withCredentials: !0,
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
								}
							})
						}
					};
				return x
			}
		]), b.module("services.breadcrumbs", []), b.module("services.breadcrumbs").factory("breadcrumbs", ["$rootScope", "$location",
			function(a, b) {
				var c = [],
					d = {};
				return a.$on("$routeChangeSuccess", function(a, d) {
					var e, f = b.path().split("/"),
						g = [],
						h = function(a) {
							return "/" + f.slice(0, a + 1).join("/")
						};
					for (f.shift(), e = 0; e < f.length; e++) g.push({
						name: f[e],
						path: h(e)
					});
					c = g
				}), d.getAll = function() {
					return c
				}, d.getFirst = function() {
					return c[0] || {}
				}, d
			}
		]), b.module("services.config", []).factory("configService", ["$http",
			function(a) {

			}
		]), b.module("services.crud", ["services.crudRouteProvider"]), b.module("services.crud").factory("crudEditMethods", function() {
			return function(a, c, d, e, f) {
				var g = {};
				return g[a] = c, g[a + "Copy"] = b.copy(c), g.save = function() {
					this[a].$saveOrUpdate(e, e, f, f)
				}, g.canSave = function() {
					return this[d].$valid && !b.equals(this[a], this[a + "Copy"])
				}, g.revertChanges = function() {
					this[a] = b.copy(this[a + "Copy"])
				}, g.canRevert = function() {
					return !b.equals(this[a], this[a + "Copy"])
				}, g.remove = function() {
					this[a].$id() ? this[a].$remove(e, f) : e()
				}, g.canRemove = function() {
					return c.$id()
				}, g.getCssClasses = function(a) {
					var b = this[d][a];
					return {
						error: b.$invalid && b.$dirty,
						success: b.$valid && b.$dirty
					}
				}, g.showError = function(a, b) {
					return this[d][a].$error[b]
				}, g
			}
		}), b.module("services.crud").factory("crudListMethods", ["$location",
			function(a) {
				return function(b) {
					var c = {};
					return c["new"] = function() {
						a.path(b + "/new")
					}, c.edit = function(c) {
						a.path(b + "/" + c)
					}, c
				}
			}
		]),
		function() {
			function a(a) {
				this.$get = b.noop, this.routesFor = function(d, e, f) {
					var g = d.toLowerCase(),
						h = "/" + d.toLowerCase();
					f = f || e, b.isString(e) && "" !== e && (g = e + "/" + g), null !== f && f !== c && "" !== f && (h = "/" + f + h);
					var i = function(a) {
							return g + "/" + d.toLowerCase() + "-" + a.toLowerCase() + ".tpl.html"
						},
						j = function(a) {
							return d + a + "Ctrl"
						},
						k = {
							whenList: function(a) {
								return k.when(h, {
									templateUrl: i("List"),
									controller: j("List"),
									resolve: a
								}), k
							},
							whenNew: function(a) {
								return k.when(h + "/new", {
									templateUrl: i("Edit"),
									controller: j("Edit"),
									resolve: a
								}), k
							},
							whenEdit: function(a) {
								return k.when(h + "/:itemId", {
									templateUrl: i("Edit"),
									controller: j("Edit"),
									resolve: a
								}), k
							},
							when: function(b, c) {
								return a.when(b, c), k
							},
							otherwise: function(b) {
								return a.otherwise(b), k
							},
							$routeProvider: a
						};
					return k
				}
			}
			a.$inject = ["$routeProvider"], b.module("services.crudRouteProvider", ["ngRoute"]).provider("crudRoute", a)
		}(), b.module("services.data", []), b.module("services.data").factory("dataService", ["$http",
			function(a) {
				var b = {};
				return b.getDataBySceneId = function(b, c, d, e) {
					c = c || 1, d = d || 10;
					var f = "?c=scenedata&a=getdata&id=" + b + "&pageNo=" + c + "&pageSize=" + d;
					e && (f += (/\?/.test(f) ? "&" : "?") + "user=" + e);
					var g = new Date;
					return f += "&time=" + g.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + f
					})
				}, b.getDataDetail = function(b, c) {
					var d = "?c=custom&a=detail&id=" + b;
					c && (d += (/\?/.test(d) ? "&" : "?") + "user=" + c);
					var e = new Date;
					return d += (/\?/.test(d) ? "&" : "?") + "date=" + e.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + d
					})
				}, b.getAllData = function(b, c, d, e) {
					var f = "?c=custom&a=getAllData&pageSize=10&pageNo=" + b;
					c && (f += (/\?/.test(f) ? "&" : "?") + "user=" + c), e && (f += (/\?/.test(f) ? "&" : "?") + "origin=" + e), d && (f += (/\?/.test(f) ? "&" : "?") + "groupId=" + d);
					var g = new Date;
					return f += (/\?/.test(f) ? "&" : "?") + "time=" + g.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + f
					})
				}, b.getProspectDataAccount = function(b) {
					var c = "?c=custom&a=prospectCount&time=" + (new Date).getTime();
					return b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.getAllPageView = function(b) {
					var c = "?c=scene&a=pvcount&time=" + (new Date).getTime();
					return b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b), a({
						withCredentials: !0,
						method: "GET",
						url:JSON_URL + c
					})
				}, b.deleteDataById = function(b) {
					var c = "?c=custom&a=delete&id=" + b;
					return a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.getAllDataCount = function(b) {
					var c = "?c=custom&a=count";
					b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
					var d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.getOpenCount = function(b) {
					var c = "?c=scene&a=opencount";
					b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
					var d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.getAllSceneDataCount = function(b) {
					var c = "?c=scenedata&a=getcount";
					b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
					var d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.saveData = function(b) {
					{
						var c = "m/c/save";
						new Date
					}
					return a({
						withCredentials: !0,
						method: "POST",
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						url: PREFIX_URL + c,
						data: b
					})
				}, b.getSceneField = function(b) {
					var c = "?c=custom&a=formField&id=" + b,
						d = new Date;
					return c += "&time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.getPremergeScenes = function(b) {
					var c = "?c=custom&a=newDataScene";
					b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
					var d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "&time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, b.mergeSceneData = function(b, c) {
					var d = "?c=custom&a=imps&id=" + b;
					return a({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + d,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(c)
					})
				}, b.getOrigin = function() {
					var b = "c-group-list.html";
					return b += "?date=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + b
					})
				}, b.getGroups = function() {
				 var b = "c-group-list.html";
					return b += "?date=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + b
					})
				}, b.assignGroup = function(b) {
					var c = "m/c/group/set?cIds=" + b.cIds + "&gIds=" + b.gIds;
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + c,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b.deleteAssociation = function(b) {
					var c = "m/c/group/unset?cId=" + b.cId + "&gId=" + b.gId;
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + c,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b.createGroup = function(b) {
					var c = "m/c/group/create";
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.deleteCustomer = function(b) {
					var c = "m/c/delete?ids=" + b.ids;
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + c,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b.deleteGroup = function(b) {
					var c = "m/c/group/delete?id=" + b;
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + c,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b
			}
		]), b.module("services.exceptionHandler", ["services.i18nNotifications"]), b.module("services.exceptionHandler").factory("exceptionHandlerFactory", ["$injector",
			function(a) {
				return function(b) {
					return function(c, d) {
						var e = a.get("i18nNotifications");
						b(c, d), e.pushForCurrentRoute("error.fatal", "error", {}, {
							exception: c,
							cause: d
						})
					}
				}
			}
		]), b.module("services.exceptionHandler").config(["$provide",
			function(a) {
				a.decorator("$exceptionHandler", ["$delegate", "exceptionHandlerFactory",
					function(a, b) {
						return b(a)
					}
				])
			}
		]), b.module("services.file", []), b.module("services.file").factory("fileService", ["$http",
			function(a) {
				var b = {};
				return b.listFileCategory = function(b) {
		    		var c = "class-" + ("1" == b ? "tpType" : "bgType") + ".htm",
						d = new Date;
					return c += "?time=" + d.getTime(), a({withCredentials: !0, method: "GET", url: PREFIX_URL + c})
				}, b.deleteFile = function(b) {
					var c = "?c=upfile&a=delete",
						d = {
							id: b
						};
					return a({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(d)
					})
				}, b.createCategory = function(b) {
					var c = "?controller=Show&method=createTag",
						d = {
							tagName: b
						};
					return a({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(d)
					})
				}, b.getCustomTags = function() {
					var b = "?controller=Show&method=my&?time" + (new Date).getTime();
					return a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + b
					})
				}, b.deleteTag = function(b) {
					var c = "?controller=Show&method=deleteTag",
						d = {
							id: b
						};
					return a({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(d)
					})
				}, b.setCategory = function(b, c) {
					var d = "?controller=Show&method=setUpfileTagId",
						e = {
							tagId: b,
							fileIds: c
						};
					return a({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + d,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(e)
					})
				}, b.getImagesByTag = function(b, c, d, e) {
					var f = "?controller=Show&method=userList&";
					return f += "fileType=" + c, b && (f += "&tagId=" + b), f += "&pageNo=" + (d ? d : 1), f += "&pageSize=" + (e ? e : 12), f += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + f
					})
				}, b.getImagesBySysTag = function(b, c, d, e, f) {
					var g = "?controller=Show&method=sysList&";
					return g += "tagId=" + b, g += "&fileType=" + c, g += "&bizType=" + f, g += "&pageNo=" + (d ? d : 1), g += "&pageSize=" + (e ? e : 12), g += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + g
					})
				}, b.unsetTag = function(b, c) {
					var d = "m/base/file/tag/unset",
						e = {
							tagId: b,
							fileIds: c
						};
					return a({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + d,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(e)
					})
				}, b.getChildCategory = function(b) {
					var c = "?controller=Show&method=upfileSysTag&type=11";
					return b && (c += "&bizType=" + b), c += (/\?/.test(c) ? "&" : "?") + "time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + c
					})
				}, b.getFileByCategory = function(b, c, d, e) {
					var f = "?controller=Show&method=sysList&";
					"0" === d && "2" === e && (f = "?controller=Show&method=userList&"), f += "pageNo=" + (b ? b : 1), f += "&pageSize=" + (c ? c : 12), d && "all" != d && (f += "&bizType=" + (d ? d : -1)), f += "&fileType=" + (e ? e : -1);
					var g = new Date;
					return f += "&time=" + g.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + f
					})
				}, b.cropImage = function(b) {
					var c = "?c=page&a=crop&";
					return a({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b
			}
		]), b.module("services.history", []).factory("historyService", ["$rootScope",
			function(a) {
				var b = {},
					c = {},
					d = {};
				return b.addPage = function(d, e) {
					return c[d] || (c[d] = {
						currentPos: 0,
						inHistory: !1,
						pageHistory: []
					}, b.addPageHistory(d, e)), a.$broadcast("history.changed"), JSON.parse(c[d].pageHistory[c[d].currentPos])
				}, b.addPageHistory = function(b, e) {
					d = c[b], d.inHistory && (d.inHistory = !1, d.pageHistory.length = d.currentPos + 1);
					var f = JSON.stringify(e);
					f != d.pageHistory[d.pageHistory.length - 1] && d.pageHistory.push(f), d.currentPos = d.pageHistory.length - 1, a.$broadcast("history.changed")
				}, b.clearHistory = function() {
					c = {}
				}, b.canBack = function(a) {
					return d = c[a], d.currentPos > 0
				}, b.canForward = function(a) {
					return d = c[a], d.currentPos < d.pageHistory.length - 1
				}, b.back = function(b) {
					if (d = c[b], d.pageHistory.length) {
						d.inHistory = !0;
						var e = 0 === d.currentPos ? d.pageHistory[0] : d.pageHistory[--d.currentPos];
						return a.$broadcast("history.changed"), JSON.parse(e)
					}
				}, b.forward = function(b) {
					if (d = c[b], d.pageHistory.length) {
						d.inHistory = !0;
						var e = d.currentPos == d.pageHistory.length - 1 ? d.pageHistory[d.currentPos] : d.pageHistory[++d.currentPos];
						return a.$broadcast("history.changed"), JSON.parse(e)
					}
				}, b
			}
		]), b.module("services.httpRequestTracker", []), b.module("services.httpRequestTracker").factory("httpRequestTracker", ["$http",
			function(a) {
				var b = {};
				return b.hasPendingRequests = function() {
					return a.pendingRequests.length > 0
				}, b
			}
		]), b.module("services.i18nNotifications", ["services.notifications", "services.localizedMessages"]), b.module("services.i18nNotifications").factory("i18nNotifications", ["localizedMessages", "notifications",
			function(a, c) {
				var d = function(c, d, e, f) {
						return b.extend({
							message: a.get(c, e),
							type: a.get(d, e)
						}, f)
					},
					e = {
						pushSticky: function(a, b, e, f) {
							return c.pushSticky(d(a, b, e, f))
						},
						pushForCurrentRoute: function(a, b, e, f) {
							return c.pushForCurrentRoute(d(a, b, e, f))
						},
						pushForNextRoute: function(a, b, e, f) {
							return c.pushForNextRoute(d(a, b, e, f))
						},
						getCurrent: function() {
							return c.getCurrent()
						},
						remove: function(a) {
							return c.remove(a)
						}
					};
				return e
			}
		]), b.module("services.localizedMessages", []).factory("localizedMessages", ["$interpolate", "I18N.MESSAGES",
			function(a, b) {
				var c = function(a, b) {
					return a || "?" + b + "?"
				};
				return {
					get: function(d, e) {
						var f = b[d];
						return f ? a(f)(e) : c(f, d)
					}
				}
			}
		]), b.module("services.mine", []), b.module("services.mine").factory("MineService", ["$http",
			function(a, b) {
				var c = {};
				return c.getMyScenes = function(b, c, d, e) {
					var f = "?c=scene&a=my&type";
					b && (f += "=" + b), f += "&pageNo=" + (c ? c : 1), f += "&pageSize=" + (d ? d : 12), e && (f += "&user=" + e);
					var g = new Date;
					return f += (/\?/.test(f) ? "&" : "?") + "time=" + g.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + f
					})
				}, c
			}
		]), b.module("services.modal", ["confirm-dialog", "message-dialog", "bindemail-dialog"]).factory("ModalService", ["$modal",
			function(a) {
				var b = {};
				return b.openBindEmailDialog = function() {
					a.open({
						keyboard: !1,
						backdropClick: !0,
						windowClass: "confirm-dialog",
						templateUrl: "dialog/bindemail.tpl.html",
						controller: "BindEmailDialogCtrl"
					})
				}, b.openConfirmDialog = function(b, c, d) {
					a.open({
						backdrop: "static",
						keyboard: !1,
						backdropClick: !1,
						windowClass: "confirm-dialog",
						templateUrl: "dialog/confirm.tpl.html",
						controller: "ConfirmDialogCtrl",
						resolve: {
							confirmObj: function() {
								return b
							}
						}
					}).result.then(c, d)
				}, b.openMsgDialog = function(b, c, d) {
					a.open({
						backdrop: "static",
						keyboard: !1,
						backdropClick: !1,
						windowClass: "message-dialog",
						templateUrl: "dialog/message.tpl.html",
						controller: "MessageDialogCtrl",
						resolve: {
							msgObj: function() {
								return b
							}
						}
					}).result.then(c, d)
				}, b
			}
		]), b.module("I18N.MESSAGES", []).constant("I18N.MESSAGES", {
			"notify.success": "success",
			"notify.info": "info",
			"notify.danger": "danger",
			"notify.warning": "warning",
			"notify.tip": "tip",
			"errors.route.changeError": "Route change error",
			"crud.user.save.success": "A user with id '{{id}}' was saved successfully.",
			"crud.user.remove.success": "A user with id '{{id}}' was removed successfully.",
			"crud.user.remove.error": "Something went wrong when removing user with id '{{id}}'.",
			"crud.user.save.error": "Something went wrong when saving a user...",
			"crud.project.save.success": "A project with id '{{id}}' was saved successfully.",
			"crud.project.remove.success": "A project with id '{{id}}' was removed successfully.",
			"crud.project.save.error": "Something went wrong when saving a project...",
			"login.reason.notAuthorized": "离开久了，麻烦再登录一次吧！",
			"login.reason.notAuthenticated": "离开久了，麻烦再登录一次吧！",
			"login.error.invalidCredentials": "登录失败，请检查邮箱和密码是否正确。",
			"login.error.serverError": "There was a problem with authenticating: {{exception}}.",
			"register.error.serverError": "There was a problem with authenticating: {{exception}}.",
			"login.reset.notmatch": "新密码和重复密码不匹配",
			"register.error.match": "两次输入密码不一致",
			"register.error.agreement": "请先同意注册协议再完成注册",
			"file.bg.pageSize": "18",
			"scene.save.success.published": "场景已保存成功！",
			"scene.save.success.nopublish": "保存成功，还需要发布哦！",
			"scene.save.success.companyTpl": "成功生成企业样例",
			"scene.clear.success.companyTpl": "成功取消企业样例",
			"companytpl.setting.success": "成功生成企业模板",
			"scene.publish.success": "发布成功！",
			"account.success": "提交成功！",
			"branch.open.success": "账号打开成功！",
			"branch.close.success": "账号关闭成功！",
			"dept.create.success": "部门创建成功！",
			"scene.setting.success": "场景设置成功！",
			"data.assign.success": "分组成功！",
			"data.delete.success": "数据删除成功！",
			"group.delete.success": "分组删除成功！",
			"group.create.success": "分组创建成功！",
			"rel.tip": "您的账号还没有绑定邮箱，去用户中心->账号管理，马上绑定",
			"page.change.success": "页面名称修改成功！",
			"email.save.success": "邮箱绑定成功！",
			"reset.psw.success": "密码修改成功",
			"save.success": "保存成功！"
		}), b.module("services.notifications", []).factory("notifications", ["$rootScope",
			function(a) {
				var c = {
						STICKY: [],
						ROUTE_CURRENT: [],
						ROUTE_NEXT: []
					},
					d = {},
					e = function(a, c) {
						if (!b.isObject(c)) throw new Error("Only object can be added to the notification service");
						return a.push(c), c
					};
				return a.$on("$routeChangeSuccess", function() {
					c.ROUTE_CURRENT.length = 0, c.ROUTE_CURRENT = b.copy(c.ROUTE_NEXT), c.ROUTE_NEXT.length = 0
				}), d.getCurrent = function() {
					return [].concat(c.STICKY, c.ROUTE_CURRENT)
				}, d.pushSticky = function(a) {
					return e(c.STICKY, a)
				}, d.pushForCurrentRoute = function(a) {
					return e(c.ROUTE_CURRENT, a)
				}, d.pushForNextRoute = function(a) {
					return e(c.ROUTE_NEXT, a)
				}, d.remove = function(a) {
					b.forEach(c, function(b) {
						var c = b.indexOf(a);
						c > -1 && b.splice(c, 1)
					})
				}, d.removeAll = function() {
					b.forEach(c, function(a) {
						a.length = 0
					})
				}, d
			}
		]), b.module("services.pagetpl", []), b.module("services.pagetpl").factory("pageTplService", ["$http", "$rootScope", "$modal", "$q",
			function(a, b, c, d) {
				var e = {};
				return e.getPageTpls = function(b) {
					var c = "?controller=Show&method=getPageTpl&type=" + b,
						d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + c
					})
				}, e.getMyTplList = function(b) {
					var c = "/m/scene/pageList/" + b,
						d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + c
					})
				}, e.getPageTplTypes = function() {
					var b = "pageTplType.htm",
						c = new Date;
					return b += (/\?/.test(b) ? "&" : "?") + "time=" + c.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + b
					})
				}, e.getPageTagLabel = function(b) {
					var c = "?controller=Show&method=upfileSysTag&type=88";
					null != b && (c += (/\?/.test(c) ? "&" : "?") + "bizType=" + b);
					var d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + c
					})
				}, e.getPageTagLabelCheck = function(b) {
					var c = "?c=sysadmin&a=tagpagelist&id=" + b,
						d = new Date;
					return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + c
					})
				}, e.getPageTplTypestemp = function(b, c) {
					var d = "?controller=Show&method=sysPageTpl",
						e = new Date;
					return null != b && (d += (/\?/.test(d) ? "&" : "?") + "tagId=" + b), null != c && (d += (/\?/.test(d) ? "&" : "?") + "bizType=" + c), d += (/\?/.test(d) ? "&" : "?") + "time=" + e.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + d
					})
				}, e.updataChildLabel = function(b, c) {
					//var d = "/m/eqs/tag/page/set/?ids=" + b;
					var d = "?c=sysadmin&a=tagpageset&ids=" + b;
					null != c && (d += (/\?/.test(d) ? "&" : "?") + "pageId=" + c);
					var e = new Date;
					return d += (/\?/.test(d) ? "&" : "?") + "time=" + e.getTime(), a({
						withCredentials: !0,
						method: "POST",
				url: JSON_URL + d
					})
				}, e
			}
		]), b.module("services.sample", []).factory("sampleService", ["$rootScope", "$http",
			function(a, b) {
				var c = {};
				return c.getSamples = function(a, c, d) {
					var e =  JSON_URL + "?c=scene&a=promotion";
					return a && (e += "&type=" + a), c && (e += /\?/.test(e) ? "&" : "?", e += "pageNo=" + c), d && (e += /\?/.test(e) ? "&" : "?", e += "pageSize=" + d), b({
						withCredentials: !0,
						method: "GET",
						url: e
					})
				}, c.getSamplesPV = function() {
					var a = PREFIX_S1_URL + "eqs/topThree?time=" + (new Date).getTime();
					return b({
						withCredentials: !0,
						method: "GET",
						url: a
					})
				}, c
			}
		]), b.module("services.scene", ["scene.create.console", "services.history", "services.select", "scene.create.console.pictures", "scene.edit.trigger"]), b.module("services.scene").factory("sceneService", ["$http", "$rootScope", "$modal", "$q", "security", "$cacheFactory", "historyService", "selectService", "picturesService", "ModalService", "triggerService",
			function(c, d, e, f, g, h, i, j, k, l, m) {
				function n(a) {
					Q.splice(Q.indexOf(R[a]), 1), delete R[a]
				}

				function o(a) {
					P.obj.elements = a, $("#nr").empty(), O.parse({
						def: P.obj,
						appendTo: "#nr",
						mode: "edit"
					}), $("#editBG").hide();
					for (var b in a)
						if (3 == a[b].type) {
							$("#editBG").show();
							break
						}
					d.$broadcast("dom.changed")
				}

				function p(a) {
					R = {}, $.each(a, function(a, b) {
						R[b.id] = b
					})
				}

				function q(a, b) {
					var c = {},
						d = $("#nr .edit_area"),
						e = d.children().last(),
						f = d.children(".maxIndex"),
						g = 0;
					if (g = f.length > 0 ? parseInt(f.css("z-index"), 10) + 1 : e.length > 0 ? parseInt(e.css("z-index"), 10) + 1 : 101, b) return b.zIndex = g, parseInt(b.top, 10) > $("#nr .edit_area").outerHeight() - 20 && (b.top = $("#nr .edit_area").outerHeight() - 20 + "px"), b;
					var h = $("#nr .edit_area").outerWidth(),
						i = h;
					return "v" == a && (i = 50), "4" == a && (i = 80), c = {
						top: "100px",
						left: (h - i) / 2 + "px"
					}, c.zIndex = g, c
				}

				function r(a, b, c, d) {
					var e = parseInt(a.css.top, 10) + 10 * S,
						f = parseInt(a.css.left, 10);
					e + 34 > $("#nr .edit_area").outerHeight() ? (b.css.top = e + "px", b.css.left = f + 10 + "px") : (b.css.top = e + 34 + "px", b.css.left = a.css.left, c == d && S++)
				}

				function s() {
					for (var a = Math.ceil(1e3 * Math.random()), b = 0; b < Q.length; b++)
						if (Q[b].id == a) return s();
					return a
				}

				function t(a, b, c) {
					var d, e = s(),
						f = {};
					if (3 == ("" + a).charAt(0)) {
						if ($("#editBG:visible").length > 0) {
							var g;
							for (g = 0; g < Q.length; g++)
								if (3 == Q[g].type) {
									f = Q[g];
									break
								}
							return f
						}
						f = {
							content: null,
							css: {},
							id: e,
							num: 0,
							pageId: P.obj.id,
							properties: {
								bgColor: null,
								imgSrc: null
							},
							sceneId: P.obj.sceneId,
							title: null,
							type: 3
						}
					}
					return 1 == ("" + a).charAt(0) && (f = {
						id: e,
						properties: {
							title: "提交"
						},
						type: 1,
						pageId: P.obj.id,
						sceneId: P.obj.sceneId
					}), 8 == ("" + a).charAt(0) && (d = q(a, b), $.extend(!0, d, {
						color: "#676767",
						borderWidth: "1",
						borderStyle: "solid",
						borderColor: "#ccc",
						borderRadius: "5",
						backgroundColor: "#f9f9f9"
					}), f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							title: "一键拨号",
							number: ""
						},
						sceneId: P.obj.sceneId,
						title: null,
						type: 8
					}), 2 == ("" + a).charAt(0) && (d = q(a, b), f = {
						content: "点击此处进行编辑",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {},
						sceneId: P.obj.sceneId,
						title: null,
						type: 2
					}), 4 == ("" + a).charAt(0) && (d = q(a, b), d.width = "100px", d.height = "100px", f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							width: "100px",
							height: "100px",
							src: ""
						},
						sceneId: P.obj.sceneId,
						title: null,
						type: 4
					}), 5 == ("" + a).charAt(0) && (d = q(a, b), $.extend(!0, d, {
						color: "#676767",
						borderWidth: "1",
						borderStyle: "solid",
						borderColor: "#ccc",
						borderRadius: "5",
						backgroundColor: "#f9f9f9"
					}), f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							placeholder: "请命名"
						},
						isInput: 1,
						sceneId: P.obj.sceneId,
						title: "请命名",
						type: 5
					}), 6 == ("" + a).charAt(0) && (d = q(a, b), $.extend(!0, d, {
						color: "#676767",
						borderWidth: "1",
						borderStyle: "solid",
						borderColor: "#ccc",
						borderRadius: "5",
						backgroundColor: "#f9f9f9"
					}), f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							title: "提交"
						},
						sceneId: P.obj.sceneId,
						title: null,
						type: 6
					}), "p" == a && (d = q(a, b), f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							title: "图集"
						},
						sceneId: P.obj.sceneId,
						title: null,
						type: "p"
					}), "v" == a && (d = q(a, b), d.width = "48px", d.height = "48px", f = {
						content: "",
						css: d,
						id: e,
						num: 1,
						pageId: P.obj.id,
						properties: {
							src: ""
						},
						sceneId: P.obj.sceneId,
						title: null,
						type: "v"
					}), c && $.extend(!0, f, c), Q.push(f), R[f.id] = f, f
				}

				function u(a, b, c) {
					var e = O.wrapComp(b, "edit");
					$("#nr .edit_area").append(e);
					for (var f = O.getInterceptors(), g = 0; g < f.length; g++) f[g](e, b);
					return O.getEventHandlers()[("" + a).charAt(0)](e, b), c || (i.addPageHistory(P.obj.id, P.obj.elements), d.$broadcast("dom.changed"), e.trigger("mousedown")), e
				}

				function v(a, b) {
					var c = [];
					return "g101" == a && (c.push(V("501")), c.push(V("502")), c.push(V("503")), c.push(V("601"))), c
				}

				function w(a, b) {
					N.currentElemDef = b, $(a).css("cursor", "text"), $(a).parents("li").hasClass("inside-active") || ($(a).bind("click", function(a) {
						a.stopPropagation()
					}), $(document).bind("mousedown", function(c) {
						$(a).css("cursor", "default"), $("#btn-toolbar").find("input[type=text][data-edit]").blur(), $("#btn-toolbar") && $("#btn-toolbar").remove(), $(a).unbind("click"), b.content = $(a).html(), $(a).parents("li").removeClass("inside-active").css("user-select", "none"), $(a).removeAttr("contenteditable"), $(document).unbind("mousedown")
					}), $(a).parents("li").addClass("inside-active").css("user-select", "initial"), d.$broadcast("text.click", a))
				}

				function x(a) {
					F(a, function(b) {
						a.properties.src = b.data;
						var c = b.width / b.height,
							d = $("#" + a.id);
						if (d.length > 0) {
							var e = $("#inside_" + a.id).width(),
								f = $("#inside_" + a.id).height(),
								g = e / f;
							c >= g ? (d.outerHeight(f), d.outerWidth(f * c), d.css("marginLeft", -(d.outerWidth() - e) / 2), d.css("marginTop", 0)) : (d.outerWidth(e), d.outerHeight(e / c), d.css("marginTop", -(d.outerHeight() - f) / 2), d.css("marginLeft", 0)), d.attr("src", PREFIX_FILE_HOST + b.data), a.properties.imgStyle = {}, a.properties.imgStyle.width = d.outerWidth(), a.properties.imgStyle.height = d.outerHeight(), a.properties.imgStyle.marginTop = d.css("marginTop"), a.properties.imgStyle.marginLeft = d.css("marginLeft")
						} else b.width > $("#nr .edit_area").width() && (b.width = $("#nr .edit_area").width(), b.height = b.width / c), b.height > $("#nr .edit_area").height() && (b.height = $("#nr .edit_area").height(), b.width = b.height * c), a.css.width = b.width, a.css.height = b.height, a.properties.imgStyle = {}, a.properties.imgStyle.width = b.width, a.properties.imgStyle.height = b.height, a.properties.imgStyle.marginTop = "0", a.properties.imgStyle.marginLeft = "0", u(a.type, a)
					}, function() {
						a.properties.src || n(a.id)
					})
				}

				function y(a) {
					e.open({
						windowClass: "console six-contain",
						templateUrl: "scene/console/button.tpl.html",
						controller: "ButtonConsoleCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						a.properties.title = b.title;
						var c = b.title.replace(/ /g, "&nbsp;");
						$("#" + a.id).html(c)
					})
				}

				function z(a) {
					W || (W = e.open({
						windowClass: "console six-contain",
						templateUrl: "scene/console/tel.tpl.html",
						controller: "TelConsoleCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						W = null, a.properties.title = b.title, a.properties.number = b.number;
						b.title.replace(/ /g, "&nbsp;");
						$.extend(!0, a.css, b.btnStyle), $("#" + a.id).length > 0 && $("#" + a.id).parents("li").remove(), u(a.type, a)
					}, function() {
						W = null, $("#" + a.id).length || n(a.id)
					}))
				}

				function A(a) {
					W || (W = e.open({
						windowClass: "console",
						templateUrl: "scene/console/input.tpl.html",
						controller: "InputConsoleCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						W = null, b.type && (a.type = b.type), a.properties.placeholder = b.title, a.properties.required = b.required, a.title = b.title, $("#" + a.id).length > 0 ? ($("#" + a.id).attr("placeholder", b.title), $("#" + a.id).attr("required", b.required)) : u(a.type, a)
					}, function() {
						W = null, $("#" + a.id).length || n(a.id)
					}))
				}

				function B(a) {
					W || (W = e.open({
						windowClass: "console",
						backdrop: "static",
						templateUrl: "scene/console/pictures.tpl.html",
						controller: "picturesCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						W = null, a.properties = b;
						var c = $("#inside_" + a.id);
						c.length && c.remove(), u(a.type, a)
					}, function() {
						W = null, $("#" + a.id).length || n(a.id)
					}))
				}

				function C(a) {
					W || (W = e.open({
						windowClass: "console",
						templateUrl: "scene/console/video.tpl.html",
						controller: "VideoCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						W = null, a.properties.src = b, $("#" + a.id).length || u(a.type, a)
					}, function() {
						W = null, $("#" + a.id).length || n(a.id)
					}))
				}

				function D(a) {
					F(a, function(b) {
						var c = $("#nr .edit_area").parent()[0];
						if ("imgSrc" == b.type) {
							var d = b.data;
							c.style.backgroundImage = "url(" + PREFIX_FILE_HOST + d + ")", a.properties.bgColor = null, a.properties.imgSrc = d
						}
						"backgroundColor" == b.type && (c.style.backgroundImage = "none", c.style.backgroundColor = b.color, a.properties.imgSrc = null, a.properties.bgColor = b.color), i.addPageHistory(P.obj.id, P.obj.elements), $("#editBG").unbind("click"), $("#editBG").show().bind("click", function() {
							D(a)
						})
					}, function() {})
				}

				function E() {
					W || (W = e.open({
						windowClass: "console",
						templateUrl: "scene/console/audio.tpl.html",
						controller: "AudioConsoleCtrl",
						resolve: {
							obj: function() {
								return P.obj.scene.image && P.obj.scene.image.bgAudio ? P.obj.scene.image.bgAudio : {}
							}
						}
					}).result.then(function(a) {
						W = null, "bgAudio" == a.compType && (P.obj.scene.image || (P.obj.scene.image = {}), P.obj.scene.image.bgAudio = a.bgAudio)
					}, function() {
						W = null
					}))
				}

				function F(a, b, c) {
					if (!W) {
						var d = "0";
						3 == a.type && (d = "0"), 4 == a.type && (d = "1"), W = e.open({
							windowClass: "console img_console",
							templateUrl: "scene/console/bg.tpl.html",
							controller: "BgConsoleCtrl",
							resolve: {
								obj: function() {
									return {
										fileType: d,
										elemDef: a
									}
								}
							}
						}).result.then(function(a) {
							W = null, b(a)
						}, function(a) {
							W = null, c(a)
						})
					}
				}

				function G(a, b, c) {
					N.currentElemDef = a, d.$broadcast("showStylePanel", {
						activeTab: "style"
					})
				}

				function H(a, b, c) {
					N.currentElemDef = a, d.$broadcast("showStylePanel", {
						activeTab: "anim"
					})
				}

				function I(a, b, c) {
					N.currentElemDef = a, X = d.$broadcast("showCropPanel", a)
				}

				function J(a) {
					a.sceneId = P.obj.sceneId, e.open({
						windowClass: "console six-contain",
						templateUrl: "scene/console/link.tpl.html",
						controller: "LinkConsoleCtrl",
						resolve: {
							obj: function() {
								return a
							}
						}
					}).result.then(function(b) {
						b && "http://" != b ? (isNaN(b) ? a.properties.url = PREFIX_S1_URL + "main-jumpgo?url=" + encodeURIComponent(b) : (a.properties.url = b, console.log(b)), $("#inside_" + a.id).find(".fa-link").removeClass("fa-link").addClass("fa-anchor")) : (delete a.properties.url, $("#inside_" + a.id).find(".fa-anchor").removeClass("fa-anchor").addClass("fa-link"))
					})
				}
				var K, L, M, N = {},
					O = SS.templateParser("jsonParser"),
					P = null,
					Q = null,
					R = {},
					S = ($("#nr .edit_area"), 0),
					T = !1;
				N.historyBack = function() {
					i.canBack(P.obj.id) && (Q = i.back(P.obj.id), p(Q), o(Q))
				}, N.historyForward = function() {
					i.canForward(P.obj.id) && (Q = i.forward(P.obj.id), p(Q), o(Q))
				};
				var U = N.createCompGroup = function(a, b) {
						for (var c = v(a), e = 0; e < c.length; e++) {
							var f = t(c[e].type, b, c[e]);
							b = b ? {
								left: b.left,
								top: parseInt(b.top, 10) + 50 + "px"
							} : {
								left: "0px",
								top: "150px"
							}, u(c[e].type, f, !0)
						}
						i.addPageHistory(P.obj.id, P.obj.elements), d.$broadcast("dom.changed")
					},
					V = function(a, b) {
						var c;
						return "501" == a && (c = {
							properties: {
								placeholder: "姓名"
							},
							title: "姓名",
							type: 501
						}), "502" == a && (c = {
							properties: {
								placeholder: "手机"
							},
							title: "手机",
							type: 502
						}), "503" == a && (c = {
							properties: {
								placeholder: "邮箱"
							},
							title: "邮箱",
							type: 503
						}), "601" == a && (c = {
							properties: {
								title: "提交"
							},
							type: 601
						}), c
					};
				N.createComp = function(b, c) {
					var d;
					if ("g" == ("" + b).charAt(0)) return void U(b, c);
					if ("9" == ("" + b).charAt(0)) return void E();
					if (d = t(b, c), 4 == b) return void x(d);
					if (5 == b) return void A(d);
					if (8 == b) return void z(d);
					if ("p" == b) return void B(d);
					if ("v" == b) return void C(d);
					if (3 == b) return void D(d);
					if (2 == b) {
						var e = u(b, d);
						$(".element", e).trigger("dblclick").focus(), setTimeout(function() {
							if (a.getSelection) {
								var b = a.getSelection();
								b.modify("move", "left", "documentboundary"),b.modify("extend", "right", "documentboundary");
							}
						})
					} else u(b, d)
				}, N.updateCompPosition = function(a, b, c) {
					for (var e = 0; e < Q.length; e++) "inside_" + Q[e].id == a && (Q[e].css ? (Q[e].css.left = b.left, Q[e].css.top = b.top, c || i.addPageHistory(P.obj.id, Q)) : (Q[e].css = b, c || i.addPageHistory(P.obj.id, Q)));
					d.$apply()
				}, N.updateCompAngle = function(a, b) {
					for (var c = 0; c < Q.length; c++) "inside_" + Q[c].id == a && (Q[c].css ? Q[c].css.transform = "rotateZ(" + b + "deg)" : Q[c].css = {}, i.addPageHistory(P.obj.id, Q));
					d.$apply()
				}, N.setCopy = function(a) {
					T = a, d.$broadcast("copyState.update", a)
				}, N.getCopy = function() {
					return T
				}, N.getPageNames = function(a) {
					var b = "?controller=Show&method=scenePageList&id=" + a + "&date=" + (new Date).getTime();
					return c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + b
					})
				}, N.changePageSort = function(a, b) {
					var d = "?c=page&a=pageSort&id=" + b + "&pos=" + a + "&date=" + (new Date).getTime();
					return c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL  + d
					})
				}, N.updateCompSize = function(a, b) {
					for (var c = 0; c < Q.length; c++) "inside_" + Q[c].id == a && (Q[c].css || (Q[c].css = {}), Q[c].css.width = b.width, Q[c].css.height = b.height, Q[c].css.top = b.top, Q[c].css.left = b.left, Q[c].properties.width = b.width, Q[c].properties.height = b.height, b.imgStyle && (Q[c].properties.imgStyle = b.imgStyle), i.addPageHistory(P.obj.id, Q));
					d.$apply()
				}, N.savePageNames = function(a) {
					var b = "?c=page&a=savePageName",
						d = {
							id: a.id,
							sceneId: a.sceneId,
							name: a.name
						};
					return c({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + b,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(d)
					})
				}, N.resetCss = function() {
					$("#nr .edit_area li").each(function(a, b) {
						var c = R[b.id.replace(/inside_/g, "")];
						c && (c.css || (c.css = {}), c.css.zIndex = b.style.zIndex ? b.style.zIndex : "0")
					})
				}, N.copyElement = function() {
					S = 0, M = P.obj.id;
					var a = j.getElements(),
						c = [];
					$.each(a, function(a, b) {
						c.push(R[b])
					}), K = b.copy(c), L = b.copy(c), N.setCopy(!0)
				}, N.pasteElement = function() {
					for (var a = 0, c = [], e = 0; e < K.length; e++) {
						K[e].pageId = P.obj.id, K[e].id = s(), M == K[e].pageId ? (a++, r(L[e], K[e], a, K.length)) : (S = 0, K[e].css = b.copy(L[e].css));
						var f = b.copy(K[e]);
						Q.push(f), R[f.id] = f, c.push(u(f.type, f, !0))
					}
					M = P.obj.id, i.addPageHistory(P.obj.id, P.obj.elements), d.$broadcast("dom.changed"), $.each(c, function(a, b) {
						b.children(".bar").show(), j.addElement(b.attr("id").split("_")[1])
					})
				};
				var W = null,
					X = null;
				return O.addInterceptor(function(a, b, c) {
					function e() {
						var c = $('<ul id="popMenu" class="dropdown-menu" style="min-width: 100px; display: block;" role="menu" aria-labelledby="dropdownMenu1"><li class="edit" role="presentation"><a role="menuitem" tabindex="-1"><div class="glyphicon glyphicon-edit" style="color: #08a1ef;"></div>&nbsp;&nbsp;编辑</a></li><li class="style" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-paint-brush" style="color: #08a1ef;"></div>&nbsp;&nbsp;样式</a></li><li class="animation" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-video-camera" style="color: #08a1ef;"></div>&nbsp;&nbsp;动画</a></li><li class="trigger" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-lightbulb-o" style="color: #08a1ef; margin: 0 2px; font-size: 18px;"></div>&nbsp;&nbsp;触发</a></li><li class="link" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-link" style="color: #08a1ef;"></div>&nbsp;&nbsp;链接</a></li><li class="copy" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-copy" style="color: #08a1ef;"></div>&nbsp;&nbsp;复制</a></li><li role="presentation" class="bottom_bar"><a title="上移一层"><div class="up" style="display: inline-block; width: 26px;height: 22px; background: url(http://static.parastorage.com/services/skins/2.1127.3/images/wysiwyg/core/themes/editor_web/button/fpp-buttons-icons4.png) 0px -26px no-repeat;"></div></a><a title="下移一层"><div class="down" style="display: inline-block; width: 26px;height: 22px; background: url(http://static.parastorage.com/services/skins/2.1127.3/images/wysiwyg/core/themes/editor_web/button/fpp-buttons-icons4.png) 0px -80px no-repeat;"></div></a><a title="删除"><div class="remove" style="display: inline-block; width: 26px;height: 22px; background: url(http://static.parastorage.com/services/skins/2.1127.3/images/wysiwyg/core/themes/editor_web/button/fpp-buttons-icons4.png) 0px -1px no-repeat;"></div></a></li></ul>').css({
							position: "absolute",
							"user-select": "none"
						});
						T && c.find(".copy").after($('<li class="paste" role="presentation"><a role="menuitem" tabindex="-1"><div class="fa fa-paste" style="color: #08a1ef;"></div>&nbsp;&nbsp;粘贴</a></li>')), c.find(".edit").click(function(d) {
							switch (d.stopPropagation(), b.type.toString().charAt(0)) {
								case "1":
									break;
								case "2":
									w(a.find(".element").get(0), b);
									break;
								case "3":
									break;
								case "4":
									x(b);
									break;
								case "5":
									A(b);
									break;
								case "6":
									y(b);
									break;
								case "7":
									break;
								case "8":
									z(b);
									break;
								case "9":
									break;
								case "g":
									break;
								case "p":
									B(b);
									break;
								case "v":
									C(b)
							}
							c.hide()
						}), c.find(".style").click(function(d) {
							d.stopPropagation(), G(b, function(c) {
								if (1 == b.type)
									for (var d in b.properties.labels) c.backgroundColor && (b.properties.labels[d].color.backgroundColor = c.backgroundColor, $(".label_content").css("background-color", c.backgroundColor)), c.color && (b.properties.labels[d].color.color = c.color, $(".label_content").css("color", c.color));
								else $(".element-box", a).css(c), $.extend(!0, b.css, c)
							}), c.hide()
						}), c.find(".animation").click(function(a) {
							a.stopPropagation(), H(b, function(a) {
								b.properties.anim = a
							}), c.hide()
						}), c.find(".link").click(function(a) {
							a.stopPropagation(), J(b), c.hide()
						}), c.find(".remove").click(function(a) {
							a.stopPropagation();
							d.$broadcast("element.delete")
						});
						var e = utilTrigger.getSendType(),
							f = utilTrigger.getHandleType();
						return c.find(".trigger").click(function(d) {
							d.stopPropagation();
							var g = $('<div class="switch">');
							a.append(g).children(".bar").hide();
							var h = $("#nr"),
								i = h.find(".edit_area").children("li");
							$('<div class="mark-trigger"><div class="tip"></div></div>').insertAfter(".edit_area").click(function() {
								$(this).remove(), g.remove(), a.parent().find(".boom").remove(), m.clearTrigger(b.id), $.each(R, function(a, b) {
									var c = h.find("#inside_" + a),
										d = c.attr("ctype");
									2 == d && c.css("background-color", ""), (2 == d || 4 == d) && c.css("z-index", "");
									var e = m.getTrigger(a);
									e ? b.trigger = e : delete b.trigger
								})
							}), i.each(function() {
								var a = $(this),
									b = a.attr("ctype");
								(2 == b || 4 == b) && a.css({
									"background-color": "rgba(255,255,255,0.9)",
									"z-index": 10001
								})
							});
							var j = m.getSendIds(f.SHOW.value, b.id);
							$.each(j, function(a, b) {
								var c = h.find("#inside_" + b);
								c.css({
									"background-color": "",
									"z-index": ""
								})
							});
							var k = m.getReceiveIds(e.CLICK.value, f.SHOW.value, b.id);
							$.each(k, function(a, b) {
								$('<div class="boom">').appendTo(h.find("#inside_" + b))
							}), c.hide()
						}), c.find(".down").click(function(c) {
							var d = a.prev();
							if (!(d.length <= 0)) {
								var e = a.css("zIndex");
								a.css("zIndex", d.css("zIndex")), d.css("zIndex", e), d.before(a);
								for (var f = 0; f < Q.length; f++)
									if (Q[f].id == b.id && f > 0) {
										var g = Q[f].css.zIndex;
										Q[f].css.zIndex = Q[f - 1].css.zIndex, Q[f - 1].css.zIndex = g;
										break
									}
							}
						}), c.find(".up").click(function(c) {
							var d = a.next();
							if (!(d.length <= 0)) {
								var e = a.css("zIndex");
								a.css("zIndex", d.css("zIndex")), d.css("zIndex", e), d.after(a);
								for (var f = 0; f < Q.length; f++)
									if (Q[f].id == b.id && f < Q.length - 1) {
										var g = Q[f].css.zIndex;
										Q[f].css.zIndex = Q[f + 1].css.zIndex, Q[f + 1].css.zIndex = g;
										break
									}
							}
						}), c.find(".copy").click(function(a) {
							a.stopPropagation(), $(".modal-dialog")[0] || N.copyElement(), c.hide()
						}), c.find(".paste").click(function(a) {
							a.stopPropagation(), $(".modal-dialog")[0] || N.pasteElement(), c.hide()
						}), c.find(".cut").click(function(a) {
							a.stopPropagation(), I(b), c.hide()
						}), 2 != b.type && 4 != b.type && c.find(".trigger").hide(), g.isAllowToAccess(g.accessDef.SCENE_EDIT_TRIGGER) || c.find(".trigger").hide(), 4 != b.type && (c.find(".link").hide(), c.find(".cut").hide()), "p" == b.type && (c.find(".animation").hide(), c.find(".style").hide()), c
					}
					if ("view" != c) {
						b.trigger && m.setTrigger(b.id, b.trigger);
						var f = $("#eq_main");
						a.on("click contextmenu", ".element-box", function(a) {
							if (a.stopPropagation(), "none" != $(".select-panel").css("display")) return !1;
							if ($(".edit_area").find(".switch").length) return !1;
							$("#comp_setting:visible").length > 0 && "p" != b.type && (N.currentElemDef = b, d.$broadcast("showStylePanel"));
							var c = e(),
								g = $("#popMenu");
							return g.length > 0 && g.remove(), f.append(c), c.css({
								left: a.pageX + f.scrollLeft() + 15,
								top: a.pageY + f.scrollTop()
							}).show(), f.mousemove(function(a) {
								c = $("#popMenu"), (a.pageX < c.offset().left - 20 || a.pageX > c.offset().left + c.width() + 20 || a.pageY < c.offset().top - 20 || a.pageY > c.offset().top + c.height() + 20) && (c.hide(), $(this).unbind("mousemove"))
							}), !1
						}), a.attr("title", "按住鼠标进行拖动，点击鼠标进行编辑")
					}
				}), O.bindEditEvent("2", function(a, b) {
					var c = $(".element", a)[0];
					$(c).mousedown(function(a) {
						$(this).parents("li").hasClass("inside-active") && a.stopPropagation()
					}), $(c).bind("contextmenu", function(a) {
						$(this).parents("li").hasClass("inside-active") ? a.stopPropagation() : $(this).blur()
					}), $(c).bind("dblclick", function(a) {
						return $(".edit_area").find(".switch").length ? !1 : (w(c, b), $("#popMenu").hide(), void a.stopPropagation())
					}), $(c).bind("keydown", function(a) {
						a.stopPropagation()
					})
				}), O.bindEditEvent("3", function(a, b) {
					$("#editBG").unbind("click"), $("#editBG").show().bind("click", function(){
						D(b)
					})
				}), O.bindEditEvent("v", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						C(b), $("#popMenu").hide()
					})
				}), O.bindEditEvent("4", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						return $(".edit_area").find(".switch").length ? !1 : (x(b), void $("#popMenu").hide())
					})
				}), O.bindEditEvent("5", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						A(b), $("#popMenu").hide()
					})
				}), O.bindEditEvent("p", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						B(b), $("#popMenu").hide()
					}), k.setProperties(b.properties)
				}), O.bindEditEvent("6", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						y(b), $("#popMenu").hide()
					})
				}), O.bindEditEvent("8", function(a, b) {
					var c = $(".element", a)[0];
					$(c).unbind("dblclick"), $(c).bind("dblclick", function() {
						z(b), $("#popMenu").hide()
					})
				}), O.bindEditEvent("7", function(a, b) {
					var c = $(".element", a)[0];
					c.addEventListener("click", function(a) {
						W || e.open({
							windowClass: "",
							templateUrl: "scene/console/map.tpl.html",
							controller: "MapConsoleCtrl"
						}).result.then(function(a) {
							var c = new BMap.Map("map_" + b.id);
							c.clearOverlays();
							var d = new BMap.Point(a.lng, a.lat),
								e = new BMap.Marker(d);
							c.addOverlay(e);
							var f = new BMap.Label(a.address, {
								offset: new BMap.Size(20, -10)
							});
							e.setLabel(f), c.centerAndZoom(d, 12), b.properties.pointX = a.lng, b.properties.pointY = a.lat, b.properties.x = a.lng, b.properties.y = a.lat, b.properties.markTitle = a.address
						})
					})
				}), N.templateEditor = O, N.getTplById = function(a) {
					var b = "m/scene/select?id=" + a,
						d = new Date;
					return b += "&time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + b
					})
				}, N.createByTpl = function(a) {
					var b = JSON_URL + "?c=scene&a=createBySys";
					return c({
						withCredentials: !0,
						method: "POST",
						url: b,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(a)
					})
				}, N.getSceneDetail = function(a, b) {
					var d = "?controller=Show&method=detail&id=" + a;
					return b && (d += (/\?/.test(d) ? "&" : "?") + "user=" + b), c({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + d
					})
				}, N.saveSceneSettings = function(a) {
					var b = "?c=scene&a=saveSettings";
					return c({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + b,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						},
						data: JSON.stringify(a)
					})
				}, N.publishScene = function(a) {
					var b = "?controller=Show&method=publish&id=" + a,
						d = new Date;
					return b += "&time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + b
					})
				}, N.closeScene = function(a) {
					var b = "?c=scene&a=off&id=" + a,
						d = new Date;
					return b += "&time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + b
					})
				}, N.openScene = function(a) {
					var b = "?c=scene&a=on&id=" + a,
						d = new Date;
					return b += "&time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + b
					})
				}, N.createBlankScene = function(a, b, d) {
					var e = {
							name: a,
							type: b,
							pageMode: d
						},
						f = "?c=scene&a=create";
					return c({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + f,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(e)
					})
				}, N.copySceneById = function(a) {
					var b = "?c=scene&a=createByCopy&id=" + a;
					return c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + b
					})
				}, N.deleteSceneById = function(a) {
					var b = "?c=scene&a=delscene&id=" + a;
					return c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + b
					})
				}, N.getCoverImages = function() {
					var a = "?controller=Show&method=userList&bizType=99&fileType=1&time=" + (new Date).getTime();
					return c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + a
					})
				}, N.getSceneByPage = function(a, b, d) {
					var e = "";
					b || d ? (e = "?controller=Show&method=createPage&id=" + a, d && (e += "&copy=true")) : e = "?controller=Show&method=design&id=" + a;
					var g = f.defer(),
						h = new Date;
					return e += (/\?/.test(e) ? "&" : "?") + "time=" + h.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + e
					}).then(function(a) {
						g.resolve(a), P = a.data, P.obj.elements || (P.obj.elements = []), Q = P.obj.elements;
						for (var b = 0; Q && b < Q.length; b++) R[Q[b].id] = Q[b]
					}, function(a) {
						g.reject(a)
					}), g.promise
				}, N.previewSceneTpl = function(a) {
					var b = "?controller=Show&method=sysPageInfo&id=" + a,
						d = (f.defer(), new Date);
					return b += (/\?/.test(b) ? "&" : "?") + "time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + b
					})
				}, N.recordTplUsage = function(a) {
					var b = "?controller=Show&method=usePageCount&id=" + a;
					return c({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + b
					})
				}, N.getSceneTpl = function(a) {
					var b = h.get("tplCache") ? h.get("tplCache") : h("tplCache"),
						d = f.defer();
					if (b.get(a)) {
						var e = $.extend(!0, {}, b.get(a));
						e.data.obj.scene && e.data.obj.scene.image && e.data.obj.scene.image.bgAudio && (P.obj.scene.image || (P.obj.scene.image = {}), P.obj.scene.image.bgAudio = e.data.obj.scene.image.bgAudio);
						for (var g = 0; g < e.data.obj.elements.length; g++) {
							var i = e.data.obj.elements[g];
							i.id = s(), i.sceneId = P.obj.sceneId, i.pageId = P.obj.id
						}
						Q = e.data.obj.elements;
						for (var j = 0; j < Q.length; j++) R[Q[j].id] = Q[j];
						d.resolve(e)
					} else {
						var k = "?controller=Show&method=sysPageInfo&id=" + a,
							l = new Date;
						k += (/\?/.test(k) ? "&" : "?") + "time=" + l.getTime(), c({
							withCredentials: !0,
							method: "GET",
							url: CONTROLLER_URL + k
						}).then(function(a) {
							b.put(a.data.obj.id, $.extend(!0, {}, a)), a.data.obj.scene && a.data.obj.scene.image && a.data.obj.scene.image.bgAudio && (P.obj.scene.image || (P.obj.scene.image = {}), P.obj.scene.image.bgAudio = a.data.obj.scene.image.bgAudio);
							for (var c = 0; c < a.data.obj.elements.length; c++) {
								var e = a.data.obj.elements[c];
								e.id = s(), e.sceneId = P.obj.sceneId, e.pageId = P.obj.id
							}
							Q = a.data.obj.elements;
							for (var f = 0; f < Q.length; f++) R[Q[f].id] = Q[f];
							d.resolve(a)
						}, function(a) {
							d.reject(a)
						})
					}
					return d.promise
				}, N.saveScene = function(a) {
					var b = "?controller=Show&method=savePage";
					return c({
						withCredentials: !0,
						method: "POST",
						url: CONTROLLER_URL + b,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						},
						data: JSON.stringify(a)
					})
				}, N.deletePage = function(a) {
					var b = "?controller=Show&method=delPage&id=" + a;
					return c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + b
					})
				}, N.getBgImages = function(a) {
					var b = "m/scene/gallery/" + a,
						d = new Date;
					return b += (/\?/.test(b) ? "&" : "?") + "time=" + d.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + b
					})
				}, N.createCustomComp = V, N.openAudioModal = E, N.getElements = function() {
					return Q
				}, N.getElementsMap = function() {
					return R
				}, N.deleteElement = n, N.getSceneObj = function() {
					return P
				}, N.getTpls = function(a, b, d, e) {
					var f = "?c=scene&a=syslist";
					null != a && (f += (/\?/.test(f) ? "&" : "?") + "sceneType=" + a), f += (/\?/.test(f) ? "&" : "?") + "pageNo=" + (b ? b : 1), f += (/\?/.test(f) ? "&" : "?") + "pageSize=" + (d ? d : 12), e && (f += (/\?/.test(f) ? "&" : "?") + "orderBy=" + e);
					var g = new Date;
					return f += (/\?/.test(f) ? "&" : "?") + "time=" + g.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + f
					})
				}, N.getSceneType = function() {
					var a = "?controller=Show&method=typeList";
					return c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + a
					})
				}, N.getCompanyTpls = function(a, b) {
					var d = "/m/scene/tpl/company/list?pageNo=" + a + "&pageSize=" + b;
					return c({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + d
					})
				}, N.createCompanyTpls = function(a) {
					var b = "/m/scene/tpl/company/set?id=" + a;
					return c({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + b
					})
				}, N.clearCompanyTpls = function(a) {
					var b = "/m/scene/tpl/company/unset?id=" + a;
					return c({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + b
					})
				}, N.getPageTpls = function(a, b, d, e, f, g) {
					var h = "?c=scene&a=syslist";
					a && (h += (/\?/.test(h) ? "&" : "?") + "tplType=1"), b && (h += (/\?/.test(h) ? "&" : "?") + "bizType=" + b), d && (h += (/\?/.test(h) ? "&" : "?") + "tagId=" + d), g && (h += (/\?/.test(h) ? "&" : "?") + "orderBy=" + g);
					var i = new Date;
					return h += (/\?/.test(h) ? "&" : "?") + "pageNo=" + (e ? e : 1), h += (/\?/.test(h) ? "&" : "?") + "pageSize=" + (f ? f : 12), h += (/\?/.test(h) ? "&" : "?") + "time=" + i.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + h
					})
				}, N.getPageTplTypesTwo = function(a, b) {
					var d = "?controller=Show&method=upfileSysTag&type=2&bizType=" + b,
						e = new Date;
					return d += (/\?/.test(d) ? "&" : "?") + "time=" + e.getTime(), c({
						withCredentials: !0,
						method: "GET",
						url: CONTROLLER_URL + d
					})
				}, N.saveMyTpl = function(a) {
					var b = "?c=user&a=saveMyTpl";
					return c({
						withCredentials: !0,
						method: "POST",
						url: JSON_URL + b,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						},
						data: JSON.stringify(a)
					})
				}, N.saveCompanyTpl = function(a) {
					var b = "m/scene/page/companytpl/save";
					return c({
						withCredentials: !0,
						method: "POST",
						url: PREFIX_URL + b,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						},
						data: JSON.stringify(a)
					})
				}, N.previewScene = function(a) {
					var b = "?c=user&a=getMyTpl&id=" + a,
						d = new Date;
					b += (/\?/.test(b) ? "&" : "?") + "time=" + d.getTime();
					var e = f.defer();
					return c({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + b
					}).then(function(a) {
						for (var b = h.get("tplCache") ? h.get("tplCache") : h("tplCache"), c = 0; c < a.data.list.length; c++) {
							var d = {
								data: {
									obj: {
										elements: a.data.list[c].elements,
										scene: a.data.obj
									}
								}
							};
							b.put(a.data.list[c].id, $.extend(!0, {}, d))
						}
						e.resolve(a)
					}), e.promise
				}, N.transferScene = function(a, b) {
            var d = JSON_URL + "?c=scene&a=transfer";
					return d += "&loginName=" + b, d += "&id=" + a, d += "&time=" + (new Date).getTime(), c({
						withCredentials: !0,
						method: "POST",
						url: d
					})
				}, N
			}
		]), b.module("services.select", []).factory("selectService", ["$rootScope",
			function(a) {
				var b = {},
					c = [];
				return b.addElement = function(b) {
					c.indexOf(b) >= 0 || (c.push(b), c.length > 1 && a.$broadcast("select.more"))
				}, b.deleteElement = function(b) {
					var d = c.indexOf(b + "");
					0 > d || (c.splice(d, 1), c.length <= 1 && a.$broadcast("select.less"))
				}, b.clearElements = function() {
					c = [], a.$broadcast("select.less")
				}, b.getElements = function() {
					return c
				}, b
			}
		]), b.module("services.spread", ["services.scene"]), b.module("services.spread").factory("SpreadService", ["$http", "sceneService", "$rootScope",
			function(a, b, c) {
				var d = {};
				d.getDataBySceneId = function(b, c, d, e, f, g, h) {
					var i = "?c=Stat&id=" + b;
					g && (i += (/\?/.test(i) ? "&" : "?") + "user=" + g), h && (i += (/\?/.test(i) ? "&" : "?") + "extId=" + h), c && (i += "&startDate=" + c), d && (i += "&endDate=" + d), e && (i += "&pageSize=" + e), f && (i += "&pageNo=" + f);
					var j = new Date;
					return i += "&time=" + j.getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL + i
					})
				}, d.getActivities = function() {
					var b = new Date;
					return a({
						withCredentials: !0,
						method: "GET",
						url: JSON_URL
					})
				};
				var e = function(a) {
					var b = new Date;
					return b.setDate(b.getDate() + a), b.setHours(0), b.setMinutes(0), b.setSeconds(0), b.setMilliseconds(0), b.getTime()
				};
				d.updateName = function(b) {
					var c = PREFIX_URL + "m/scene/expand/save";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				};
				c.branchid;
				return d.getSceneDetail = function(a, d) {
					b.getSceneDetail(a, d).then(function(a) {
						c.$broadcast("scene.detail", a.data.obj, d)
					}, function() {})
				}, d.getSceneData = function(a, b, f, g, h) {
					var i = e(b),
						j = e(f);
					d.getDataBySceneId(a, i, j, 30, 0, g, h).then(function(b) {
						c.$broadcast("scene.data", b.data.list, a, i, j, g)
					}, function() {})
				}, d.expandWebs = [], d.getWebList = function(b, e) {
					var f = "m/scene/expand/list";
					b && (f += (/\?/.test(f) ? "&" : "?") + "id=" + b), e && (f += (/\?/.test(f) ? "&" : "?") + "user=" + e), f += (/\?/.test(f) ? "&" : "?") + "time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: PREFIX_URL + f
					}).then(function(a) {
						a.data.success && (d.expandWebs = a.data.list, c.$broadcast("webs.update"))
					}, function(a) {})
				}, d.deleteWeb = function(b) {
					var e = PREFIX_URL + "m/scene/expand/delete";
					a({
						withCredentials: !0,
						method: "POST",
						url: e,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					}).then(function(a) {
						a.data.success && (d.expandWebs.splice(b.index, 1), c.$broadcast("webs.update"))
					}, function(a) {})
				}, d
			}
		]), b.module("services.usercenter", []).factory("usercenterService", ["$http",
			function(a) {
				var b = {};
				return b.getUserInfo = function() {
            var b = JSON_URL + "?c=user&a=check";
					return b += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.getCompanyScale = function() {
					var b = PREFIX_URL + "base/class/company_scale";
					return b += "?time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.getCompanyIndustry = function() {
					var b = PREFIX_URL + "base/class/company_industry";
					return b += "?time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.getCompanyInfo = function() {
            var b = PREFIX_URL + "m/u/company/info";
					return b += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.saveCompanyInfo = function(b) {
					var c = PREFIX_URL + "m/u/company/save";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.saveUserInfo = function(b) {
            var c = JSON_URL + "?c=user&a=save";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.getUserXd = function() {
            var b = JSON_URL + "?c=user&a=xd";
					return b += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.getgiveXd = function(b) {
            var c = JSON_URL + "?c=user&a=givexd";
					return c += "&toUser=" + b.toUser, c += "&xdCount=" + b.xdCount, c += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "POST",
						url: c
					})
				}, b.getXdlog = function(b, c) {
            var d = JSON_URL + "?c=user&a=xdlog&pageNo=" + b + "&pageSize=" + c;
					return d += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "POST",
						url: d
					})
				}, b.getXdStat = function() {
					var b = JSON_URL;
					return b += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.relAccount = function(b, c, d) {
					var e = PREFIX_URL + "eqs/bindAccount?relUser=" + b + "&loginName=" + c + "&loginPassword=" + d;
					return e += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "POST",
						url: e,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b.setRead = function(b) {
					var c = PREFIX_URL + "m/u/markRead?ids=" + b;
					return c += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b.getNewMessage = function(b, c, d, e) {
					var f = JSON_URL + "?c=statics&a=all&line=7248&pageNo=" + b + "&pageSize=" + c;
					return d && (f += "&unread=" + d), e && (f += "&system=" + e), f += "&time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: f
					})
				}, b.getBranches = function(b, c) {
					var d = JSON_URL;
					return b && (d += (/\?/.test(d) ? "&" : "?") + "pageSize=" + b), c && (d += (/\?/.test(d) ? "&" : "?") + "pageNo=" + c), d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: d
					})
				}, b.getDepts = function() {
					var b = PREFIX_URL + "m/u/tag/list";
					return b += "?time=" + (new Date).getTime(), a({
						withCredentials: !0,
						method: "GET",
						url: b
					})
				}, b.addDept = function(b) {
					var c = PREFIX_URL + "m/u/tag/create";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.updateBranch = function(b) {
					var c = PREFIX_URL + "m/u/sub/save";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.createBranch = function(b) {
					var c = PREFIX_URL + "m/u/sub/create";
					return a({
						withCredentials: !0,
						method: "POST",
						url: c,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						},
						data: $.param(b)
					})
				}, b.openBranch = function(b, c) {
					var d = PREFIX_URL;
					return d += c ? "m/u/sub/turnOn?id=" + b : "m/u/sub/turnOff?id=" + b, a({
						withCredentials: !0,
						method: "POST",
						url: d,
						headers: {
							"Content-Type": "text/plain; charset=UTF-8"
						}
					})
				}, b
			}
		]), b.module("templates-app", ["about.tpl.html", "data/associateData.tpl.html", "data/edit/canedit.tpl.html", "data/edit/canread.tpl.html", "data/editData.tpl.html", "dialog/bindemail.tpl.html", "dialog/confirm.tpl.html", "dialog/message.tpl.html", "error.tpl.html", "error/error.tpl.html", "footer.tpl.html", "header.tpl.html", "help.tpl.html", "home/home.tpl.html", "main/console/group.tpl.html", "main/console/transferscene.tpl.html", "main/customer.tpl.html", "main/main.tpl.html", "main/spread.tpl.html", "main/spreadDetail.tpl.html", "main/tab/dataDetail.tpl.html", "main/tab/qrcode.tpl.html", "main/tab/sceneStatistics.tpl.html", "main/tab/spreadMethod.tpl.html", "main/userGuide.tpl.html", "my/myscene.tpl.html", "my/sceneSetting.tpl.html", "my/upload.tpl.html", "notifications.tpl.html", "reg/agreement.tpl.html", "reg/reg.tpl.html", "sample/sample.tpl.html", "scene/console.tpl.html", "scene/console/angle-knob.tpl.html", "scene/console/anim.tpl.html", "scene/console/audio.tpl.html", "scene/console/bg.tpl.html", "scene/console/button.tpl.html", "scene/console/category.tpl.html", "scene/console/cropimage.tpl.html", "scene/console/fake.tpl.html", "scene/console/input.tpl.html", "scene/console/link.tpl.html", "scene/console/map.tpl.html", "scene/console/microweb.tpl.html", "scene/console/pictures.tpl.html", "scene/console/setting.tpl.html", "scene/console/style.tpl.html", "scene/console/tel.tpl.html", "scene/console/video.tpl.html", "scene/create.tpl.html", "scene/createNew.tpl.html", "scene/edit/select/select.tpl.html", "scene/effect/falling.tpl.html", "scene/scene.tpl.html", "usercenter/console/branch.tpl.html", "usercenter/console/relAccount.tpl.html", "usercenter/console/upgrade_company.tpl.html", "usercenter/request_reg.tpl.html", "usercenter/tab/account.tpl.html", "usercenter/tab/message.tpl.html", "usercenter/tab/reset.tpl.html", "usercenter/tab/userinfo.tpl.html", "usercenter/tab/xd.tpl.html", "usercenter/transfer.tpl.html", "usercenter/usercenter.tpl.html"]), b.module("about.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("about.tpl.html", '')
			}
		]), b.module("data/associateData.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("data/associateData.tpl.html", '')
			}
		]), b.module("data/edit/canedit.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("data/edit/canedit.tpl.html", '')
			}
		]), b.module("data/edit/canread.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("data/edit/canread.tpl.html", '');

			}
		]), b.module("data/editData.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("data/editData.tpl.html", '<div ng-include="\'header.tpl.html\'"></div>\n<div id="main" class="min_contain" ng-if="!hideOpea">\n    <div ng-include="\'data/edit/canedit.tpl.html\'"></div>\n</div>\n<div id="main" class="min_contain" ng-if="hideOpea">\n    <div ng-include="\'data/edit/canread.tpl.html\'"></div>\n</div>')
			}
		]), b.module("dialog/bindemail.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("dialog/bindemail.tpl.html", '<div class="email-account">\n    <h1>您的账号还没有绑定邮箱</h1>\n    <p>去用户中心>账号管理，<a ng-href="#/usercenter/account?bindemail">马上绑定</a></p>\n</div>')
			}
		]), b.module("dialog/confirm.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("dialog/confirm.tpl.html", '<div class="modal-header">\n    <span>确认信息</span>\n</div>\n<div class="modal-body" ng-if="confirmObj.msg">\n	<div class="confirm-msg">{{confirmObj.msg}}</div>\n</div>\n<div class="btn-contain btn-small">\n    <a ng-click="ok();" class="btn-main">\n        {{confirmObj.confirmName || \'是\'}}\n    </a>\n    <a ng-click="cancel();" class="btn-grey0">\n        {{confirmObj.cancelName || \'取消\'}}\n    </a>\n</div>')
			}
		]), b.module("dialog/message.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("dialog/message.tpl.html", '<div class="modal-header">\n    <span class="glyphicon glyphicon-exclamation-sign"></span>\n    <span>{{msgObj.title || \'提示\'}}</span>\n</div>\n<div class="modal-body" ng-if="msgObj.msg">\n    <div class="msg" ng-class="msgObj.title ? \'\' : \'msg-padding\'">{{msgObj.msg}}</div>\n</div>\n<div class="modal-footer">\n	<a ng-click="close();" class="btn-main"\n    style="width: 88px;">关闭</a>\n</div>')
			}
		]), b.module("error.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("error.tpl.html", '<div class="error">\n    <div class="header">\n        <div class="content">\n            <div class="logo"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/logo.png" alt=""></div>\n        </div>\n    </div>\n    <div class="error_contain">\n        <div class="error_con">\n            <img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/404_03.png" alt="" />\n            <p style="font-size:24px;margin-top:30px;margin-bottom:15px;">对不起，您想要进入的页面已经去火星了！</p>\n            <p style="text-align:left;"><a href="#/home">返回地球</a></p>\n        </div>\n    </div>\n</div>\n<div ng-include="\'footer.tpl.html\'"></div>')
			}
		]), b.module("error/error.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("error/error.tpl.html", '<div class="error">\n    <div class="header">\n        <div class="content">\n            <div class="logo"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/logo.png" alt="" /></div>\n        </div>\n    </div>\n    <div class="error_contain">\n        <div class="error_con">\n            <img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/404_03.png" alt="" />\n            <p style="font-size:24px;margin-top:30px;margin-bottom:15px;">对不起，您想要进入的页面已经去火星了！</p>\n            <p style="text-align:left;"><a href="#/home">返回地球</a></p>\n        </div>\n    </div>\n</div>\n<div ng-include="\'footer.tpl.html\'"></div>')
			}
		]), b.module("footer.tpl.html", []).run(["$templateCache",
				function($templateCache) {
		                $templateCache.put("footer.tpl.html",
		                "<footer>\n" +
		                "	<div class=\"content_center\">\n" +
		                "	<article class=\"footer\">\n" +
		                "	<p class=\"beizhu\">(c) 2015 {{web_copyright}} All rights reserved   {{web_ipc}}</p>\n" +
		                "	<p>\n" +
		                "	<a href=\"https://ss.knet.cn/verifyseal.dll?sn=e14082111011652865izip000000&amp;ct=df&amp;a=1&amp;pa=0.5974755212664604\" target=\"_blank\" rel=\"nofollow\" style=\"margin: 0 auto;\">\n" +
		                "	<img ng-src=\"{{CLIENT_CDN}}addons/Market/Show/public/images/sn.png\">\n" +
		                "	</a>\n" +
		                "	</p>\n" +
		                "	</article>\n" +
		                "	</div>\n" +
		                "	</footer>");
             }]), b.module("header.tpl.html", []).run(["$templateCache",
			function(a) {
        			a.put("header.tpl.html", '<div class="header_tpl">\n	<div class="content clearfix">\n		<div class="logo" id="logo"></div>\n		<div class="head_nav" ng-if="showToolBar();">\n			<ul class="clearfix head_navs">\n				<li ng-class="{hover:isActive == \'main\'}">\n					<a href="#/main">我的场景</a>\n				</li>\n				<li ng-class="{hover:isActive == \'spread\'}">\n					<a href="#/main/spread/statistics">我的推广</a>\n				</li>\n				<li ng-class="{hover:isActive == \'customer\'}">\n					<a href="#/main/customer">我的客户</a>\n				</li>\n						\n			</ul>\n			<div ng-if="user.type == 2 && showBranchSelect" class="select-branch">\n				<select style="width:200px;" ng-model="global.branch" ng-options="branch.loginName for branch in userbranches" ng-change="selectBranch(branch)">\n					<option value="">当前账号</option>\n				</select>\n			</div>\n			<login-toolbar></login-toolbar>\n		</div>\n	    \n	</div>\n</div>	\n')
			
		}]), b.module("help.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("help.tpl.html", '')
			}
		]), b.module("home/home.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("home/home.tpl.html", '')
			}
	   ]), b.module("main/console/group.tpl.html", []).run(["$templateCache", 
			function(a) {
				a.put("main/console/group.tpl.html", '<div class="modal-header">\n    <span>新建组</span>\n</div>\n<div class="modal-body add-new-cat" forbidden-list-close>\n    <input type="text" ng-model="group.name" placeholder="请设置名称"/>\n</div>\n<p ng-show="authError" style="text-align:center;">{{authError}}</p>\n<div class="btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确认</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("main/console/transferscene.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/console/transferscene.tpl.html", '')
			}
		]), b.module("main/customer.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/customer.tpl.html", '');

			}
		]), b.module("main/main.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/main.tpl.html", '')
			}
		]), b.module("main/spread.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/spread.tpl.html", '')
			}
		]), b.module("main/spreadDetail.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/spreadDetail.tpl.html", '')
			}
		]), b.module("main/tab/dataDetail.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/tab/dataDetail.tpl.html", '')
			}
		]), b.module("main/tab/qrcode.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/tab/qrcode.tpl.html", '')
			}
		]), b.module("main/tab/sceneStatistics.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/tab/sceneStatistics.tpl.html", '')
			}
		]), b.module("main/tab/spreadMethod.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/tab/spreadMethod.tpl.html", '');

			}
		]), b.module("main/userGuide.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("main/userGuide.tpl.html", '<div style="position: fixed; left: 0; top: 0; bottom: 0; right: 0; background: rgba(0,0,0,0.8); z-index: 10000;" ng-show="firstLogin" ng-click="firstLogin = false;" ng-controller="userGuideCtrl">\n    <div style="width: 1000px; margin: 0 auto;">\n        <img style="margin: 109px 66px 0 30px; float: right;" src="{{CLIENT_CDN}}addons/Market/Show/public/images/chuangjian.png">\n        <img style="margin: 140px 0 0 0; float: right;" src="{{CLIENT_CDN}}addons/Market/Show/public/images/guide_main.png">\n    </div>\n</div>')
			}
		]), b.module("my/myscene.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("my/myscene.tpl.html", '')
			}
		]), b.module("my/sceneSetting.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("my/sceneSetting.tpl.html", '<div ng-include="\'header.tpl.html\'"></div>\n<div class="myscene min-contain">\n	<div class="main clearfix">\n	    <div class="content">\n	        <div class="fl">\n	            <iframe style="border: 0; width: 322px; height: 641px;" ng-src="{{customUrl}}"></iframe>\n	        </div> \n			<div class="rcont">\n			    <div class="top" style = "height: auto;">                  \n			        <div class = "setting-panel">\n			            <div class="alert alert-warning" role="alert" ng-if = "invalidText">\n			                {{invalidText}}\n			            </div>\n			            <form class="form-horizontal" role="form" name = "myForm" novalidate>\n				            <div class="form_img_input clearfix">\n						        <div class="title">\n						            <h1 title="场景基本信息设置">基本设置</h1>\n						        </div>				            	\n				                <div class="form-group form_upload col-sm-4">\n				                    <div class = "cover-panel" style = "margin-left: 20px;">\n				                        <div class = "cover-list" >\n				                          <nobr>\n				                            <ul>\n				                                <li class="cover-img" style = "" title="更换此场景封面"><a ng-click = "openImageModal()" style="display:block;"><img style = "width:190px; height:190px;" ng-src="{{PREFIX_FILE_HOST +  scene.image.imgSrc}}" /><em>更换场景封面</em></a></li>\n				                            </ul>\n				                          </nobr>\n				                    	</div>\n				                    </div>\n				                </div>				            	\n				            	<div class="form_input_groups col-sm-8">\n					                <div class="form-group control-group">\n					                    <label for="name" class="col-sm-3 control-label">场景名称</label>\n					                    <div class="col-sm-9">\n					                        <input name = "name" type="text" class="form-control" id="name" placeholder="场景名称" ng-model = "scene.name">\n					                    </div>\n					                </div>\n					                <div class="form-group">\n					                    <label for="type" class="col-sm-3 control-label">场景类型</label>\n					                    <div class="col-sm-9">\n					                        <select ng-model="scene.type" ng-options="scenetype.name for scenetype in types" id = "type" class = "form-control"></select>\n					                    </div>\n					                </div>\n					                <div class="form-group">\n					                    <label for="page_mode" class="col-sm-3 control-label">翻页方式</label>\n					                    <div class="col-sm-9">\n					                        <select ng-model="scene.pageMode" ng-options="pagemode.name for pagemode in pagemodes" id = "page_mode" class = "form-control"></select>\n					                    </div>\n					                </div>\n					                <div class="form-group">\n					                    <label for="description" class="col-sm-3 control-label">场景描述</label>\n					                    <div class="col-sm-9">\n					                        <textarea ng-model = "scene.description" class="form-control" rows="2" id = "description" name = "description" maxlength = "30" placeholder="你可以写下30字的场景描述哦！"></textarea>\n					                    </div>\n					                </div>					                \n					            </div>\n					        </div>\n					        <div class="gao_shezhi">\n						        <h1 class="gao-title" style="">高级设置</h1>\n				                <section ng-if="!scene.image.isAdvancedUser && !hideAd">\n				                    <div class="form-group">\n				                        <label for="page_mode" class="last-page control-label">尾页设置</label>\n				                        <div class = "cover-panel ml-20">\n				                            <div class = "cover-list col-sm-11 last-cover" style="">\n				                              	<nobr>\n				                                	<ul>\n				                                    	<li class="cover-img1" ng-repeat="pageTpl in pageTpls" img-click\n				                                    	ng-click = "chooseLastPage(pageTpl.id)">\n				                                    		<a href="">\n				                                    			<img ng-class="{checked: scene.image.lastPageId == pageTpl.id}" class="lp-list" style = "" ng-src="{{PREFIX_FILE_HOST + pageTpl.properties.thumbSrc}}"/>\n				                                    		</a>\n				                                    	</li>\n				                                	</ul>\n				                              	</nobr>\n				                        	</div>\n				                        </div>\n				                    </div>\n				                </section>\n				                <div class="form-group" class="mt-15" ng-if="false">\n				                  <label for="start_date" class="col-sm-2 control-label">开放时间</label>\n				                  <div>\n				                    <div style = "margin-left: 130px;" class="input-group col-sm-3 col-sm-offset-2">\n				                    <input type="text" class="form-control" datepicker-popup="{{format}}" ng-model="startDate" is-open="openedmin" min-date="minDateStart" max-date="maxDateStart" datepicker-options="dateOptions" ng-required="true" close-text="关闭" clear-text = "清除" current-text = "今天" placeholder = "开放时间" readonly/>\n				                    <span class="input-group-btn">\n				                      <button type="button" class="btn btn-default" ng-click="openmin($event)" ng-disabled = "alwaysOpen"><i class="glyphicon glyphicon-calendar"></i></button>\n				                    </span>\n				                  </div>\n				                  <div class="input-group col-sm-3 col-sm-offset-6" style = "margin-top: -35px;">\n				                    <input type="text" class="form-control" datepicker-popup="{{format}}" ng-model="endDate" is-open="openedmax" min-date="minDateEnd" max-date="\'2015-06-22\'" datepicker-options="dateOptions" ng-required="true" close-text="关闭"  clear-text = "清除" current-text = "今天" placeholder = "结束时间"  readonly/>\n				                    <span class="input-group-btn">\n				                      <button type="button" class="btn btn-default" ng-click="openmax($event)" ng-disabled = "alwaysOpen"><i class="glyphicon glyphicon-calendar"></i></button>\n				                    </span>\n				                  </div>\n				                  <div class="checkbox col-sm-offset-9" style = "margin-top: -35px;">\n				                    <label style = "padding-left: 40px;">\n				                      <input type="checkbox" ng-model = "alwaysOpen" ng-change = "switchOpen()"> 不限制\n				                    </label>\n				                  </div>\n				                  </div>\n				                </div>\n				                <div ng-if = "scene.createTime > 1416502800000" class="form-group" ad-set>\n				                    <label for="description" class="col-sm-2 control-label" ng-if="!scene.image.isAdvancedUser && !hideAd">友链设置</label>\n				                    <div class="col-sm-10" ng-if="!scene.image.isAdvancedUser && !hideAd" style = "padding-left:0px;">\n				                        <label style = "padding-top: 7px;">\n				                          <input type="checkbox" ng-change = "hideAdd()" ng-model = "scene.image.hideEqAd" /><span style = "font-weight: 100;">去掉场景中'+web_copyright+'尾页，本次使用'+QI_AD_XDS+'个秀点。</span>\n				                        </label>\n				                    </div>\n				                    <div class="form-group youlian-set" ng-if="scene.image.isAdvancedUser || hideAd">\n				                    	<label  for="description" style="margin-left:10px;" class="col-sm-2 control-label">友链设置</label>\n				                        <div class="my-xd" style = "">我的秀点：<span>{{userXd | fixnum}}</span>个</div>\n				                        <div class="get-xd"><a href="http://bbs.www.48ym.com/forum.php?mod=viewthread&tid=297&extra=page%3D1" target = "_blank">获取秀点</a></div>\n				                    </div>\n				                    <div class="form-group youlian-set hide-label" ng-if="!scene.image.isAdvancedUser && !hideAd">\n				                        <div class="my-xd" style = "">我的秀点：<span>{{userXd | fixnum}}</span>个</div>\n				                        <div class="get-xd"><a href="http://bbs.www.48ym.com/forum.php?mod=viewthread&tid=297&extra=page%3D1" target = "_blank">获取秀点</a></div>\n				                    </div>\n				                    <section style="margin-left: 15px;" ng-if="\n				                    scene.image.isAdvancedUser && !hideAd">\n					                    <div class="form-group">\n					                        <label for="page_mode" style="margin-left:35px;padding:5px 0;" class="control-label">底标样式</label>\n					                        <div class = "cover-panel" style = "margin-left: 20px;">\n					                            <div class = "cover-list col-sm-11 bottom-list" style="">\n					                              	<nobr>\n					                                	<ul>\n					                                		<li style = ""\n					                                    	ng-click = "chooseBottomLabel()">\n					                                    		<a href="">\n					                                    			<img class="static-img" ng-class="{checked: !scene.property.bottomLabel.id \n					                                    			&& !hideAd && !scene.image.hideEqAd}" style = "" ng-src="{{CLIENT_CDN}}assets/images/defaultBottomLabel.jpg"/>\n					                                    		</a>\n					                                    	</li>\n					                                    	<li\n					                                    	ng-click = "hideAdd(\'image\')"ng-mouseenter="showXd = true;" ng-mouseleave="showXd = false;" >\n					                                    		<a style="position:relative;" href="">\n					                                    			<span class="cost-xd"ng-if="showXd">消耗100秀点</span>\n					                                    			<img ng-class="{checked: scene.image.hideEqAd}" ng-src="{{CLIENT_CDN}}assets/images/noBottomLabel.jpg"/>\n					                                    		</a>\n					                                    	</li>\n					                                    	<li ng-repeat="bottomPageTpl in bottomPageTpls"\n					                                    	ng-click="chooseBottomLabel(bottomPageTpl.id)">\n					                                    		<a href="">\n					                                    			<img ng-class="{checked: scene.property.bottomLabel.id == bottomPageTpl.id}" ng-src="{{PREFIX_FILE_HOST + bottomPageTpl.properties.thumbSrc}}"/>\n					                                    		</a>\n					                                    	</li>\n					                                	</ul>\n					                              	</nobr>\n					                        	</div>\n					                        </div>\n					                    </div>\n					                </section>\n				                </div>	\n			                	<div ng-if="scene.property.bottomLabel.id" class="form-group" ng-if="!hideAd && isAdvancedUser">\n				                    <label for="page_mode" class="col-sm-2 control-label">名称</label>\n				                    <div class="col-sm-4">\n				                        <input type="text" ng-model="scene.property.bottomLabel.name"/>\n				                    </div>\n				                    <label for="page_mode" class="col-sm-2 control-label">链接地址</label>\n				                    <div class="col-sm-4">\n				                        <input type="text" ng-model="scene.property.bottomLabel.url" ng-init="scene.property.bottomLabel.url=\'http://\'"/>\n				                    </div>\n				                </div>\n				                <div class="form-group" style = "margin-top: 25px;">\n				                    <label for="share" class="col-sm-2 control-label">推广设置</label>\n				                    <div class="checkbox col-sm-offset-2">\n				                      <label style = "tui-title">\n				                        <input id = "share" type="checkbox" ng-true-value = "1" ng-false-value = "0" ng-model = "scene.applyPromotion"/>\n				                        申请帮助推荐\n				                        <span class="samp-tip" style = "">(审核通过后，场景达到1000次展示将有机会被推荐到<a href="#/sample" target="_blank"><ins>场景案例中心</ins></a>)</span>\n				                      </label>\n				                    </div>\n				                </div>\n				                <div ng-show="userProperty.type ==2 && scene.status != -1 && scene.status != -2" class="form-group" style = "margin-top: 25px;">\n				                    <label for="companytpl" class="col-sm-2 control-label">企业样例</label>\n				                    <div class="checkbox col-sm-offset-2">\n				                        <label style="tui-title">\n				                            <input id="companytpl" ng-true-value = "3" ng-false-value="0" ng-model="scene.isTpl" type="checkbox" />\n				                            保存为企业样例\n				                            <span class="samp-tip">(成为企业样例后，子账号可免费使用)  </span>\n				                        </label>\n				                    </div>\n				                </div>				                \n				                <div class="checkbox col-sm-offset-2" ng-if="isVendorUser" style="margin-bottom:25px;margin-left:96px;" >\n				                    <label class="samp-title">\n				                        <input id = "share" type="checkbox" value="" ng-true-value = "1" ng-false-value = "0" ng-model = "scene.applyTemplate" />\n				                        申请作为样例\n				                        <span class="samp-tip">(审核通过后，每做一个样例送100个秀点)</span>\n				                    </label>\n				                </div>\n\n				                <div class = "changjing_caozuo">\n		            				<a href="#/scene/create/{{sceneId}}?pageId=1" class="btn-secondary" style="margin-right:10px">编辑场景</a>\n				                    <a ng-click = "saveSceneSettings(scene)" class="btn-save">保存设置</a>\n				                </div>\n					        </div>\n			            </form>                 \n			        </div>\n			    </div>\n			</div>\n		</div>\n	</div>\n</div>\n<div ng-include="\'footer.tpl.html\'"></div>')
			}
		]), b.module("my/upload.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("my/upload.tpl.html", '<div nv-file-drop="" uploader="uploader">\n\n        <div class="container">\n\n            <div class="row">\n\n                <div class="col-md-3">\n                    <div ng-show="uploader.isHTML5">\n                        <!-- 3. nv-file-over uploader="link" over-class="className" -->\n                        <div ng-show="category.fileType != \'2\'" class="well my-drop-zone" nv-file-over="" uploader="uploader">\n                            拖拽图片到此区域\n                        </div>\n                        <div ng-show="category.fileType == \'2\'" class="well my-drop-zone" nv-file-over="" uploader="uploader">\n                            拖拽音乐到此区域\n                        </div>\n                    </div>\n\n                    <!-- Example: nv-file-select="" uploader="{Object}" options="{Object}" filters="{String}" -->\n                    \n                    <div id="upload_btn" class="btn-main">\n                        <span ng-show="category.fileType == \'0\' || category.fileType == \'1\'">选择图片</span>\n                        <span ng-show="category.fileType == \'2\'">选择音乐</span>\n                        <input type="file" id="uploadBtn" ng-click = "removeQueue()" nv-file-select="" uploader="uploader" multiple/>\n                    </div>\n                    <br/>\n\n                </div>\n\n                <div class="col-md-9" style="margin-bottom: 40px">\n                    <!-- <p>等待上传图片个数: {{ uploader.queue.length }}</p> -->\n                    <p ng-show="category.fileType == \'1\' && !category.headerImage && !category.coverImage">每次最多上传5张图片，上传图片建议大小在100k以内，格式为jpg\\bmp\\png\\gif，<a href="https://tinypng.com/" target="_blank"><font color="red">图片压缩神器</font></a></p>\n                   <p ng-show="category.fileType == \'0\'">图片建议尺寸为640px*1008像素，图片大小在100K以内，格式为jpg\\bmp\\png\\gif，<a href="https://tinypng.com/" target="_blank"><font color="red">图片压缩神器</font></a></p>\n                    <p ng-show="category.fileType == \'2\'">上传音乐大小不超过2M，格式为mp3，<a href="" target="_blank"><font color="red">音乐裁剪工具</font></a></p>\n                    <p ng-show = "category.fileType == \'1\' && (category.headerImage || category.coverImage)">上传图片建议像素为250px*250px，上传图片大小在100K以内，格式为jpg\\bmp\\png\\gif</p>\n                    <table class="table">\n                        <thead>\n                            <tr>\n                                <th width="50%">名称</th>\n                                <th ng-show="uploader.isHTML5">大小</th><!-- \n                                <th ng-show="uploader.isHTML5">进度</th>\n                                <th>操作</th> -->\n                            </tr>\n                        </thead>\n                        <tbody>\n                            <tr ng-repeat="item in uploader.queue">\n                                <td>\n                                    <strong>{{ item.file.name }}</strong>\n                                    <!-- Image preview -->\n                                    <!--auto height-->\n                                    <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->\n                                    <!--auto width-->\n                                    <div ng-show="uploader.isHTML5" ng-thumbnail="{ file: item._file, height: 100 }"></div>\n                                    <!--<div ng-thumbnail="{ file: item._file, height: 100 }"></div>\n                                    fixed width and height -->\n                                    <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->\n                                </td>\n                                <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>\n                                 <td ng-show="uploader.isHTML5">\n                                    <div class="progress" style="margin-bottom: 0;">\n                                        <div class="progress-bar" role="progressbar" ng-style="{ \'width\': item.progress + \'%\' }"></div>\n                                    </div>\n                                </td>\n                                <!--<td nowrap>\n                                    <button type="button" class="btn btn-success btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">\n                                        <span class="glyphicon glyphicon-upload"></span> 上传\n                                    </button>\n                                    <button type="button" class="btn btn-warning btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">\n                                        <span class="glyphicon glyphicon-ban-circle"></span> 取消\n                                    </button>\n                                    <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">\n                                        <span class="glyphicon glyphicon-trash"></span> 删除\n                                    </button>\n                                </td> -->\n                            </tr>\n                        </tbody>\n                    </table>\n\n                    <div>\n                        <!-- <div>\n                            上传进度:\n                            <div class="progress" style="">\n                                <div class="progress-bar" role="progressbar" ng-style="{ \'width\': uploader.progress + \'%\' }"></div>\n                            </div>\n                        </div> -->\n                        <button type="button" class="btn btn-secondary btn-s" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">\n                            <span class="glyphicon glyphicon-upload"></span> 上传\n                        </button>\n                       <!--  <button type="button" class="btn btn-warning btn-s" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">\n                            <span class="glyphicon glyphicon-ban-circle"></span> 取消\n                        </button> -->\n                        <button type="button" class="btn btn-danger btn-s" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">\n                            <span class="glyphicon glyphicon-trash"></span> 删除\n                        </button>\n                    </div>\n\n                </div>\n\n            </div>\n\n        </div>\n\n    </div>')
			}
		]), b.module("notifications.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("notifications.tpl.html", '<div ng-class="[\'alert\', \'alert-\'+notification.type]" ng-repeat="notification in notifications.getCurrent()" notification-fadeout>\n    <button class="close" ng-click="removeNotification(notification)">x</button>\n    {{notification.message}}\n</div>\n')
			}
		]), b.module("reg/agreement.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("reg/agreement.tpl.html", '<div ng-include="\'footer.tpl.html\'"></div>');

			}
		]), b.module("reg/reg.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("reg/reg.tpl.html", '<div><a ng-href="{{weiChatUrl}}">登录测试</a></div>')
			}
		]), b.module("sample/sample.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("sample/sample.tpl.html", '<div class="sample contain min_contain">	\n	    <header>\n	        <div class="we_nav content_center">\n	            <div class="link_list">\n	                <ul class="clearfix">\n	                    <li class="bg_hover"><a>用户案例</a></li>\n	                    <li ng-hide="isAuthenticated()"><a ng-click = "login()">登录</a></li>\n	                    <li ng-hide="isAuthenticated()" class=""><a ng-click = "register()">注册</a></li>\n	                    <li ng-show="isAuthenticated()"><a href="#/main">进入</a></li>\n	                </ul>\n	            </div>                  \n	            <div id="logo"><a href="#/home"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/logo.png" alt=""></a></div>\n	        </div>    \n	    </header>\n	    <div class="content_center">\n<!-- 		    <div class="pv_contain clearfix">\n		    	<div class="img_pv_contain">\n			    	<div class="pv_images" >\n						<ul>\n							<li  class="con_list" ng-repeat="dayTop in dayTop" ng-show="page == \'day\'">\n							<a ng-href="{{PREFIX_CLIENT_HOST + \'v-\' + dayTop.code}}" target="_blank">\n								<div class="pv_images_cont">\n									<div ng-hide="showCode2 == true"><img ng-src="{{PREFIX_FILE_HOST + dayTop.image.imgSrc}}" alt="" width="235px" /></div>\n									<div ng-show="showCode2 == true" qr-code qr-url="{{PREFIX_FILE_HOST + dayTop.image.imgSrc}}" class="qrcode">\n									\n									</div>\n									<p class="anli_name" title="{{dayTop.name}}">{{dayTop.name}}</p>\n								</div>\n							</a>\n							<p class="changj_pv"><span class="er_name"><em>{{dayTop.userName}}</em><a ng-mouseover="showCode2 = true" ng-mouseleave="showCode2 = false" href="">二维码</a></span><span class="changj_show_num">展示:{{dayTop.showCount | fixnum}}</span></p>\n							\n						</li>\n						</ul>\n						<ul>\n							<li class="con_list" ng-repeat="monthTop in monthTop" ng-show="page == \'month\'">\n							<a ng-href="{{PREFIX_CLIENT_HOST + \'v-\' + monthTop.code}}" target="_blank">\n								<div class="pv_images_cont">\n									<div ng-hide="showCode1 == true"><img ng-src="{{PREFIX_FILE_HOST + monthTop.image.imgSrc}}" alt="" width="235px" /></div>\n									<div ng-show="showCode1 == true" qr-code qr-url="{{PREFIX_CLIENT_HOST + \'v-\' + monthTop.code}}" class="qrcode">\n									</div>\n								</div>\n								<p class="anli_name" title="{{monthTop.name}}">{{monthTop.name}}</p>\n							</a>\n							<p class="changj_pv"><span class="er_name"><em>{{monthTop.userName}}</em><a ng-mouseover="showCode1 = true" ng-mouseleave="showCode1 = false" href="">二维码</a></span><span class="changj_show_num">展示:{{monthTop.showCount | fixnum}}</span></p>\n							\n							</li>\n						</ul>\n						<ul>\n							<li class="con_list" ng-repeat="weekTop in weekTop" ng-show="page == \'week\'">\n							<a ng-href="{{PREFIX_CLIENT_HOST + \'v-\' + weekTop.code}}" target="_blank">\n								<div class="pv_images_cont" >\n									<div ng-hide="showCode3 == true"><img ng-src="{{PREFIX_FILE_HOST + weekTop.image.imgSrc}}" alt="" width="235px" /></div>\n									<div ng-show="showCode3 == true" qr-code qr-url="{{PREFIX_CLIENT_HOST + \'v-\' + weekTop.code}}" class="qrcode">\n									</div>\n									<p class="anli_name" title="{{weekTop.name}}">{{weekTop.name}}</p>\n								</div>\n\n							</a>\n							<p class="changj_pv"><span class="er_name"><em>{{weekTop.userName}}</em><a ng-mouseover="showCode3 = true" ng-mouseleave="showCode3 = false" href="">二维码</a></span><span class="changj_show_num">展示:{{weekTop.showCount | fixnum}}</span></p>\n							\n						</li>\n						</ul>\n			    	</div>		    			    			    			    	\n		 		</div>\n		    	<div class="pv_nav">\n		    		<h1><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/sample/desr.png" alt="" /></h1>\n		    		<ul class="clearfix">\n		    			<li ng-class="{hover:page == \'month\'}" ng-click="page = \'month\'">本月排名</li><li ng-class="{hover:page == \'week\'}" ng-click="page = \'week\'">本周排名</li><li ng-click="page = \'day\'" ng-class="{hover:page == \'day\'}">昨日排名</li>\n		    		</ul>\n		    	</div>\n		    </div> -->\n		    <div class="header_con">	\n			    <div class="sample_cat clearfix" data-ng-init="load()">\n			    	<div class="sample_images mains">\n			    		<div class="clearfix">\n							<div class="con_list" ng-repeat = "home in homes">\n								<a ng-href="{{PREFIX_CLIENT_HOST + \'v-\' + home.code}}" target="_blank">\n									<div ng-show="showCode == true" class="cj_img qrcode" qr-code qr-url="{{PREFIX_CLIENT_HOST + \'v-\' + home.code}}">\n										<!-- <img ng-src="{{PREFIX_SERVER_HOST + \'eqs/qrcode/\' + home.code + \'.png\'}}" alt="" width="235px" /> -->\n									</div>\n									<div ng-hide="showCode == true" class="cj_img"><img ng-src="{{PREFIX_FILE_HOST + home.image.imgSrc}}" alt="" width="235px" /></div>\n									<p class="anli_name" title="{{home.name}}">{{home.name}}</p>\n								</a>\n								<p class="clearfix"><span class="er_name"><em>{{home.userName}}</em><a ng-mouseover="showCode = true" ng-mouseleave="showCode = false" href="">二维码</a></span>场景展示:{{home.showCount | fixnum}}</p>\n							</div>\n						</div>\n						<div class="mores" ng-init = "showMoreButton = true;" ng-hide = \'homes.length < 9\'>\n					    	<a ng-click="showMore(type)" ng-show = \'showMoreButton\'>查看更多</a>\n					    	<p ng-show = "!showMoreButton" style="font-size:16px;">没有更多了</p>\n					    </div>\n					    <p style="text-align:center;margin-top:100px;" ng-show = \'homes.length <= 0\'>该分类下暂无场景</p>\n			    	</div>\n			    	<div class="sample_cats">\n				    	<div class="sample_fix fixed">\n				    		<div class="cat-list">\n					    		<h1><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/sample/case.png" alt="" /></h1>\n					    		<ul class="clearfix">\n				                    <li id="one1" ng-class="{hover:typeindex == \'all\'}" ng-click="getHomes(\'all\', null, 1, 9);type=null">全部案例</li>\n				                    <li ng-repeat = "sceneType in sceneTypes" ng-class = "{hover: typeindex == $index}" ng-click = "getHomes($index, sceneType.value, 1, 9)">\n				                        {{sceneType.name}}\n				                    </li>\n					    		</ul>\n					    	</div>\n				    		<div>\n				    							    		</div>\n				    	</div>\n			    	</div>	\n			    </div>    \n			</div>\n		</div>	\n</div>\n<div ng-include="\'footer.tpl.html\'"></div>\n\n')
			}
		]), b.module("scene/console.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console.tpl.html", '<div>\n<div ng-show="comp_type==\'bg\'" ng-include="\'scene/console/bg.tpl.html\'" ng-controller="BgConsoleCtrl"></div>\n</div>')
			}
		]), b.module("scene/console/angle-knob.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/angle-knob.tpl.html", '<div class="sliderContainer">\n	<div class="sliderKnob"></div>\n</div>')
			}
		]), b.module("scene/console/anim.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/anim.tpl.html", '<div ng-if="activeTab == \'anim\'" ng-controller="AnimConsoleCtrl">\n	<div class="anim_area">\n		<div class="anim-panels" ng-if="animations.length">\n			<section ng-repeat="animation in animations track by $index">\n				<div class="style_list" ng-init="opea.show=true" ng-click="opea.show=!opea.show">\n			        <b class="caret" ng-if="opea.show"></b>\n			        <b class="caret off" ng-if="!opea.show"></b>\n			        动画&nbsp;{{$index+1}}\n			        <span style="padding-right: 10px;cursor:pointer;" class="fr" ng-click="removeAnim($index, $event)"><img title="删除此动画" ng-src="/addons/Market/Show/public/images/delete.png" ></span>\n			    </div>\n			    <div ng-if="opea.show" class="style_list_angel clearfix">\n			        <label>方式</label>\n		        	<div class="flo_lef touming">\n		        		<select style="width:100px;border:1px solid #C9C9C9;" ng-model="types[$index]" ng-change="animation.type=types[$index].id; changeAnimation(animation, $index)" ng-options="animType.name group by animType.cat for animType in animTypeEnum">\n		            		<option value="-1">无</option>\n		        		</select>	        		\n		    		</div>\n			    </div>\n			    <div ng-if="opea.show && animation.type == 7" class="style_list_angel clearfix">\n			        <label>速度</label>\n		        	<div class="clearfix touming">\n			        	<div class="num" style="text-align:right;margin-top:4px;">\n			        		<input type="checkbox" value="" ng-model="animation.linear" ng-true-value="1" style="margin-right:2px;margin-top:0px;"/>匀速\n			        	</div>		        			        		\n		    		</div>\n			    </div>			    \n			    <div class="row" ng-if="animation.type != -1 && animation.type != null && opea.show">            \n			        <form role="form">\n			            <div class="style_list_angel clearfix" ng-show="animation.type == 1 || animation.type == 2">\n			                <label>方向</label>\n			                <div class="flo_lef touoming"><select style="color:#999" class="form-control" ng-model="directions[$index]" ng-change="animation.direction=directions[$index].id;changeAnimation(animation, $index)" ng-options="animDirection.name for animDirection in animDirectionEnum">\n			                </select></div>\n			            </div>\n			            <div class="style_list_angel">\n			                <label>时间</label>\n			                <div class="touming clearfix">\n			                    <p class="num"><input limit-input class="input_kuang short" type="number" step="0.1" min="0" max="20" ng-model="animation.duration" /></p>\n			                    <div class="num" style="width:100px;" ui-slider min="0" max="20" use-decimals step="0.1" ng-model="animation.duration"></div>\n			                </div>\n			            </div>              \n			            <div class="style_list_angel">\n			                <label>延迟</label>\n			                <div class="touming clearfix">\n			                    <p class="num"><input limit-input class="input_kuang short" type="number" step="0.1" min="0" max="20" class="form-control" ng-model="animation.delay"/></p>\n			                    <div class="num" style="width:100px;" ui-slider min="0" max="20" use-decimals step="0.1" ng-model="animation.delay"></div>\n			                </div>\n			            </div>\n			            <div class="style_list_angel">\n			                <label>次数</label>\n			                <div class="touming clearfix">\n			                    <p class="num" style="float:left;margin-right:10px;"><input ng-disabled  = "animation.count" limit-input class="input_kuang short" type="number" min="1" max="10" class="form-control" ng-model="animation.countNum" /></p>\n			                    <div class="num" style="text-align:right;margin-top:0px;"><input type="checkbox" value="" id="xunhuan" ng-model="animation.count" style="margin-right:2px;margin-top:0px;" />循环</div>\n			                </div>\n			                              \n			            </div>\n			        </form>                 \n			    </div>\n			</section>\n		</div>\n		<div class="add-anim">\n			<a ng-click="addAnim()" class="add-anims">添加动画</a>\n			<a style="margin-top:10px;" ng-click="previewAnim()" class="broad-anim">播放动画</a>\n		</div>\n	</div>\n	<div class="modal-footer">\n		<a class="btn-main" ng-click="cancel()">确定</a>\n		<a class="btn-grey0" ng-click="clear()">清除动画</a>\n	</div>\n</div>')
			}
		]), b.module("scene/console/audio.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/audio.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>音乐素材</h1>\n        <p>选择音乐库中音乐或把喜欢的乐曲上传到我的音乐中</p>\n    </div> \n	<div class="input_console dialog-content">\n		<div class="modify_area">\n			<form class="form-horizontal" role="form">\n				<div class="category_list nav-list">\n					<ul class="category_list_container clearfix">\n						<li ng-class="{active: category.value == model.bgAudio.type}" ng-repeat="category in categoryList" ng-click="model.bgAudio.type = category.value">\n							{{category.name}}\n						</li>\n					</ul>\n				</div>\n				<div ng-if="model.bgAudio.type == \'1\'" class="audio_area clearfix">\n					<span class="control-label" style="font-size:14px;">链接地址</span>\n					<input class="" type="text" ng-model="model.type1" placeholder="请输入mp3文件链接" style="width:280px;height:35px;line-height:35px;border:1px solid #E7E7E7;border-radius:0px;padding-left:5px;font-size:12px;" />\n				</div>\n				<div ng-if="model.bgAudio.type == \'2\'" class="audio_area clearfix" style="height:auto;">\n					<select class="float-lf selectcartoon" ng-change="selectAudio(2)" ng-model="model.selectedMyAudio" ng-options="myAudio.name for myAudio in myAudios" id="nb_musicurl" style="padding-left:5px;width:280px;">\n		     			<option value="">选择我的音乐</option>\n		         	</select>\n		         	<span class="btn-main" ng-click="goUpload()">上传音乐</span>\n		         	<div ng-if = "model.type2" style = "margin-top:10px;">\n		         		<audio ng-src="{{model.type2}}" controls="controls">\n						</audio>								\n		         	</div>\n				</div>\n				<div ng-if="model.bgAudio.type == \'3\'" class="audio_area clearfix">\n					<select class="float-lf selectcartoon" ng-change="selectAudio(3)" ng-model="model.selectedAudio" ng-options="reservedAudio.name for reservedAudio in reservedAudios" id="nb_musicurl" style="padding-left:5px;width:280px;height:35px;line-height:35px;border:1px solid #E7E7E7;">\n		     			<option value="">选择音乐库文件</option>\n		         	</select>  	\n			        <div ng-if = "model.type3" style = "margin-top:10px;">\n		         		<audio  ng-src="{{model.type3}}" controls="controls">\n						</audio>								\n		         	</div>\n				</div>\n			</form>\n		</div>\n	</div>\n</div>\n<div class="btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/bg.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/bg.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>素材库</h1>\n       <p ng-show="fileType == \'0\'">选择背景库的图片或上传图片到我的背景中，选择即可使用(最佳尺寸：640×1008像素)</p>\n   <p ng-show="fileType == \'1\'">选择素材库的图片或上传图片到我的素材库中，选择即可使用</p>\n    </div>\n	<div class="dialog-content bg_console clearfix" style="background-color:#E7E7E7;">\n		<div class="fl" style="width:120px;">\n			 <ul class="nav nav-tabs tabs-left" style="padding-top:0px;"><!-- \'tabs-right\' for right tabs -->\n	    		<li class="active" ng-click="changeCategory(\'0\')">\n	    			<a href="" ng-show="fileType == \'0\'" ng-click="switchToSystemImages(\'false\');" data-toggle="tab">我的背景</a>\n	    			<a href="" ng-show="fileType == \'1\'" ng-click="switchToSystemImages(\'false\')" data-toggle="tab">我的图片</a>\n	    		</li>\n			    <li>\n			    	<a href="" ng-show="fileType == \'0\'" ng-click="switchToSystemImages(\'true\'); changeCategory(\'all\')" data-toggle="tab">背景库</a>\n			    	<a href="" ng-show="fileType == \'1\'" ng-click="switchToSystemImages(\'true\'); changeCategory(\'all\')" data-toggle="tab">图片库</a>\n			    </li>\n			  </ul>\n		</div>\n		<div class="fl bg-rig">\n			<div class="tab-content" id="bg_contain">\n		        <div class="tab-pane active" ng-show="!systemImages">\n		        	<div class="img_list" style="padding-bottom: 0px;">\n		     <div class="category_list clearfix">\n		<ul class="category_list_container clearfix" style="width:610px;float:left;">\n		<li ng-class="{active: tagIndex == -1}" class="category_item" ng-click="changeCategory(\'0\');">\n		全部 \n</li>\n	<li ng-class="{active: tagIndex == $index}" class="category_item" ng-repeat="myTag in myTags" ng-mouseenter="hoverTag(myTag)" ng-mouseleave="hoverTag(myTag)" ng-click="getImagesByTag(myTag.id, $index)">\n									{{myTag.name}}<span ng-if="myTag.hovered" ng-click="deleteTag(myTag.id, $index, $event)">x</span>\n								</li>						\n							</ul>\n							<div class="category_item active" ng-click="createCategory();" style="float:right;">\n								创建分类\n							</div>						\n						</div>\n						<div class="edit">\n							<input type="checkbox" ng-model="allImages.checked" ng-change="selectAll()"/>&nbsp;&nbsp;<span ng-click="deleteImage()"><a href="">删除</a></span>\n							<div class="btn-group">\n								<div class="dropdown-toggle"  data-toggle="dropdown" ng-click="setIndex($event);">分类到</div>\n								<div class="dropdown-menu" role="menu">\n									<ul forbidden-close>\n				                        <li ng-class="{selecttag: dropTagIndex == $index}" ng-repeat="myTag in myTags" ng-click="selectTag(myTag, $index)"><span>{{myTag.name}}</span></li>\n				                        <li ng-click="createCategory();" class="add_cate clearfix"><em>+</em><span>添加分类</span></li>\n			                      	</ul>\n			                      	<div class="fl btn-main" style="width:100%;" ng-click="setCategory(dropTagIndex)"><a href="" style="color:#FFF;">确定</a></div>\n			                    </div>\n							</div>\n			        	</div>\n			        </div>\n			    </div>\n		        <div class="tab-pane" ng-class="{active: systemImages}" ng-show="systemImages">\n		        	<div class="img_list">\n		        		<div class="category_list">				\n							<ul class="category_list_container clearfix">\n								<li class="category_item"  ng-click="changeCategory(\'all\')" ng-class="{active: \'all\' == categoryId}">\n								最新\n								</li>\n								<li ng-class="{active: category.value == categoryId}" class="category_item" ng-repeat="category in categoryList" ng-click="changeCategory(category.value); getChildCategory(category.value);sysTagIndex = -1;">\n									{{category.name}}\n								</li>\n								<li ng-show="fileType == \'0\'" class="category_item"  ng-click="changeCategory(\'c\'); numPages=2;" ng-class="{active: \'c\' == categoryId}">\n								纯色背景\n								</li>\n							</ul>	\n						</div>\n			        	<div class="cat_two_list clearfix" ng-if="\'c\' != categoryId && \'all\' != categoryId">\n			        		<ul>\n			        			<li ng-class="{active: sysTagIndex == $index}" ng-repeat = "childCatrgory in childCatrgoryList" ng-click="getImagesBySysTag(childCatrgory.id, $index, 1, categoryId)" style="cursor:pointer;">\n			        				{{childCatrgory.name}}\n			        			</li>\n			        		</ul>\n			        	</div>\n		        	</div>\n		        </div>\n			    <div class="img_list" style="padding-top:0px;">\n			    	<div class="img_list_container" ng-class="{photo_list: fileType == \'1\', bg_list: fileType == \'0\'}">\n						<ul class="img_box clearfix">\n							<li ng-show="categoryId == \'0\'" class="upload" title="上传图片" ng-click="goUpload(img.path)">\n								<span class=""><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_15.jpg" alt="" /></span>\n							</li>\n							<li class="imageList" ng-show="fileType == \'0\' && \'c\' != categoryId" ng-repeat="img in imgList track by $index" ng-click="switchSelect(img, $event)" ng-mouseenter="hover(img)" ng-mouseleave="hover(img)" ng-class="{hovercolor: img.showOp || img.selected}" right-click>\n								<img ng-src="{{PREFIX_FILE_HOST + img.tmbPath}}" />\n								<div class="edit_content" ng-if="(img.showOp || img.selected) && categoryId == \'0\'">\n									<div class="select" ng-if="!img.selected && categoryId == \'0\'"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/nocheck.jpg"/></div>\n									<div class="select" ng-if="img.selected && categoryId == \'0\'"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/checked.png"/></div>\n									<div class="del" ng-click="deleteImage(img.id, $event)"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_07.png" /></div>\n									<div ng-if="categoryId == \'0\'" class="set btn-group" class="dropdown-toggle"  data-toggle="dropdown" ng-click="prevent(img, $event)">\n										<img id="{{img.id}}" ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_19.png" />\n									</div>	\n									<div class="dropdown-menu set_category" id="{{img.id}}" role="menu">\n										<ul forbidden-close id="cat_tab">\n					                        <li ng-class="{selecttag: dropTagIndex == $index}" ng-repeat="myTag in myTags" ng-click="selectTag(myTag, $index)"><span>{{myTag.name}}</span></li>\n					                        <li ng-click="createCategory();" class="add_cate clearfix"><em>+</em><span>添加分类</span></li>\n				                      	</ul>\n				                      	<div class="fl btn-main" style="width:100%;"><a href="" style="color:#FFF;" ng-click="setCategory(dropTagIndex, img.id)">确定</a></div>\n				                    </div>\n										\n								</div>\n							</li>\n							<li class="imageList" ng-show="fileType == \'1\'"  ng-repeat="img in imgList track by $index" ng-click="switchSelect(img, $event)" ng-mouseenter="hover(img)" ng-mouseleave="hover(img)" ng-class="{hovercolor: img.showOp || img.selected}" right-click>\n								<img ng-src="{{PREFIX_FILE_HOST + img.tmbPath}}"/>\n								<div class="edit_content" ng-show="(img.showOp || img.selected) && categoryId == \'0\'">\n									<div class="select" ng-if="!img.selected && categoryId == \'0\'"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/nocheck.jpg"/></div>\n									<div class="select" ng-if="img.selected && categoryId == \'0\'"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/checked.png"/></div>\n									<div class="del" ng-click="deleteImage(img.id, $event)" ng-click="deleteImg()"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_07.png" /></div>\n									<div class="set btn-group" ng-if="categoryId == \'0\'" class="dropdown-toggle" ng-click="prevent(img, $event)" data-toggle="dropdown">\n										<img id="{{img.id}}" ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_19.png" />\n									</div>\n									<div class="dropdown-menu set_category" role="menu">\n										<ul forbidden-close id="cat_tab">\n					                        <li ng-class="{selecttag: dropTagIndex == $index}" ng-repeat="myTag in myTags" ng-click="selectTag(myTag, $index)"><span>{{myTag.name}}</span></li>\n					                        <li ng-click="createCategory()" class="add_cate clearfix"><em>+</em><span>添加分类</span></li>\n				                      	</ul>\n				                      	<div class="fl btn-main" ng-click="setCategory(dropTagIndex, img.id)" style="width:100%;"><a href="" style="color:#FFF;">确定</a></div>\n				                    </div>\n								</div>\n							</li>\n							<li class="photo_item" style="background-color: {{img.color}}" ng-show="fileType == \'0\' && \'c\' == categoryId" ng-mouseenter="hover(img)" ng-mouseleave="hover(img)" ng-class="{hovercolor: img.showOp || img.selected, mr0: $index%9 == 8}" ng-click="switchSelect(img, $event)"  ng-repeat="img in imgList track by $index">\n							</li>\n						</ul>\n					</div>\n					<div class="fanye_foot clearfix" style="margin-top: 20px;">\n						<div class="fr btn-main" ng-click="replaceImage();"><a href="" style="color:#FFF;">确定</a></div>\n						<div class="pagination_container fl">\n							<pagination style="float: left" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;" max-size="5" items-per-page="pageSize" total-items="totalItems" ng-model="currentPage" ng-change="getImagesByPage(categoryId, currentPage)" boundary-links="true" rotate="true" num-pages="numPages"></pagination>\n					        <div class="current_page">\n					            <input type="text" ng-model="toPage" ng-keyup="$event.keyCode == 13 ? getImagesByPage(categoryId, toPage) : null">\n					            <a ng-click="getImagesByPage(categoryId,toPage)" class="go">GO</a>\n					            <span>当前: {{currentPage}} / {{numPages}} 页</span>\n					        </div>\n					    </div>\n					</div>\n			    </div>\n			</div>\n		</div>\n	</div>')
			}
		]), b.module("scene/console/button.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/button.tpl.html", '<div class="dialog-contain">\n    <div class="dialog-head">\n        <h1>按钮名称</h1>\n        <p ng-show="!authError">可以设置提交按钮</p>\n        <p ng-show="authError">{{authError}}</p>\n    </div>\n    <div class="dialog-content">\n        <form class="form-contain" role="form">\n            <div class="modify_area form-list clearfix">\n                <lable class="form-label">按钮名称：</lable>\n                <div class="form-input">\n                    <input type="text" maxlength="15" ng-model="model.title" ng-keyup="$event.keyCode == 13 ? confirm() : null"/>\n                </div>\n            </div>           \n        </form>\n    </div>\n</div>\n<div class="btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/category.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/category.tpl.html", '<div class="modal-header">\n    <span>创建分类</span>\n</div>\n<div class="modal-body add-new-cat">\n    <input type="text" ng-model="category.name" placeholder="分类名称" />\n</div>\n<div class="btn-contain btn-small">\n    <a ng-click="confirm()" class="btn-main login">确定</a>\n    <a ng-click="cancel();" class="btn-grey0">取消</a>\n</div>    ')
			}
		]), b.module("scene/console/cropimage.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/cropimage.tpl.html", '<div class="dialog-contain cropimage">\n    <div class="dialog-head">\n        <h1>图片裁切</h1>\n        <p style="margin-top:0">请根据您的需要，点击自定义或匹配单签上方按钮进行裁切</p>\n    </div>\n	<div class="crop-content dialog-content">\n		<div class="crop-control">\n			<ul>\n				<li ng-class="{active: !fit}">\n					<div class="pl">\n						<div class="check" ng-click="fit = false"></div>\n						<div class="cha text-center">自定义</div>\n					</div>\n					<div class="pr">\n						<div class="kuan cha" ng-show="!fit">宽度: <span class="cropWidth"></span></div>\n						<div class="kuan cha" ng-show="!fit">高度: <span class="cropHeight"></span></div>\n						<div class="kuan cha"><input type="checkbox" ng-disabled="fit" ng-model="lockRatio"/>锁定当前比例</div>\n					</div>\n				</li>\n				<li ng-class="{active: fit}">\n					<div class="pl">\n						<div class="check" ng-click="fit = true"></div>\n						<div class="cha text-center">匹配当前</div>\n					</div>\n					<div class="pr">\n						<div class="kuan cha" ng-show="fit">宽度: <span class="cropWidth"></span></div>\n						<div class="kuan cha" ng-show="fit">高度: <span class="cropHeight"></span></div>\n						<div class="kuan cha">匹配当前图片框比例</div>\n					</div>\n				</li>\n				<li class="crop-btn fr">\n					<a class=" btn-main" href="" ng-click="crop()">确定</a>\n					<a class=" btn-grey0" style="margin-top:20px;" href="" ng-click="cancel()">取消</a>\n				</li>\n			</ul>\n		</div>\n		<div class="image_crop">\n			<img id="target">\n		</div>\n	</div>\n</div>')
			}
		]), b.module("scene/console/fake.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/fake.tpl.html", '<div></div>')
			}
		]), b.module("scene/console/input.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/input.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>输入框</h1>\n        <p>在场景中添加输入框可以用来收集数据信息</p>\n    </div>\n	<div class="form_console dialog-content">\n		<div class="modify_area">\n			<span class="label">输入框名称：</span>\n			<input type="text" maxlength="15" ng-model="model.title" ng-keyup="$event.keyCode == 13 ? confirm() : null"/>\n			<input type="checkbox" id="checkbox_required" ng-model="model.required" ng-true-value="required" style="margin-top:0;margin-left:5px;" />\n			<label for="checkbox_required" style="font-weight: lighter; margin:0;font-size:12px;">必填</label>\n		\n			<div class="customized_container">\n				<input type="radio" id="input_name" ng-model="model.type" ng-change="model.title=\'姓名\'" value="501" /><label for="input_name">姓名</label>\n				<input type="radio" id="input_phone" ng-model="model.type" ng-change="model.title=\'手机\'" value="502" /><label for="input_phone">手机</label>\n				<input type="radio" id="input_email" ng-model="model.type" ng-change="model.title=\'邮箱\'" value="503" /><label for="input_email">邮箱</label>\n				<input type="radio" id="input_text" ng-model="model.type" ng-change="model.title=\'文本\'" value="5" /><label for="input_text">文本</label>\n			</div>\n		</div>\n	</div>\n</div>\n<div class="btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/link.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/link.tpl.html", '<div class="dialog-contain">\n    <div class="dialog-head">\n        <h1>外链</h1>\n        <p style="margin-top:0">您可以为每个元素添加场景页的链接和外链</p>\n    </div>\n	<div class = "link-modal dialog-content">\n		<form class="form-contain">\n			<div class="form-list clearfix">\n	            <label for="inputPassword3" class="form-label">\n	            	<input type="radio" name="externalRadio" id="externalRadio" ng-model = "url.link" value="external" ng-change = "changed()" style="margin:0px;">网站地址：\n				</label>\n	            <div class="form-input">\n	                <input class = "" style="height:35px;width:280px;" type="text" ng-model = "url.externalLink" name="externalLink" id="externalLink" placeholder = "网站地址" ng-disabled = "url.link == \'internal\'" ng-change = "selectRadio(\'external\')"/>\n					<a style = "font-size: 16px;display: inline-block; margin-top: 5px;background-image: url(\'/addons/Market/Show/public/images/create/delete.png\'); width: 14px; height: 14px;" ng-show = "url.link == \'external\'" class = "delete-link" ng-click = "removeLink(\'external\')"></a>\n	            </div>\n	        </div>\n		</div>\n	</div>\n</div>\n<div class = "btn-contain btn-small">\n	<a class = "btn-main login" ng-click = "confirm()">确定</a>\n	<a class = "btn-grey0 cancel" ng-click = "cancel()">取消</a>\n</div>');
			}
		]), b.module("scene/console/map.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/map.tpl.html", '<div class="map_console">\n	<div id="l-map"></div>\n	<div class="search_area">\n		<div class="input-group">\n		  <input type="text" class="form-control" ng-model="search.address" ng-keyup="$event.keyCode == 13 ? searchAddress() : null" placeholder="请输入地名">\n		  <span class="input-group-btn">\n		    <button ng-click="searchAddress()" class="btn btn-default" type="button">搜索</button>\n		  </span>\n		</div><!-- /input-group -->\n		<div id="r-result">\n			<ul class="list-group">\n				<li class="list-group-item" ng-repeat="address in searchResult" ng-click="setPoint(address.point.lat, address.point.lng, address.address)">\n					{{address.address}}	\n				</li>\n			</ul>\n		</div>\n	</div>\n</div>\n<div class="modal-footer">\n    <a class="btn-main login" style="width: 88px;" ng-click="resetAddress()">确定</a>\n    <a class="btn-grey0 cancel" style="width: 88px;" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/microweb.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/microweb.tpl.html", '<div class="button_console">\n	<div class="modify_area">\n		<div>导航样式:\n			<ul>\n				<li ng-click = "selectColor(color)" ng-class = "{colorborder: model.color == color.backgroundColor}" style = "display: inline-block; margin: 10px;" ng-repeat = "color in backgroundColors"><div style = "width: 50px; height: 30px; margin: 10px; cursor:pointer;" ng-style = "color"></div></li>\n			</ul>\n		</div>\n	</div>\n	<div class = "divider" style = "margin-top: 10px; height: 1px; background: #ccc;"></div>\n	<div class="modify_area">\n		<div>\n			<ul class="clearfix" style="left:50%;margin-left:-160px;position:relative;height:65px;">\n				<li class = "title_color" ng-class = "{colorborder:labelIndex == $index && labelName.mousedown,selectedcolor: labelName.selected,whitecolor: labelName.color.backgroundColor == \'#fafafa\'}" ng-click = "switchLabel(labelName, $index)" style = "display: inline-block;float:left;" ng-repeat = "labelName in labelNames"><div style = "margin: 10px; width:50px; height: 30px;line-height:30px; border: 1px solid #ccc; cursor: pointer;" ng-style = "labelName.color">{{labelName.title}}</div></li>\n			</ul>\n		</div>\n		<span class="label">导航名称：</span>\n		<input type="text" ng-model="model.title" ng-change = "changeLabelName()" ng-keyup="$event.keyCode == 13 ? confirm() : null" placeholder = "导航名称" maxlength = "4"/>\n	</div>\n\n	<div class="modify_area">\n		<span class="label">链接页面：</span>\n		<select style = "width: 181px; height: 30px; display: inline-block;" ng-model = "model.link" ng-options = "page.name for page in pageList" ng-change = "selectLink(model.link)"></select>\n	</div>\n\n	<div class="modify_area" style = "color: #ff0000">\n		至少选择两个标签，并分别添加链接\n	</div>\n	\n</div>\n<div class="modal-footer">\n    <a class="btn-main login" style="width: 88px;" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" style="width: 88px;" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/pictures.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/pictures.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>图集组件</h1>\n        <p>图集中可以添加多张图片</p>\n    </div> \n    <div class="pic-contain">\n        <div class="pic-head clearfix pic-same">\n            <div class="select-img">\n                <a ng-click="choosePic()">选择图片</a>\n                <span>最多可选择6张图片</span>\n            </div>\n            <div class="select-style clearfix">\n                <select ng-model="properties.picStyle" ng-options="pic.desc for pic in picStyles">\n                    <!--<option value ="">图片轮播</option>-->\n                    <!--<option value ="">翻书效果</option>-->\n                    <!--<option value="">轮播效果</option>-->\n                    <!--<option value="">上下效果</option>-->\n                </select>\n                <span class="bg-color" ng-style="{\'background-color\': properties.bgColor}"></span>\n                <span class="select-bg-color" colorpicker="rgba" ng-model="properties.bgColor">背景颜色</span>\n            </div>\n        </div> \n        <div class="pic-img-list pic-same">\n            <ul class="clearfix">\n                <li eqx-pictures-image-click ng-class="{hover: currentImageIndex === $index}" ng-repeat="img in properties.children track by $index">\n                    <img class="pic-img" ng-src="{{PREFIX_FILE_HOST + img.src}}"/>\n                    <i class="delete-img"><img ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/bg_07.png" /></i>\n                </li>\n            </ul>\n        </div>\n        <div class="pic-preview" ng-style="{\'background-color\': properties.bgColor, width: position.width, height: position.height}">\n            <!--<img eqx-image-crop ng-src="{{CLIENT_CDN}}addons/Market/Show/public/images/scene6.jpg" />\n            <div class="operation">\n                <a class="quxiao ">取消</a><a class="finish">完成</a>\n            </div>\n            <div class="shape">\n                <span><a>自由裁切</a>|<a>正方形</a>|<a>标准</a></span>\n            </div>-->\n        </div>\n        <div class="operation-pre">\n            <!--<a class="enhance">增强</a><a class="rotation">旋转</a>-->       </div>\n        <div class="pic-same pic-play clearfix">\n            <div class="set-play clearfix">\n               <!--  class=on  开启 off 关闭 -->\n                <span ng-show="properties.autoPlay"><span class="button on" ng-click="properties.autoPlay = false"><i></i></span>已开启自动播放</span>\n                <span ng-show="!properties.autoPlay"><span class="button off" ng-click="properties.autoPlay = true"><i></i></span>已关闭自动播放</span>\n            </div>\n            <div class="btn-content btn-contain btn-small" style="padding:0">\n                <a class="btn-main login" ng-click="ok()">确定</a>\n                <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n            </div>\n        </div>\n    </div>\n</div>')
			}
		]), b.module("scene/console/setting.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/setting.tpl.html", '<div panel-draggable id="comp_setting">\n	<div class="cancel"><a href="" title="关闭" ng-click="cancel()">x</a></div>\n	<div class="style_head clearfix">\n		<ul class="clearfix">\n			<li><a ng-click="activeTab = \'style\'" ng-class="{hover:activeTab == \'style\'}">样式</a></li>\n			<li><a ng-click="activeTab = \'anim\'" ng-class="{hover:activeTab == \'anim\'}">动画</a></li>\n		</ul>\n	</div>\n	<div class="style_content">\n		<div ng-include="\'scene/console/anim.tpl.html\'"></div>\n		<div ng-include="\'scene/console/style.tpl.html\'"></div>\n		\n	</div>		\n	\n</div>')
			}
		]), b.module("scene/console/style.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/style.tpl.html", '<div ng-if="activeTab == \'style\'" ng-controller="StyleConsoleCtrl">\n	<div class="yangshi">\n		<section>\n			<div class="style_list" ng-init="showBasic=true" ng-click="showBasic = !showBasic; showBorder = false; showShadow = false;">\n				<b class="caret" ng-show="showBasic"></b><b class="caret off" ng-show="!showBasic"></b>基础样式\n			</div>\n			<div ng-show="showBasic"  class="style_con_hei">\n				<div class="style_list_angel clearfix">\n					<label>背景颜色</label>\n					<div class="color_select clearfix">\n						<a class="input_kuang flo_lef" ng-style="{backgroundColor: model.backgroundColor}" ng-model="model.backgroundColor" colorpicker="rgba" ></a>\n			    		<input class=" flo_right" style="width:115px; height:20px;line-height:18px;" style-input elem-id="{{elemDef.id}}" ng-model="model.backgroundColor" css-item="backgroundColor" type="text" />\n			    	</div>\n				</div>\n				<div class="style_list_angel clearfix" ng-show="elemDef.type == \'2\' ||elemDef.type == \'8\' || (\'\'+elemDef.type).charAt(0) == \'6\'">\n			  		<label>文字颜色</label>\n			  		<div class="color_select clearfix">\n			  			<a class="input_kuang flo_lef" ng-style="{backgroundColor: model.color}" ng-model="model.color" colorpicker="rgba" ></a>\n			  			<input class=" flo_right" style="width:115px; height:20px;line-height:18px;" style-input elem-id="{{elemDef.id}}" ng-model="model.color" css-item="color" type="text" />\n			    	</div>\n			  	</div>\n				<div class="style_list_angel clearfix">\n					<label>透明度</label>\n					<div class="touming clearfix">\n				  		<p class="num"><input class="short" type="number" min="0" max="100" limit-input style-input elem-id="{{elemDef.id}}" css-item="opacity" ng-model="model.opacity"/></p>\n						<div style="width: 100px;" ui-slider min="0" max="100" ng-model="model.opacity"></div>\n				  	</div>\n			  	</div>				  	\n			  	<div class="style_list_angel clearfix" ng-show="elemDef.type == \'8\' || (\'\'+elemDef.type).charAt(0) == \'6\' || elemDef.type == \'2\' || (\'\'+elemDef.type).charAt(0) == \'5\'">\n			  		<div>\n						<label>边距</label>\n						<div class="touming clearfix">\n					  		<p class="num"><input class="short" min="0" max="20" limit-input class="input_kuang short" type="number" style-input css-item="padding" ng-model="model.paddingTop"/></p>				\n					  		<div style="width: 100px;" ui-slider min="0" max="20" ng-model="model.paddingTop"></div>\n					  	</div>\n					</div>\n				</div>\n				<div class="style_list_angel clearfix" ng-show="elemDef.type == \'8\' || (\'\'+elemDef.type).charAt(0) == \'6\' || elemDef.type == \'2\' || (\'\'+elemDef.type).charAt(0) == \'5\'">\n					<div>\n						<label>行高</label>\n						<div class="touming clearfix">\n					  		<p class="num"><input class="short" min="0" max="3" limit-input step="0.1" class="input_kuang short" type="number" style-input css-item="lineHeight" ng-model="model.lineHeight"/></p>			\n					  		<div style="width: 100px;" use-decimals step="0.1" ui-slider min="0" max="3" ng-model="model.lineHeight"></div>\n					  	</div>\n					</div>\n				</div>								\n			</div>\n		</section>\n		<section>\n			<div class="style_list" ng-click="showBorder = !showBorder; showBasic=false;showShadow=false;">\n				<b class="caret" ng-show="showBorder"></b><b class="caret off" ng-show="!showBorder"></b>边框样式\n			</div>\n			<div ng-show="showBorder" class="style_con_hei">\n				<div class="style_list_angel clearfix">\n					<label>边框尺寸</label>\n					<div class="touming clearfix">\n				  		<p class="num"><input class="input_kuang short" limit-input type="number" min="0" max="20" style-input css-item="borderWidth" ng-model="model.borderWidth"/></p>				\n				  		<div style="width: 100px;" ui-slider min="0" max="20" ng-model="model.borderWidth"></div>\n				  	</div>\n				</div>\n				<div class="style_list_angel clearfix">\n			  		<label>边框弧度</label>\n			    	<div class="touming clearfix">\n			    		<p class="num"><input class="input_kuang short" type="number" min="0" max="{{maxRadius}}" limit-input style-input css-item="borderRadius" ng-model="model.borderRadius" /></p>  		\n				  		<div class="num" style="width:100px;" ui-slider min="0" max="{{maxRadius}}" ng-model="model.borderRadius"></div>\n			    	</div>\n			  	</div>	\n				<div class="style_list_angel clearfix">\n					<label>边框样式</label>\n					<div class="touming">\n						<select style="border:1px solid #ccc;height:20px;" style-input css-item="borderStyle" ng-model="model.borderStyle">\n							<option value="solid">直线</option>\n							<option value="dashed">破折线</option>\n							<option value="dotted">点状线</option>\n							<option value="double">双划线</option>\n							<option value="groove">3D凹槽</option>\n							<option value="ridge">3D垄状</option>\n							<option value="inset">3D内嵌</option>\n							<option value="outset">3D外嵌</option>\n						</select>\n					</div>\n			  	</div>\n				<div class="style_list_angel clearfix">\n					<label>边框颜色</label>\n					<div class="color_select clearfix">\n						<input class="flo_right short"  style="width:115px; height:20px;line-height:18px;" style-input ng-model="model.borderColor" css-item="borderColor" type="text" />\n						<a class="input_kuang flo_lef" ng-style="{backgroundColor: model.borderColor}" ng-model="model.borderColor" colorpicker="rgba"></a>\n						\n			    	</div>\n			  	</div>\n			  	<div class="style_list_angel clearfix">\n					<div>\n						<label>旋转</label>\n						<div class="touming clearfix">\n					  		<p class="num"><input min="0" max="360" limit-input style-input css-item="transform" class="input_kuang short" type="number"  ng-model="model.transform"/></p>			\n					  		<div style="width: 100px;" ui-slider min="0" max="360" ng-model="model.transform"></div>\n					  	</div>\n					</div>\n				</div>			  	\n			</div>\n		</section>\n		<section>\n			<div class="style_list" ng-click="showShadow = !showShadow; showBasic=false;showBorder=false;">\n				<b class="caret" ng-show="showShadow"></b><b class="caret off" ng-show="!showShadow"></b>阴影样式\n			</div>\n			<div ng-show="showShadow" class="style_con_hei">\n				<div class="style_list_angel clearfix">\n					<label>大小</label>\n					<div class="touming clearfix">\n						<div style="width: 100px;" ui-slider min="0" max="20" ng-model="tmpModel.boxShadowSize"></div>\n						<p class="num"><input limit-input class="input_kuang short" min="0" max="20" type="number" style-input css-item="boxShadow" ng-model="tmpModel.boxShadowSize"/></p>\n					</div>\n			  	</div>\n			  	<div class="style_list_angel clearfix">\n					<label>模糊</label>\n					<div class="touming clearfix">\n						<div style="width: 100px;" ui-slider min="0" max="20" ng-model="tmpModel.boxShadowBlur"></div>\n						<p class="num"><input limit-input class="input_kuang short" min="0" max="20" type="number" style-input css-item="boxShadow" ng-model="tmpModel.boxShadowBlur"/></p>\n					</div>\n			  	</div>\n			  	<div class="style_list_angel clearfix">\n					<label>颜色</label>\n					<div class="clearfix color_select">\n			    		<input class=" flo_right short" style="width:115px; height:20px;line-height:18px;" style-input  ng-model="tmpModel.boxShadowColor" css-item="boxShadow" type="text" />	\n						<a class="input_kuang flo_lef" ng-style="{backgroundColor: tmpModel.boxShadowColor}" ng-model="tmpModel.boxShadowColor" colorpicker="rgba" colorpicker-fixed-position="true"></a>\n			    	</div>\n				</div>	\n			  	<div class="style_list_angel clearfix">\n					<label>方向</label>\n					<div class="clearfix">\n				  		<div class="fr">\n				  			<p class="num" style="margin-top:18px;"><input style="width:58px;margin-right:5px;padding:0;" min="0" max="359" limit-input class="input_kuang" type="number" style-input css-item="boxShadow" ng-model="tmpModel.boxShadowDirection" /></p></div>					\n				  		<angle-knob class="flo_lef" style="display: block;position: relative;height: 55px;margin-left:28px;margin-top:5px;"></angle-knob>\n				  	</div>\n				</div>\n			</div>\n	</div>\n	</section>\n	</div>\n	<div class="modal-footer">\n		<a class="btn-main" ng-click="cancel()">确定</a>\n		<a class="btn-grey0" ng-click="clear()">清除样式</a>\n	</div>\n</div>\n')
			}
		]), b.module("scene/console/tel.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/tel.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>电话组件</h1>\n        <p>填写按钮名称和联系号码，点击可以直接拨打</p>\n    </div>\n	<div class="button_console dialog-content">\n		<form class="form-contain" form="role">\n			<div class="modify_area  tel_title">\n				<span ng-repeat = "button in buttons track by $index" ng-class = "{spanborder: $index == btnIndex}">\n					<!-- <a ng-class = "{btn1: $index==0, btn2: $index == 1, btn3: $index ==2, btn4: $index ==3}" ng-click = "chooseTelButton(button, $index, $event)" selected><span class = "glyphicon glyphicon-earphone"></span>{{button.text}}</a> -->\n					<a ng-style = "button.btnStyle" ng-click = "chooseTelButton(button, $index, $event)" selected>{{button.text}}</a>\n				</span>\n			</div>\n			<div class="form-list clearfix">\n	            <label for="inputPassword3" class="form-label">按钮名称：</label>\n	            <div class="form-input">\n	                <input type="text" ng-model="model.title" ng-keyup="$event.keyCode == 13 ? confirm() : null"/>\n	            </div>\n	        </div>\n			<div class="form-list clearfix">\n	            <label for="inputPassword3" class="form-label">手机/电话：</label>\n	            <div class="form-input">\n	                <input class = "tel-button" type="text" placeholder = "010-88888888" ng-model="model.number" ng-keyup="$event.keyCode == 13 ? confirm() : null" ng-focus = "removePlaceHolder($event)" ng-blur = "addPlaceHolder()"/>\n	            </div>\n	        </div>	        \n		</form>\n	</div>\n</div>\n<div class="btn-content btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/console/video.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/console/video.tpl.html", '<div class="dialog-contain ">\n    <div class="dialog-head">\n        <h1>视频组件</h1>\n        <p>把视频通用代码复制到框中即可使用</p>\n    </div>\n	<div class="nav-list">\n		<ul>\n			<li class="active">视频</li>\n		</ul>\n	</div>    \n	<div class="video_console dialog-content">\n		<div class="modify_area" style="height:auto">\n			<div class="video_tip">\n				<span>视频通用代码：</span>\n				<span class="video_code"><a href="" target="_blank"><ins>什么是视频通用代码？</ins></a></span>\n			</div>\n			<div class="video_tip">\n				<textarea style="border-radius:0px;" class = "video_src" ng-model="model.src" ng-keyup="$event.keyCode == 13 ? confirm() : null"/>\n			</div>\n			<div class="video_tip">将视频的通用代码粘贴到文本框里即可。<a href="" target="_blank"><ins>查看帮助</ins></a></div>\n			<div class="video_tip">支持的视频：<a href="http://www.youku.com/" target="_blank"><ins>优酷</ins></a>、<a href="http://www.tudou.com/" target="_blank"><ins>土豆</ins></a>、<a href="http://v.qq.com/" target="_blank"><ins>腾讯视频</ins></a></div>\n		</div>	\n	</div>\n</div>\n<div class="btn-contain btn-small">\n    <a class="btn-main login" ng-click="confirm()">确定</a>\n    <a class="btn-grey0 cancel" ng-click="cancel()">取消</a>\n</div>')
			}
		]), b.module("scene/create.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/create.tpl.html", '<div class="creat_head">\n  <div class="creat_head_con clearfix">\n	<div class="creat_logo"><a href="'+PREFIX_HOST+'hcc/main.html" ng-click="stopCopy()"><img ng-src="/addons/Market/Show/public/images/back.jpg" /></a></div>\n	<div class="creat_con clearfix">\n		<ul class="comp_panel clearfix">\n		  <li comp-draggable="panel" ctype="2" class="comp-draggable text" title="请拖动到编辑区域" ng-click="createComp(\'2\');">\n			<span>文本</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="3" class="comp-draggable bg" title="请拖动到编辑区域" ng-click="createComp(\'3\');">\n			<span>背景</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="9" class="comp-draggable music" title="请拖动到编辑区域" ng-click="createComp(\'9\');">\n			<span>音乐</span>\n		  </li>  \n		  <li comp-draggable="panel" ctype="v" class="comp-draggable vedio" title="请拖动到编辑区域" ng-click="createComp(\'v\');">\n			<span>视频</span>\n		  </li>        \n		  <li comp-draggable="panel" ctype="4" class="comp-draggable image" title="请拖动到编辑区域" ng-click="createComp(\'4\');">\n			<span>图片</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="5" class="comp-draggable textarea" title="请拖动到编辑区域" ng-click="createComp(\'5\');">\n			<span>输入框</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="6" class="comp-draggable button" title="请拖动到编辑区域" ng-click="createComp(\'6\');">\n			<span>按钮</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="p" class="comp-draggable images hidden" title="请拖动到编辑区域" ng-click="createComp(\'p\');">\n			<span>图集</span>\n		  </li>\n		  <li comp-draggable="panel" ctype="8" class="comp-draggable phone" title="请拖动到编辑区域" ng-click="createComp(\'8\');">\n			<span>电话</span>\n		  </li>          \n		  <li comp-draggable="panel" ctype="g101" class="comp-draggable contact" title="请拖动到编辑区域" ng-click="createCompGroup(\'g101\');">\n			<span>联系人</span>\n		  </li>          \n		  <li ng-click="openOneEffectPanel(oneEffect)" class="texiao">\n			<span><a id = "toggle_button" class="page_effect" >特效</a></span></li>\n		</ul>\n  </div>\n	<div class="create-action">\n		<ul>\n			<li class="act-border save"><span class="create-save" ng-click="saveScene(true)">保存</span></li>\n			<li class="publish"><span class="create-publish" ng-click="publishScene()">预览</span></li>\n			<li class="act-border quit"><a href="'+PREFIX_HOST+'hcc/main.html"><span class="create-quit" style="color:#fff">退出</span></a></li> \n		</ul>\n	</div>\n	<div ng-hide="showToolBar();">\n		<div ng-show="isEditor" style="position: absolute;right: -200px;top: 20px;">\n			<select ng-model="tpl.obj.scene.isTpl">\n				<option value="0">非模板</option>\n				<option value="1">保存为pc模板</option>\n				<option value="2">保存为移动端模板</option>\n			</select>\n		</div>\n	</div>\n</div>\n</div>\n<div class="create_scene">\n  <div class="main clearfix">\n	  <div class="content">\n		  <div class="create_left">\n			<tabset justified="true">\n			  <tab heading="" class="hint--bottom hint--rounded" style = "width: 290px;">\n				  <tabset justified="true" class="tpl_tab">\n					<tab ng-repeat="pageTplType in pageTplTypes" heading="{{pageTplType.name}}" ng-click="getPageTplsByType(pageTplType.value)">\n					  <div class="nav2 clearfix" dropdown >\n						<div class="others dropdown-toggle" ng-show="otherCategory.length > 0"><span></span></div>\n						<ul class="clearfix nav2_list">\n						  <li ng-class="{active:childCat.id == categoryId}" ng-click="getPageTplTypestemp(childCat.id ,bizType)" ng-repeat="childCat in childCatrgoryList">{{childCat.name}}</li>\n						</ul>\n						<ul class="clearfix nav2_other dropdown-menu">\n						  <li ng-class="{active:othercat.id == categoryId}" ng-click="getPageTplTypestemp(othercat.id ,bizType)" ng-repeat="othercat in otherCategory">{{othercat.name}}</li>\n						</ul>                        \n					  </div>\n					  <ul class="page_tpl_container clearfix">\n						<li class="page_tpl_item" ng-repeat="pageTpl in pageTpls" class="comp-draggable" title="点击插入编辑区域" ng-click="insertPageTpl(pageTpl.id);">\n						  <img ng-src="{{PREFIX_FILE_HOST + pageTpl.properties.thumbSrc}}" />\n						</li>\n					  </ul>\n					</tab>\n										<!-- 获取企业模板 -->\n					<tab ng-repeat="mycompany in myCompany" heading="{{myCompany[0].name}}" active="mycompany.active" ng-if = "pageTplTypes" ng-click = "getPageTplsByCompanyType()" ng-show="userProperty.type ==2 || userProperty.type ==21">\n						<div style="padding:10px;" ng-hide="myCompanyTpls">在页面管理中选中页面，点击企业模板，即可生成企业页面模板！</div>\n						<ul class="page_tpl_container clearfix">\n							<li thumb-tpl my-tpl="pageTpl" style="position: relative;" id="company-tpl" class="nr page_tpl_item comp-draggable my-tpl" ng-repeat="pageTpl in myCompanyTpls" title="点击插入编辑区域" ng-click="insertPageTpl(pageTpl.id);">\n							</li>\n						</ul>\n					</tab>                    \n				  </tabset>\n			  </tab>\n			</tabset>\n		  </div> \n		  <div class="phoneBox" multi-comp-drag>\n			<div edit-common edit-keymap>\n				<div class="top"></div>\n				<div class = "phone_menubar"></div>\n				<div class="scene_title_baner">\n				  <div ng-bind="tpl.obj.scene.name" class="scene_title"></div>\n				</div>\n				<div class="nr sortable" id="nr" element-anim></div>\n				<div class="bottom"></div>\n	</div>\n			<div class="phone_texiao">\n				<div id="editBG" style="display: none;">\n					<span class="hint--right hint--rounded" data-hint="选择新背景">背景</span><div style="margin:10px 0;border-bottom: 2px solid #666;"></div><a style = "color: #666;" class="hint--bottom hint--rounded" data-hint="删除当前页面的背景"><span ng-click="removeBG($event)" class="glyphicon glyphicon-remove"></span></a>\n				</div>\n				<div id="editBGAudio" ng-click="openAudioModal()" ng-show="tpl.obj.scene.image.bgAudio">\n					<span class="hint--right hint--rounded" data-hint="选择新音乐">音乐</span><div style="margin:10px 0;border-bottom: 2px solid #666;"></div><a style = "color: #666;" class="hint--bottom hint--rounded" data-hint="删除当前页面的音乐"><span ng-click="removeBGAudio($event)" class="glyphicon glyphicon-remove"></span></a>\n				</div>\n				<div id="editScratch" ng-click="openOneEffectPanel(tpl.obj.properties)" ng-show="tpl.obj.properties">\n					<span class="hint--right hint--rounded" data-hint="选择新特效">{{effectName}}</span><div style="margin:10px 0;border-bottom: 2px solid #666;"></div><a style = "color: #666;" class="hint--bottom hint--rounded" data-hint="删除当前页面特效"><span ng-click="removeScratch($event)" class="glyphicon glyphicon-remove"></span></a>\n				</div>\n			</div>\n			<div class="history">\n				<a title="撤销(ctrl+z)" ng-click="back()"><i class="fa fa-reply" ng-class="{active: canBack}"></i></a>\n				<a title="恢复(ctrl+y)" ng-click="forward()"><i class="fa fa-share" ng-class="{active: canForward}"></i></a>\n				<a title="刷新预览" style="margin-top:10px;" ng-click="refreshPage(tpl.obj, pageNum, $event)"><i class="fa refresh"></i></a>				\n			</div>\n		  </div>\n		  <div id = "containment" class="create_right"> \n		<div class = "nav_top">\n			  <div class="nav_top_list">\n				<a ng-click="duplicatePage()" class="">复制</a>\n						<a ng-click = "creatCompanyTemplate()" ng-show="userProperty.type ==2">企业模版</a>\n				<a class="" ng-click = "deletePage($event)" ng-show = "pages.length != 1">删除</a>\n			  </div>\n			  <div class = "btn-group">\n				<div class="dropdown">\n				  <div id = "page_panel" ng-show="showPageEffect" class="dropdown-menu1 panel panel-default">\n					<ul class = "effect_list">\n					  <li class = "effect" ng-repeat = "effect in effectList" ng-click = "openOneEffectPanel(effect)">\n						<div class = "effect_img"><img ng-src="{{effect.src}}"></div>\n						<div class = "effect_info">{{effect.name}}</div>\n					  </li>\n					</ul>\n				  </div>\n				  <div id = "page_panel" ng-if="effectType == \'scratch\'" class="dropdown-menu1 panel panel-default">\n					<div class="panel-heading">涂抹设置</div>\n					<div class="panel-body">\n					  <form class="form-horizontal" role="form">\n						<div class="form-group form-group-sm clearfix" style="margin-bottom:0;">\n						  <label class="col-sm-5 control-label">覆盖特效</label>\n						  <div class="col-sm-7">\n							<select ng-model = "scratch.image" ng-options = "scracthImage.name for scracthImage in scratches"  style="width:115px;">\n							</select>\n						  </div>\n						</div>\n						<div class="form-group form-group-sm" style="margin-bottom:0px;margin-top:5px;">\n						  <label class="col-sm-5 control-label" style="padding-top:6px;">覆盖图片</label>\n						  <div class="col-sm-7">\n							<a ng-click = "openUploadModal()" class = "auto_img btn-main btn-success ">自定义图片</a>\n						  </div>\n						</div>\n						<div class = "divider" style="margin-top:6px;"></div>\n						<div class = "well" style="margin-bottom:0px;">\n						  <img class = "scratch" ng-src="{{scratch.image.path}}"/>\n						</div>\n						<div class = "divider"></div>\n						<div class="form-group form-group-sm" style="margin-bottom:10px;">\n						  <label for="inputEmail3" class="col-sm-5 control-label">涂抹比例</label>\n						  <div class="col-sm-7">\n							<select ng-model = "scratch.percentage" ng-options = "percentage.name for percentage in percentages">\n							</select>\n						  </div>\n						</div>\n						 <div class="form-group form-group-sm" style="margin-bottom:10px;">\n						  <label for="inputEmail3" class="col-sm-5 control-label">提示文字</label>\n						  <div class="col-sm-7">\n							<input type="text" ng-model = "scratch.tip" id="inputEmail3" placeholder="提示文字" maxlength = "15">\n						  </div>\n						</div>\n						<div class="form-group form-group-sm" style="margin-bottom:0px;">\n						  <div class="modal-footer" style="padding-bottom:0px;">\n							<a dropdown-toggle type="button" ng-click = "saveEffect(scratch)" class="btn-main" style="width:88px;border:none;">保存</a>\n							<a dropdown-toggle type="button" ng-click = "cancelEffect()" class="btn-grey0" style="width:88px;">取消</a>\n						  </div>\n						</div>\n					  </form>\n					</div>\n				  </div>\n\n				  <div id = "page_panel" ng-if="effectType==\'finger\'" class="dropdown-menu1 panel panel-default">\n\n					<div class="panel-heading">指纹设置</div>\n					<div class="panel-body">\n					  <form class="form-horizontal" role="form">\n						<div class="form-group form-group-sm" style="margin-bottom:10px;">\n						  <label class="col-sm-5 control-label">背景图片</label>\n						  <div class="col-sm-7">\n							<select ng-model = "finger.bgImage" ng-options = "bgImage.name for bgImage in fingerBackgrounds">\n							</select>\n						  </div>\n						</div>\n						<div class="form-group form-group-sm" style="margin-bottom:10px;">\n						  <label class="col-sm-5 control-label">指纹图片</label>\n						  <div class="col-sm-7">\n							<select ng-model = "finger.zwImage" ng-options = "zwImage.name for zwImage in fingerZws">\n							</select>\n						  </div>\n						</div>\n						<div class = "divider"></div>\n						<div class = "well" style="margin-bottom:15px;">\n						  <img class = "finger_bg" ng-src="{{finger.bgImage.path}}"/>\n							\n							<img class = "finger_zw" ng-src="{{finger.zwImage.path}}"/>\n						  					\n						</div>\n						<div class="form-group form-group-sm" style="margin-bottom:0px;">\n						  <div class="modal-footer" style="padding-bottom:0px;">\n							<a class="btn-main" dropdown-toggle type="button" ng-click = "saveEffect(finger)" class="btn btn-success btn-sm btn-main login" style="width:88px;">保存</a>\n							<a dropdown-toggle type="button" ng-click = "cancelEffect()" class="btn-grey0" style="width:88px;">取消</a>\n						  </div>\n						</div>\n					  </form>\n					</div>\n				  </div>\n				  <div id = "page_panel" ng-show="effectType == \'money\'" class="dropdown-menu1 panel panel-default">\n					<div class="panel-heading">数钱设置</div>\n					<div class="panel-body">\n					  <div class = "well" style="margin-bottom:15px;">\n						  <img ng-src="{{CLIENT_CDN + \'addons/Market/Show/public/images/create/money_thumb2.jpg\'}}"/>      \n					  </div>\n					  <div>\n						<span>文字提示：</span>\n						<span class="fr" style="width: 140px;"><input type="text" ng-model="money.tip" placeholder="让你数到手抽筋"></span>\n					  </div>\n					  <div class="form-group form-group-sm" style="margin-bottom:0px;">\n						<div class="modal-footer" style="padding-bottom:0px;">\n						  <a class="btn-main" dropdown-toggle type="button" ng-click = "saveEffect(money)" class="btn btn-success btn-sm btn-main login" style="width:88px;">保存</a>\n						  <a dropdown-toggle type="button" ng-click = "cancelEffect()" class="btn-grey0" style="width:88px;">取消</a>\n						</div>\n					  </div>\n					</div>\n				  </div>\n				  <div ng-include="\'scene/effect/falling.tpl.html\'"></div>\n				</div>\n			  </div>\n			</div>\n\n			<div class="nav_content">\n			  <ul id = "pageList" ui-sortable = "sortableOptions" ng-model="pages">\n				<li class = "blurClass" ng-repeat="page in pages track by $index" ng-click="navTo(page, $index, $event)" ng-init = "editableStatus[$index] = false" ng-class="{current: pageNum-1 == $index}" blur-children>\n					<span style = "float: left; margin-top: 17px; background: #fff; color: #666; font-weight: 200;border-radius:9px;width:18px;height:18px;padding:0px;text-align:center;line-height:18px;" class = "badge">{{$index+1}}</span>\n					<span style = "margin-left: 17px;font-size:14px;" ng-click = "editableStatus[$index] = true" ng-show = "!editableStatus[$index]">{{page.name}}</span>\n					<input style = "width: 80px; height: 25px; margin-top: 8px; margin-left: 10px; color: #999;" type = "text" ng-model = "page.name" ng-show = "editableStatus[$index]" ng-blur = "editableStatus[$index] = false;savePageNames(page, $index)" ng-focus = "getOriginPageName(page)" maxlength = "7" custom-focus/>                   \n				</li>\n			  </ul>\n			  <div class = "page-list-label" ng-show="isEditor && pageList == true">  \n				  <label ng-repeat = "allchild in pageLabelAll">\n					  <input type="checkbox" name="" value="" ng-model = "allchild.ischecked">{{allchild.name}}\n				  </label>                                                 \n				  <div class="select-labels">\n					  <a ng-click="pageChildLabel()">确定</a>\n				  </div>\n			  </div>               \n			</div>\n			<div class="nav_bottom">\n			  <a ng-click="insertPage()" class="" title="增加一页">+</a>\n			 <!--  <a ng-click="duplicatePage()" class="duplicate_page">复制一页</a> -->\n			</div>\n\n			<div ng-show="isEditor">\n			  <div class="btn-main" ng-click="chooseThumb()">选择本页缩略图</div>\n			  <img width="100" ng-src="{{PREFIX_FILE_HOST + tpl.obj.properties.thumbSrc}}"></img>\n			</div>\n		  </div>\n		  <div ng-include="\'scene/edit/select/select.tpl.html\'" ng-controller="selectCtrl">\n	  </div>\n  </div>\n</div>\n</div>\n');

			}
		]), b.module("scene/createNew.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/createNew.tpl.html", '')
			}
		]), b.module("scene/edit/select/select.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/edit/select/select.tpl.html", '<div class="select-panel" ng-show="showSelectPanel" panel-draggable>\n    <div class="select-header">多选操作</div>\n    <div class="select-content">\n        <ul>\n            <li><a title="左对齐" eqx-align-left><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-left.png" alt="左对齐"/></a></li>\n            <li><a title="水平居中对齐" eqx-align-horizontal-center><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-middle-horizontal.png" alt="水平居中对齐"/></a></li>\n            <li><a title="右对齐" eqx-align-right><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-right.png" alt="右对齐"/></a></li>\n            <li><a title="上对齐" eqx-align-top><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-top.png" alt="上对齐"/></a></li>\n            <li><a title="垂直居中对齐" eqx-align-vertical-center><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-middle-vertical.png" alt="垂直居中对齐"/></a></li>\n            <li><a title="下对齐" eqx-align-bottom><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-bottom.png" alt="下对齐"/></a></li>\n        </ul>\n        <ul>\n            <li><a title="复制" eqx-copy><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-copy.png" alt="复制"></a></li>\n            <li><a title="粘贴" eqx-paste ng-style="{opacity: pasteOpacity}"><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-paste.png" alt="粘贴"></a></li>\n            <li><a title="删除" eqx-delete-more><img src="{{CLIENT_CDN}}addons/Market/Show/public/images/select/scene-all-delete.png" alt="删除"></a></li>\n        </ul>\n    </div>\n</div>')
			}
		]), b.module("scene/effect/falling.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/effect/falling.tpl.html", '<div id = "page_panel" ng-if="effectType == \'fallingObject\'" class="dropdown-menu1 panel panel-default">\n    <div class="panel-heading">落物设置</div>\n    <div class="panel-body">\n      <form class="form-horizontal" role="form">\n        <div class="form-group form-group-sm" style="margin-bottom:10px;">\n          <label class="col-sm-5 control-label">环境图片</label>\n          <div class="col-sm-7">\n            <select ng-model = "falling.src" ng-options = "fallingObj.name for fallingObj in fallings">\n            </select>\n          </div>\n        </div>\n        <div class = "divider"></div>\n        <div class = "well" style="margin-bottom:15px;text-align: center;background-color: #ddd">\n          <img ng-src="{{falling.src.path}}"/>\n        </div>\n        <div class = "divider"></div>\n        <div class="form-group form-group-sm" style="margin-bottom:10px;">\n          <label class="col-sm-5 control-label">环境氛围</label>\n          <div class="col-sm-7">\n          	<div style="line-height: 24px;font-size: 12px;"><span style="margin-right:39px;">弱</span><span style="margin-right:37px;">中</span><span>强</span></div>\n          	<div style="width: 100px;" ui-slider min="1" max="3" ng-model="falling.density"></div>\n\n          </div>\n        </div>\n        \n        <div class="form-group form-group-sm" style="margin-bottom:0px;">\n          <div class="modal-footer" style="padding-bottom:0px;">\n            <a class="btn-main" dropdown-toggle type="button" ng-click = "saveEffect(falling)" class="btn btn-success btn-sm btn-main login" style="width:88px;">保存</a>\n            <a dropdown-toggle type="button" ng-click = "cancelEffect()" class="btn-grey0" style="width:88px;">取消</a>\n          </div>\n        </div>\n      </form>\n    </div>\n  </div>')
			}
		]), b.module("scene/scene.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("scene/scene.tpl.html", '')
			}
		]), b.module("usercenter/console/branch.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/console/branch.tpl.html", '')
			}
		]), b.module("usercenter/console/relAccount.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/console/relAccount.tpl.html", '')
			}
		]), b.module("usercenter/console/upgrade_company.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/console/upgrade_company.tpl.html", '')
			}
		]), b.module("usercenter/request_reg.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/request_reg.tpl.html", '<div class="request_reg">\n	<div class="close" ng-click="cancel()">x</div>\n	<div class="erwei" qr-code qr-url="{{PREFIX_CLIENT_HOST + \'m/#/wxLogin?id=\' + currentUser.id}}"></div>\n<!-- 	<div class="erwei" qr-code qr-url="{{PREFIX_CLIENT_HOST + \'m/#/wxreg?id=\' + currentUser.id}}"></div>	 -->	\n</div>')
			}
		]), b.module("usercenter/tab/account.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/tab/account.tpl.html", '')
			}
		]), b.module("usercenter/tab/message.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/tab/message.tpl.html", '')
			}
		]), b.module("usercenter/tab/reset.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/tab/reset.tpl.html", '')
			}
		]), b.module("usercenter/tab/userinfo.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/tab/userinfo.tpl.html", '<div class="panel panel-default">\n  <div class="panel-body">\n    <fieldset ng-disabled  = "!editInfo.isEditable">                 \n      <form class="form-horizontal" role="form" style="margin-left:220px;margin-top:25px;">\n        <div class="form-group" style="margin-bottom: 22px;">\n          <label for="inputPassword3" class="col-sm-2 control-label">登录账号</label>\n          <div class="col-sm-6" style="top: 6px;">{{userinfo.noRel || userinfo.loginName}}</div>\n        </div>\n        <div ng-show="userProperty.type !==2">\n            <div class="form-group">\n              <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>\n              <div class="col-sm-6">\n                <input type="text" class="form-control" ng-model = "userinfo.name" id="inputEmail3" placeholder="用户名" maxlength = "12">\n              </div>\n            </div>\n            <div class="form-group">\n              <label class="col-sm-2 control-label">性别</label>\n              <div class="col-sm-6">\n                <label class="radio-inline">\n                  <input type="radio" ng-model = "userinfo.sex" id="inlineRadio1" value="1"> 男\n                </label>\n                <label class="radio-inline">\n                  <input type="radio" ng-model = "userinfo.sex" id="inlineRadio2" value="2"> 女\n                </label>\n              </div>\n            </div>\n            <div class="form-group">\n              <label for="inputEmail3" class="col-sm-2 control-label">手机</label>\n              <div class="col-sm-6">\n                <input type="text" class="form-control" ng-model = "userinfo.phone" id="inputEmail3" placeholder="手机">\n              </div>\n            </div>\n            <div class="form-group">\n              <label for="inputPassword3" class="col-sm-2 control-label">QQ</label>\n              <div class="col-sm-6">\n                <input type="text" class="form-control" ng-model = "userinfo.qq" id="inputPassword3" placeholder="QQ">\n              </div>\n            </div>\n            <div class="form-group">\n              <label for="inputPassword3" class="col-sm-2 control-label">座机</label>\n              <div class="col-sm-6">\n                <input type="text" class="form-control" ng-model = "userinfo.tel" id="inputPassword3" placeholder="座机">\n              </div>\n            </div>\n      </div>\n      <div ng-show="userProperty.type ==2">\n          <div class="form-group">\n            <label for="inputCompany" class="col-sm-2 control-label">企业</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.name" id="inputCompany" placeholder="企业">\n            </div>\n          </div> \n          <div class="form-group">\n            <label for="inputWeb" class="col-sm-2 control-label">网址</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.website" id="inputWeb" placeholder="网址">\n            </div>\n          </div> \n          <div class="form-group">\n            <label for="inputAddress" class="col-sm-2 control-label">地址</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.address" id="inputAddress" placeholder="地址">\n            </div>\n          </div>\n          <div class="form-group">\n            <label for="inputcontacts" class="col-sm-2 control-label">联系人</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.contacts" id="inputcontacts" placeholder="联系人" maxlength = "12">\n            </div>\n          </div> \n          <div class="form-group">\n            <label for="inputEmail3" class="col-sm-2 control-label">手机</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.tel" id="inputEmail3" placeholder="手机">\n            </div>\n          </div>  \n          <div class="form-group">\n            <label for="inputEmail3" class="col-sm-2 control-label">座机</label>\n            <div class="col-sm-6">\n              <input type="text" class="form-control" ng-model = "companyInfo.mobile" id="inputEmail3" placeholder="座机">\n            </div>\n          </div>                                                        \n      </div>     \n      <div class="form-group">\n        <div>\n          <script type="text/javascript" src="http://api.geetest.com/get.php?gt=1ebc844c9e3a8c23e2ea4b567a8afd2d"></script>\n        </div>\n      </div>\n      <div class="form-group">\n        <div class="col-sm-offset-2 col-sm-10">\n          <a class="btn-main" ng-show = "editInfo.isEditable && userProperty.type !==2" ng-click = "saveUserInfo(userinfo)">保存</a>\n          <a class="btn-main" ng-show = "editInfo.isEditable && userProperty.type ==2" ng-click = "saveCompanyInfo(companyInfo)">保存</a>          \n          <a class="btn-grey0" ng-click = "cancel();" ng-show = "editInfo.isEditable">取消</a>\n        </div>\n        <div class="col-sm-offset-2 col-sm-10"><a class="btn-main" ng-click = "editInfo.isEditable = true;" ng-show="!editInfo.isEditable"><span>编辑</span></a></div> \n      </div>\n    </form>\n    </fieldset>\n  </div>\n</div>')
			}
		]), b.module("usercenter/tab/xd.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/tab/xd.tpl.html", '');
			}
		]), b.module("usercenter/transfer.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/transfer.tpl.html", '<div></div>')
			}
		]), b.module("usercenter/usercenter.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("usercenter/usercenter.tpl.html", '<div></div>')
			}
		]), b.module("templates-common", ["directives/lineChart.tpl.html", "directives/mapeditor.tpl.html", "directives/page-tpl-types.tpl.html", "directives/pieChart.tpl.html", "directives/toolbar.tpl.html", "security/login/form.tpl.html", "security/login/reset.tpl.html", "security/login/toolbar.tpl.html", "security/register/otherregister.tpl.html", "security/register/register.tpl.html"]), b.module("directives/lineChart.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("directives/lineChart.tpl.html", '<canvas id="chart-area" width="300" height="300"/>')
			}
		]), b.module("directives/mapeditor.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("directives/mapeditor.tpl.html", '\n\n<div class="col-lg-6">\n	<div class="input-group">\n	  <input type="text" class="form-control" ng-model="address" placeholder="请输入地名">\n	  <span class="input-group-btn">\n	    <button ng-click="searchAddress()" class="btn btn-default" type="button">搜索</button>\n	  </span>\n	</div><!-- /input-group -->\n</div><!-- /.col-lg-6 -->\n<div id="r-result"></div>')
			}
		]), b.module("directives/page-tpl-types.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("directives/page-tpl-types.tpl.html", '<div class="btn-group" style="padding: 0;">\n    <div class="dropdown">\n        <a class="btn dropdown-toggle first-child" data-toggle="dropdown" title="页面模板" style=" color: #fff;">\n            页面模板\n            &nbsp;\n            <b class="caret">\n            </b>\n        </a>\n        <ul class="dropdown-menu size-menu">\n            <li ng-repeat="type in pageTplTypes">\n                <a ng-href="#/scene/create/{{type.value}}?pageId=1">\n                    {{type.name}}\n                </a>\n            </li>\n        </ul>\n    </div>\n</div>')
			}
		]), b.module("directives/pieChart.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("directives/pieChart.tpl.html", '<canvas id="chart-area" width="300" height="300"/>')
			}
		]), b.module("directives/toolbar.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("directives/toolbar.tpl.html", '<div class="btn-toolbar" id="btn-toolbar"  data-role="editor-toolbar">\n    <div class="btn-group">\n        <div class="dropdown">\n            <a class="btn dropdown-toggle first-child" data-toggle="dropdown" title="文字大小">\n                <i class="glyphicon glyphicon-text-width">\n                </i>\n                &nbsp;\n                <b class="caret">\n                </b>\n            </a>\n            <ul class="dropdown-menu size-menu">\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 7">\n                        48px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 6">\n                        32px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 5">\n                        24px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 4">\n                        18px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 3">\n                        16px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 2">\n                        13px\n                    </a>\n                </li>\n                <li>\n                    <a dropdown-toggle data-edit="fontSize 1">\n                        12px\n                    </a>\n                </li>\n            </ul>\n        </div>\n    </div>\n    <div class="btn-group">\n        <div class="dropdown">\n            <a class="btn dropdown-toggle" data-toggle="dropdown" title="文字颜色">\n                <i class="glyphicon glyphicon-font color-btn">\n                </i>\n                &nbsp;\n                <b class="caret">\n                </b>\n            </a>\n            <ul class="dropdown-menu color-menu">\n            </ul>\n        </div>\n    </div>\n    <div class="btn-group">\n        <div class="dropdown">\n            <a class="btn dropdown-toggle" data-toggle="dropdown" title="文字背景颜色">\n                <i class="glyphicon glyphicon-font bgcolor-btn">\n                </i>\n                &nbsp;\n                <b class="caret">\n                </b>\n            </a>\n            <ul class="dropdown-menu bgcolor-menu">\n            </ul>\n        </div>\n    </div>\n    <div class="btn-group">\n        <a class="btn" data-edit="bold" title="文字加粗">\n            <i class="glyphicon glyphicon-bold">\n            </i>\n        </a>\n    </div>\n    <div class="btn-group">\n        <a class="btn" data-edit="justifyleft" title="文字居左">\n            <i class="glyphicon glyphicon-align-left">\n            </i>\n        </a>\n        <a class="btn" data-edit="justifycenter" title="文字居中">\n            <i class="glyphicon glyphicon-align-center">\n            </i>\n        </a>\n        <a class="btn" data-edit="justifyright" title="文字居右">\n            <i class="glyphicon glyphicon-align-right">\n            </i>\n        </a>\n    </div>\n    <div class="btn-group">\n        <a class="btn" ng-click="increaseLineHeight()" title="增大行间距">\n            <i class="fa fa-dedent"></i>\n        </a>\n        <a class="btn" ng-click="decreaseLineHeight()" title="减小行间距">\n            <i class="fa fa-indent"></i>\n        </a>\n    </div>\n    <div class="btn-group">\n        <div class="dropdown">\n            <a class="btn dropdown-toggle createLink" data-toggle="dropdown" sceneid = "{{sceneId}}" title="添加超链接：先选中要加连接的文字"><i class="fa fa-link"></i></a>\n            <div class="dropdown-menu input-append" style="min-width: 335px;padding:4px 4px 14px 19px;">\n                <div class = "span4" style="margin-top:10px;">\n                    <input name = "external" ng-model = "link" class = "span2" type = "radio" value = "external" style="vertical-align:middle;margin:0px;"> 网站地址：\n                    <input class="span2" placeholder="URL" sceneid="{{sceneId}}" type="text" data-edit="createLink" value = "http://" style="border-radius:0px;width:200px;height:35px;" />\n                </div>\n                           <div class = "span4" style = "margin-top: 10px; display:none;">\n                     <input name = "internal" ng-model = "link" class = "span2" type = "radio" value = "internal" style="vertical-align:middle;margin:0px;"> 场景页面：\n                    <select class = "span2" style = "width: 200px;height:35px; display:none;" ng-options = "page.name for page in internalLinks" sceneid="{{sceneId}}" data-edit = "createLink" pageid="{{internalLink.id}}" ng-model = "internalLink"></select> \n                </div>           \n                <div style="text-align:center"><a class="btn-main" style="color:#FFF; margin-top:20px;" dropdown-toggle>确定</a></div>\n            </div>\n        </div>        \n    </div>\n    <div class="btn-group">\n        <a class="btn" data-edit="unlink" title="清除超链接"><i class="fa fa-unlink"></i></a>\n    </div>\n   <div class="btn-group">\n        <a class="btn last-child" data-edit="RemoveFormat" title="清除样式">\n            <i class="fa fa-eraser">\n            </i>\n        </a>\n    </div>\n</div>')
			}
		]), b.module("security/login/form.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("security/login/form.tpl.html", '<div class = "login-form-section">\n  <div class = "login-content">\n    <form class = "loginForm" novalidate ng-show = "showLogin && !sendPassword">\n      <div class = "section-title">\n        <h3>登录</h3>\n      </div>\n      <div class="error-wrap">\n        <div class="alert alert-danger" role="alert" ng-show="authReason">\n            {{authReason}}\n        </div>\n        <div class="alert alert-danger" role="alert" ng-show="authError">\n            {{authError}}\n        </div>\n      </div>\n <div><center><a href="/hcc/login.html">点此重新登录</a></center></div>     </form>\n  </div>\n </div>\n')
			}
		]), b.module("security/login/reset.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("security/login/reset.tpl.html", '')
			}
		]), b.module("security/login/toolbar.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("security/login/toolbar.tpl.html", '')
			}
		]), b.module("security/register/otherregister.tpl.html", []).run(["$templateCache",
			function(a) {
				a.put("security/register/otherregister.tpl.html", '')
			}
		]), b.module("security/register/register.tpl.html", []).run(["$templateCache",
			function(a) {
				var reg_str='';
       			a.put("security/register/register.tpl.html", reg_str)			}
		])
}(window, window.angular);