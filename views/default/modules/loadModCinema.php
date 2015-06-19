<!-- Portfolio Grid Section -->
<section class="shoppingCart">
    <div>
        <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
            <h3>Modificar Cine</h3>
            <hr class="star-primary">
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="width: 90%; margin: 0 auto;">
            <div class="form-horizontal">
                <?php
                echo "<input type='hidden' name='modidCinema' value='$id'/>";
                ?>  
                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre Cine:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="modNameCinema" placeholder="Nombre Director" required value="<?php echo $cinema->getName_cinema(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Dirección Cine:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="modAddressCinema" placeholder="Nombre Director" required value="<?php echo $cinema->getAddress_cinema(); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" style="margin-top: 5%;">
            <input type="submit" name="modCinema" class="btn btn-primary" value="Modificar Cine">
        </div>
    </div>
</section>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>

<!-- modElements -->
<script src="views/resource/js/mod.refreshElements.js"></script>