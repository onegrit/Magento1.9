(function(){function a(b){do{if(b.className&&b.className.indexOf("mceItemLayer")!=-1){return b}}while(b=b.parentNode)}tinymce.create("tinymce.plugins.Layer",{init:function(b,c){var d=this;d.editor=b;b.addCommand("mceInsertLayer",d._insertLayer,d);b.addCommand("mceMoveForward",function(){d._move(1)});b.addCommand("mceMoveBackward",function(){d._move(-1)});b.addCommand("mceMakeAbsolute",function(){d._toggleAbsolute()});b.addButton("moveforward",{title:"layer.forward_desc",cmd:"mceMoveForward"});b.addButton("movebackward",{title:"layer.backward_desc",cmd:"mceMoveBackward"});b.addButton("absolute",{title:"layer.absolute_desc",cmd:"mceMakeAbsolute"});b.addButton("insertlayer",{title:"layer.insertlayer_desc",cmd:"mceInsertLayer"});b.onInit.add(function(){var e=b.dom;if(tinymce.isIE){b.getDoc().execCommand("2D-Position",false,true)}});b.onMouseUp.add(function(f,h){var g=a(h.target);if(g){f.dom.setAttrib(g,"data-mce-style","")}});b.onMouseDown.add(function(f,j){var h=j.target,i=f.getDoc(),g;if(tinymce.isGecko){if(a(h)){if(i.designMode!=="on"){i.designMode="on";h=i.body;g=h.parentNode;g.removeChild(h);g.appendChild(h)}}else{if(i.designMode=="on"){i.designMode="off"}}}});b.onNodeChange.add(d._nodeChange,d);b.onVisualAid.add(d._visualAid,d)},getInfo:function(){return{longname:"Layer",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/layer",version:tinymce.majorVersion+"."+tinymce.minorVersion}},_nodeChange:function(c,b,f){var d,e;d=this._getParentLayer(f);e=c.dom.getParent(f,"DIV,P,IMG");if(!e){b.setDisabled("absolute",1);b.setDisabled("moveforward",1);b.setDisabled("movebackward",1)}else{b.setDisabled("absolute",0);b.setDisabled("moveforward",!d);b.setDisabled("movebackward",!d);b.setActive("absolute",d&&d.style.position.toLowerCase()=="absolute")}},_visualAid:function(b,d,c){var f=b.dom;tinymce.each(f.select("div,p",d),function(g){if(/^(absolute|relative|fixed)$/i.test(g.style.position)){if(c){f.addClass(g,"mceItemVisualAid")}else{f.removeClass(g,"mceItemVisualAid")}f.addClass(g,"mceItemLayer")}})},_move:function(j){var c=this.editor,g,h=[],f=this._getParentLayer(c.selection.getNode()),e=-1,k=-1,b;b=[];tinymce.walk(c.getBody(),function(d){if(d.nodeType==1&&/^(absolute|relative|static)$/i.test(d.style.position)){b.push(d)}},"childNodes");for(g=0;g<b.length;g++){h[g]=b[g].style.zIndex?parseInt(b[g].style.zIndex):0;if(e<0&&b[g]==f){e=g}}if(j<0){for(g=0;g<h.length;g++){if(h[g]<h[e]){k=g;break}}if(k>-1){b[e].style.zIndex=h[k];b[k].style.zIndex=h[e]}else{if(h[e]>0){b[e].style.zIndex=h[e]-1}}}else{for(g=0;g<h.length;g++){if(h[g]>h[e]){k=g;break}}if(k>-1){b[e].style.zIndex=h[k];b[k].style.zIndex=h[e]}else{b[e].style.zIndex=h[e]+1}}c.execCommand("mceRepaint")},_getParentLayer:function(b){return this.editor.dom.getParent(b,function(c){return c.nodeType==1&&/^(absolute|relative|static)$/i.test(c.style.position)})},_insertLayer:function(){var c=this.editor,e=c.dom,d=e.getPos(e.getParent(c.selection.getNode(),"*")),b=c.getBody();c.dom.add(b,"div",{style:{position:"absolute",left:d.x,top:(d.y>20?d.y:20),width:100,height:100},"class":"mceItemVisualAid mceItemLayer"},c.selection.getContent()||c.getLang("layer.content"));if(tinymce.isIE){e.setHTML(b,b.innerHTML)}},_toggleAbsolute:function(){var b=this.editor,c=this._getParentLayer(b.selection.getNode());if(!c){c=b.dom.getParent(b.selection.getNode(),"DIV,P,IMG")}if(c){if(c.style.position.toLowerCase()=="absolute"){b.dom.setStyles(c,{position:"",left:"",top:"",width:"",height:""});b.dom.removeClass(c,"mceItemVisualAid");b.dom.removeClass(c,"mceItemLayer")}else{if(c.style.left==""){c.style.left=20+"px"}if(c.style.top==""){c.style.top=20+"px"}if(c.style.width==""){c.style.width=c.width?(c.width+"px"):"100px"}if(c.style.height==""){c.style.height=c.height?(c.height+"px"):"100px"}c.style.position="absolute";b.dom.setAttrib(c,"data-mce-style","");b.addVisual(b.getBody())}b.execCommand("mceRepaint");b.nodeChanged()}}});tinymce.PluginManager.add("layer",tinymce.plugins.Layer)})();