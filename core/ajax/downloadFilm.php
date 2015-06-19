<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Film.php';
include_once '../class/Buy.php';

if (!empty($_REQUEST['idMovie'])) {
    $id = $_REQUEST['idMovie'];

    $session = new Sessions();
    $functionDB = new FunctionsDB();

    if ($session->isUserConnected()) {
        $buy = $session->getBuyDigital($id);
        $nameFile = "";

        if (!empty($buy)) {
            $root = "../../views/resource/films/";
            $file = basename($functionDB->getFilmsID($id)->getArchive_url());
            $path = $root . $file;
            $type = '';

            if (is_file($path)) {
                $size = filesize($path);
                if (function_exists('mime_content_type')) {
                    $type = mime_content_type($path);
                } else if (function_exists('finfo_file')) {
                    $info = finfo_open(FILEINFO_MIME);
                    $type = finfo_file($info, $path);
                    finfo_close($info);
                }
                if ($type == '') {
                    $type = "application/force-download";
                }
                // Definir headers
                header('Pragma: public');
                header('Expires: 0');
                header("Content-Type: $type");
                header("Content-disposition: attachment; filename=\"$file\"");
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $size);
                header('Connection: close');
                // Descargar archivo
                ob_clean();
                flush();

                $fp = fopen($path, "rb");
                while (!feof($fp)) {
                    print(fread($fp, 1024 * 8));
                    flush();
                    ob_flush();
                    if (connection_aborted()) {
                        break;
                    }
                }
                exit();
            } else {
                die("NOT EXIT FILE");
            }
        } else {
            echo "NO PERMISSIONS";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}

