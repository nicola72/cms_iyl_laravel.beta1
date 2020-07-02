<?php session_start(); ?>
<!DOCTYPE HTML>
<!--
/*
 * jQuery File Upload Plugin Demo 6.8
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title>jQuery File Upload Demo</title>
<meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap styles -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<!-- Generic page styles -->
<link rel="stylesheet" href="css/style.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
	
</head>
<body>

<?php
$tabella=$_REQUEST['tabella'];
$id=$_REQUEST['id'];
require_once($_SERVER['DOCUMENT_ROOT']."/admin/_parametri.php");
if($id==0){
	$query="SELECT Auto_increment FROM information_schema.tables WHERE table_name='$tabella'";
	$result=mysql_query($query);
	$xx=mysql_fetch_row($result);
	$id=$xx[0];
}
$_SESSION['tabella']=$tabella;
$_SESSION['primary_key']=$id;
$_SESSION['dimensione_max_miniature_immagini']=$_REQUEST['dimensione_max_miniature_immagini'];

		//Campo caricamento immagini
		//devo creare le directory in cui salvare le immagini, e lo devo fare via ftp altrimenti non mi ci scrive
		// set up basic connection
		//echo $ftp_host; exit;
		$conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftp_host"); 		
		// try to login
		if (!(@ftp_login($conn_id, $ftp_id, $ftp_pw))) 
		{
		    echo "Couldn't connect as $ftp_id\n";
		}		
		// try to create the directory $dir
//		$ftpuploaddir=str_replace("/home/amministrazione.inyourlife.info/","/",dirname($_SERVER['SCRIPT_FILENAME']));
//		$ftpuploaddir.="/jqueryuploadfiles/server/php/".$_SESSION["nome_dominio"]."/".$this->originalPrimaryTable."/".$id;
		$ftpuploaddir.="/httpdocs/file/".$tabella."/".$id;
//		echo $ftpuploaddir; exit;
		// /public_html/cmsv3/jqueryuploadfiles/server/php/corniceriapaolotonda.it/tb_foto_pittori/6
		//devo creare il percorso ftp
		$upload_dir1=$ftpuploaddir."/files";
		$upload_dir2=$ftpuploaddir."/thumbnails";
		$upload_dir3=$ftpuploaddir."/crops";
		ftp_chdir($conn_id,"/");
		if (!(ftp_mkdir_recursive($conn_id, $upload_dir1))) {
			echo "Problemi con la creazione di $upload_dir1";
		}
		ftp_chdir($conn_id,"/");
		if (!(ftp_mkdir_recursive($conn_id, $upload_dir2))) {
			echo "Problemi con la creazione di $upload_dir2";
		}
		ftp_chdir($conn_id,"/");
		if (!(ftp_mkdir_recursive($conn_id, $upload_dir3))) {
			echo "Problemi con la creazione di $upload_dir3";
		}
		//close the connection
		ftp_close($conn_id);
	
?>	
<div style="text-align: center">
<?php if ($dimensione_consigliata[$tabella]) { ?>
	Dimensione consigliata per le foto <?php echo $dimensione_consigliata[$tabella];?> pixel<br>Dimensione minima in larghezza <?php echo $_REQUEST['dimensione_max_miniature_immagini']; ?> pixel<br/>
<?php } else { ?>
	Dimensione consigliata per le foto 1270*960 pixel<br>Dimensione minima in larghezza 1270 pixel<br/>
<?php } ?>
</div>

<div style='width:90%;margin-left:50px;' id="fileimmaginicontainer"><h4 style="color:red;margin-left:10px;">Gestione Files e Immagini</h4><br/>
		
    <form id="fileupload" action="server/php/index.php" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7" style="margin-left:10px;">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Aggiungi files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Inizia upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Ferma upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Cancella</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">

        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
		{% if (file.type.toString().toUpperCase() === "APPLICATION/PDF") { 
			file.thumbnail_url="icon/pdf_icon.png";
		
		}  else if (file.type.toString().toUpperCase() === "APPLICATION/VND.OPENXMLFORMATS-OFFICEDOCUMENT.PRESENTATIONML.PRESENTATION"
       		|| file.type.toString().toUpperCase() === "APPLICATION/VND.MS-POWERPOINT") {
     		file.thumbnail_url="icon/ppt_icon.png";
		
		} else if (file.type.toString().toUpperCase() === "APPLICATION/VND.OPENXMLFORMATS-OFFICEDOCUMENT.WORDPROCESSINGML.DOCUMENT"
       		|| file.type.toString().toUpperCase() === "APPLICATION/MSWORD") {
     		file.thumbnail_url="icon/word_icon.png";
		
		} %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="icon-trash icon-white"></i>
                <span>{%=locale.fileupload.destroy%}</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="http://blueimp.github.io/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The localization script -->
<script src="js/locale.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]></script><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->  
    
</div><br/>
</body> 
</html>

<?php
function ftp_mkdir_recursive($con_id,$path){
		$mode=777;
		$mode = octdec ( str_pad ( $mode, 4, '0', STR_PAD_LEFT ) );
		$mode = (int) $mode;
        $fullpath = ftp_pwd($con_id);
        foreach(explode("/",$path) as $part){
                $fullpath .= $part."/";
                if(empty($part) and ($part!="0")){
                        continue;
                }
                if(!@ftp_chdir($con_id, $fullpath)){
                        if(@ftp_mkdir($con_id, $part)){
                        		ftp_chmod($con_id,$mode,$part);
                                ftp_chdir($con_id, $part);
                        }else{
                                return false;
                        }
                }
        }
        return true;
}
?>