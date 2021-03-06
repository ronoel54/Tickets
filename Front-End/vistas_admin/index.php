<?php
include '../Back-End/Presentador/TicketConsultarAdminPresentador.php';
require_once '../Back-End/Presentador/EntidadUsuario.php';
$usuarios = Usuario::buscarPorTipoUsuario('tecnico');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
<script type="text/javascript">
    function mostrar(){
        if(document.getElementById('oculto').style.display == 'block')
        {
            document.getElementById('oculto').style.display = 'none';
            document.getElementById('textCambia').innerHTML = "Generar ticket <i class='mdi-alert-warning right'></i>";

        }else{
            (document.getElementById('oculto').style.display = 'block');
            document.getElementById('textCambia').innerHTML = "Ocutar <i class='mdi-alert-warning right'></i>";
        }
    }
</script>
    <header>
        <ul id="dropdownUsuario" class="dropdown-content">
            <li><a href="UsuarioEditar.php">Editar Info</a>
            </li>
        </ul>
        <ul id="dropdownTickets" class="dropdown-content">
            <li><a href="#!">Consultar</a>
            </li>
        </ul>
        <nav>
            <div class="nav-wrapper cyan lighten-1">
                <a href="#!" class="brand-logo">Tickets</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdownTickets">Tickets<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    </li>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdownUsuario">Usuario<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    </li>
                    <li><a href="../index.php"><i class="mdi-content-send right"></i>Salir</a>
                    </li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="#">Sass</a>
                    </li>
                    <li><a href="#">Components</a>
                    </li>
                    <li><a href="#">Javascript</a>
                    </li>
                    <li><a href="../index.php"><i class="mdi-content-send right"></i>Salir</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="container section">
        <div class="row">
            <div class="col s12 ">
                <div id="popout" class="section scrollspy">
                    <h4>Administrador de incidencias</h4>
                    <p class="caption">Estatus de incidencias. </p>
                    <ul class="collapsible popout collapsible-accordion" data-collapsible="accordion">
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-alert-warning"></i>Incidencias sin asignar</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                    <tr>
                                        <th data-field="asunto">Id</th>
                                        <th data-field="asunto">Usuario</th>
                                        <th data-field="asunto">Asunto</th>
                                        <th data-field="prioridad">Prioridad</th>
                                        <th data-field="detalle">Detalle</th>
                                        <th data-field="estado">Estatus</th>
                                        <th data-field="tecnico">Tecnico</th>
                                        <th data-field="estado"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($adminTickets as $item): ?>
                                            <?php
                                            if(($item['estado']=='NUEVO')&& $item['id_usrEncargado']=='0'){?>
                                                <tr>

                                                    <td>
                                                        <?php echo $item['id'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $usuario = Usuario::buscarPorId($item['id_usrCreador']);
                                                        echo $usuario->getCorreo(); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $item['asunto'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $item['prioridad'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $item['detalle'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $item['estado'] ?>
                                                    </td>
                                                    <form action="../Back-End/Presentador/TicketAsignaTecnicoPresentador.php" method="post">
                                                        <td>
                                                            <select class="browser-default" name="id_usrEncargado" required>
                                                                <option value="" disabled selected>Tecnico a asignar</option>
                                                                <?php
                                                                foreach($usuarios as $items):?>
                                                                    <option value="<?php echo $items['id'];?>"><?php echo $items['correo'] ?></option>
                                                                <?php  endforeach;?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input id="id_tickets" type="hidden" class="validate" name="id_tickets" value="<?php echo $item['id'];?>">
                                                            <button class="btn waves-effect waves-light cyan lighten-1" type="submit" name="action">Asignar
                                                            </button>
                                                        </td>
                                                    </form>
                                                </tr>

                                            <?php   }   endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-action-done"></i>Incidencias asignadas abiertas</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                    <tr>
                                        <th data-field="numero">Num</th>
                                        <th data-field="asunto">Usuario</th>
                                        <th data-field="asunto">Asunto</th>
                                        <th data-field="prioridad">Prioridad</th>
                                        <th data-field="detalle">Detalle</th>
                                        <th data-field="estado">Estatus</th>
                                        <th data-field="tecnico">Tecnico</th>
                                        <th data-field="estadoDetalle">Detalle-Tecnico</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($adminTickets as $item): ?>
                                        <?php
                                        if(($item['estado']!='CERRADO')&& $item['id_usrEncargado']!='0'){?>
                                            <tr>
                                                <td>
                                                    <?php echo $item['id'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $usuario = Usuario::buscarPorId($item['id_usrCreador']);
                                                    echo $usuario->getCorreo(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['asunto'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['prioridad'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['detalle'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['estado'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $usuario2 = Usuario::buscarPorId($item['id_usrEncargado']);
                                                    echo $usuario2->getCorreo(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['estadoDetalle'] ?>
                                                </td>

                                            </tr>

                                        <?php   }    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>


                        <li class="">
                            <div class="collapsible-header"><i class="mdi-action-done-all"></i>Incidencias cerradas</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                    <tr>
                                        <th data-field="numero">Num</th>
                                        <th data-field="usuario">Usuario</th>
                                        <th data-field="asunto">Asunto</th>
                                        <th data-field="prioridad">Prioridad</th>
                                        <th data-field="detalle">Detalle</th>
                                        <th data-field="estado">Estatus</th>
                                        <th data-field="tecnico">Tecnico</th>
                                        <th data-field="estadoDetalle">Detalle-Tecnico</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($adminTickets as $itemi): ?>
                                        <?php
                                        if(  $itemi['estado']=='CERRADO'){?>
                                            <tr>
                                                <td>
                                                    <?php echo $itemi['id'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $usuario = Usuario::buscarPorId($itemi['id_usrCreador']);
                                                    echo $usuario->getCorreo(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemi['asunto'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemi['prioridad'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemi['detalle'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemi['estado'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($itemi['id_usrEncargado']!= 0)
                                                    {
                                                        $usuario2 = Usuario::buscarPorId($itemi['id_usrEncargado']);
                                                        echo $usuario2->getCorreo();
                                                    }
                                                     ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemi['estadoDetalle'] ?>
                                                </td>

                                            </tr>

                                        <?php   }    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li class="">
                            <div class="collapsible-header"><i class="mdi-communication-ring-volume"></i>Incidencias en pendiente</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                    <tr>
                                        <th data-field="numero">Num</th>
                                        <th data-field="usuario">Usuario</th>
                                        <th data-field="asunto">Asunto</th>
                                        <th data-field="prioridad">Prioridad</th>
                                        <th data-field="detalle">Detalle</th>
                                        <th data-field="estado">Estatus</th>
                                        <th data-field="tecnico">Tecnico</th>
                                        <th data-field="estadoDetalle">Detalle-Tecnico</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($adminTickets as $itemis): ?>
                                        <?php
                                        if(  $itemis['estado']=='PENDIENTE'){?>
                                            <tr>
                                                <td>
                                                    <?php echo $itemis['id'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $usuario = Usuario::buscarPorId($itemis['id_usrCreador']);
                                                    echo $usuario->getCorreo(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemis['asunto'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemis['prioridad'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemis['detalle'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemis['estado'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($itemis['id_usrEncargado']!= 0)
                                                    {
                                                        $usuario2 = Usuario::buscarPorId($itemis['id_usrEncargado']);
                                                        echo $usuario2->getCorreo();
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $itemis['estadoDetalle'] ?>
                                                </td>

                                            </tr>

                                        <?php   }    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                    </ul>
                </div>
                <button class="btn waves-effect waves-light cyan lighten-1" onclick="mostrar()" id="textCambia" name="action" >Generar ticket
                    <i class="mdi-alert-warning right"></i>
                </button>
                <br/>
                <br/>
                <form action="../Back-End/Presentador/TicketsCrearPresentador.php" method="post" id='oculto' style='display:none;'>
                    <div class="row">
                        <label>Prioridad</label>
                        <select class="browser-default" name="prioridad" required>
                            <option value="" disabled selected>Escoga la prioridad</option>
                            <option value="BAJA">BAJA</option>
                            <option value="MODERADA">MODERADA</option>
                            <option value="ALTA">ALTA</option>
                        </select>
                    </div>

                    <div class="row">
                        <label>Sistema Operativo</label>
                        <select class="browser-default" name="SO" required>
                            <option value="" disabled selected>Escoga Sistema Operativo</option>
                            <option value="Linux">Linux</option>
                            <option value="Window">Window</option>
                            <option value="iOS">iOS</option>
                        </select>
                    </div>


                    <div class="row ">
                        <div class="input-field">
                            <input id="asunto" type="text" class="validate" length="10" name="asunto" required>
                            <label for="asunto">Asunto</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col s12">
                            <textarea id="detalle" class="materialize-textarea" length="120" name="detalle" required></textarea>
                            <label for="detalle">Detalle</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light cyan lighten-1" type="submit" name="action">Generar
                        <i class="mdi-alert-warning right"></i>
                    </button>
                </form>

                <div style="color: blue;">
                    <?php
                    if (isset($_GET["TicketGenerado"]))
                    {
                        if ($_GET["TicketGenerado"]=="si")
                        {
                            echo '*Su ticket fue generado con exito*';
                        }else{
                            echo '*Error en generar ticket intente mas tarde*';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="page-footer cyan lighten-1">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Tickets</h5>
                    <p class="grey-text text-lighten-4">Diseño y desarrollo como software de defensa de tesis.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Tesistas</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Alumno #1</a>
                        </li>
                        <li><a class="grey-text text-lighten-3" href="#!">Alumno #2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2015 Copyright
                <a class="grey-text text-lighten-4 right" href="#!">Universidad</a>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>