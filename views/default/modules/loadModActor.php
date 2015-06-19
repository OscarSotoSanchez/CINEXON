<!-- Portfolio Grid Section -->
<section class="shoppingCart">
    <div>
        <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
            <h3>Modificar Actor</h3>
            <hr class="star-primary">
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="width: 90%; margin: 0 auto;">
            <div class="form-horizontal">
                <?php
                echo "<input type='hidden' name='modidActor' value='$id'/>";
                ?>  
                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre Actor:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="modNameActor" placeholder="Nombre Actor" required value="<?php echo $actor[1]; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" style="margin-top: 20%;">
            <input type="submit" name="modActor" class="btn btn-primary" value="Modificar Actor">
        </div>
    </div>
</section>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>

<!-- modElements -->
<script src="views/resource/js/mod.refreshElements.js"></script>