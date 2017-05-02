<?php
$title = 'Inicio';
require("../../modulos/SeguridadModulo.php");
require_once ("../../template/header.php");

$obj = new Seguridad();
$datos = $obj->getEstadisticas();

?>
 <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-server"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Lotizaciones</p>
                                            <?php echo $datos['lotizaciones'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> <a href="../lotizacion/listar.php">Ver m&aacute;s</a>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-map"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Predios</p>
                                            <?php echo $datos['lotes'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> <a href="../lote/listar.php">Ver m&aacute;s</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-map-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Predios Disponibles</p>
                                            <?php echo $datos['lotes_disponibles'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i>  <a href="../acuerdo/listar.php">Realizar acuerdo</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Clientes</p>
                                            <?php echo $datos['clientes'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> <a href="../usuario/listar.php">Ver m&aacute;s</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bienvenido <?php echo  $_SESSION['SESSION_USER']->nombres ." ". $_SESSION['SESSION_USER']->apellidos;?></h4>
                                <p class="category">Sistema de Control de Predios</p>
                                
                                <div class="row" style="margin: 0 auto; ">
                                
                                	<img alt="" src="../../web/images/banner1.jpg" style="margin: 50px 0;">
                                
                                	
                                </div>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
<?php
include "../../template/footer.php";
?>