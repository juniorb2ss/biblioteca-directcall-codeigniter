<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exemplo Consultar Portabilidade
 *
 * Este exemplo mostra como utilizar a consulta de portabilidade
 *
 * @package		     CodeIgniter
 * @subpackage     Exemplos
 * @category	     Controller
 * @author		     Carlos Eduardo juniorb2ss@gmail.com
*/

class portabilidade extends CI_Controller
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
       * Consultar Portabilidade
       *
       * Doc: http://goo.gl/4E7FEH
       * @param string numero_telefone Numero que vai ser consultado
       */
      
      echo $this->directcall->portabilidade_consultar('(código pais) + (código área) + (número telefone)') );
   }
 
} // END class portabilidade

/* End of file portabilidade.php */
/* Location: ./application/controllers/portabilidade.php */