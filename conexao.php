<?php

$host = "localhost";
$porta = "3307";
$banco = "biblioteca";
$usuario = "root";
$senha = "";

try {

    $db = new PDO(
        "mysql:host=$host;port=$porta;dbname=$banco",
        $usuario,
        $senha
    );

} catch(PDOException $e) {

    echo "Erro: " . $e->getMessage();

}

?>