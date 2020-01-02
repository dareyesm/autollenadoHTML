<?php

//llamar la conexion a la base de datos
require 'class/database.php';
$objData = new Database();

if(isset($_GET['opcion'])){
    
    $sth1 = $objData->prepare('select * from users U inner join user_data UD '
            . 'on U.idUsers = UD.idUsers WHERE U.idUsers = :idUser');
    $sth1->bindParam(':idUser', $_GET['opcion']);
    $sth1->execute();
    
    $result1 = $sth1->fetchAll();
    
}

$sth = $objData->prepare('SELECT idUsers, loginUsers FROM users');
$sth->execute();

$result = $sth->fetchAll();

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Auto-llenar un Formulario</title>
        <meta charset="utf-8" />
    </head>
    <script type="text/javascript">
        function buscar(){
            var opcion = document.getElementById('userN').value;
            window.location.href = 'http://localhost:8888/CodigosVideos/11-autofillform/index.php?opcion='+opcion;
        }
    </script>
    <body>
        <form name="autoLlenar" action="save.php" method="post">
            <fieldset>
                <legend>Datos de Usuario:</legend>
                <label>Seleccione el Nombre del Client:</label>
                <select name="userN" id="userN" onchange="return buscar();">
                    <?php
                    
                    if($result1){?>
                    <option value="<?php echo $result1[0]['idUsers'];?>">
                         <?php echo $result1[0]['loginUsers'];?>
                    </option>    
                    <?php
                    }?>
                    <option value=""></option>
                    <?php
                    
                    foreach ($result as $key => $value) {?>
                    <option value="<?php echo $value['idUsers'];?>"><?php echo $value['loginUsers'];?></option>
                    <?php
                        
                    }
                    
                    ?>
                </select>
                <label>Nombres:</label>
                <?php
                
                if(isset($result1)){?>
                    <input type="text" name="names" value="<?php echo $result1[0]['names']?>" />
                <?php
                    
                }else{?>
                    <input type="text" name="names" value="" />
                <?php
                    
                }
                
                ?>
                <label>Correo:</label>
                <?php
                
                if(isset($result1)){?>
                    <input type="text" name="email" value="<?php echo $result1[0]['emailUser']?>" />
                <?php
                    
                }else{?>
                    <input type="text" name="email" value="" />
                <?php
                    
                }
                
                ?>
                    <label>Pais:</label>
                <?php
                
                if(isset($result1)){?>
                    <input type="text" name="country" value="<?php echo $result1[0]['country']?>" />
                <?php
                    
                }else{?>
                    <input type="text" name="country" value="" />
                <?php
                    
                }
                
                ?>
                    <label>Ciudad:</label>
                <?php
                
                if(isset($result1)){?>
                    <input type="text" name="city" value="<?php echo $result1[0]['city']?>" />
                <?php
                    
                }else{?>
                    <input type="text" name="city" value="" />
                <?php
                    
                }
                
                ?>
                <input type="submit" value="ENVIAR" />
            </fieldset>
        </form>
    </body>
</html>

