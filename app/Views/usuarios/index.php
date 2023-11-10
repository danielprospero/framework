<?php 
var_dump($dados['usuarios']);   
foreach($dados['usuarios'] as $usuario)
{
    echo $usuario->usuarioNome;
    echo "<br>";
}
?>
