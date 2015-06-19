<?php

class Mail {

    private $cabeceras = "";
    private $titulo = "";

    public function resetPassword($pass, $destinatario) {
        //Título
        $this->titulo = 'Cambio de contraseña en Cinexon';

        //Cabeceras
        $this->cabeceras = "MIME-Version: 1.0\r\n";
        $this->cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
        //dirección del remitente 
        $this->cabeceras .= "From: Cinexon <cinexon@molamogollon.com>\r\n";

        //Mensaje
        $mensaje = '
			<HTML>
				<head>
					<title>Reiniciar tu contraseña</title>
				</head>
				<body>
					<span id="header"><img style="width: 100%; height: 200px;" src="http://cinexon.webhop.me/views/resource/img/icono_pdf.png"/></span>
					<span id="body_mail">
						<h1>¡Hola!</h1>

						<p>Este correo se ha enviado porque, por lo visto, has olvidado tu contraseña. ¡Mecachis, hay que
						tener más atenta esa cabeza!<br/><br/>

						Hemos reiniciado tu contraseña, a partir de ahora, esta será tu nueva clave:</p>
						<br/>
						<ul>
							<li>Contraseña: ' . $pass . '</li>
						</ul>
						<br/>
						<p>¡No te olvides la próxima vez!</p>
					</span>
				</body>
			</HTML>
			';

        //Enviarlo
        $enviado = mail($destinatario, $this->titulo, $mensaje, $this->cabeceras);
    }

//resetPassword

    public function activateAccount($url, $destinatario) {
        //Título
        $this->titulo = 'Activación cuenta en Cinexon';

        //Cabeceras
        $this->cabeceras = "MIME-Version: 1.0\r\n";
        $this->cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
        //dirección del remitente 
        $this->cabeceras .= "From: Cinexon <cinexon@molamogollon.com>\r\n";

        //Mensaje
        $mensaje = '
			<HTML>
				<head>
					<title>Reiniciar tu contraseña</title>
				</head>
				<body>
					<span id="header"><img style="width: 100%; height: 200px;" src="http://cinexon.webhop.me/views/resource/img/icono_pdf.png"/></span>
					<span id="body_mail">
						<h1>¡Bienvenido!</h1>

						<p>Este correo se ha enviado porque te registrarte en Cinexon<br/><br/>

						Para poder a disfrutar de todo lo que te ofrece nuestra página pulse el siguiente enlace:</p>
						<br/>
						<ul>
							<li>Enalce: ' . $url . '</li>
						</ul>
						<br/>
						<p>¡Disfruta!</p>
					</span>
				</body>
			</HTML>
			';

        //Enviarlo
        $enviado = mail($destinatario, $this->titulo, $mensaje, $this->cabeceras);
    }

    public function sendMail($mensaje, $destinatario) {
        $this->titulo = 'Hola, usuario/a de Cinexon';

        //Cabeceras
        $this->cabeceras = "MIME-Version: 1.0\r\n";
        $this->cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
        //dirección del remitente 
        $this->cabeceras .= "From: Cinexon <cinexon@molamogollon.com>\r\n";

        // Enviarlo
        mail($destinatario, $this->titulo, $mensaje, $this->cabeceras);
    }

//sendMail
}

//Class
?>