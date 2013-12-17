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
     * Obrigatório Número de quem esta enviando o SMS, formato exemplo: 554199xx2010 (DDI DDD NUMERO)
     *
     * Doc: http://goo.gl/iEFt8b
     * @var [string]
     */
    
    public $numero_origem;

    /**
     * Destino obrigatório Número de destino do SMS, formato exemplo: 554199xx2010 (DDI DDD NUMERO)
     * 
     *    Notas sobre este parâmetro:   
     *    - Para enviar para mais do que um destinatário basta incluir um ; no meio de cada número, por exemplo: 554199xx2010;554199xx2030, 
     *      mas esta alternativa não deve ser utilizada para enviar SMS para mais do que 10 destinatários.
     *    - Quando você precisar enviar para mais do que 10 destinatários prefira informar os números via arquivo csv +Inf.
     *
     * Doc: http://goo.gl/iEFt8b
     * @var [string]
     */
    
    public $numero_destino;

    /**
     * Opcional Opção para enviar como texto ou voz podendo ser ("voz" para torpedo de voz | "texto" para sms), por padrão é texto.
     * Doc: http://goo.gl/iEFt8b
     * @var string
     */
    
    public $tipo = 'texto';
    
    /**
     * Opcional Opção para envio do número de origem no início do SMS podendo ser s para enviar e n para não enviar.
     * Doc: http://goo.gl/iEFt8b
     * @var string
     */
    
    public $id_origem = 's';
    

    /**
     * Obrigatório Texto a ser enviado na mensagem pode ter até 700 caracteres, mas "importante":
     *       - Notas sobre este parâmetro:
     *         - Um SMS pode ter até 140 caracteres;
     *         - Mensagens maiores serão divididas em "multiplos SMS", antes de serem entregues;
     *         - A cobrança será proporcional ao número de SMS utilizado em cada envio.  
     *         
     * Doc: http://goo.gl/iEFt8b
     * @var [string]
     */
    
    public $texto;

    /**
     * Última resposta da API
     * Doc: http://goo.gl/iEFt8b
     * @var [array]
     */
    
    private $last_response = array();

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
    }

    /**
     * Requesita uma nova token para o servidor, as tokens são válidas por 1 hora.
     * Doc: http://goo.gl/1d7ozo
     * @return [string] access_token
     */
    
    public function _request_token()
    {
        /**
         * url
         */
            $url = $this->configs['url_request_token'];
        /**
         * setando opções
         */
        
        $options = array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_HEADER => 0,
                    CURLOPT_RETURNTRANSFER => 1
                );

        /**
         * setando chamadas posts
         */
        
        $post = array(
                    'client_id' => $this->configs['client_id'],
                    'client_secret' => $this->configs['client_secret']
                );
        /**
         * executando e capturando retorno
         */
        
        $this->last_response = $this->_call_curl($url, $options, $post);
        
        
        if(empty($this->last_response->access_token))
        {
            show_error('Resposta inválida API DirectCall');
        }
        else
        {
            $this->config['access_token'] = $this->last_response->access_token;
        }
    }

    public function _call_curl($url, $array_options, $array_post)
    {
       /**
         * inicializando curl
         */
        
        $this->_ci->curl->create($url);

        /**
         * setando opções
         */
        
        $this->_ci->curl->options( $array_options );

        /**
         * setando chamadas posts
         */
        
        $this->_ci->curl->post( $array_post );

        /**
         * executando e capturando retorno
         */
        
        return json_decode($this->_ci->curl->execute());
        
    }

    
    /**
     * Enviar sms pela API módulo de sms
     * @return [array] status do envio
     */    
    public function enviar_sms($debug = FALSE)
    {
        /**
         * url
         */
            $url = $this->configs['url_sms_send'];
        /**
         * setando opções
         */
        
        $options = array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_HEADER => 0,
                    CURLOPT_RETURNTRANSFER => 1
                );

        /**
         * setando chamadas posts
         */
        
        $post = array(
                    'origem' => $this->numero_origem,
                    'destino' => $this->numero_destino,
                    'tipo' => $this->tipo,
                    'access_token' => $this->config['access_token'],
                    'texto' => $this->texto
                );
        /**
         * executando e capturando retorno
         */
        
        $this->last_response = $this->_call_curl($url, $options, $post);

        /**
         * debug
         */

        if($debug === TRUE)
        {
            $this->debug();
        }

        /**
         * executando e capturando retorno
         */
        
    }

    /**
     * debug function
     */
    public function debug()
    {
        echo '<pre>';
        var_dump($this->last_response);
        echo '</pre>';
    }

} // END class Directcall

/* End of file directcall.php */
/* Location: ./application/libraries/directcall.php */