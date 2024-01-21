<?php 
// traemos el año actual
$año = date("Y");
 ?>
 <?php
//  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 1 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_feriados=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
 <?php 
 //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 2 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_licencias=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
 <?php 
 //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 3 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_receptor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
 <?php 
 //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 4 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_permisos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
  <?php 
  //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto 
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 7 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_otros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
   <?php 
   //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 5 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_pSubrogacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
   <?php 
   //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 6 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_lSubrogacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
    <?php
    //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos 
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID) as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 8 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_Designacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
     <?php 
     //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID)as cantidad_decreto FROM decreto
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 9 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_MA=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
      <?php 
      //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID)as cantidad_decreto FROM decreto 
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 10 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_CA=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>
       <?php 
      //  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("
SELECT COUNT(decreto.DECRETO_TIPO_ID)as cantidad_decreto FROM decreto 
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
WHERE DECRETO_TIPO_ID = 11 AND DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID;");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$cantidad_FS=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 ?>