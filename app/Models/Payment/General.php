<?php

namespace App\Http\Controllers\Payment;

use Exception;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class General
{
    public $due_days = 5;

    public function getOptions(): array
    {
        return [
            'client_id' => env('GERENCIANET_CLIENT_ID', ''),
            'client_secret' => env('GERENCIANET_CLIENT_SECRET', ''),
            'sandbox' => env('GERENCIANET_SANDBOX', true) // (true = desenvolvimento e false = producao)
        ];
    }

    /**
     * Consult status from transaction by token
     *
     * @param String $token
     * @return array
     */
    public function getTransactionStatus(String $token): array
    {
        $params = [
            'token' => $token
        ];

        try {
            $api = new Gerencianet($this->getOptions());
            $chargeNotification = $api->getNotification($params, []);

            // Conta o tamanho do array data (que armazena o resultado)
            $i = count($chargeNotification["data"]);
            // Pega o último Object chargeStatus
            $ultimoStatus = $chargeNotification["data"][$i - 1];
            // Acessando o array Status
            $status = $ultimoStatus["status"];
            // Obtendo o ID da transação    
            $charge_id = $ultimoStatus["identifiers"]["charge_id"];
            // Obtendo a String do status atual
            $statusAtual = $status["current"];

            return ['charge_id' => $charge_id, 'status' => $statusAtual];
        } catch (GerencianetException $e) {
            return ['error' => true, 'message' => "Code:$e->code. $e->errorDescription"];
        } catch (Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}