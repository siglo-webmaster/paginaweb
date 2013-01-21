<?php
require_once("lib/nomad_mimemail.inc.php");
class classEmail {
    public $cabeceras;
    public $from;
    public $to; //array
    public $subject;
    public $date;
    public $body;
    public $mail;
    
    function __construct($data) {
        $this->mail = new nomad_mimemail();
      //  $this->mail->set_smtp_host("ssl://smtp.gmail.com",465);
      //  $this->mail->set_smtp_auth("oborja@siglodelhombre.com", "");
        
        $this->mail->set_from(_SIGLOEMAIL);
        $this->mail->set_to($data['to']);
        $this->mail->set_subject("Registro nuevo usuario www.siglodelhombre.com");
        $this->mail->set_text("Usuario registrado exitosamente.

Datos del proceso:
Usuario: ".$data['username']."
Password: ".$data['password']."

            ");
        


    }
    
    function send(){
        return true;
        ///TODO
        if ($this->mail->send()){
            echo "The MIME Mail has been sent";
        }
        else {
            echo "Error enviando correo";
        }
            
    }
}

?>
