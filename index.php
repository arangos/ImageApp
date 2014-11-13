<?php
session_start();
include_once "conexion.php";

function verificar_login($user, $password, &$result) {
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'";
    $rec = mysql_query($sql);
    $count = 0;

    while ($row = mysql_fetch_object($rec)) {
        $count++;
        $result = $row;
    }

    if ($count == 1) {
        return 1;
    } else {
        return 0;
    }
}

if (!isset($_SESSION['userid'])) {
    if (isset($_POST['login'])) {
        if (verificar_login($_POST['user'], $_POST['password'], $result) == 1) {
            $_SESSION['userid'] = $result->idusuario;
            header("location:subir_imagen.php");
        } else {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
    ?> 
    <html>
        <body>
            <img src="http://img.webme.com/pic/m/meisterbkn/welcome.jpg" align="middle">
            <style type="text/css">
                <!-- 
                body {font-family:fantasy}
                -->
                body {background-color:#c7d0d5;}
            </style>

            <form action="" method="post" class="login" align="middle"> 
                <div><label>Usuario</label><input name="user" type="text" ></div> 
                <div><label>Contrasena</label><input name="password" type="password"></div> 
                <div><input name="login" type="submit" value="Login"></div>
            </form> 

            <form action="registro_usuario.php" method="post" class="registro" align="middle">
                <div><input name="registro" type="submit" value="Registro"></div>
            </form>
            <script type="text/javascript">
        </body>
    </html>

    <?php
} else {
    echo 'Su usuario ingreso correctamente.' ;
    echo '<a href="logout.php">Logout</a>';
    echo '<a href="subir_imagen.php">Aceptar</a>';
}
?>