<html>
    <head>
        <style type="text/css">
            <!-- 
            body {font-family:fantasy}
            -->
        </style>
        <meta charset="UTF-8">
        <title>
            Upload an Image   
        </title>
    </head>
    <body style="background-color:#c7d0d5;">
        <h1 style="text-align:center;">WebImage</h1>
        <h3 style="color: black">Suba su imágen.<h3>
             <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
   			 Select image to upload:
   			 
   			 
   			 <input type="file" name="fileToUpload" id="fileToUpload" value="fileToUpload">
   			 
   			 <input type="submit" value="Upload Image" name="submit">
   			 </form>
                
                <form action='subir_imagen.php' method='post' class='subir_imagen'>
                       <div><input name="subir_imagen" type="submit" value="Subir otra imagen"></div>
                </form>
                
                <form action='logout.php' method='post' class='logout'>
                       <div><input name="logout" type="submit" value="Logout"></div>
                </form>
                
                <form action='ver_imagen.php' method='post' class='ver_imagenes'>
                       <div><input name="ver_imagenes" type="submit" value="Ver Imagenes Guardadas"></div>
                </form>

                <?php
// conexión a la base de datos
                session_start();
                include_once "conexion.php";
// propiedades de la imagen

$file = $_FILES['fileToUpload'] ['tmp_name'];
$path = getcwd()."/imagenes/";
$pic = $path.basename($_FILES['fileToUpload']['name']);

echo $pic;

$image = addslashes(file_get_contents($_FILES['fileToUpload'] ['tmp_name']));
$image_name = addslashes($_FILES['fileToUpload'] ['name']);
$image_size = getimagesize($_FILES['fileToUpload'] ['tmp_name']);
        
                	
           	if (!$insert = mysql_query("INSERT INTO store VALUES ('','$image_name','$image','$pic')")) {
           			echo "Problema subiendo imagen";
              		} else {
           			$lastid = mysql_insert_id();
           			echo "Imagen insertada en bd.<p />Tu imagen:<p /><img src=get.php?id=$lastid>";
              		}
               	 
   
$target_dir = getcwd()."/imagenes/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</body>
</html>
