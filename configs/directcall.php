<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| DirectCall
| -------------------------------------------------------------------------
| Arquivo configuração da librarie DirectCall, informe seu client_id e client_secret.
|
|   Doc: http://goo.gl/1d7ozo
|
*/

/**
 * client_id obrigatório Código identificador do cliente Directcall.
 */
    $config['client_id'] = '';
/**
 * client_secret obrigatório Código secreto do cliente Directcall.
 */
    $config['client_secret'] = '';
/**
 * format opcional Opção de retorno da API podendo ser JSON ou XML, se não informado JSON será o padrão.
 * 
 * Doc: http://goo.gl/1d7ozo
 */
    $config['format'] = 'JSON'; // json ou xml

/**
 * Url que será feito requesição nova token.
 */
    $config['url_request_token'] = 'http://api.directcallsoft.com/request_token';

/**
 * Url que será enviado novo sms.
 */
    $config['url_sms_send'] = 'http://api.directcallsoft.com/sms/send';

/**
 * Url que será feito consulta sms.
 */
    $config['url_sms_status'] = 'http://api.directcallsoft.com/sms/status';
/**
 * Url que será feito consulta portabilidade
 */
    $config['portabilidade_consultar'] = 'http://api.directcallsoft.com/portabilidade/consultar';


/* End of file directcall.php */
/* Location: ./application/config/directcall.php */