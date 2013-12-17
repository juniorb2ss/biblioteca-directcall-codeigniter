<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exemplo Enviar SMS
 *
 * Este exemplo mostra como utilizar a librarie directcall para enviar único sms
 *
 * @package		   CodeIgniter
 * @subpackage	 Exemplos
 * @category	   Controller
 * @author		   Carlos Eduardo juniorb2ss@gmail.com
*/

class enviar_unico_sms extends CI_Controller
{
   
   public function __construct()
   {
      /**
       * instanciando a biblioteca
       */
      
      $this->load->library('directcall');

      /**
       * definindo número de origem, número de destino e texto
       */

      /**
       * Número de Origem Obs: Não precisa ser um número, pode ser uma palavra Ex: MeuSistema Online
       * @var string
       */
      
      $this->directcall->numero_origem = 'MeuSistema Online';

      /**
       * Número do telefone que irá receber a mensagem
       * @var string
       */
      
      $this->directcall->numero_destino = '(código pais) + (código área) + (número do telefone)';

      /**
       * Forma que a mensagem será entregue
       * Doc: http://goo.gl/iEFt8b
       * @var string | texto ou sms
       */
      
      $this->directcall->tipo = 'texto';

      /**
       * Texto que será entregue ao número
       */
      
      $this->directcall->texto = 'Testando nova librarie';

      /**
       * Envia SMS
       */
      
      $this->directcall->enviar_sms();
   }
 
} // END class enviar_unico_sms

/* End of file enviar_unico_sms.php */
/* Location: ./application/controllers/enviar_unico_sms.php */