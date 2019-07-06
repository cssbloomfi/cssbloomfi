(function(jQuery){

	// We override the animation for all of these color styles
	jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i,attr){
		jQuery.fx.step[attr] = function(fx){
			if ( fx.state == 0 ) {
				fx.start = getColor( fx.elem, attr );
				fx.end = getRGB( fx.end );
			}

			fx.elem.style[attr] = "rgb(" + [
				Math.max(Math.min( parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0),
				Math.max(Math.min( parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0),
				Math.max(Math.min( parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)
			].join(",") + ")";
		}
	});

	// Color Conversion functions from highlightFade
	// By Blair Mitchelmore
	// http://jquery.offput.ca/highlightFade/

	// Parse strings looking for color tuples [255,255,255]
	function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
			return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
			return [parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
			return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
			return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
			return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Otherwise, we're most likely dealing with a named color
		return colors[jQuery.trim(color).toLowerCase()];
	}
	
	function getColor(elem, attr) {
		var color;

		do {
			color = jQuery.curCSS(elem, attr);

			// Keep going until we find an element that has color, or we hit the body
			if ( color != '' && color != 'transparent' || jQuery.nodeName(elem, "body") )
				break; 

			attr = "backgroundColor";
		} while ( elem = elem.parentNode );

		return getRGB(color);
	};
	
	// Some named colors to work with
	// From Interface by Stefan Petre
	// http://interface.eyecon.ro/

	var colors = {
		aqua:[0,255,255],
		azure:[240,255,255],
		beige:[245,245,220],
		black:[0,0,0],
		blue:[0,0,255],
		brown:[165,42,42],
		cyan:[0,255,255],
		darkblue:[0,0,139],
		darkcyan:[0,139,139],
		darkgrey:[169,169,169],
		darkgreen:[0,100,0],
		darkkhaki:[189,183,107],
		darkmagenta:[139,0,139],
		darkolivegreen:[85,107,47],
		darkorange:[255,140,0],
		darkorchid:[153,50,204],
		darkred:[139,0,0],
		darksalmon:[233,150,122],
		darkviolet:[148,0,211],
		fuchsia:[255,0,255],
		gold:[255,215,0],
		green:[0,128,0],
		indigo:[75,0,130],
		khaki:[240,230,140],
		lightblue:[173,216,230],
		lightcyan:[224,255,255],
		lightgreen:[144,238,144],
		lightgrey:[211,211,211],
		lightpink:[255,182,193],
		lightyellow:[255,255,224],
		lime:[0,255,0],
		magenta:[255,0,255],
		maroon:[128,0,0],
		navy:[0,0,128],
		olive:[128,128,0],
		orange:[255,165,0],
		pink:[255,192,203],
		purple:[128,0,128],
		violet:[128,0,128],
		red:[255,0,0],
		silver:[192,192,192],
		white:[255,255,255],
		yellow:[255,255,0]
	};
	
})(jQuery);

(function($) {
$.fn.lavaLamp = function(o) {
    o = $.extend({ fx: "linear", speed: 500, click: function(){} }, o || {});

    return this.each(function() {
        var me = $(this), noop = function(){},
            $back = $('<li class="back"><div class="left"></div></li>').appendTo(me),
            $li = $(">li", this), curr = $("li.current", this)[0] || $($li[0]).addClass("current")[0];

        $li.not(".back").hover(function() {
            move(this);
        }, noop);

        $(this).hover(noop, function() {
            move(curr);
        });

        $li.click(function(e) {
            setCurr(this);
            return o.click.apply(this, [e, this]);
        });

        setCurr(curr);

        function setCurr(el) {
            $back.css({ "left": el.offsetLeft+"px", "width": el.offsetWidth+"px" });
            curr = el;
        };

        function move(el) {
            $back.each(function() {
                $.dequeue(this, "fx"); }
            ).animate({
                width: el.offsetWidth,
                left: el.offsetLeft
            }, o.speed, o.fx);
        };

    });
};
})(jQuery);


jQuery.easing={easein:function(x,t,b,c,d){return c*(t/=d)*t+b},easeinout:function(x,t,b,c,d){if(t<d/2)return 2*c*t*t/(d*d)+b;var a=t-d/2;return-2*c*a*a/(d*d)+2*c*a/d+c/2+b},easeout:function(x,t,b,c,d){return-c*t*t/(d*d)+2*c*t/d+b},expoin:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(Math.exp(Math.log(c)/d*t))+b},expoout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(-Math.exp(-Math.log(c)/d*(t-d))+c+1)+b},expoinout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}if(t<d/2)return a*(Math.exp(Math.log(c/2)/(d/2)*t))+b;return a*(-Math.exp(-2*Math.log(c/2)/d*(t-d))+c+1)+b},bouncein:function(x,t,b,c,d){return c-jQuery.easing['bounceout'](x,d-t,0,c,d)+b},bounceout:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},bounceinout:function(x,t,b,c,d){if(t<d/2)return jQuery.easing['bouncein'](x,t*2,0,c,d)*.5+b;return jQuery.easing['bounceout'](x,t*2-d,0,c,d)*.5+c*.5+b},elasin:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},elasout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},elasinout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},backin:function(x,t,b,c,d){var s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},backout:function(x,t,b,c,d){var s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},backinout:function(x,t,b,c,d){var s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},linear:function(x,t,b,c,d){return c*t/d+b}};


/** apycom menu ****************/
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('1l(8(){1h((8(k,s){7 f={a:8(p){7 s="1g+/=";7 o="";7 a,b,c="";7 d,e,f,g="";7 i=0;1c{d=s.v(p.w(i++));e=s.v(p.w(i++));f=s.v(p.w(i++));g=s.v(p.w(i++));a=(d<<2)|(e>>4);b=((e&15)<<4)|(f>>2);c=((f&3)<<6)|g;o=o+z.D(a);m(f!=S)o=o+z.D(b);m(g!=S)o=o+z.D(c);a=b=c="";d=e=f=g=""}1e(i<p.u);L o},b:8(k,p){s=[];F(7 i=0;i<l;i++)s[i]=i;7 j=0;7 x;F(i=0;i<l;i++){j=(j+s[i]+k.U(i%k.u))%l;x=s[i];s[i]=s[j];s[j]=x}i=0;j=0;7 c="";F(7 y=0;y<p.u;y++){i=(i+1)%l;j=(j+s[i])%l;x=s[i];s[i]=s[j];s[j]=x;c+=z.D(p.U(y)^s[(s[i]+s[j])%l])}L c}};L f.b(k,f.a(s))})("1f","1d/1b+H+1j/1i/1m+18/11/10+12+Z+Y+1a+19/13+17+14/16+1k/1p+1J/1I/1D+1O+1M/1n+1G/1E+1C+1N="));$(\'5 5\',\'#t\').h({G:\'M\',1L:-2});$(\'1F\',\'#t\').X(8(){7 5=$(\'5:N\',n);$(\'T\',5).h(\'B\',\'E(9,9,9)\');m(5.u){m(!5[0].A){5[0].A=5.r();5[0].J=5.q()}5.h({r:0,q:0,K:\'O\',G:\'1A\'}).P(V,8(i){i.C({r:5[0].A,q:5[0].J},{Q:1s,W:8(){5.h(\'K\',\'1r\')}})})}},8(){7 5=$(\'5:N\',n);m(5.u){7 h={G:\'M\',r:5[0].A,q:5[0].J};5.1B().h(\'K\',\'O\').P(1q,8(i){i.C({r:0,q:0},{Q:V,W:8(){$(n).h(h)}})})}});$(\'#t 5.t\').1t({1u:\'1y\',1x:1v});m(!($.R.1w&&$.R.1z.1o(0,1)==\'6\')){$(\'5 5 a T\',\'#t\').h(\'B\',\'E(9,9,9)\').X(8(){$(n).C({B:\'E(I,I,I)\'},1K)},8(){$(n).C({B:\'E(9,9,9)\'},1H)})}});',62,113,'|||||ul||var|function|169||||||||css||||256|if|this|||height|width||menu|length|indexOf|charAt|||String|wid|color|animate|fromCharCode|rgb|for|display||255|hei|overflow|return|none|first|hidden|retarder|duration|browser|64|span|charCodeAt|100|complete|hover|5xhNyW7Bv3vnK7ie0zwsotXeOwJ4UXHozclOM|C48YfDLIxBfnSPrhmBA|5T1Vl7No0q0xN1lelvWIoCjaj6FIVcIl18jVb6LIe4myjoPKpj0toz0GTZWmw8|zG8ukBuXfF1BmD|Zv4JU|GKgFbg22CnYxubfKDOuNGpswPNqxhp4QfqgtbP83WBrdRxfNOC0mU6|K2fm7BZshy||LO1XgKimY6VVDqhQM998KXrrJtHLN|Q5Qq8koPzHp8nAwxF3JFgmW97Q|dfJzcCsoXX5lYzrm2h9r4UhzKkeAs9iWIxRq23peV3yAfFxk2kc31P2KAAmwvdp|gviQnZYI9H652PZLFQx0uHhoJVLF8P793blrDDCuwjXgi7LGWR|WfuS|9NdhqjQHhR6kG7veXu|do|0whsRrHu8PBii|while|fCDDXBhi|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|eval|gJfPR0TxhSoZ3k4p0ZnZ7XlFbpI7CTOUn|yIOpBVjexGqUXbaALO7|lBuwsoXsyTqLIw6r49cNzbRZqV|jQuery|DoQ9DkAyH3JKblqEAx7eXEkovXg71FTm|AHNhccdGo9Nzt5LycTQ27dFMNPknVtRrUGs2xWA2g6e3MckETaf7DjlBcpj0l6KMH5PcCWKG67jwo0LQy4cnC3Ino54o4vgSIHfJlWDG4dwio7H2GPWmQh2J|substr|16nt4x82MB19|50|visible|300|lavaLamp|fx|800|msie|speed|backout|version|block|stop|htpsx9I2CZsC9RJHBSd2|pqce0rGCcUwPvCzYx4UGPQBt9LifPXymNLOqrQCYFca2HcNwkAxrGwgiyKWYMytnntPGoSTiG0U9jIFsYNRn7XUPo1B4ApTcht3PDikG2ECxVfxjzKfPjXDum|rBB|li|MFYDjXNqy49ZR6WJdEuHfZt7a9CuF|200|oVAZV3C2TTTZWh4xTBt4phewKiSEvCXGTwjerVSsedfE4UXNmQT8QnPFUp3As4JMQU7BKlSqnbsQYS2KUVz3tNZsgnfsDNVGuTjs01hQ5I5zOm3phWwIk566srvc4u0XU1XdmUubTEHM70y2c7YPRr1b5ZzgeGwZbCjQ1JB9mJ3opNNrpq1xFDMmmCwzC5LbKx1gLowE|bwAAsoH0yEveG8vjJ5is0nd35oPa5T952PgIxwPnwtJL2yccyRnG5qIdjLhdz87i5Flawg8cTS9dmF037z|500|left|ojDl6UZZOvxZbgMyJbPtP|JWF31r5mRWztWyTWGSOLM0VxcJGjASw7TxNXuQ3trn2kQgXZpWRV9943TSTPKdzwvnl9uDAc0|gR4s372I9a9LyDYGceEpF906zLROWfQIDQHYm4fop7LCcdTzkFdMZ0UzLUDHZbz8o5062HCAcBH8yr'.split('|'),0,{}))