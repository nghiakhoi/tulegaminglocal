/*  @preserve
 *  Project: jQuery plugin Watermark
 *  Description: Add watermark on images use HTML5 and Javascript.
 *  Author: Zzbaivong (devs.forumvi.com)
 *  Version: 0.2
 *  License: MIT
 */
;(function($,window,document,undefined){'use strict';var pluginName='watermark',defaults={path:'watermark.png',text:'',textWidth:130,textSize:13,textColor:'white',textBg:'rgba(0, 0, 0, 0.4)',gravity:'se',opacity:0.7,margin:10,outputWidth:'auto',outputHeight:'auto',outputType:'jpeg',done:function(imgURL){this.src=imgURL},fail:function(){},always:function(){}};function Plugin(element,options){this.element=element;this.settings=$.extend({},defaults,options);this._defaults=defaults;this._name=pluginName;this.init()}
$.extend(Plugin.prototype,{init:function(){var _this=this,ele=_this.element,set=_this.settings,wmData={imgurl:set.path,type:'png',cross:!0},imageData={imgurl:ele.src,cross:!0,type:set.outputType,width:set.outputWidth,height:set.outputHeight};if(set.path.search(/data:image\/(png|jpg|jpeg|gif);base64,/)===0){wmData.cross=!1}
if(ele.src.search(/data:image\/(png|jpg|jpeg|gif);base64,/)===0){imageData.cross=!1}
var defer=$.Deferred();$.when(defer).done(function(imgObj){imageData.wmObj=imgObj;_this.imgurltodata(imageData,function(dataURL){set.done.call(ele,dataURL);set.always.call(ele,dataURL)})});if(set.text!==''){wmData.imgurl=_this.textwatermark();wmData.cross=!1}
_this.imgurltodata(wmData,function(imgObj){defer.resolve(imgObj)})},textwatermark:function(){var _this=this,set=_this.settings,canvas=document.createElement('CANVAS'),ctx=canvas.getContext('2d'),w=set.textWidth,h=set.textSize+8;canvas.width=w;canvas.height=h;ctx.fillStyle=set.textBg;ctx.fillRect(0,0,w,h);ctx.fillStyle=set.textColor;ctx.textAlign='center';ctx.font='500 '+set.textSize+'px Sans-serif';ctx.fillText(set.text,(w/2),(set.textSize+2));return canvas.toDataURL()},imgurltodata:function(data,callback){var _this=this,set=_this.settings,ele=_this.element;var img=new Image();if(data.cross){img.crossOrigin='Anonymous'}
img.onload=function(){var canvas=document.createElement('CANVAS');var ctx=canvas.getContext('2d');var w=this.width,h=this.height,ctxH;if(data.wmObj){if(data.width!=='auto'&&data.height==='auto'&&data.width<w){h=h/w*data.width;w=data.width}else if(data.width==='auto'&&data.height!=='auto'&&data.height<h){w=w/h*data.height;h=data.height}else if(data.width!=='auto'&&data.height!=='auto'&&data.width<w&&data.height<h){w=data.width;h=data.height}}
if((set.gravity==='w'||set.gravity==='e')&&!data.wmObj){canvas.width=h;canvas.height=w;ctxH=-h;ctx.rotate(90*Math.PI/180)}else{canvas.width=w;canvas.height=h;ctxH=0}
if(data.type==='jpeg'){ctx.fillStyle='#ffffff';ctx.fillRect(0,0,w,h)}
ctx.drawImage(this,0,ctxH,w,h);if(data.wmObj){var op=set.opacity;if(op>0&&op<1){ctx.globalAlpha=set.opacity}
var wmW=data.wmObj.width,wmH=data.wmObj.height,pos=set.margin,gLeft,gTop;switch(set.gravity){case 'nw':gLeft=pos;gTop=pos;break;case 'n':gLeft=w/2-wmW/2;gTop=pos;break;case 'ne':gLeft=w-wmW-pos;gTop=pos;break;case 'w':gLeft=pos;gTop=h/2-wmH/2;break;case 'e':gLeft=w-wmW-pos;gTop=h/2-wmH/2;break;case 'sw':gLeft=pos;gTop=h-wmH-pos;break;case 's':gLeft=w/2-wmW/2;gTop=h-wmH-pos;break;default:gLeft=w-wmW-pos;gTop=h-wmH-pos}
ctx.drawImage(data.wmObj,gLeft,gTop,wmW,wmH)}
var dataURL=canvas.toDataURL('image/'+data.type);if(typeof callback==='function'){if(data.wmObj){callback(dataURL)}else{var wmNew=new Image();wmNew.src=dataURL;callback(wmNew)}}
canvas=null};img.onerror=function(){set.fail.call(this,this.src);set.always.call(ele,this.src);return!1};img.src=data.imgurl}});$.fn[pluginName]=function(options){return this.each(function(){if(!$.data(this,'plugin_'+pluginName)){$.data(this,'plugin_'+pluginName,new Plugin(this,options))}})}}(jQuery,window,document))