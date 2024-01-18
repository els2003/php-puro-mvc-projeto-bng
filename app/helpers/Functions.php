<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// ===============================================================
function logger($mensagem = '', $level = 'info')
{
    // criar o canal de log
    $log = new Logger('registo_logs');
    $log->pushHandler(new StreamHandler(LOGS_PATH));

    // adicionar registo de logs condicionado pelo level
    switch ($level) {
        case 'info':
            $log->info($mensagem);
            break;
        case 'notice':
            $log->notice($mensagem);
            break;
        case 'warning':
            $log->warning($mensagem);
            break;
        case 'error':
            $log->error($mensagem);
            break;
        case 'critical':
            $log->critical($mensagem);
            break;
        case 'alert':
            $log->alert($mensagem);
            break;
        case 'emergency':
            $log->emergency($mensagem);
            break;
        
        default:
            $log->info($mensagem);
            break;
    }
}

// ===============================================================
function check_session()
{

    // check if there is an active session
    return isset($_SESSION['user']);
}

// ===============================================================
function printData($data, $die = true)
{
    echo '<pre>';
    if(is_object($data) || is_array($data)){
        print_r($data);
    } else {
        echo $data;
    }

    if($die){
        die('<br>FIM</br>');
    }
}

// ===============================================================
function aes_encrypt($value) 
{
    // encrypt $value
    return bin2hex(openssl_encrypt($value, 'aes-256-cbc', OPENSSL_KEY, OPENSSL_RAW_DATA, OPENSSL_IV));
    // openssl_encrypt( $valor_a_ser_encript, 'algorito_usado', chave_ramdom_32caracteres ,
    //dados_raizes_sem_alteração, inicializationVector_16caracteres)
}

// ===============================================================
function aes_decrypt($value) 
{
    // decrypt $value
    if(strlen($value) % 2 != 0) {
        return false;
    }

    return openssl_decrypt(hex2bin($value), 'aes-256-cbc', OPENSSL_KEY, OPENSSL_RAW_DATA, OPENSSL_IV);
}

// ===============================================================
function get_active_user_name() 
{
    return $_SESSION['user']->name;
}