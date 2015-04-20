!function(e,t,s){"use strict";function r(e){return e.trim?e.trim():e.replace(/^\s+|\s+$/g,"")}function n(){var t;_=!1,V=e.devicePixelRatio,G={},Q={},t=(V||1)*M.xQuant,M.uT||(M.maxX=Math.max(1.3,M.maxX),t=Math.min(t,M.maxX),E.DPR=t),X.width=Math.max(e.innerWidth||0,T.clientWidth),X.height=Math.max(e.innerHeight||0,T.clientHeight),X.vw=X.width/100,X.vh=X.height/100,X.em=E.getEmValue(),X.rem=X.em,p=M.lazyFactor/2,p=p*t+p,h=.2+.1*t,d=.5+.2*t,f=.5+.25*t,g=t+1.3,(m=X.width>X.height)||(p*=.9),P&&(p*=.9),b=[X.width,X.height,t].join("-")}function i(e,t,s){var r=t*Math.pow(e-.3,1.9);return m||(r/=1.3),e+=r,e>s}function a(e){var t,s=E.getSet(e),r=!1;"pending"!=s&&(r=b,s&&(t=E.setRes(s),r=E.applySetCandidate(t,e))),e[E.ns].evaled=r}function c(e,t){return e.res-t.res}function l(e,t,s){var r;return!s&&t&&(s=e[E.ns].sets,s=s&&s[s.length-1]),r=o(t,s),r&&(t=E.makeUrl(t),e[E.ns].curSrc=t,e[E.ns].curCan=r,r.res||Z(r,r.set.sizes)),r}function o(e,t){var s,r,n;if(e&&t)for(n=E.parseSet(t),e=E.makeUrl(e),s=0;s<n.length;s++)if(e==E.makeUrl(n[s].url)){r=n[s];break}return r}function u(e,t){var s,r,n,i,a=e.getElementsByTagName("source");for(s=0,r=a.length;r>s;s++)n=a[s],n[E.ns]=!0,i=n.getAttribute("srcset"),i&&t.push({srcset:i,media:n.getAttribute("media"),type:n.getAttribute("type"),sizes:n.getAttribute("sizes")})}t.createElement("picture");var d,f,m,p,g,h,v,z,y,b,E={},C=function(){},S=t.createElement("img"),x=S.getAttribute,w=S.setAttribute,A=S.removeAttribute,T=t.documentElement,L={},M={xQuant:1,lazyFactor:.4,maxX:2},N="data-risrc",R=N+"set",$="webkitBackfaceVisibility"in T.style,k=navigator.userAgent,P=/rident/.test(k)||/ecko/.test(k)&&k.match(/rv\:(\d+)/)&&RegExp.$1>35,I="currentSrc",W=/\s+\+?\d+(e\d+)?w/,B=/((?:\([^)]+\)(?:\s*and\s*|\s*or\s*|\s*not\s*)?)+)?\s*(.+)/,U=/^([\+eE\d\.]+)(w|x)$/,D=/\s*\d+h\s*/,F=e.respimgCFG,H=("https:"==location.protocol,"position:absolute;left:0;visibility:hidden;display:block;padding:0;border:none;font-size:1em;width:1em;overflow:hidden;clip:rect(0px, 0px, 0px, 0px)"),O="font-size:100%!important;",_=!0,G={},Q={},V=e.devicePixelRatio,X={px:1,"in":96},q=t.createElement("a"),j=!1,J=function(e,t,s,r){e.addEventListener?e.addEventListener(t,s,r||!1):e.attachEvent&&e.attachEvent("on"+t,s)},K=function(e){var t={};return function(s){return s in t||(t[s]=e(s)),t[s]}},Y=function(){var e=/^([\d\.]+)(em|vw|px)$/,t=function(){for(var e=arguments,t=0,s=e[0];++t in e;)s=s.replace(e[t],e[++t]);return s},s=K(function(e){return"return "+t((e||"").toLowerCase(),/\band\b/g,"&&",/,/g,"||",/min-([a-z-\s]+):/g,"e.$1>=",/max-([a-z-\s]+):/g,"e.$1<=",/calc([^)]+)/g,"($1)",/(\d+[\.]*[\d]*)([a-z]+)/g,"($1 * e.$2)",/^(?!(e.[a-z]|[0-9\.&=|><\+\-\*\(\)\/])).*/gi,"")});return function(t,r){var n;if(!(t in G))if(G[t]=!1,r&&(n=t.match(e)))G[t]=n[1]*X[n[2]];else try{G[t]=new Function("e",s(t))(X)}catch(i){}return G[t]}}(),Z=function(e,t){return e.w?(e.cWidth=E.calcListLength(t||"100vw"),e.res=e.w/e.cWidth):e.res=e.x,e},et=function(s){var r,n,i,a=s||{};if(a.elements&&1==a.elements.nodeType&&("IMG"==a.elements.nodeName.toUpperCase()?a.elements=[a.elements]:(a.context=a.elements,a.elements=null)),a.reparse&&!a.reevaluate&&(a.reevaluate=!0,e.console&&console.warn&&console.warn("reparse was renamed to reevaluate!")),r=a.elements||E.qsa(a.context||t,a.reevaluate||a.reselect?E.sel:E.selShort),i=r.length){for(E.setupRun(a),j=!0,n=0;i>n;n++)E.fillImg(r[n],a);E.teardownRun(a)}},tt=K(function(e){var t=[1,"x"],s=r(e||"");return s&&(s=s.replace(D,""),t=s.match(U)?[1*RegExp.$1,RegExp.$2]:!1),t});I in S||(I="src"),L["image/jpeg"]=!0,L["image/gif"]=!0,L["image/png"]=!0,L["image/svg+xml"]=t.implementation.hasFeature("http://wwwindow.w3.org/TR/SVG11/feature#Image","1.1"),E.ns=("ri"+(new Date).getTime()).substr(0,9),E.supSrcset="srcset"in S,E.supSizes="sizes"in S,E.selShort="picture>img,img[srcset]",E.sel=E.selShort,E.cfg=M,E.supSrcset&&(E.sel+=",img["+R+"]"),E.DPR=V||1,E.u=X,E.types=L,z=E.supSrcset&&!E.supSizes,E.setSize=C,E.makeUrl=K(function(e){return q.href=e,q.href}),E.qsa=function(e,t){return e.querySelectorAll(t)},E.matchesMedia=function(){return E.matchesMedia=e.matchMedia&&(matchMedia("(min-width: 0.1em)")||{}).matches?function(e){return!e||matchMedia(e).matches}:E.mMQ,E.matchesMedia.apply(this,arguments)},E.mMQ=function(e){return e?Y(e):!0},E.calcLength=function(e){var t=Y(e,!0)||!1;return 0>t&&(t=!1),t},E.supportsType=function(e){return e?L[e]:!0},E.parseSize=K(function(e){var t=(e||"").match(B);return{media:t&&t[1],length:t&&t[2]}}),E.parseSet=function(e){if(!e.cands){var t,s,r,n,i,a,c=e.srcset;for(e.cands=[];c;)c=c.replace(/^\s+/g,""),t=c.search(/\s/g),r=null,-1!=t?(s=c.slice(0,t),n=s.charAt(s.length-1),","!=n&&s||(s=s.replace(/,+$/,""),r=""),c=c.slice(t+1),null==r&&(i=c.indexOf(","),-1!=i?(r=c.slice(0,i),c=c.slice(i+1)):(r=c,c=""))):(s=c,c=""),s&&(r=tt(r))&&(a={url:s.replace(/^,+/,""),set:e},a[r[1]]=r[0],"x"==r[1]&&1==r[0]&&(e.has1x=!0),e.cands.push(a))}return e.cands},E.getEmValue=function(){var e;if(!v&&(e=t.body)){var s=t.createElement("div"),r=T.style.cssText,n=e.style.cssText;s.style.cssText=H,T.style.cssText=O,e.style.cssText=O,e.appendChild(s),v=s.offsetWidth,e.removeChild(s),v=parseFloat(v,10),T.style.cssText=r,e.style.cssText=n}return v||16},E.calcListLength=function(e){if(!(e in Q)||M.uT){var t,s,n,i,a,c,l=r(e).split(/\s*,\s*/),o=!1;for(a=0,c=l.length;c>a&&(t=l[a],s=E.parseSize(t),n=s.length,i=s.media,!n||!E.matchesMedia(i)||(o=E.calcLength(n))===!1);a++);Q[e]=o?o:X.width}return Q[e]},E.setRes=function(e){var t;if(e){t=E.parseSet(e);for(var s=0,r=t.length;r>s;s++)Z(t[s],e.sizes)}return t},E.setRes.res=Z,E.applySetCandidate=function(e,t){if(e.length){var s,r,n,a,o,u,m,v,z,y,C,S,x,w=t[E.ns],A=b,T=p,L=h;if(v=w.curSrc||t[I],z=w.curCan||l(t,v,e[0].set),r=E.DPR,x=z&&z.res,!m&&v&&(S=P&&!t.complete&&z&&x>r,S||z&&!(g>x)||(z&&r>x&&x>d&&(f>x&&(T*=.87,L+=.04*r),z.res+=T*Math.pow(x-L,2)),y=!w.pic||z&&z.set==e[0].set,z&&y&&z.res>=r&&(m=z))),!m)for(x&&(z.res=z.res-(z.res-x)/2),e.sort(c),u=e.length,m=e[u-1],n=0;u>n;n++)if(s=e[n],s.res>=r){a=n-1,m=e[a]&&(o=s.res-r)&&(S||v!=E.makeUrl(s.url))&&i(e[a].res,o,r)?e[a]:s;break}return x&&(z.res=x),m&&(C=E.makeUrl(m.url),w.curSrc=C,w.curCan=m,C!=v&&E.setSrc(t,m),E.setSize(t)),A}},E.setSrc=function(e,t){var s;e.src=t.url,$&&(s=e.style.zoom,e.style.zoom="0.999",e.style.zoom=s)},E.getSet=function(e){var t,s,r,n=!1,i=e[E.ns].sets;for(t=0;t<i.length&&!n;t++)if(s=i[t],s.srcset&&E.matchesMedia(s.media)&&(r=E.supportsType(s.type))){"pending"==r&&(s=r),n=s;break}return n},E.parseSets=function(e,t,r){var n,i,a,c,l="PICTURE"==t.nodeName.toUpperCase(),d=e[E.ns];(d.src===s||r.src)&&(d.src=x.call(e,"src"),d.src?w.call(e,N,d.src):A.call(e,N)),(d.srcset===s||!E.supSrcset||e.srcset||r.srcset)&&(n=x.call(e,"srcset"),d.srcset=n,c=!0),d.sets=[],l&&(d.pic=!0,u(t,d.sets)),d.srcset?(i={srcset:d.srcset,sizes:x.call(e,"sizes")},d.sets.push(i),a=(z||d.src)&&W.test(d.srcset||""),a||!d.src||o(d.src,i)||i.has1x||(i.srcset+=", "+d.src,i.cands.push({url:d.src,x:1,set:i}))):d.src&&d.sets.push({srcset:d.src,sizes:null}),d.curCan=null,d.curSrc=s,d.supported=!(l||i&&!E.supSrcset||a),c&&E.supSrcset&&!d.supported&&(n?(w.call(e,R,n),e.srcset=""):A.call(e,R)),d.supported&&!d.srcset&&(!d.src&&e.src||e.src!=E.makeUrl(d.src))&&(null==d.src?e.removeAttribute("src"):e.src=d.src),d.parsed=!0},E.fillImg=function(e,t){var s,r,n=t.reselect||t.reevaluate;if(e[E.ns]||(e[E.ns]={}),r=e[E.ns],n||r.evaled!=b){if(!r.parsed||t.reevaluate){if(s=e.parentNode,!s)return;E.parseSets(e,s,t)}r.supported?r.evaled=b:a(e)}},E.setupRun=function(t){(!j||_||V!=e.devicePixelRatio)&&(n(),t.elements||t.context||clearTimeout(y))},e.HTMLPictureElement?(et=C,E.fillImg=C):!function(){var s,r=e.attachEvent?/d$|^c/:/d$|^c|^i/,n=function(){var e=t.readyState||"";c=setTimeout(n,"loading"==e?200:999),t.body&&(s=s||r.test(e),E.fillImgs(),s&&clearTimeout(c))},i=function(){E.fillImgs()},a=function(){clearTimeout(y),_=!0,y=setTimeout(i,99)},c=setTimeout(n,t.body?9:99);J(e,"resize",a),J(t,"readystatechange",n)}(),E.respimage=et,E.fillImgs=et,E.teardownRun=C,et._=E,e.respimage=et,e.respimgCFG={ri:E,push:function(e){var t=e.shift();"function"==typeof E[t]?E[t].apply(E,e):(M[t]=e[0],j&&E.fillImgs({reselect:!0}))}};for(;F&&F.length;)e.respimgCFG.push(F.shift())}(window,document),function(e,t){e.lazySizes=t(e,e.document),"function"==typeof define&&define.amd&&define(e.lazySizes)}(window,function(e,t){"use strict";if(t.getElementsByClassName){var s,r=t.documentElement,n=/^picture$/i,i=["load","error","lazyincluded","_lazyloaded"],a=function(e,t){var s=new RegExp("(\\s|^)"+t+"(\\s|$)");return e.className.match(s)&&s},c=function(e,t){a(e,t)||(e.className+=" "+t)},l=function(e,t){var s;(s=a(e,t))&&(e.className=e.className.replace(s," "))},o=function(e,t,s){var r=s?"addEventListener":"removeEventListener";s&&o(e,t),i.forEach(function(s){e[r](s,t)})},u=function(e,s,r){var n=t.createEvent("Event");return n.initEvent(s,!0,!0),n.details=r||{},e.dispatchEvent(n),n},d=function(t,s){var r,n;e.HTMLPictureElement||(e.picturefill?picturefill({reevaluate:!0,reparse:!0,elements:[t]}):e.respimage?(s&&(n=s.srcset&&"srcset"||s.src&&"src")&&(r=t[respimage._.ns],r&&r[n]!=s[n]&&t.getAttribute(n)==s[n]&&(r[n]=void 0)),respimage({reparse:!0,elements:[t]})):s&&s.src&&(t.src=s.src))},f=function(e,t){return getComputedStyle(e,null)[t]},m=function(e,r){for(var n=e.offsetWidth;n<s.minSize&&r&&r!=t.body&&!e._lazysizesWidth;)n=r.offsetWidth,r=r.parentNode;return n},p=function(e){var s,r,n=function(){s&&(s=!1,e())},i=function(){clearInterval(r),t.hidden||(n(),r=setInterval(n,66))};return t.addEventListener("visibilitychange",i),i(),function(e){s=!0,e===!0&&n()}},g=function(){var i,m,g,v,z,y,b,E,C,S,x,w,A=navigator.userAgent,T=e.HTMLPictureElement&&A.match(/hrome\/(\d+)/)&&40==RegExp.$1,L=/webkit/i.test(A),M=/^img$/i,N=/^iframe$/i,R=-2,$=R,k=R,P=R,I=!0,W=0,B=0,U=0,D=function(e){B--,e&&e.target&&o(e.target,D),(!e||0>B||!e.target)&&(B=0)},F=function(e,s){var n,i=e,a="hidden"!=f(e,"visibility");for(C-=s,w+=s,S-=s,x+=s;a&&(i=i.offsetParent)&&i!=r&&i!=t.body;)a=v&&4>B||(f(i,"opacity")||1)>0,a&&"visible"!=f(i,"overflow")&&(n=i.getBoundingClientRect(),a=x>n.left-1&&S<n.right+1&&w>n.top-1&&C<n.bottom+1);return a},H=function(){var e,t,r,n,a,c,l,o=i.length,u=Date.now(),d=U;if(I||V(),o){for(;o>d&&i[d];d++,U++)if((c=i[d].getAttribute("data-expand"))&&(n=1*c)||(n=P),!(B>6&&(!c||"src"in i[d])))if(B>3&&n>R&&(n=R),l!==n&&(b=innerWidth+n,E=innerHeight+n,a=-1*n,l=n),e=i[d].getBoundingClientRect(),(w=e.bottom)>=a&&(C=e.top)<=E&&(x=e.right)>=a&&(S=e.left)<=b&&(w||x||S||C)&&(v&&P==$&&3>B&&4>W&&!c||F(i[d],n)))U--,u+=2,Q(i[d]),r=!0;else{if(!y&&Date.now()-u>3)return U++,y=!0,void O();!r&&v&&!t&&3>B&&4>W&&(m[0]||s.preloadAfterLoad)&&(m[0]||!c&&(w||x||S||C||"auto"!=i[d].getAttribute(s.sizesAttr)))&&(t=m[0]||i[d])}U=0,y=!1,W++,k>P&&2>B&&W>4?(P=k,W=0,O()):P!=$&&(P=$),t&&!r&&Q(t)}},O=p(H),_=function(e){c(e.target,s.loadedClass),l(e.target,s.loadingClass),o(e.target,_)},G=function(e,t){try{e.contentWindow.location.replace(t)}catch(s){e.setAttribute("src",t)}},Q=function(e,t){var r,i,f,m,p,g,y,b,E,C,S,x=e.currentSrc||e.src,w=M.test(e.nodeName),A=e.getAttribute(s.sizesAttr)||e.getAttribute("sizes"),R="auto"==A;if(!R&&(L||v)||!w||!x||e.complete||a(e,s.errorClass)){if(!(E=u(e,"lazybeforeunveil",{force:!!t})).defaultPrevented){if(A&&(R?h.updateElem(e,!0):e.setAttribute("sizes",A)),g=e.getAttribute(s.srcsetAttr),p=e.getAttribute(s.srcAttr),w&&(y=e.parentNode,b=n.test(y.nodeName||"")),C=E.details.firesLoad||"src"in e&&(g||p||b),C&&(B++,o(e,D,!0),clearTimeout(z),z=setTimeout(D,3e3)),b)for(r=y.getElementsByTagName("source"),i=0,f=r.length;f>i;i++)(S=s.customMedia[r[i].getAttribute("media")])&&r[i].setAttribute("media",S),m=r[i].getAttribute(s.srcsetAttr),m&&r[i].setAttribute("srcset",m);g?(e.setAttribute("srcset",g),T&&A&&e.removeAttribute("src")):p&&(N.test(e.nodeName)?G(e,p):e.setAttribute("src",p)),s.addClasses&&(c(e,s.loadingClass),o(e,_,!0))}setTimeout(function(){"auto"==A&&c(e,s.autosizesClass),(g||b)&&d(e,{srcset:g,src:p}),l(e,s.lazyClass),(!C||e.complete&&x==(e.currentSrc||e.src))&&(C&&D(E),s.addClasses&&_(E)),e=null})}},V=function(){g&&!I&&($=Math.max(Math.min(s.expand||s.threshold||120,300),9),k=4*$),I=!0},X=function(){g=!0,I=!1},q=function(){v=!0,X(),O(!0)},j=function(){i=t.getElementsByClassName(s.lazyClass),m=t.getElementsByClassName(s.lazyClass+" "+s.preloadClass),s.scroll&&addEventListener("scroll",O,!0),addEventListener("resize",function(){I=!1,O()}),e.MutationObserver?new MutationObserver(O).observe(r,{childList:!0,subtree:!0,attributes:!0}):(r.addEventListener("DOMNodeInserted",O,!0),r.addEventListener("DOMAttrModified",O,!0)),addEventListener("hashchange",O,!0),["transitionstart","transitionend","load","focus","mouseover","animationend","click"].forEach(function(e){t.addEventListener(e,O,!0)}),(v=/d$|^c/.test(t.readyState))||(addEventListener("load",q),t.addEventListener("DOMContentLoaded",O)),setTimeout(X,666),O()};return{init:j,checkElems:O,unveil:Q}}(),h=function(){var e,r=function(e,t){var s,r,i,a,c,l=e.parentNode;if(l&&(s=m(e,l),c=u(e,"lazybeforesizes",{width:s,dataAttr:!!t}),!c.defaultPrevented&&(s=c.details.width,s&&s!==e._lazysizesWidth))){if(e._lazysizesWidth=s,s+="px",e.setAttribute("sizes",s),n.test(l.nodeName||""))for(r=l.getElementsByTagName("source"),i=0,a=r.length;a>i;i++)r[i].setAttribute("sizes",s);c.details.dataAttr||d(e,c.details)}},i=function(){var t,s=e.length;if(s)for(t=0;s>t;t++)r(e[t])},a=p(i),c=function(){e=t.getElementsByClassName(s.autosizesClass),addEventListener("resize",a)};return{init:c,checkElems:a,updateElem:r}}(),v=function(){v.i||(v.i=!0,h.init(),g.init())};return function(){var t,r={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",scroll:!0,autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",addClasses:!0,minSize:50,customMedia:{},init:!0};s=e.lazySizesConfig||{};for(t in r)t in s||(s[t]=r[t]);e.lazySizesConfig=s,r.init&&setTimeout(v)}(),{cfg:s,autoSizer:h,loader:g,init:v,updateAllSizes:h.updateElems,updateAllLazy:g.checkElems,unveilLazy:g.unveil,uS:h.updateElem,uP:d,aC:c,rC:l,hC:a,fire:u,gW:m}}}),window.lazySizesConfig={addClasses:!0};
//# sourceMappingURL=images.js.map