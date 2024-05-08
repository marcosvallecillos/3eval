
<?php
require_once "autoloader.php";
$modelo = new modelo();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $task_id = $_GET["id"];
    
    
    $task = $modelo->encotrarID($task_id);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    

    $modelo->updateTarea($id, $titulo, $descripcion, $fecha_vencimiento);

    header("Location: prueba.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Modificar Tarea</title>
    <link rel="stylesheet" type="text/css" href="form/view.css" media="all">
</head>
<body id="main_body">
    
    <img id="top" src="form/top.png" alt="">
    <div id="form_container">
    
        <h1><a>Modificar Tarea</a></h1>
        <form class="appnitro"  method="post" action="">
            <div class="form_description">
                <h2>Modificar Tarea</h2>
                <p>Modifica los datos de la tarea seleccionada</p>
            </div>                      
            <ul >
                <li>
                    <label class="description" for="titulo">Título </label>
                    <div>
                        <input name="titulo" class="element text medium" type="text" maxlength="255" value="<?php echo $task->titulo; ?>"/> 
                    </div> 
                </li>       
                <li>
                    <label class="description" for="descripcion">Descripción de la tarea </label>
                    <div>
                        <textarea name="descripcion" class="element textarea medium"><?php echo $task->descripcion; ?></textarea> 
                    </div> 
                </li>
                <li>
                    <label class="description" for="fecha_vencimiento">Fecha de vencimiento </label>
                    <span>
                        <input name="fecha_vencimiento" class="element text" size="10" maxlength="10" value="<?php echo $task->fecha_vencimiento; ?>" type="date">
                    </span>     
                </li>
                
                <li class="buttons">
                    <input type="hidden" name="id" value="<?php echo $task->id; ?>" />
                    <input class="button_text" type="submit" name="submit" value="Guardar Cambios" />
                </li>
            </ul>
        </form>    
        <div id="footer">
            Generated by <a href="http://www.floridauniversitaria.es">Florida</a>
        </div>
    </div>
    <img id="bottom" src="form/bottom.png" alt="">
</body>
</html>