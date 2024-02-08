<?php
//creando primero que nada una variable para la conexion a mi base de datos
try {
    $conexion = new PDO('mysql:host=localhost; dbname=aplicacion', 'root', '');
    echo "Conexion Establecida";
} catch (PDOException $error) {
    echo "Error de conexion:";
}

if (isset($_POST['id'])) {
    $id = ($_POST['id']);
    $completado = (isset($_POST['completado'])) ? 1 : 0;
    $sql = "UPDATE tareas SET completar=? WHERE id=?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$completado, $id]);
}

if (isset($_POST['agregar_tarea'])) {
    $tarea = ($_POST['tarea']);
    $sql = 'INSERT INTO tareas (tarea) VALUE(?)';
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$tarea]);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];  //capturamos el id del registro que queremos
    $sql = "DELETE FROM tareas WHERE id=?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$id]);
}

$sql = 'SELECT  * FROM tareas';
$registros = $conexion->query($sql);
