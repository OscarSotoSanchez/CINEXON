<section class="shoppingCart">
    <div class="row">
        <div>
            <div class="col-lg-12 text-center">
                <h3>Compras</h3>
                <hr class="star-primary">
            </div>
        </div>
        <?php
        echo '<div class="col-md-12" id="shoppingCart">
                    <div style="width: 85%; margin: 0 auto;">';
        
        if (count($arrayCartelera) > 0) {
            echo '<table class="table table-striped tableShops" cellspacing=0>';
            echo    '<thead>
                        <tr>
                            <td colspan=3>
            			PELÍCULAS CARTELERA
                            </td>
                        </tr>
                    </thead>
                    <tbody>';
            for ($x = 0; $x < count($arrayCartelera); $x++) {
                echo        '<tr>';
                echo            '<td class="titulo">';
                echo                '<b>'.$arrayCartelera[$x][0][0]->getTitle_movie() .'</b>';
                echo            '</td>';
                echo            '<td style="text-align:right;">';
                echo                '<b>'. $arrayCartelera[$x][2][2] .'</b>';
                echo            '</td>';                
                echo            '<td class="descarga">';
                echo                '<a style="color: black;" href="#" name="downloadPDF" id="'.$arrayCartelera[$x][1].'">Descargar Entradas</a></p>';
                echo            '</td>';
                echo        '</tr>';
            }
            echo    '</tbody>';           
            echo '</table>';
        }
        
        if (count($arrayDigital) > 0) {
                        echo '<table class="table table-striped tableShops" cellspacing=0>';
            echo    '<thead>
                        <tr>
                            <td colspan=2>
            			PELÍCULAS DIGITAL
                            </td>
                        </tr>
                    </thead>
                    <tbody>';
            for ($x = 0; $x < count($arrayDigital); $x++) {
                echo        '<tr>';
                echo            '<td class="titulo">';
                echo                '<b>'.$arrayDigital[$x][0][0]->getTitle_movie().'</b>';
                echo            '</td>';
                echo            '<td class="descarga">';
                echo                '<a style="color: black;" href="#" name="downloadFILM" id="'.$arrayDigital[$x][0][0]->getId_movie().'">Descargar Película</a></p>';
                echo            '</td>';
                echo        '</tr>';
            }
            echo    '</tbody>';           
            echo '</table>';
        }
        echo    '</div>';
        echo '</div>';
        ?>
    </div>    
</section>

<!-- downloadFilm -->
<script src="views/resource/js/downloadFilm.js"></script>