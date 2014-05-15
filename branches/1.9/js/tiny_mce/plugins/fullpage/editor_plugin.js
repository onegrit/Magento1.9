(function(){var b=tinymce.each,a=tinymce.html.Node;tinymce.create("tinymce.plugins.FullPagePlugin",{init:function(c,d){var e=this;e.editor=c;c.addCommand("mceFullPageProperties",function(){c.windowManager.open({file:d+"/fullpage.htm",width:430+parseInt(c.getLang("fullpage.delta_width",0)),height:495+parseInt(c.getLang("fullpage.delta_height",0)),inline:1},{plugin_url:d,data:e._htmlToData()})});c.addButton("fullpage",{title:"fullpage.desc",cmd:"mceFullPageProperties"});c.onBeforeSetContent.add(e._setContent,e);c.onGetContent.add(e._getContent,e)},getInfo:function(){return{longname:"Fullpage",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/fullpage",version:tinymce.majorVersion+"."+tinymce.minorVersion}},_htmlToData:function(){var f=this._parseHeader(),h={},c,i,g,e=this.editor;function d(l,j){var k=l.attr(j);return k||""}h.fontface=e.getParam("fullpage_default_fontface","");h.fontsize=e.getParam("fullpage_default_fontsize","");i=f.firstChild;if(i.type==7){h.xml_pi=true;g=/encoding="([^"]+)"/.exec(i.value);if(g){h.docencoding=g[1]}}i=f.getAll("#doctype")[0];if(i){h.doctype="<!DOCTYPE"+i.value+">"}i=f.getAll("title")[0];if(i&&i.firstChild){h.metatitle=i.firstChild.value}b(f.getAll("meta"),function(m){var k=m.attr("name"),j=m.attr("http-equiv"),l;if(k){h["meta"+k.toLowerCase()]=m.attr("content")}else{if(j=="Content-Type"){l=/charset\s*=\s*(.*)\s*/gi.exec(m.attr("content"));if(l){h.docencoding=l[1]}}}});i=f.getAll("html")[0];if(i){h.langcode=d(i,"lang")||d(i,"xml:lang")}i=f.getAll("link")[0];if(i&&i.attr("rel")=="stylesheet"){h.stylesheet=i.attr("href")}i=f.getAll("body")[0];if(i){h.langdir=d(i,"dir");h.style=d(i,"style");h.visited_color=d(i,"vlink");h.link_color=d(i,"link");h.active_color=d(i,"alink")}return h},_dataToHtml:function(g){var f,d,h,j,k,e=this.editor.dom;function c(n,l,m){n.attr(l,m?m:undefined)}function i(l){if(d.firstChild){d.insert(l,d.firstChild)}else{d.append(l)}}f=this._parseHeader();d=f.getAll("head")[0];if(!d){j=f.getAll("html")[0];d=new a("head",1);if(j.firstChild){j.insert(d,j.firstChild,true)}else{j.append(d)}}j=f.firstChild;if(g.xml_pi){k='version="1.0"';if(g.docencoding){k+=' encoding="'+g.docencoding+'"'}if(j.type!=7){j=new a("xml",7);f.insert(j,f.firstChild,true)}j.value=k}else{if(j&&j.type==7){j.remove()}}j=f.getAll("#doctype")[0];if(g.doctype){if(!j){j=new a("#doctype",10);if(g.xml_pi){f.insert(j,f.firstChild)}else{i(j)}}j.value=g.doctype.substring(9,g.doctype.length-1)}else{if(j){j.remove()}}j=f.getAll("title")[0];if(g.metatitle){if(!j){j=new a("title",1);j.append(new a("#text",3)).value=g.metatitle;i(j)}}if(g.docencoding){j=null;b(f.getAll("meta"),function(l){if(l.attr("http-equiv")=="Content-Type"){j=l}});if(!j){j=new a("meta",1);j.attr("http-equiv","Content-Type");j.shortEnded=true;i(j)}j.attr("content","text/html; charset="+g.docencoding)}b("keywords,description,author,copyright,robots".split(","),function(m){var l=f.getAll("meta"),n,p,o=g["meta"+m];for(n=0;n<l.length;n++){p=l[n];if(p.attr("name")==m){if(o){p.attr("content",o)}else{p.remove()}return}}if(o){j=new a("meta",1);j.attr("name",m);j.attr("content",o);j.shortEnded=true;i(j)}});j=f.getAll("link")[0];if(j&&j.attr("rel")=="stylesheet"){if(g.stylesheet){j.attr("href",g.stylesheet)}else{j.remove()}}else{if(g.stylesheet){j=new a("link",1);j.attr({rel:"stylesheet",text:"text/css",href:g.stylesheet});j.shortEnded=true;i(j)}}j=f.getAll("body")[0];if(j){c(j,"dir",g.langdir);c(j,"style",g.style);c(j,"vlink",g.visited_color);c(j,"link",g.link_color);c(j,"alink",g.active_color);e.setAttribs(this.editor.getBody(),{style:g.style,dir:g.dir,vLink:g.visited_color,link:g.link_color,aLink:g.active_color})}j=f.getAll("html")[0];if(j){c(j,"lang",g.langcode);c(j,"xml:lang",g.langcode)}h=new tinymce.html.Serializer({validate:false,indent:true,apply_source_formatting:true,indent_before:"head,html,body,meta,title,script,link,style",indent_after:"head,html,body,meta,title,script,link,style"}).serialize(f);this.head=h.substring(0,h.indexOf("</body>"))},_parseHeader:function(){return new tinymce.html.DomParser({validate:false,root_name:"#document"}).parse(this.head)},_setContent:function(g,d){var m=this,i,c,h=d.content,f,l="",e=m.editor.dom,j;function k(n){return n.replace(/<\/?[A-Z]+/g,function(o){return o.toLowerCase()})}if(d.format=="raw"&&m.head){return}if(d.source_view&&g.getParam("fullpage_hide_in_source_view")){return}h=h.replace(/<(\/?)BODY/gi,"<$1body");i=h.indexOf("<body");if(i!=-1){i=h.indexOf(">",i);m.head=k(h.substring(0,i+1));c=h.indexOf("</body",i);if(c==-1){c=h.length}d.content=h.substring(i+1,c);m.foot=k(h.substring(c))}else{m.head=this._getDefaultHeader();m.foot="\n</body>\n</html>"}f=m._parseHeader();b(f.getAll("style"),function(n){if(n.firstChild){l+=n.firstChild.value}});j=f.getAll("body")[0];if(j){e.setAttribs(m.editor.getBody(),{style:j.attr("style")||"",dir:j.attr("dir")||"",vLink:j.attr("vlink")||"",link:j.attr("link")||"",aLink:j.attr("alink")||""})}e.remove("fullpage_styles");if(l){e.add(m.editor.getDoc().getElementsByTagName("head")[0],"style",{id:"fullpage_styles"},l);j=e.get("fullpage_styles");if(j.styleSheet){j.styleSheet.cssText=l}}},_getDefaultHeader:function(){var f="",c=this.editor,e,d="";if(c.getParam("fullpage_default_xml_pi")){f+='<?xml version="1.0" encoding="'+c.getParam("fullpage_default_encoding","ISO-8859-1")+'" ?>\n'}f+=c.getParam("fullpage_default_doctype",'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');f+="\n<html>\n<head>\n";if(e=c.getParam("fullpage_default_title")){f+="<title>"+e+"</title>\n"}if(e=c.getParam("fullpage_default_encoding")){f+='<meta http-equiv="Content-Type" content="text/html; charset='+e+'" />\n'}if(e=c.getParam("fullpage_default_font_family")){d+="font-family: "+e+";"}if(e=c.getParam("fullpage_default_font_size")){d+="font-size: "+e+";"}if(e=c.getParam("fullpage_default_text_color")){d+="color: "+e+";"}f+="</head>\n<body"+(d?' style="'+d+'"':"")+">\n";return f},_getContent:function(d,e){var c=this;if(!e.source_view||!d.getParam("fullpage_hide_in_source_view")){e.content=tinymce.trim(c.head)+"\n"+tinymce.trim(e.content)+"\n"+tinymce.trim(c.foot)}}});tinymce.PluginManager.add("fullpage",tinymce.plugins.FullPagePlugin)})();