(function(h){var i=h.DOM,g=h.dom.Event,c=h.extend,f=h.each,a=h.util.Cookie,e,d=h.explode;function b(p,m){var k,l,o=p.dom,j="",n,r;previewStyles=p.settings.preview_styles;if(previewStyles===false){return""}if(!previewStyles){previewStyles="font-family font-size font-weight text-decoration text-transform color background-color"}function q(s){return s.replace(/%(\w+)/g,"")}k=m.block||m.inline||"span";l=o.create(k);f(m.styles,function(t,s){t=q(t);if(t){o.setStyle(l,s,t)}});f(m.attributes,function(t,s){t=q(t);if(t){o.setAttrib(l,s,t)}});f(m.classes,function(s){s=q(s);if(!o.hasClass(l,s)){o.addClass(l,s)}});o.setStyles(l,{position:"absolute",left:-65535});p.getBody().appendChild(l);n=o.getStyle(p.getBody(),"fontSize",true);n=/px$/.test(n)?parseInt(n,10):0;f(previewStyles.split(" "),function(s){var t=o.getStyle(l,s,true);if(s=="background-color"&&/transparent|rgba\s*\([^)]+,\s*0\)/.test(t)){t=o.getStyle(p.getBody(),s,true);if(o.toHex(t).toLowerCase()=="#ffffff"){return}}if(s=="font-size"){if(/em|%$/.test(t)){if(n===0){return}t=parseFloat(t,10)/(/%$/.test(t)?100:1);t=(t*n)+"px"}}j+=s+":"+t+";"});o.remove(l);return j}h.ThemeManager.requireLangPack("advanced");h.create("tinymce.themes.AdvancedTheme",{sizes:[8,10,12,14,18,24,36],controls:{bold:["bold_desc","Bold"],italic:["italic_desc","Italic"],underline:["underline_desc","Underline"],strikethrough:["striketrough_desc","Strikethrough"],justifyleft:["justifyleft_desc","JustifyLeft"],justifycenter:["justifycenter_desc","JustifyCenter"],justifyright:["justifyright_desc","JustifyRight"],justifyfull:["justifyfull_desc","JustifyFull"],bullist:["bullist_desc","InsertUnorderedList"],numlist:["numlist_desc","InsertOrderedList"],outdent:["outdent_desc","Outdent"],indent:["indent_desc","Indent"],cut:["cut_desc","Cut"],copy:["copy_desc","Copy"],paste:["paste_desc","Paste"],undo:["undo_desc","Undo"],redo:["redo_desc","Redo"],link:["link_desc","mceLink"],unlink:["unlink_desc","unlink"],image:["image_desc","mceImage"],cleanup:["cleanup_desc","mceCleanup"],help:["help_desc","mceHelp"],code:["code_desc","mceCodeEditor"],hr:["hr_desc","InsertHorizontalRule"],removeformat:["removeformat_desc","RemoveFormat"],sub:["sub_desc","subscript"],sup:["sup_desc","superscript"],forecolor:["forecolor_desc","ForeColor"],forecolorpicker:["forecolor_desc","mceForeColor"],backcolor:["backcolor_desc","HiliteColor"],backcolorpicker:["backcolor_desc","mceBackColor"],charmap:["charmap_desc","mceCharMap"],visualaid:["visualaid_desc","mceToggleVisualAid"],anchor:["anchor_desc","mceInsertAnchor"],newdocument:["newdocument_desc","mceNewDocument"],blockquote:["blockquote_desc","mceBlockQuote"]},stateControls:["bold","italic","underline","strikethrough","bullist","numlist","justifyleft","justifycenter","justifyright","justifyfull","sub","sup","blockquote"],init:function(k,l){var m=this,n,j,p;m.editor=k;m.url=l;m.onResolveName=new h.util.Dispatcher(this);n=k.settings;k.forcedHighContrastMode=k.settings.detect_highcontrast&&m._isHighContrast();k.settings.skin=k.forcedHighContrastMode?"highcontrast":k.settings.skin;if(!n.theme_advanced_buttons1){n=c({theme_advanced_buttons1:"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect",theme_advanced_buttons2:"bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",theme_advanced_buttons3:"hr,removeformat,visualaid,|,sub,sup,|,charmap"},n)}m.settings=n=c({theme_advanced_path:true,theme_advanced_toolbar_location:"top",theme_advanced_blockformats:"p,address,pre,h1,h2,h3,h4,h5,h6",theme_advanced_toolbar_align:"left",theme_advanced_statusbar_location:"bottom",theme_advanced_fonts:"Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats",theme_advanced_more_colors:1,theme_advanced_row_height:23,theme_advanced_resize_horizontal:1,theme_advanced_resizing_use_cookie:1,theme_advanced_font_sizes:"1,2,3,4,5,6,7",theme_advanced_font_selector:"span",theme_advanced_show_current_color:0,readonly:k.settings.readonly},n);if(!n.font_size_style_values){n.font_size_style_values="8pt,10pt,12pt,14pt,18pt,24pt,36pt"}if(h.is(n.theme_advanced_font_sizes,"string")){n.font_size_style_values=h.explode(n.font_size_style_values);n.font_size_classes=h.explode(n.font_size_classes||"");p={};k.settings.theme_advanced_font_sizes=n.theme_advanced_font_sizes;f(k.getParam("theme_advanced_font_sizes","","hash"),function(r,q){var o;if(q==r&&r>=1&&r<=7){q=r+" ("+m.sizes[r-1]+"pt)";o=n.font_size_classes[r-1];r=n.font_size_style_values[r-1]||(m.sizes[r-1]+"pt")}if(/^\s*\./.test(r)){o=r.replace(/\./g,"")}p[q]=o?{"class":o}:{fontSize:r}});n.theme_advanced_font_sizes=p}if((j=n.theme_advanced_path_location)&&j!="none"){n.theme_advanced_statusbar_location=n.theme_advanced_path_location}if(n.theme_advanced_statusbar_location=="none"){n.theme_advanced_statusbar_location=0}if(k.settings.content_css!==false){k.contentCSS.push(k.baseURI.toAbsolute(l+"/skins/"+k.settings.skin+"/content.css"))}k.onInit.add(function(){if(!k.settings.readonly){k.onNodeChange.add(m._nodeChanged,m);k.onKeyUp.add(m._updateUndoStatus,m);k.onMouseUp.add(m._updateUndoStatus,m);k.dom.bind(k.dom.getRoot(),"dragend",function(){m._updateUndoStatus(k)})}});k.onSetProgressState.add(function(r,o,s){var t,u=r.id,q;if(o){m.progressTimer=setTimeout(function(){t=r.getContainer();t=t.insertBefore(i.create("DIV",{style:"position:relative"}),t.firstChild);q=i.get(r.id+"_tbl");i.add(t,"div",{id:u+"_blocker","class":"mceBlocker",style:{width:q.clientWidth+2,height:q.clientHeight+2}});i.add(t,"div",{id:u+"_progress","class":"mceProgress",style:{left:q.clientWidth/2,top:q.clientHeight/2}})},s||0)}else{i.remove(u+"_blocker");i.remove(u+"_progress");clearTimeout(m.progressTimer)}});i.loadCSS(n.editor_css?k.documentBaseURI.toAbsolute(n.editor_css):l+"/skins/"+k.settings.skin+"/ui.css");if(n.skin_variant){i.loadCSS(l+"/skins/"+k.settings.skin+"/ui_"+n.skin_variant+".css")}},_isHighContrast:function(){var j,k=i.add(i.getRoot(),"div",{style:"background-color: rgb(171,239,86);"});j=(i.getStyle(k,"background-color",true)+"").toLowerCase().replace(/ /g,"");i.remove(k);return j!="rgb(171,239,86)"&&j!="#abef56"},createControl:function(m,j){var k,l;if(l=j.createControl(m)){return l}switch(m){case"styleselect":return this._createStyleSelect();case"formatselect":return this._createBlockFormats();case"fontselect":return this._createFontSelect();case"fontsizeselect":return this._createFontSizeSelect();case"forecolor":return this._createForeColorMenu();case"backcolor":return this._createBackColorMenu()}if((k=this.controls[m])){return j.createButton(m,{title:"advanced."+k[0],cmd:k[1],ui:k[2],value:k[3]})}},execCommand:function(l,k,m){var j=this["_"+l];if(j){j.call(this,k,m);return true}return false},_importClasses:function(l){var j=this.editor,k=j.controlManager.get("styleselect");if(k.getLength()==0){f(j.dom.getClasses(),function(q,m){var p="style_"+m,n;n={inline:"span",attributes:{"class":q["class"]},selector:"*"};j.formatter.register(p,n);k.add(q["class"],p,{style:function(){return b(j,n)}})})}},_createStyleSelect:function(o){var l=this,j=l.editor,k=j.controlManager,m;m=k.createListBox("styleselect",{title:"advanced.style_select",onselect:function(q){var r,n=[],p;f(m.items,function(s){n.push(s.value)});j.focus();j.undoManager.add();r=j.formatter.matchAll(n);h.each(r,function(s){if(!q||s==q){if(s){j.formatter.remove(s)}p=true}});if(!p){j.formatter.apply(q)}j.undoManager.add();j.nodeChanged();return false}});j.onPreInit.add(function(){var p=0,n=j.getParam("style_formats");if(n){f(n,function(q){var r,s=0;f(q,function(){s++});if(s>1){r=q.name=q.name||"style_"+(p++);j.formatter.register(r,q);m.add(q.title,r,{style:function(){return b(j,q)}})}else{m.add(q.title)}})}else{f(j.getParam("theme_advanced_styles","","hash"),function(t,s){var r,q;if(t){r="style_"+(p++);q={inline:"span",classes:t,selector:"*"};j.formatter.register(r,q);m.add(l.editor.translate(s),r,{style:function(){return b(j,q)}})}})}});if(m.getLength()==0){m.onPostRender.add(function(p,q){if(!m.NativeListBox){g.add(q.id+"_text","focus",l._importClasses,l);g.add(q.id+"_text","mousedown",l._importClasses,l);g.add(q.id+"_open","focus",l._importClasses,l);g.add(q.id+"_open","mousedown",l._importClasses,l)}else{g.add(q.id,"focus",l._importClasses,l)}})}return m},_createFontSelect:function(){var l,k=this,j=k.editor;l=j.controlManager.createListBox("fontselect",{title:"advanced.fontdefault",onselect:function(m){var n=l.items[l.selectedIndex];if(!m&&n){j.execCommand("FontName",false,n.value);return}j.execCommand("FontName",false,m);l.select(function(o){return m==o});if(n&&n.value==m){l.select(null)}return false}});if(l){f(j.getParam("theme_advanced_fonts",k.settings.theme_advanced_fonts,"hash"),function(n,m){l.add(j.translate(m),n,{style:n.indexOf("dings")==-1?"font-family:"+n:""})})}return l},_createFontSizeSelect:function(){var m=this,k=m.editor,n,l=0,j=[];n=k.controlManager.createListBox("fontsizeselect",{title:"advanced.font_size",onselect:function(o){var p=n.items[n.selectedIndex];if(!o&&p){p=p.value;if(p["class"]){k.formatter.toggle("fontsize_class",{value:p["class"]});k.undoManager.add();k.nodeChanged()}else{k.execCommand("FontSize",false,p.fontSize)}return}if(o["class"]){k.focus();k.undoManager.add();k.formatter.toggle("fontsize_class",{value:o["class"]});k.undoManager.add();k.nodeChanged()}else{k.execCommand("FontSize",false,o.fontSize)}n.select(function(q){return o==q});if(p&&(p.value.fontSize==o.fontSize||p.value["class"]&&p.value["class"]==o["class"])){n.select(null)}return false}});if(n){f(m.settings.theme_advanced_font_sizes,function(p,o){var q=p.fontSize;if(q>=1&&q<=7){q=m.sizes[parseInt(q)-1]+"pt"}n.add(o,p,{style:"font-size:"+q,"class":"mceFontSize"+(l++)+(" "+(p["class"]||""))})})}return n},_createBlockFormats:function(){var l,j={p:"advanced.paragraph",address:"advanced.address",pre:"advanced.pre",h1:"advanced.h1",h2:"advanced.h2",h3:"advanced.h3",h4:"advanced.h4",h5:"advanced.h5",h6:"advanced.h6",div:"advanced.div",blockquote:"advanced.blockquote",code:"advanced.code",dt:"advanced.dt",dd:"advanced.dd",samp:"advanced.samp"},k=this;l=k.editor.controlManager.createListBox("formatselect",{title:"advanced.block",onselect:function(m){k.editor.execCommand("FormatBlock",false,m);return false}});if(l){f(k.editor.getParam("theme_advanced_blockformats",k.settings.theme_advanced_blockformats,"hash"),function(n,m){l.add(k.editor.translate(m!=n?m:j[n]),n,{"class":"mce_formatPreview mce_"+n,style:function(){return b(k.editor,{block:n})}})})}return l},_createForeColorMenu:function(){var n,k=this,l=k.settings,m={},j;if(l.theme_advanced_more_colors){m.more_colors_func=function(){k._mceColorPicker(0,{color:n.value,func:function(o){n.setColor(o)}})}}if(j=l.theme_advanced_text_colors){m.colors=j}if(l.theme_advanced_default_foreground_color){m.default_color=l.theme_advanced_default_foreground_color}m.title="advanced.forecolor_desc";m.cmd="ForeColor";m.scope=this;n=k.editor.controlManager.createColorSplitButton("forecolor",m);return n},_createBackColorMenu:function(){var n,k=this,l=k.settings,m={},j;if(l.theme_advanced_more_colors){m.more_colors_func=function(){k._mceColorPicker(0,{color:n.value,func:function(o){n.setColor(o)}})}}if(j=l.theme_advanced_background_colors){m.colors=j}if(l.theme_advanced_default_background_color){m.default_color=l.theme_advanced_default_background_color}m.title="advanced.backcolor_desc";m.cmd="HiliteColor";m.scope=this;n=k.editor.controlManager.createColorSplitButton("backcolor",m);return n},renderUI:function(l){var q,m,r,w=this,u=w.editor,x=w.settings,v,k,j;if(u.settings){u.settings.aria_label=x.aria_label+u.getLang("advanced.help_shortcut")}q=k=i.create("span",{role:"application","aria-labelledby":u.id+"_voice",id:u.id+"_parent","class":"mceEditor "+u.settings.skin+"Skin"+(x.skin_variant?" "+u.settings.skin+"Skin"+w._ufirst(x.skin_variant):"")+(u.settings.directionality=="rtl"?" mceRtl":"")});i.add(q,"span",{"class":"mceVoiceLabel",style:"display:none;",id:u.id+"_voice"},x.aria_label);if(!i.boxModel){q=i.add(q,"div",{"class":"mceOldBoxModel"})}q=v=i.add(q,"table",{role:"presentation",id:u.id+"_tbl","class":"mceLayout",cellSpacing:0,cellPadding:0});q=r=i.add(q,"tbody");switch((x.theme_advanced_layout_manager||"").toLowerCase()){case"rowlayout":m=w._rowLayout(x,r,l);break;case"customlayout":m=u.execCallback("theme_advanced_custom_layout",x,r,l,k);break;default:m=w._simpleLayout(x,r,l,k)}q=l.targetNode;j=v.rows;i.addClass(j[0],"mceFirst");i.addClass(j[j.length-1],"mceLast");f(i.select("tr",r),function(o){i.addClass(o.firstChild,"mceFirst");i.addClass(o.childNodes[o.childNodes.length-1],"mceLast")});if(i.get(x.theme_advanced_toolbar_container)){i.get(x.theme_advanced_toolbar_container).appendChild(k)}else{i.insertAfter(k,q)}g.add(u.id+"_path_row","click",function(n){n=n.target;if(n.nodeName=="A"){w._sel(n.className.replace(/^.*mcePath_([0-9]+).*$/,"$1"));return false}});if(!u.getParam("accessibility_focus")){g.add(i.add(k,"a",{href:"#"},"<!-- IE -->"),"focus",function(){tinyMCE.get(u.id).focus()})}if(x.theme_advanced_toolbar_location=="external"){l.deltaHeight=0}w.deltaHeight=l.deltaHeight;l.targetNode=null;u.onKeyDown.add(function(p,n){var s=121,o=122;if(n.altKey){if(n.keyCode===s){if(h.isWebKit){window.focus()}w.toolbarGroup.focus();return g.cancel(n)}else{if(n.keyCode===o){i.get(p.id+"_path_row").focus();return g.cancel(n)}}}});u.addShortcut("alt+0","","mceShortcuts",w);return{iframeContainer:m,editorContainer:u.id+"_parent",sizeContainer:v,deltaHeight:l.deltaHeight}},getInfo:function(){return{longname:"Advanced theme",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",version:h.majorVersion+"."+h.minorVersion}},resizeBy:function(j,k){var l=i.get(this.editor.id+"_ifr");this.resizeTo(l.clientWidth+j,l.clientHeight+k)},resizeTo:function(j,n,l){var k=this.editor,m=this.settings,o=i.get(k.id+"_tbl"),p=i.get(k.id+"_ifr");j=Math.max(m.theme_advanced_resizing_min_width||100,j);n=Math.max(m.theme_advanced_resizing_min_height||100,n);j=Math.min(m.theme_advanced_resizing_max_width||65535,j);n=Math.min(m.theme_advanced_resizing_max_height||65535,n);i.setStyle(o,"height","");i.setStyle(p,"height",n);if(m.theme_advanced_resize_horizontal){i.setStyle(o,"width","");i.setStyle(p,"width",j);if(j<o.clientWidth){j=o.clientWidth;i.setStyle(p,"width",o.clientWidth)}}if(l&&m.theme_advanced_resizing_use_cookie){a.setHash("TinyMCE_"+k.id+"_size",{cw:j,ch:n})}},destroy:function(){var j=this.editor.id;g.clear(j+"_resize");g.clear(j+"_path_row");g.clear(j+"_external_close")},_simpleLayout:function(z,u,l,j){var y=this,v=y.editor,w=z.theme_advanced_toolbar_location,q=z.theme_advanced_statusbar_location,m,k,r,x;if(z.readonly){m=i.add(u,"tr");m=k=i.add(m,"td",{"class":"mceIframeContainer"});return k}if(w=="top"){y._addToolbars(u,l)}if(w=="external"){m=x=i.create("div",{style:"position:relative"});m=i.add(m,"div",{id:v.id+"_external","class":"mceExternalToolbar"});i.add(m,"a",{id:v.id+"_external_close",href:"javascript:;","class":"mceExternalClose"});m=i.add(m,"table",{id:v.id+"_tblext",cellSpacing:0,cellPadding:0});r=i.add(m,"tbody");if(j.firstChild.className=="mceOldBoxModel"){j.firstChild.appendChild(x)}else{j.insertBefore(x,j.firstChild)}y._addToolbars(r,l);v.onMouseUp.add(function(){var o=i.get(v.id+"_external");i.show(o);i.hide(e);var n=g.add(v.id+"_external_close","click",function(){i.hide(v.id+"_external");g.remove(v.id+"_external_close","click",n);return false});i.show(o);i.setStyle(o,"top",0-i.getRect(v.id+"_tblext").h-1);i.hide(o);i.show(o);o.style.filter="";e=v.id+"_external";o=null})}if(q=="top"){y._addStatusBar(u,l)}if(!z.theme_advanced_toolbar_container){m=i.add(u,"tr");m=k=i.add(m,"td",{"class":"mceIframeContainer"})}if(w=="bottom"){y._addToolbars(u,l)}if(q=="bottom"){y._addStatusBar(u,l)}return k},_rowLayout:function(x,p,l){var w=this,q=w.editor,v,y,j=q.controlManager,m,k,u,r;v=x.theme_advanced_containers_default_class||"";y=x.theme_advanced_containers_default_align||"center";f(d(x.theme_advanced_containers||""),function(s,o){var n=x["theme_advanced_container_"+s]||"";switch(s.toLowerCase()){case"mceeditor":m=i.add(p,"tr");m=k=i.add(m,"td",{"class":"mceIframeContainer"});break;case"mceelementpath":w._addStatusBar(p,l);break;default:r=(x["theme_advanced_container_"+s+"_align"]||y).toLowerCase();r="mce"+w._ufirst(r);m=i.add(i.add(p,"tr"),"td",{"class":"mceToolbar "+(x["theme_advanced_container_"+s+"_class"]||v)+" "+r||y});u=j.createToolbar("toolbar"+o);w._addControls(n,u);i.setHTML(m,u.renderHTML());l.deltaHeight-=x.theme_advanced_row_height}});return k},_addControls:function(k,j){var l=this,m=l.settings,n,o=l.editor.controlManager;if(m.theme_advanced_disable&&!l._disabled){n={};f(d(m.theme_advanced_disable),function(p){n[p]=1});l._disabled=n}else{n=l._disabled}f(d(k),function(q){var p;if(n&&n[q]){return}if(q=="tablecontrols"){f(["table","|","row_props","cell_props","|","row_before","row_after","delete_row","|","col_before","col_after","delete_col","|","split_cells","merge_cells"],function(r){r=l.createControl(r,o);if(r){j.add(r)}});return}p=l.createControl(q,o);if(p){j.add(p)}})},_addToolbars:function(y,k){var B=this,q,p,u=B.editor,C=B.settings,A,j=u.controlManager,w,l,r=[],z,x,m=false;x=j.createToolbarGroup("toolbargroup",{name:u.getLang("advanced.toolbar"),tab_focus_toolbar:u.getParam("theme_advanced_tab_focus_toolbar")});B.toolbarGroup=x;z=C.theme_advanced_toolbar_align.toLowerCase();z="mce"+B._ufirst(z);l=i.add(i.add(y,"tr",{role:"presentation"}),"td",{"class":"mceToolbar "+z,role:"toolbar"});for(q=1;(A=C["theme_advanced_buttons"+q]);q++){m=true;p=j.createToolbar("toolbar"+q,{"class":"mceToolbarRow"+q});if(C["theme_advanced_buttons"+q+"_add"]){A+=","+C["theme_advanced_buttons"+q+"_add"]}if(C["theme_advanced_buttons"+q+"_add_before"]){A=C["theme_advanced_buttons"+q+"_add_before"]+","+A}B._addControls(A,p);x.add(p);k.deltaHeight-=C.theme_advanced_row_height}if(!m){k.deltaHeight-=C.theme_advanced_row_height}r.push(x.renderHTML());r.push(i.createHTML("a",{href:"#",accesskey:"z",title:u.getLang("advanced.toolbar_focus"),onfocus:"tinyMCE.getInstanceById('"+u.id+"').focus();"},"<!-- IE -->"));i.setHTML(l,r.join(""))},_addStatusBar:function(p,k){var l,w=this,q=w.editor,x=w.settings,j,u,v,m;l=i.add(p,"tr");l=m=i.add(l,"td",{"class":"mceStatusbar"});l=i.add(l,"div",{id:q.id+"_path_row",role:"group","aria-labelledby":q.id+"_path_voice"});if(x.theme_advanced_path){i.add(l,"span",{id:q.id+"_path_voice"},q.translate("advanced.path"));i.add(l,"span",{},": ")}else{i.add(l,"span",{},"&#160;")}if(x.theme_advanced_resizing){i.add(m,"a",{id:q.id+"_resize",href:"javascript:;",onclick:"return false;","class":"mceResize",tabIndex:"-1"});if(x.theme_advanced_resizing_use_cookie){q.onPostRender.add(function(){var n=a.getHash("TinyMCE_"+q.id+"_size"),r=i.get(q.id+"_tbl");if(!n){return}w.resizeTo(n.cw,n.ch)})}q.onPostRender.add(function(){g.add(q.id+"_resize","click",function(n){n.preventDefault()});g.add(q.id+"_resize","mousedown",function(E){var t,r,s,o,D,A,B,G,n,F,y;function z(H){H.preventDefault();n=B+(H.screenX-D);F=G+(H.screenY-A);w.resizeTo(n,F)}function C(H){g.remove(i.doc,"mousemove",t);g.remove(q.getDoc(),"mousemove",r);g.remove(i.doc,"mouseup",s);g.remove(q.getDoc(),"mouseup",o);n=B+(H.screenX-D);F=G+(H.screenY-A);w.resizeTo(n,F,true);q.nodeChanged()}E.preventDefault();D=E.screenX;A=E.screenY;y=i.get(w.editor.id+"_ifr");B=n=y.clientWidth;G=F=y.clientHeight;t=g.add(i.doc,"mousemove",z);r=g.add(q.getDoc(),"mousemove",z);s=g.add(i.doc,"mouseup",C);o=g.add(q.getDoc(),"mouseup",C)})})}k.deltaHeight-=21;l=p=null},_updateUndoStatus:function(k){var j=k.controlManager,l=k.undoManager;j.setDisabled("undo",!l.hasUndo()&&!l.typing);j.setDisabled("redo",!l.hasRedo())},_nodeChanged:function(o,u,E,r,F){var z=this,D,G=0,y,H,A=z.settings,x,l,w,C,m,k,j;h.each(z.stateControls,function(n){u.setActive(n,o.queryCommandState(z.controls[n][1]))});function q(p){var s,n=F.parents,t=p;if(typeof(p)=="string"){t=function(v){return v.nodeName==p}}for(s=0;s<n.length;s++){if(t(n[s])){return n[s]}}}u.setActive("visualaid",o.hasVisual);z._updateUndoStatus(o);u.setDisabled("outdent",!o.queryCommandState("Outdent"));D=q("A");if(H=u.get("link")){H.setDisabled((!D&&r)||(D&&!D.href));H.setActive(!!D&&(!D.name&&!D.id))}if(H=u.get("unlink")){H.setDisabled(!D&&r);H.setActive(!!D&&!D.name&&!D.id)}if(H=u.get("anchor")){H.setActive(!r&&!!D&&(D.name||(D.id&&!D.href)))}D=q("IMG");if(H=u.get("image")){H.setActive(!r&&!!D&&E.className.indexOf("mceItem")==-1)}if(H=u.get("styleselect")){z._importClasses();k=[];f(H.items,function(n){k.push(n.value)});j=o.formatter.matchAll(k);H.select(j[0]);h.each(j,function(p,n){if(n>0){H.mark(p)}})}if(H=u.get("formatselect")){D=q(o.dom.isBlock);if(D){H.select(D.nodeName.toLowerCase())}}q(function(p){if(p.nodeName==="SPAN"){if(!x&&p.className){x=p.className}}if(o.dom.is(p,A.theme_advanced_font_selector)){if(!l&&p.style.fontSize){l=p.style.fontSize}if(!w&&p.style.fontFamily){w=p.style.fontFamily.replace(/[\"\']+/g,"").replace(/^([^,]+).*/,"$1").toLowerCase()}if(!C&&p.style.color){C=p.style.color}if(!m&&p.style.backgroundColor){m=p.style.backgroundColor}}return false});if(H=u.get("fontselect")){H.select(function(n){return n.replace(/^([^,]+).*/,"$1").toLowerCase()==w})}if(H=u.get("fontsizeselect")){if(A.theme_advanced_runtime_fontsize&&!l&&!x){l=o.dom.getStyle(E,"fontSize",true)}H.select(function(n){if(n.fontSize&&n.fontSize===l){return true}if(n["class"]&&n["class"]===x){return true}})}if(A.theme_advanced_show_current_color){function B(p,n){if(H=u.get(p)){if(!n){n=H.settings.default_color}if(n!==H.value){H.displayColor(n)}}}B("forecolor",C);B("backcolor",m)}if(A.theme_advanced_show_current_color){function B(p,n){if(H=u.get(p)){if(!n){n=H.settings.default_color}if(n!==H.value){H.displayColor(n)}}}B("forecolor",C);B("backcolor",m)}if(A.theme_advanced_path&&A.theme_advanced_statusbar_location){D=i.get(o.id+"_path")||i.add(o.id+"_path_row","span",{id:o.id+"_path"});if(z.statusKeyboardNavigation){z.statusKeyboardNavigation.destroy();z.statusKeyboardNavigation=null}i.setHTML(D,"");q(function(I){var p=I.nodeName.toLowerCase(),s,v,t="";if(I.nodeType!=1||p==="br"||I.getAttribute("data-mce-bogus")||i.hasClass(I,"mceItemHidden")||i.hasClass(I,"mceItemRemoved")){return}if(h.isIE&&I.scopeName!=="HTML"&&I.scopeName){p=I.scopeName+":"+p}p=p.replace(/mce\:/g,"");switch(p){case"b":p="strong";break;case"i":p="em";break;case"img":if(y=i.getAttrib(I,"src")){t+="src: "+y+" "}break;case"a":if(y=i.getAttrib(I,"name")){t+="name: "+y+" ";p+="#"+y}if(y=i.getAttrib(I,"href")){t+="href: "+y+" "}break;case"font":if(y=i.getAttrib(I,"face")){t+="font: "+y+" "}if(y=i.getAttrib(I,"size")){t+="size: "+y+" "}if(y=i.getAttrib(I,"color")){t+="color: "+y+" "}break;case"span":if(y=i.getAttrib(I,"style")){t+="style: "+y+" "}break}if(y=i.getAttrib(I,"id")){t+="id: "+y+" "}if(y=I.className){y=y.replace(/\b\s*(webkit|mce|Apple-)\w+\s*\b/g,"");if(y){t+="class: "+y+" ";if(o.dom.isBlock(I)||p=="img"||p=="span"){p+="."+y}}}p=p.replace(/(html:)/g,"");p={name:p,node:I,title:t};z.onResolveName.dispatch(z,p);t=p.title;p=p.name;v=i.create("a",{href:"javascript:;",role:"button",onmousedown:"return false;",title:t,"class":"mcePath_"+(G++)},p);if(D.hasChildNodes()){D.insertBefore(i.create("span",{"aria-hidden":"true"},"\u00a0\u00bb "),D.firstChild);D.insertBefore(v,D.firstChild)}else{D.appendChild(v)}},o.getBody());if(i.select("a",D).length>0){z.statusKeyboardNavigation=new h.ui.KeyboardNavigation({root:o.id+"_path_row",items:i.select("a",D),excludeFromTabOrder:true,onCancel:function(){o.focus()}},i)}}},_sel:function(j){this.editor.execCommand("mceSelectNodeDepth",false,j)},_mceInsertAnchor:function(l,k){var j=this.editor;j.windowManager.open({url:this.url+"/anchor.htm",width:320+parseInt(j.getLang("advanced.anchor_delta_width",0)),height:90+parseInt(j.getLang("advanced.anchor_delta_height",0)),inline:true},{theme_url:this.url})},_mceCharMap:function(){var j=this.editor;j.windowManager.open({url:this.url+"/charmap.htm",width:550+parseInt(j.getLang("advanced.charmap_delta_width",0)),height:265+parseInt(j.getLang("advanced.charmap_delta_height",0)),inline:true},{theme_url:this.url})},_mceHelp:function(){var j=this.editor;j.windowManager.open({url:this.url+"/about.htm",width:480,height:380,inline:true},{theme_url:this.url})},_mceShortcuts:function(){var j=this.editor;j.windowManager.open({url:this.url+"/shortcuts.htm",width:480,height:380,inline:true},{theme_url:this.url})},_mceColorPicker:function(l,k){var j=this.editor;k=k||{};j.windowManager.open({url:this.url+"/color_picker.htm",width:375+parseInt(j.getLang("advanced.colorpicker_delta_width",0)),height:250+parseInt(j.getLang("advanced.colorpicker_delta_height",0)),close_previous:false,inline:true},{input_color:k.color,func:k.func,theme_url:this.url})},_mceCodeEditor:function(k,l){var j=this.editor;j.windowManager.open({url:this.url+"/source_editor.htm",width:parseInt(j.getParam("theme_advanced_source_editor_width",720)),height:parseInt(j.getParam("theme_advanced_source_editor_height",580)),inline:true,resizable:true,maximizable:true},{theme_url:this.url})},_mceImage:function(k,l){var j=this.editor;if(j.dom.getAttrib(j.selection.getNode(),"class","").indexOf("mceItem")!=-1){return}j.windowManager.open({url:this.url+"/image.htm",width:355+parseInt(j.getLang("advanced.image_delta_width",0)),height:275+parseInt(j.getLang("advanced.image_delta_height",0)),inline:true},{theme_url:this.url})},_mceLink:function(k,l){var j=this.editor;j.windowManager.open({url:this.url+"/link.htm",width:310+parseInt(j.getLang("advanced.link_delta_width",0)),height:200+parseInt(j.getLang("advanced.link_delta_height",0)),inline:true},{theme_url:this.url})},_mceNewDocument:function(){var j=this.editor;j.windowManager.confirm("advanced.newdocument",function(k){if(k){j.execCommand("mceSetContent",false,"")}})},_mceForeColor:function(){var j=this;this._mceColorPicker(0,{color:j.fgColor,func:function(k){j.fgColor=k;j.editor.execCommand("ForeColor",false,k)}})},_mceBackColor:function(){var j=this;this._mceColorPicker(0,{color:j.bgColor,func:function(k){j.bgColor=k;j.editor.execCommand("HiliteColor",false,k)}})},_ufirst:function(j){return j.substring(0,1).toUpperCase()+j.substring(1)}});h.ThemeManager.add("advanced",h.themes.AdvancedTheme)}(tinymce));