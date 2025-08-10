<?php
if (!empty($_POST["btneditar"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    //daros de la imagen
    $imagen = $_FILES["imagen"]["tmp_name"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = strtolower(pathinfo($nombreImagen,PATHINFO_EXTENSION));
    $directorio = "archivos/";

    if (is_file($imagen)) {
        
        if ( $tipoImagen=="jpg" or $tipoImagen=="jpeg" or $tipoImagen=="png") {
            
            //eliminamos la imagen anterior
            try {
                unlink($nombre);
            } catch (\Throwable $th) {
                //throw $th;
            }
            
            $ruta = $directorio . $id . "." . $tipoImagen;
            if (move_uploaded_file($imagen, $ruta)) {
                
                $editar=$conexion->query("update img set foto= '$ruta' where id_img=$id");

                if ($editar==1) {
                     echo "<div class=alert alert-success>Correcto, la imagen se ha subido con éxito</div>";
                } else {
                     echo "<div class=alert alert-danger>Error al editar la imagen</div>";
                }
                

            } else {
                echo "<div class=alert alert-info>Error al subir la imagen al servidos</div>";
            }
            
        } else {
           echo "<div class=alert alert-info>Solo se aceptan formatos jpg, jpeg o png.</div>";
        }
        

    } else {
        echo "<div class=alert alert-info>Debes seleccionar una imagen</div>";
    } ?>
   
   <script>
        history.replaceState(null, null, location.pathname)
   </script>

<?php }

?>