<section class="shoppingCart">
    <div class="row">
        <?php
        if ($role == "admin") {
            echo '<div style="width: 85%; margin: 0 auto;">';
            echo "<h3>Usuario Administrador</h3>";
            echo '<p class="text-muted">Él usuario Administrador no puede realizar compras, para poder disfrutar de tus compras logeate con un usuario normal.</p>';
            echo '</div>';
        } else if (!empty($shoppingCart)) {
            echo '<div>
                    <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                        <h3>Carrito de compra</h3>
                        <hr class="star-primary">
                    </div>
                  </div>';
            echo '<div class="col-md-12" id="shoppingCart">
                        <div class="shoppingCart">
                            <table class="table table-condensed">
                                <tr style="background-color: #2C4053; color: white;">
                                    <th></th>
                                    <th collspan="2" style="text-align:center;">Película</th>
                                    <th style="text-align:center;">Formato</th>
                                    <th style="text-align:center;">Cantidad</th>
                                    <th style="text-align:center;">Precio Unidad</th>
                                    <th style="text-align:center;">Precio total</th>
                                </tr>';
            for ($x = 0; $x < count($shoppingCart); $x++) {
                echo '          <tr style="background-color:#828E9B">';
                if ($shoppingCart[$x][0]->getFormat_movie() == "Digital") {
                    echo '<td><span name="delete" id="' . $shoppingCart[$x][0]->getId_movie() . '" class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#deleteShoppingCart"></span>';
                } else {
                    echo '<td><span name="delete" id="' . $shoppingCart[$x][0]->getId_movie() . ';' . $shoppingCart[$x][3] . '" class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#deleteShoppingCart"></span>';
                }
                echo '              <td align="left"><a style="color: black;" href="pelicula?id=' . $shoppingCart[$x][0]->getId_movie() . '">' . $shoppingCart[$x][0]->getTitle_movie() . '</a></td>';
                if ($shoppingCart[$x][0]->getFormat_movie() == "Digital") {
                    echo '              <td style="text-align:center;">' . $shoppingCart[$x][0]->getFormat_movie() . '</td>';
                } else {
                    echo '              <td style="text-align:center;">' . $shoppingCart[$x][0]->getFormat_movie() . ' ' . $shoppingCart[$x][2][2] . '</td>';
                }
                echo '              <td align="right">' . $shoppingCart[$x][1] . '</td>';
                echo '              <td align="right">' . $shoppingCart[$x][0]->getPrice_movie() . ' €</td>';
                echo '              <td align="right">' . $shoppingCart[$x][0]->getPrice_movie() * $shoppingCart[$x][1] . ' €</td>';
                echo '          </tr>';
            }

            echo '       </table>

                        <br/>
                        <div class="payShopping">
                            <a class="btn btn-primary" name="buttonPay">Pagar</a>
                            <span name="totalPrice" class="text-primary" style="black">Total: ' . $totalPriceShoppingCart . ' €</span>
                        </div>
                    </div>
                </div>';
        } else {
            echo '<div style="width: 85%; margin: 0 auto;">';
            echo "<h3>Tu cesta está vacía</h3>";
            echo '<p class="text-muted">Haz que tu cesta de compra sea útil: llénala de películas.</p>';
            echo '<p class="text-muted">El precio y la disponibilidad de los productos de CINEXON están sujetos a cambio. En el carrito puedes dejar temporalmente los productos que quieras. En el aparecerá el precio más reciente de cada producto.</p>';
            echo '<p class="text-muted"><a href="peliculas">Empieza a comprar</a></p>';
            echo '</div>';
        }
        ?>

        <div class="col-md-11" style="width: 85%; margin: 0 auto; display: none;" id="shoppingPay">
            <form class="form-horizontal" method="post" action=".">

                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="name" placeholder="Nombre" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Apellido:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="lastname" placeholder="Apellido" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">DNI:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="dni" placeholder="DNI" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Tarjeta de Crédito:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="cart" placeholder="Número Tarjeta de Crédito" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Número Secreto:</label>
                    <div class="col-xs-9">
                        <input type="number" min="000" max="999" name="numCart" class="form-control" placeholder="Número Secreto Tarjeta de Crédito" required value="">
                    </div>
                </div>
                <div class="col-xs-offset-3 col-xs-9">
                    <input  type="submit" name="shop" id="button" class="btn btn-primary" value="Confirmar" />
                    <a name="buttonCancel" class="btn btn-primary">Cancelar</a>                    
                </div>
            </form>  
        </div>
    </div>    
</section>

<!-- Modal Eliminar-->
<div class="modal fade" id="deleteShoppingCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar Película</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere eliminar la película?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="btnYes">Si</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Comprar-->
<div class="modal fade" id="myModalComprar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Comprar Películas</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de realizar la compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-default" id="btnYesComprar">Pagar</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function ($) {
        $("[name='buttonPay']").on("click", function () {
            $("#shoppingCart").hide();
            $("#shoppingPay").fadeIn(1500);
        });
        $("[name='buttonCancel']").on("click", function () {
            $("#shoppingPay").hide();
            $("#shoppingCart").fadeIn(1500);
        });
    })(jQuery);
</script>

<!-- deleteShop -->
<script src="views/resource/js/shoppingCart.deleteShop.js"></script>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>

<?php
if ($resetTickets) {
    echo "<script>";
    echo '$(document).ready(function () {
            messagePopUpError("Se han borrado items de tu carrito, por llevar demasiado tiempo sin confirmar.");
          })(jQuery);';
    echo "</script>";
}
?>