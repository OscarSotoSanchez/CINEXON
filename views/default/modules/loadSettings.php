
<section class="menuSettings">
    <?php
    echo '<div class="list-group" id="tabs" data-tabs="tabs">';
    echo '<span class="list-group-item text-center active" name="listSearchItem">';
    if($userSession->getRole_user() == "admin"){
        echo '<a data-toggle="modal" data-target="#sendMessage" name="nameSend" id="'.$user->getNick_user().'">';
        echo '<span>' . $user->getNick_user() . '</span>';    
        echo '</a>';
    } else {
        echo '<span>' . $user->getNick_user() . '</span>';
    }
    if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
        echo '<a href="#messages" data-toggle="tab">';
        echo '<span class="glyphicon glyphicon-envelope" style="float: right; font-size: 1.5em; color: white;"></span>';
        echo '</a>';
    } else {
        echo '<a data-toggle="modal" data-target="#sendMessage" name="nameSend" id="'.$user->getNick_user().'">';
        echo '<span class="glyphicon glyphicon-envelope" style="float: right; font-size: 1.5em; color: white;"></span>';
        echo '</a>';
    }
    echo '</span>';
    echo '<a class="list-group-item" href="#listas" data-toggle="tab">Listas</a>';
    echo '<a class="list-group-item" href="#criticas" data-toggle="tab">Críticas</a>';
    if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
        echo '<a class="list-group-item" href="#compras" data-toggle="tab">Compras</a>';
        echo '<a class="list-group-item" href="#ajustes" data-toggle="tab">Ajustes</a>';
    }
    echo '</div>';
    ?>

</section>

<div class="dataSettings">
    <div class="tab-content">
        <div class="tab-pane active fade in" id="listas" style="padding: 5%;">
            <div class="row" style="width: 90%; margin: 0 auto;">
                <div class="col-lg-12 text-center">
                    <h3>Listas</h3>
                    <hr class="star-primary">
                </div>
                <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php
                        for ($x = 0; $x < count($lists); $x++) {
                            $in = "";
                            if ($x == 0) {
                                $in = "in";
                            }

                            echo '<div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading' . $lists[$x]->getId_list() . '">
                                        <h4 class="panel-title">
                                            <a style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $lists[$x]->getId_list() . '" aria-expanded="true" aria-controls="collapse' . $lists[$x]->getId_list() . '">
                                                ' . $lists[$x]->getName_list() . '
                                            </a>';
                            if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
                                echo '<span name="deleteList" id="' . $lists[$x]->getId_list() . '" style="float:right;" class="glyphicon glyphicon-remove"></span>';
                            }
                            echo '      </h4>
                                    </div>';
                            echo '<div id="collapse' . $lists[$x]->getId_list() . '" class="panel-collapse collapse ' . $in . '" role="tabpanel" aria-labelledby="heading' . $lists[$x]->getId_list() . '">
                                    <div class="panel-body">';
                            $elemetsLists = $lists[$x]->getElementsList();
                            if (count($elemetsLists) <= 0) {
                                echo '<p class="text-center">No hay películas añadidas en la lista</p>';
                            }

                            for ($i = 0; $i < count($elemetsLists); $i++) {
                                echo '<p><a style="color: black;" href="pelicula?id=' . $elemetsLists[$i]->getId_movie() . '">' . $elemetsLists[$i]->getName_film() . '</a>';
                                if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
                                    echo '<a name="deleteElementList" id="' . $elemetsLists[$i]->getId_storage() . '" style="float:right;">Eliminar</a>';
                                }
                                echo '</p>';
                            }
                            echo '       </div>
                                </div>
                        </div>';
                        }
                        ?>
                    </div>
                    <div class="text-center">
                        <?php
                        if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
                            echo '<span data-toggle="modal" data-target="#addNewList" id="more" style="font-size:3.5em; margin-bottom: 50px;" class="glyphicon glyphicon-plus"></span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="criticas" style="padding: 5%;">
            <div class="row" id="valorations">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Críticas</h3>
                    <hr class="star-primary">
                </div>
                <?php
                for ($x = 0; $x < count($valorationArray); $x++) {
                    echo '<div class="col-md-12 critica">
                                                <p><span class="text-left"><b><a style="color: black;" href="pelicula?id=' . $valorationArray[$x]->getId_movie() . '">' . $valorationArray[$x]->getName_movie() . '</a></b></span><span style="float: right;">' . $valorationArray[$x]->getDate_valoration() . '</span></p>
                                                <p class="text-center">' . $otherFunc->writeStart($valorationArray[$x]->getValoration()) . '</p>
                                                <br/>
                                                <p>' . $valorationArray[$x]->getReview() . '</p>';

                    if ($valorationArray[$x]->getId_user() == $userSession->getId_user()) {
                        echo '<a name="btnDeleteValoration" data-toggle="modal" data-target="#deleteValoration" style="float: right; margin-top: 1%;" id="' . $valorationArray[$x]->getId_valoration() . '">Eliminar mi crítica</a>';
                    } else if ($userSession->getRole_user() == "mod" || $userSession->getRole_user() == "admin") {
                        echo '<a name="btnDeleteValoration" data-toggle="modal" data-target="#deleteValoration" style="float: right; margin-top: 1%;" id="' . $valorationArray[$x]->getId_valoration() . '">Eliminar crítica</a>';
                    }

                    echo '</div>';
                }

                if (count($valorationArray) <= 0) {
                    echo '<div class="col-md-12" style="margin-top: 10%;">
                                <p class="text-center">Todavia no has realizado ninguna crítica.</p>
                          </div>';
                }
                ?>
            </div>
        </div> 
        <?php
        if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
            echo '<div class="tab-pane" id="messages" style="padding: 5%;">';
            echo '<div class="row">';
            echo '<div class="col-lg-12 text-center" style="margin-bottom: 2%;">';
            echo '<h3>Mensajes</h3>';
            echo '<hr class="star-primary">';
            echo '</div>';

            for ($x = 0; $x < count($messages); $x++) {
                echo '<div class="col-md-12 critica">
                        <p><span class="text-left"><b><a style="color: black;" href="usuario?idUser='.$messages[$x]->getId_transmitter().'">' . $messages[$x]->getUser_transmitter()->getNick_user() . '</a></b></p>
                        <br/>
                        <p>' . $messages[$x]->getContent_message() . '</p>';

                echo '<div style="float:right; margin-top: 1%;">';
                echo '<a name="btnDeleteMessage" data-toggle="modal" data-target="#deleteMessage" id="' . $messages[$x]->getId_message() . '">Eliminar Mensaje</a>';
                echo '<br/>';
                echo '<a name="replyMessage" data-toggle="modal" data-target="#sendMessage" nameUser="' . $messages[$x]->getUser_transmitter()->getNick_user() . '" id="' . $messages[$x]->getId_transmitter() . '">Responder Mensaje</a>';
                echo '</div>';

                echo '</div>';
            }

            if (count($messages) <= 0) {
                echo '<div class="col-md-12" style="margin-top: 5%;">
                        <p class="text-center">No has recibido ningún mensaje.</p>
                     </div>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>
        <?php
        if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
            echo '<div class="tab-pane fade" id="compras" style="padding: 5%;">';
            echo '<div class="row">';
            echo '<div class="col-lg-12 text-center" style="margin-bottom: 2%;">';
            echo '<h3>Compras</h3>';
            echo '<hr class="star-primary">';
            echo '</div>';
            echo '<div class="col-md-12">';
            echo '<div style="width: 85%; margin: 0 auto;" name="tablesShops">';

            if (count($arrayCartelera) > 0) {
                echo '<div name="shopsCartelera">';
                echo '<table class="table table-striped tableShops" cellspacing=0>';
                echo '<thead>
                                    <tr>
                                        <td colspan=3>PELÍCULAS CARTELERA</td>
                                    </tr>
                                </thead>
                                <tbody>';
                for ($x = 0; $x < count($arrayCartelera); $x++) {
                    echo '<tr>';
                    echo '<td class="titulo">';
                    echo '<b><a style="color: black;" href="pelicula?id='.$arrayCartelera[$x][0]->getId_movie().'">' . $arrayCartelera[$x][0]->getTitle_movie() . '</a></b>';
                    echo '</td>';
                    echo '<td align="right">';
                    echo $arrayCartelera[$x][1]->getDate_buy() . ' ' . substr($arrayCartelera[$x][1]->getHora(), 0, 5);
                    echo '</td>';


                    $dateBuy = explode("-", $arrayCartelera[$x][1]->getDate_buy());
                    $date = explode("-", date("d-m-Y"));

                    if ($dateBuy[0] == $date[0] && $dateBuy[1] == $date[1] && $dateBuy[2] == $date[2]) {
                        echo '<td class="descarga">';
                        echo '<a style="color: black;" name="downloadPDF" id="' . $arrayCartelera[$x][1]->getId_buy() . '">Descargar Entradas</a></p>';
                        echo '</td>';
                    } else {
                        echo '<td class="descarga">';
                        echo '<a style="color: black;">No Disponible</a></p>';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '<div class="text-center" style="margin-bottom: 5%;"><a data-toggle="modal" data-target="#deleteShops" id="deleteTickets" name="btnDeleteShops">Limpiar Cartelera</a></div>';
                echo '</div>';
            }

            if (count($arrayDigital) > 0) {
                echo '<div name="shopsDigital">';
                echo '<table class="table table-striped tableShops" cellspacing=0>';
                echo '<thead>
                        <tr>
                            <td colspan=2>
            			PELÍCULAS DIGITAL
                            </td>
                        </tr>
                    </thead>
                    <tbody>';
                for ($x = 0; $x < count($arrayDigital); $x++) {
                    echo '<tr>';
                    echo '<td class="titulo">';
                    echo '<b><a style="color: black;" href="pelicula?id='.$arrayDigital[$x][0]->getId_movie().'">' . $arrayDigital[$x][0]->getTitle_movie() . '</a></b>';
                    echo '</td>';
                    echo '<td class="descarga">';
                    echo '<a style="color: black;" name="downloadFILM" id="' . $arrayDigital[$x][0]->getId_movie() . '">Descargar Película</a></p>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '<div class="text-center"><a data-toggle="modal" data-target="#deleteShops" id="deleteDigital" name="btnDeleteShops">Limpiar Digitales</a></div>';
                echo '</div>';
            }
            echo '</div>';

            echo '</div>';
            if(count($arrayCartelera) <= 0 && count($arrayDigital) <= 0){
                echo '<div class="col-md-12" style="margin-top: 10%;">
                        <p class="text-center">Todavia no has realizado ninguna compra.</p>
                      </div>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>
        <?php
        if ($user->getId_user() == $userSession->getId_user() || $userSession->getRole_user() == "admin") {
            echo '<div class="tab-pane fade" id="ajustes" style="padding: 5%;">
            <div class="row">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Ajustes</h3>
                    <hr class="star-primary">
                </div>';
            echo '<div class="col-md-12 col-xs-11">
                    <div style="width: 80%; margin: 0 auto; padding-bottom: 10%;">
                        <form class="form-horizontal">';
            echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Nick User:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="nickUser" placeholder="" required value="' . $user->getNick_user() . '" disabled>
                                </div>
                            </div>';
            echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Email:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="email" placeholder="" required value="' . $user->getEmail_user() . '" disabled>
                                </div>
                            </div>';
            echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Nombre:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="name" placeholder="" required value="' . $user->getName_user() . '">
                                </div>
                            </div>';
            if ($userSession->getRole_user() == "admin") {
                echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Role Usuario:</label>
                                <div class="col-xs-9">
                                    <select name="roleUser" class="form-control">';
                $arrayRoles = array(array("admin", "Administrador"), array("moderator", "Moderador"), array("regular", "Normal"));
                for ($x = 0; $x < count($arrayRoles); $x++) {
                    if ($user->getRole_user() == $arrayRoles[$x][0]) {
                        echo ' <option value = "' . $arrayRoles[$x][0] . '" selected>' . $arrayRoles[$x][1] . '</option>';
                    } else {
                        echo ' <option value = "' . $arrayRoles[$x][0] . '">' . $arrayRoles[$x][1] . '</option>';
                    }
                }
                echo '                            </select>
                                </div>
                            </div>';
            }
            echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Contraseña:</label>
                                <div class="col-xs-9">
                                    <input type="password" onfocus="' . "this.value = '';" . '" class="form-control" name="password" id="inputPassword" placeholder="Password" required value="' . $user->getPass_user() . '">                                
                                </div>
                            </div>';
            echo '                    <div class="form-group">
                                <label class="control-label col-xs-3">Edad:</label>
                                <div class="col-xs-9">
                                    <input type="number" min="1" max="150" name="age" class="form-control" placeholder="Edad" required value="' . $user->getAge_user() . '">
                                </div>
                            </div>';
            if($userSession->getRole_user() == "admin"){
                 echo '          <div class="text-center"><h4><a style="color: red;" data-toggle="modal" data-target="#deleteUser">Eliminar Usuario</a></h4></div>';               
            } else {
                echo '          <div class="text-center"><h4><a style="color: red;" data-toggle="modal" data-target="#deleteUser">Eliminar mi Usuario</a></h4></div>';
            }
            echo '                </form>
                    <div class="text-center" style="margin-top: 5%;">
                        <input type="button" name="buttonMod" class="btn btn-primary" value="Cambiar Ajustes">
                    </div>    
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>                            

</div>

<!-- Modal Eliminar Valoracion-->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere borrar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="btnYesDeleteUser">Sí</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Valoracion-->
<div class="modal fade" id="deleteValoration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Eliminar Valoración</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere eliminar la valoración?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="btnYesValoration">Sí</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Mensaje-->
<div class="modal fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Eliminar Mensaje</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere eliminar el mensaje?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="btnYesMessage">Sí</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Compras-->
<div class="modal fade" id="deleteShops" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Eliminar Compras</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere eliminar las compras?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="btnYesShops">Sí</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewList" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="gridSystemModalLabel">Crear Lista</h4>
            </div>
            <div class="modal-footer">
                <div style="width: 100%; margin: 0 auto;">
                    <div name="cuadroInputNameList">
                        <input type="email" name="inputNameList" class="form-control" placeholder="Nombre Lista" required>
                        <div class="text-center">
                            <label class="control-label has-error" name="mensajeNameList" style="display:none; margin-top: 5%;"></label>
                        </div>
                    </div>
                </div>
                <div class="btnComprarEntradas" style="margin-top: 5% !important;"> 
                    <button type="button" id="" name="buttonAddNewList" class="btn btn-primary disabled">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendMessage" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog sendMessage">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="gridSystemModalLabel">Enviar Mensaje a '<span name="nameReceiber" class="text-success"></span>'</h4>
            </div>
            <div class="modal-body">
                <textarea name="bodyMessage" maxlength="500"></textarea>
                <?php
                if ($user->getId_user() != $userSession->getId_user()) {
                    echo '<input type="hidden" name="idTransmitter" value="' . $userSession->getId_user() . '" />';
                }
                ?>               
            </div>
            <div class="modal-footer">
                <div class="btnComprarEntradas" style="margin-top: 5% !important;"> 
                    <button type="button" id="" name="buttonSendMessage" class="btn btn-primary disabled">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="idUser" value="<?php echo $user->getId_user(); ?>" />

<!-- downloadFilm -->
<script src="views/resource/js/downloadFilm.js"></script>

<!-- deleteValorations -->
<script src="views/resource/js/settings.deleteValoration.js"></script>

<!-- lists -->
<script src="views/resource/js/settings.lists.js"></script>

<!-- messages -->
<script src="views/resource/js/messages.js"></script>

<!-- changeDataUser -->
<script src="views/resource/js/settings.changeDataUser.js"></script>

<!-- sendMessage -->
<script src="views/resource/js/settings.sendMessage.js"></script>

<!-- deleteMessage -->
<script src="views/resource/js/settings.deleteMessages.js"></script>

<!-- deleteShops -->
<script src="views/resource/js/settings.deleteShops.js"></script>