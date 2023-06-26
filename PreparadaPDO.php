<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=premiership", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


#En este ejemplo, se obtienen los nombres de las columnas con array_keys() y se almacenan en la variable $keys. Luego, en el bucle while, se recorren los nombres de las columnas con un foreach, y se accede al valor de cada columna en base a su nombre con $row[$key]. Así, se asegura que se muestren todas las columnas de la tabla, independientemente de su número o nombre.

$stm = $pdo->prepare("SELECT PLAYER_NAME as 'Nombre', NATION_NAME as 'País'  FROM player inner join NATION on PLAYER.NATION_ID = NATION.NATION_ID");
$stm->execute();
$row = $stm->fetch(PDO::FETCH_ASSOC);
$keys = array_keys($row); //obtiene los nombres de las columnas

while($row) {
  echo "<table style='border: solid 1px black;' cols='2'><tr>";
  foreach($keys as $key) {
    echo "<td><strong>".$key . "</strong> => <strong>" . $row[$key] . "</strong> || </td><br>"; //accede al valor de cada columna en base a su nombre
  }
  echo "</tr></table>";
  $row = $stm->fetch(PDO::FETCH_ASSOC);
}




?>
</body>
</html>