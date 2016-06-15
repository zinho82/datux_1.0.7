<html>
    <?php
    require_once '../core/conexion.php';
    require_once '../core/Panel.php';
    $panel=new Panel();
    $campaign_id='ABCI0616';
    ?>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    </head>  
    <body> 
 <!--      <fieldset><legend><b>Dashboard </b></legend>
            <fieldset>
                <legend>Campaña <b><?php echo $campaign_id; ?></b> </legend>
                <div class="row">
                     <div class="col-lg-6">
                         <div class="panel panel-info">
                             <div class="panel-heading">Desglose por dias de retraso</div>
                             <div class="panel-body  ">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th>Tramo</th>
                                             <th>Asignados</th>
                                             <th>Gestionados</th>
                                             <th>Monto Gest.</th>
                                             <th>Deuda Total</th>
                                             <th>Cant. Pagos</th>
                                             <th>Monto Pagos</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>1 - 179</td>
                                             <td>aa <?php  echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 1, 179);   ?></td>
                                           <td><?php echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 1, 179);   ?></td>
                                             <td><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>180 - 270</td>
                                             <td><?php //echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 180, 270);   ?></td>
                                             <td><?php //echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 180, 270);   ?></td>
                                             <td><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>271 - 360</td>
                                             <td><?php //echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 271, 360);   ?></td>
                                             <td><?php //echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 271, 360);   ?></td>
                                             <td><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>361 - 720</td>
                                             <td><?php //echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 361, 720);   ?></td>
                                             <td><?php //echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 361, 720);   ?></td>
                                             <td><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>721 - 1080</td>
                                             <td><?php //echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>+1080</td>
                                             <td><?php echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 1081, 1000000);   ?></td>
                                             <td><?php echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 1081, 1000000);   ?></td>
                                             <td><?php echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                         </tr>
                                     </tbody>
                                     <tfoot>
                                      <tr>
                                             <th style="font-weight: bold;" ><b>Totales</b></td>
                                             <th><?php //echo $panel->Asignados($campaign_id, "asterisk", "sistema_deuda", 0, 1000000);   ?>         </th>
                                             <th><?php //echo $panel->gestionados($campaign_id, "asterisk", "sistema_gestiones", 0, 1000000);   ?>   </th>
                                             <th><?php //echo $panel->Montos($campaign_id, "asterisk", "sistema_gestiones", 0, 1000000);   ?>        </th>
                                             <th><?php //echo $panel->deuda_total($campaign_id, "asterisk", "sistema_deuda", 0, 1000000);   ?>      </th>
                                             <th><?php //echo $panel->cantPagos($campaign_id, "asterisk", "sistema_gestiones", 0, 1000000);   ?>    </th>
                                             <th><?php //echo $panel->montoPagos($campaign_id, "asterisk", "sistema_gestiones", 1, 1000000);   ?>  </th>
     
                                         </tr> 
                                     </tfoot>
                                 </table>
                             </div>
                         </div>
                     </div>
                     
                     <div class="col-lg-6"> 
                         <div class="panel panel-info">
                             <div class="panel-heading">Desglose por Monto Deuda (tramo x 1000)</div>
                             <div class="panel-body  ">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th>Tramo</th>
                                             <th>Asignados</th>
                                             <th>Gestionados</th>
                                             <th>Monto Gest.</th>
                                             <th>Deuda Total</th>
                                             <th>Cant. Pagos</th>
                                             <th>Monto Pagos</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <th>1 - 179</th>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 1, 179);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 1, 179);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 1, 179);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>180 - 270</td>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 180, 270);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 180, 270);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 180, 270);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>271 - 360</td>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 271, 360);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 271, 360);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 271, 360);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>361 - 720</td>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 361, 720);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 361, 720);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 361, 720);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>721 - 1080</td>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 721, 1080);   ?></td>
                                         </tr>
                                         <tr>
                                             <td>+1080</td>
                                             <td><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 1081, 1000000);   ?></td>
                                             <td><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 1081, 1000000);   ?></td>
                                             <td><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                             <td><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 1081, 1000000);   ?></td>
                                         </tr>
     
                                     </tbody>
                                     <tfoot>
                                         <tr>
                                             <th style="font-weight: bold;" ><b>Totales</b></td>
                                             <th><?php //echo $panel->AsignadosMonto($campaign_id, "asterisk", "sistema_deuda", 0, 1000000);   ?>         </th>
                                             <th><?php //echo $panel->gestionadosMonto($campaign_id, "asterisk", "sistema_gestiones", 1, 1000000);   ?>   </th>
                                             <th><?php //echo $panel->MontosGestionado($campaign_id, "asterisk", "sistema_gestiones", 0, 1000000);   ?>        </th>
                                             <th><?php //echo $panel->deuda_totalMontos($campaign_id, "asterisk", "sistema_deuda", 1, 1000000);   ?>      </th>
                                             <th><?php //echo $panel->cantPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 0, 1000000);   ?>    </th>
                                             <th><?php //echo $panel->montoPagosMontos($campaign_id, "asterisk", "sistema_gestiones", 1, 1000000);   ?>  </th>
     
                                         </tr> 
                                     </tfoot>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>-->
                <div class="row">
                    <!--<div class="col-lg-4"> 
                        <div class="panel panel-info">
                            <div class="panel-heading">Contactabilidad</div>
                            <div class="panel-body  ">

                                <script type="text/javascript">


<?php //$panel->ContactabilidadGraph($campaign_id, "asterisk",'conta');  ?>
                                </script>
                                <div id="conta"></div>
                            </div>
                        </div>
                    </div>-->
                    <!--<div class="col-lg-4"> 
                        <div class="panel panel-info">
                            <div class="panel-heading">Penetracion Base</div>
                            <div class="panel-body  ">

                                <script type="text/javascript">
<?php//  $panel->PenetracionGraph($campaign_id, "asterisk",'penetracion');  ?>
                                </script>
                                <div id="penetracion"></div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-lg-4"> 
                        <div class="panel panel-info">
                            <div class="panel-heading">Aceptaciones por Ruts Base(x1.000.000)</div>
                            <div class="panel-body  ">

                                <script type="text/javascript">
                                    jQuery(document).ready(function()
        {
                                    new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'penetracionrut',
  data: [
    { y: '2006', a: 100, b: 110 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});
        }  )                 
<?php  //$panel->PenetracionRutGraph($campaign_id, "asterisk",'penetracionrut');  ?>
                                </script>
                                <div id="penetracionrut"></div>
                            </div>
                        </div>
                    </div>


            </fieldset>
        </fieldset>
    </body>
</html>