<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->


<?php if($this->lang == 'spa'):?>
<html lang="es">
<?php else:?>
<html lang="<?php echo $site->langDir ?>">
<?php endif;?>

	<?php $site->getHead();?>
	<body>
	
	<!-- Se Spagnolo allora faccio vedere pagina statica -->
	<?php if($site->lang == 'spa'):?>
	
		<?php $site->getFile('home_spagnolo',true)?>
		<?php $site->getScript();?>
		<?php $site->getFile('window',true)?>
		<?php $site->getCookiesText();?>
	
	<!-- Se Russo allora faccio vedere pagina statica -->
	<?php elseif($site->lang == 'rus'):?>
	
		<?php $site->getFile('home_russo',true)?>
		<?php $site->getScript();?>
		<?php $site->getFile('window',true)?>
		<?php $site->getCookiesText();?>

    <?php elseif($site->lang == 'deu'):?>

        <?php $site->getFile('home_tedesco',true)?>
        <?php $site->getScript();?>
        <?php $site->getFile('window',true)?>
        <?php $site->getCookiesText();?>
	<?php else:?>
	
		<?php $site->getFbScript()?>
			
			
	        <div class="main-wrapper">
        	<?php $site->getFile('header');?>
        	
        	
        	<?php if($this->page == 'policy'):?>
			<?php $site->getPolicy()?>
			<?php else:?>
			<?php $site->getPage(true)?>
			<?php endif;?>
			
			
			<?php $site->getH2()?>
			<?php $site->getFile('section',true)?>
			</div>
		
		
		<?php $site->getFile('footer',true)?>
		<?php $site->getFile('window',true)?>
		
		<?php $site->getScript();?>
		<?php $site->getCookiesText();?>
	<?php endif;?>
	<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){ f[z]=function(){ (a.s=a.s||[]).push(arguments)};var a=f[z]._={ },q=c.methods.length;while(q--){(function(n){f[z][n]=function(){ f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={ 0:+new Date};a.P=function(u){ a.p[u]=new Date-a.p[0]};function s(){ a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){ hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){ return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){ b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{ b.contentWindow[g].open()}catch(w){ c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{ var t=b.contentWindow[g];t.write(p());t.close()}catch(x){ b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({ loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('1584-628-10-4108');/*]]>*/</script><noscript><a href="https://www.olark.com/site/1584-628-10-4108/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->	
	</body>
</html>