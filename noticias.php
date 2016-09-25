<?php
require_once 'PDOAdmin.php';

$_DB = new PDOAdmin(); 
$pagina = isset($_GET['pag']) ? $_GET['pag'] : 0;
$offset = $pagina * 15;

//las 15 noticias de la página
$query = "SELECT *
		  FROM noticia
		  OFFSET $pagina LIMIT 15";
$resultado = $_DB->execute($query, 1);

//total de páginas

$query2 = "SELECT COUNT(*) as n_noticias
		   FROM noticia";

$resultado = $_DB->execute($query2, 2);

$total_noticias  = $resultado['n_noticias'];
$paginas = ceil( $total_noticias/15 );

 

//ENLACES HTML DE LA PAGINA

for( $i = 0; $i < $paginas; $i++ ){

    $pagina_texto = $i + 1;
    $clase = '';
    if( $pagina == $i )
      $clase = 'active';

    echo '<a href="?pag=' . $i .  '" class="'$clase'" >' . $pagina_texto . '</a>';

}