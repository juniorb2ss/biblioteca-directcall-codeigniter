<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Carlos Eduardo juniorb2ss@gmail.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @package      CodeIgniter
 * @subpackage   Libraries
 * @category     Libraries
 * @author       Carlos Eduardo juniorb2ss@gmail.com
 * @copyright    2013 Carlos Eduardo.
 * @license      http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version      1.0
 * @link         http://directcall.com.br
 */
class Directcall
{
    /**
     * Configurações
     * 
     * @var [array]
     */
    
    private $_configs = array();

    /**
     * ci instace
     * @var [object]
     */
    
    private $_ci;

    /**
     * Define client_id e $client_secret, retorno access_token válido por 1 hora.
     * 
     * Doc: http://goo.gl/1d7ozo
     * @param [string] $client_id   client
     * @param [string] $cliend_pass description
     * @return [string] access_token Token de acesso válido por 1 hora
     */
    
    public function __construct($config)
    {
        /**
         * Capturando instância do CI
         */
        
        $this->_ci =& get_instance();

        /**
         * Carregando librarie curl
         */
        
        $this->_ci->load->library('curl');

        /**
         * chamando configurações
         */
        
        $this->_ci->config->load('directcall');

        /**
         * configirações ok ?
         */
        
        foreach ($config as $key => $value) 
        {
            if(empty($value))
            {
                show_error("Variável $key não informado nas configurações application/config/directcall.php");
            }
        }

        /**
         * argumentos passados __construct
         */
        
        $this->configs = $config;

        $this->_request_token();

        echo $this->config['access_token'];
    }

    public function _request_token()
    {
        /**
         * inicializando curl
         */
        $this->_ci->curl->create($this->configs['url_request_token']);

        /**
         * setando opções
         */
        $this->_ci->curl->options(
            array(
                CURLOPT_POST => TRUE,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1
                )
            );
        /**
         * setando chamadas posts
         */
        $this->_ci->curl->post(
            array(
                'client_id' => $this->configs['client_id'],
                'client_secret' => $this->configs['client_secret']
                )
            );
        /**
         * executando e capturando retorno
         */
        if(!$this->config['access_token'] = $this->_ci->curl->execute())
        {
            show_error('Resposta inválida API DirectCall');
        }
    }

} // END class Directcall

/* End of file directcall.php */
/* Location: ./application/libraries/directcall.php */