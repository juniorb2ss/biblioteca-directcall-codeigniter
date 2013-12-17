<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exemplo Consultar SMS
 *
 * Este exemplo mostra como utilizar a librarie directcall para consultar sms
 *
 * @package		 CodeIgniter
 * @subpackage	 Exemplos
 * @category	 Controller
 * @author		 Carlos Eduardo juniorb2ss@gmail.com
*/

class consultar_sms extends CI_Controller
{
   
   public function __construct()
   {
      /**
       * instanciando a biblioteca
       */
      
      $this->load->library('directcall');
   }

   public function consultar()
   {

      /**
       * Consultar SMS
       *
       * Doc: http://goo.gl/kz4ukM
       * @param string callerid id do sms retornado pela API ao ser enviado
       * @var string
       */
      
      echo $this->directcall->consultar_sms('98342409059580');
   }
 
} // END class consultar_sms

/* End of file consultar_sms.php */
/* Location: ./application/controllers/consultar_sms.php */