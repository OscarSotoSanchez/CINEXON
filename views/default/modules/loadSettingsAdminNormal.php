
<section class="menuSettings">
    <div class="list-group" id="tabs" data-tabs="tabs">
        <span class="list-group-item text-center active" name="listSearchItem">
            <?php
            echo '<span>' . $user->getNick_user() . '</span>';
            ?>
            <a href="#messages" data-toggle="tab">
                <span class="glyphicon glyphicon-envelope" style="float: right; font-size: 1.5em; color: white;"></span>
            </a>
        </span>
        <a class="list-group-item" href="#ajustes" data-toggle="tab">Ajustes</a>
    </div>

</section>

<div class="dataSettings">
    <div class="tab-content">
        <div class="tab-pane fade" id="ajustes" style="padding: 5%;">
            <div class="row">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Ajustes</h3>
                    <hr class="star-primary">
                </div>
                <div class="col-md-12 col-xs-11">
                    <div style="width: 80%; margin: 0 auto; padding-bottom: 10%;">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Contraseña:</label>
                                <div class="col-xs-9">
                                    <?php
                                    echo '<input type="password" onfocus="' . "this.value = '';" . '" class="form-control" name="password" id="inputPassword" placeholder="Password" required value="' . $user->getPass_user() . '">';
                                    ?>
                                </div>
                            </div>
                        </form>
                        <div class="text-center" style="margin-top: 2%;">
                            <input type="button" name="buttonMod" class="btn btn-primary" value="Modificar">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        echo '<div class="tab-pane fade in active" id="messages" style="padding: 5%;">';
        echo '<div class="row">';
        echo '<div class="col-lg-12 text-center" style="margin-bottom: 2%;">';
        echo '<h3>Mensajes</h3>';
        echo '<hr class="star-primary">';
        echo '</div>';

        for ($x = 0; $x < count($messages); $x++) {
            echo '<div class="col-md-12 critica">
                    <p><span class="text-left"><b><a style="color: black;" href="usuario?idUser=' . $messages[$x]->getId_transmitter() . '">' . $messages[$x]->getUser_transmitter()->getNick_user() . '</a></b></p>
                    <br/>
                    <p>' . $messages[$x]->getContent_message() . '</p>';

            echo '<div style="float:right; margin-top: 1%;">';
            echo '<a name="btnDeleteValoration" data-toggle="modal" data-target="#" id="' . $messages[$x]->getId_message() . '">Eliminar Mensaje</a>';
            echo '<br/>';
            echo '<a name="replyMessage" data-toggle="modal" data-target="#sendMessage" id="' . $messages[$x]->getId_transmitter() . '">Responder Mensaje</a>';
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
        ?>
    </div>                            
</div>


<div class="modal fade" id="sendMessage" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog sendMessage">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="gridSystemModalLabel">Enviar Mensaje a <span name="nameReceiber"></span></h4>
            </div>
            <div class="modal-body">
                <textarea name="bodyMessage" maxlength="500"></textarea>
                <?php
                echo '<input type="hidden" name="idTransmitter" value="' . $user->getId_user() . '" />';
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

<!-- messages -->
<script src="views/resource/js/messages.js"></script>

<!-- sendMessage -->
<script src="views/resource/js/settings.sendMessage.js"></script>


<!-- changePassword -->
<script src="views/resource/js/settingsAdminNormal.changePassword.js"></script>