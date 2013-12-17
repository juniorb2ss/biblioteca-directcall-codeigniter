biblioteca-directcall-codeigniter
=================================

Biblioteca para chamadas na API da DirectCall.

**Versão 1.0**


Inicializar:

    $this->load->library('directcall');

Funções:
    
     // @param debug opcional
    $this->directcall->enviar_sms($debug)

     // @param callerid obrigatório
    $this->directcall->consultar_sms($callerid) 
