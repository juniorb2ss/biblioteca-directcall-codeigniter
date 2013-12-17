biblioteca-directcall-codeigniter
=================================

Biblioteca para chamadas na API da DirectCall.

**Versão 1.0**


Inicializar:

    $this->load->library('directcall');

Funções:
    
     // @param debug FALSE
    $this->directcall->enviar_sms($debug)

     // @param callerid FALSE
    $this->directcall->consultar_sms($callerid) 
