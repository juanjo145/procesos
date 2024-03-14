<?php

include("conexion.php");

$nombre = $_POST["usuario"];
$pass   = $_POST["pass"];
$tipoUsuario = $_POST["tipoUsuario"];

//Login
if(isset($_POST["btningresar"]))
{
    $query = mysqli_query($conn,"SELECT * FROM login WHERE Usuario = '$nombre' AND Password='$pass' AND idTipoUsuario = $tipoUsuario");
    $nr = mysqli_num_rows($query);
    
    if($nr == 1)
    {
        $usuario = mysqli_fetch_assoc($query);
        $idTipoUsuario = $usuario['idTipoUsuario'];
        
        if($idTipoUsuario == 1)
        {
            echo "<script> alert('Bienvenido $nombre'); window.location='admin.html' </script>";
        }
        elseif($idTipoUsuario == 2)
        {
            echo "<script> alert('Bienvenido $nombre'); window.location='cliente.html' </script>";
        }
        else
        {
            echo "<script> alert('Tipo de usuario desconocido'); window.location='index.html' </script>";
        }
    }
    else
    {
        echo "<script> alert('Usuario no existe'); window.location='index.html' </script>";
    }
}

//Registrar
if(isset($_POST["btnregistrar"]))
{
    $sqlgrabar = "INSERT INTO login(Usuario, Password, idTipoUsuario) VALUES ('$nombre','$pass','$tipoUsuario')";
    
    if(mysqli_query($conn,$sqlgrabar))
    {
        echo "<script> alert('Usuario registrado con éxito: $nombre'); window.location='index.html' </script>";
    }
    else 
    {
        echo "Error: ". $sqlgrabar ."<br>". mysqli_error($conn);
    }
}

?>
