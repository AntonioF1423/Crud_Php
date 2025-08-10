<?php
if (!empty($_POST["btnregistrar"])) {
   
    $imagen=$_FILES["imagen"]["tmp_name"];
    $nombreImagen=$_FILES ["imagen"]["name"];
    $tipoImagen=strtolower(pathinfo($nombreImagen,PATHINFO_EXTENSION));
    $sizeImagen=$_FILES ["imagen"]["size"];
    $directorio="archivos/";

    if ($tipoImagen=="jpg" or $tipoImagen=="jpeg" or $tipoImagen=="png" ) {
                 
        $registro=$conexion->query("insert into img(foto) values('')");
        $idRegistro=$conexion->insert_id;

        $ruta=$directorio.$idRegistro.".".$tipoImagen;
        $actualizarImagen=$conexion->query(" update img set foto= '$ruta' where id_img= $idRegistro");

        //almacenando la img
        if(move_uploaded_file($imagen, $ruta)) {
            echo "<div class=alert alert-info>Imagen guardada exitosamente</div>";
        }else{
            echo "<div class=alert alert-danger>Error al guardar la imagen</div>";
        }

    } else {
         echo "<div class=alert alert-info>Solo se aceptan formatos de tipo jpg, jpeg, png.</div>";
    } ?>

<script>
    history.replaceState(null, null, location.pathname)
</script>

<?php }
    
?>