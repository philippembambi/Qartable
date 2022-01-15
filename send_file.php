<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fiches</title>
	<link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>

<form id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="send.php" target="uploadFrame" method="post">
    
    <span style="visibility: hidden;">
    <input type="file" name="uploadFile" id="uploadFile">
  </span>      
  <h6 id="fichier" name="fichier"></h6>
  
    <button class="ui-btn ui-corner-all ui-icon-camera ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="document.uploadForm.uploadFile.click()">Pdf</button>
    <button id="uploadSubmit" class="ui-btn ui-corner-all ui-icon-action ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="document.uploadForm.submit()">Ok</button>  
    </form>
    
    <div id="uploadStatus">Aucun upload en cours</div>
    <div id="loadingstate"></div>
    <iframe id="uploadFrame" name="uploadFrame"></iframe>

    <script>
  function uploadEnd(error, path) {
if (error === 'OK') {
document.getElementById('uploadStatus').innerHTML = '<a href="./images/' + path + '">Upload effectué !</a><br/><a href="./images/' + path +
'"><img src="./images/PDF_100px.png" style="width:250px;height:200px;"/></a>';
document.getElementById('fichier').innerHTML = path;
} else {
document.getElementById('uploadStatus').innerHTML = error;
}
}
document.getElementById('uploadForm').addEventListener('submit',
function() {
document.getElementById('uploadStatus').innerHTML ='Chargement...';
}, true);
  </script>

</body>
</html>