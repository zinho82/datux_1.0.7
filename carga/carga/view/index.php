<?php

define("BASE_BD", "asterisk");
define("TBL_TEMPORAL_ABC", "sistema_temporal_abcdin");
date_default_timezone_set('America/Santiago');
require_once '/var/www/html/sistema_gestion/carga/carga/core/conexion.php';
require_once '/var/www/html/sistema_gestion/carga/carga/core/Carga.php';

$carga = new Carga(); 
echo "  comenzando segunda parte de la carga  ";
$carga->total_registros(BASE_BD, TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('dmname',BASE_BD,TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('dmaddr1',BASE_BD,TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('dmaddr2',BASE_BD,TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('dmcity',BASE_BD,TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('u6desccomu',BASE_BD,TBL_TEMPORAL_ABC);


echo "  Reparando Telefonos  ";
$carga->Reparar_fonos('u6catelcasa', 'dmphone', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 1 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelofic', 'dmbphone', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 2 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelcelu', 'u6telcelu', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 3 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelcont', 'u6telconta', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 4 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr1', 'u6telotro1', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 5 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr2', 'u6telotro2', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 6 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr3', 'u6telotro3', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 7 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr4', 'u6telotro4', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 8 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr5', 'u6telotro5', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 9 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr6', 'u6telotro6', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 10 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr7', 'u6telotro7', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 11 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr8', 'u6telotro8', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 12 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');
$carga->Reparar_fonos('u6catelotr9', 'u6telotro9', TBL_TEMPORAL_ABC, BASE_BD, 'fono1');
$carga->fonosReparados("Fono 13 ", 'fono1', BASE_BD, TBL_TEMPORAL_ABC, 'ABCDIN_COB');

#Llenando estadisticas
$carga->fonosError('u6catelcasa', 'dmphone', 'Fono 1 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelofic', 'u6telcelu', 'Fono 2 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelcelu', 'u6telcelu', 'Fono 3 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelcont', 'u6telconta', 'Fono 4 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr1', 'u6telotro1', 'Fono 5 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr2', 'u6telotro2', 'Fono 6 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr3', 'u6telotro3', 'Fono 7 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr4', 'u6telotro4', 'Fono 8 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr5', 'u6telotro5', 'Fono 9 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr6', 'u6telotro6', 'Fono 10 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr7', 'u6telotro7', 'Fono 11 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr8', 'u6telotro8', 'Fono 12 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->fonosError('u6catelotr9', 'u6telotro9', 'Fono 13 ',BASE_BD,TBL_TEMPORAL_ABC);
#FONOS OK
$carga->FonosOK('u6catelcasa', 'dmphone', 'Fono 1 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelofic', 'u6telcelu', 'Fono 2 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelcelu', 'u6telcelu', 'Fono 3 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelcont', 'u6telconta', 'Fono 4 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr1', 'u6telotro1', 'Fono 5 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr2', 'u6telotro2', 'Fono 6 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr3', 'u6telotro3', 'Fono 7 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr4', 'u6telotro4', 'Fono 8 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr5', 'u6telotro5', 'Fono 9 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr6', 'u6telotro6', 'Fono 10 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr7', 'u6telotro7', 'Fono 11 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr8', 'u6telotro8', 'Fono 12 ', BASE_BD, TBL_TEMPORAL_ABC);
$carga->FonosOK('u6catelotr9', 'u6telotro9', 'Fono 13 ', BASE_BD, TBL_TEMPORAL_ABC);
#FONOS Nulos
$carga->FonosNulos('u6catelcasa', 'dmphone', 'Fono 1 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelofic', 'u6telcelu', 'Fono 2 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelcelu', 'u6telcelu', 'Fono 3 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelcont', 'u6telconta', 'Fono 4 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr1', 'u6telotro1', 'Fono 5 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr2', 'u6telotro2', 'Fono 6 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr3', 'u6telotro3', 'Fono 7 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr4', 'u6telotro4', 'Fono 8 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr5', 'u6telotro5', 'Fono 9 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr6', 'u6telotro6', 'Fono 10 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr7', 'u6telotro7', 'Fono 11 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr8', 'u6telotro8', 'Fono 12 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNulos('u6catelotr9', 'u6telotro9', 'Fono 13 ',BASE_BD,TBL_TEMPORAL_ABC);

#FONOS NO REPARABLES
$carga->FonosNoReparables('u6catelcasa', 'dmphone', 'Fono 1 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelofic', 'u6telcelu', 'Fono 2 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelcelu', 'u6telcelu', 'Fono 3 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelcont', 'u6telconta', 'Fono 4 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr1', 'u6telotro1', 'Fono 5 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr2', 'u6telotro2', 'Fono 6 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr3', 'u6telotro3', 'Fono 7 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr4', 'u6telotro4', 'Fono 8 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr5', 'u6telotro5', 'Fono 9 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr6', 'u6telotro6', 'Fono 10 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr7', 'u6telotro7', 'Fono 11 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr8', 'u6telotro8', 'Fono 12 ',BASE_BD,TBL_TEMPORAL_ABC);
$carga->FonosNoReparables('u6catelotr9', 'u6telotro9', 'Fono 13 ',BASE_BD,TBL_TEMPORAL_ABC);
