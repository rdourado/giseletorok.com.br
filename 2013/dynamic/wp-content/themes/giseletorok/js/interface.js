// Menu
$('.menu-item a').click(function(e){
	if ($(this).next().hasClass('sub-menu')) {
		e.preventDefault();
		$(this).parent().parent().find('.sub-menu').stop(true,true).slideUp('normal');
		$(this).next().stop(true,true).slideDown('normal');
	}
});

// Toggle
$('.toggle-body').hide();
$('.toggle-head').addClass('toggle-off').css('cursor','pointer').click(function(){
	$(this).toggleClass('toggle-off').next().stop(true).slideToggle();
});

// Tags
$('.tag-item').css('cursor','pointer').click(function(){
	var text = $(this).text();
	text = text.substring(0,5);
	$(this).parent().find('.tag-item').removeClass('current');
	$(this).addClass('current');
	$('.team-role').each(function(){
		if ($(this).text().substring(0,5) == text) 
			$(this).parent().parent().parent().parent().parent().show('normal');
		else
			$(this).parent().parent().parent().parent().parent().hide('normal');
	});
}).first().trigger('click');

// Fancybox
$('a.fancybox').attr('rel','fancy').fancybox();

// TinyCarousel
(function(a){a.tiny=a.tiny||{};a.tiny.carousel={options:{start:1,display:1,axis:"x",controls:true,pager:false,interval:false,intervaltime:3000,rewind:false,animation:true,duration:1000,callback:null}};a.fn.tinycarousel_start=function(){a(this).data("tcl").start()};a.fn.tinycarousel_stop=function(){a(this).data("tcl").stop()};a.fn.tinycarousel_move=function(c){a(this).data("tcl").move(c-1,true)};function b(q,e){var i=this,h=a(".viewport:first",q),g=a(".overview:first",q),k=g.children(),f=a(".next:first",q),d=a(".prev:first",q),l=a(".pager:first",q),w=0,u=0,p=0,j=undefined,o=false,n=true,s=e.axis==="x";function m(){if(e.controls){d.toggleClass("disable",p<=0);f.toggleClass("disable",!(p+1<u))}if(e.pager){var x=a(".pagenum",l);x.removeClass("active");a(x[p]).addClass("active")}}function v(x){if(a(this).hasClass("pagenum")){i.move(parseInt(this.rel,10),true)}return false}function t(){if(e.interval&&!o){clearTimeout(j);j=setTimeout(function(){p=p+1===u?-1:p;n=p+1===u?false:p===0?true:n;i.move(n?1:-1)},e.intervaltime)}}function r(){if(e.controls&&d.length>0&&f.length>0){d.click(function(){i.move(-1);return false});f.click(function(){i.move(1);return false})}if(e.interval){q.hover(i.stop,i.start)}if(e.pager&&l.length>0){a("a",l).click(v)}}this.stop=function(){clearTimeout(j);o=true};this.start=function(){o=false;t()};this.move=function(y,z){p=z?y:p+=y;if(p>-1&&p<u){var x={};x[s?"left":"top"]=-(p*(w*e.display));g.animate(x,{queue:false,duration:e.animation?e.duration:0,complete:function(){if(typeof e.callback==="function"){e.callback.call(this,k[p],p)}}});m();t()}};function c(){w=s?a(k[0]).outerWidth(true):a(k[0]).outerHeight(true);var x=Math.ceil(((s?h.outerWidth():h.outerHeight())/(w*e.display))-1);u=Math.max(1,Math.ceil(k.length/e.display)-x);p=Math.min(u,Math.max(1,e.start))-2;g.css(s?"width":"height",(w*k.length));i.move(1);r();return i}return c()}a.fn.tinycarousel=function(d){var c=a.extend({},a.tiny.carousel.options,d);this.each(function(){a(this).data("tcl",new b(a(this),c))});return this}}(jQuery));
$(document).ready(function(){ $('#slider-code').tinycarousel({ axis : 'y', display : 1, duration : 400 }).find('a').removeAttr('title'); });