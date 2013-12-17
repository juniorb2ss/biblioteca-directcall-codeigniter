# DirectCall Library for Codeigniter 2.x

Uma biblioteca utilizar alguns recursos da DirectCall API.

## Requisitos
1. PHP 5 ou superior
2. cURL
3. CodeIgniter 2.x

## Instalação
Clone o repositório utilizando o comando abaixo e copie seu conteudo para pasta `application` do CodeIgniter.

    git clone https://github.com/juniorb2ss/biblioteca-directcall-codeigniter.git
    
## Configuração
Para que a biblioteca funcione, precisamos configurar apenas duas variaveis, as demais são opcionais.
O arquivo de configuração se encontra em `application/config/directcall.php`.

## Como usar?

    $this->load->library('directcall');

## Exemplos
Exemplos disponíveis na pasta `exemplos` deste repositório. [Clique aqui](https://github.com/juniorb2ss/biblioteca-directcall-codeigniter/tree/master/exemplos) para ver.


## Métodos
### Enviar SMS

    // @param debug opcional
    enviar_sms($debug)

### Consultar SMS

    // @param callerid obrigatório
    consultar_sms($callerid) 

### Consultar Portabilidade

    // @param numero_telefone obrigatório
    consultar_portabilidade($numero_telefone)

## ChangeLog

### 1.0
* Criado a Biblioteca.

