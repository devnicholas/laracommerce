<?php

namespace App\Http\Controllers\Payment;

use Carbon\Carbon;
use Exception;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class Billet extends General
{
    public $billet_message = 'Depósito para conta Gerencianet
    - sr.caixa:
    - 1) Não aceitar pagamento em cheque
    - 2) Não aceitar mais de um pagamento com o mesmo boleto';

    /**
     * Create new payment with credit card
     * 
     * Data format:
     * $item = ['name','amount','value']
     * $customer = ['name','cpf','phone_number','email','birth']
     *
     * @param Array $items
     * @param Array $customer
     * @return Array
     */
    public function newPayment(array $items, array $customer): array
    {
        // Not Used
        // $discount = [ // configuração de descontos
        //     'type' => 'currency', // tipo de desconto a ser aplicado
        //     'value' => 599 // valor de desconto 
        // ];
        // $conditional_discount = [ // configurações de desconto condicional
        //     'type' => 'percentage', // seleção do tipo de desconto 
        //     'value' => 500, // porcentagem de desconto
        //     'until_date' => '2019-08-30' // data máxima para aplicação do desconto
        // ];

        $metadata = [
            'notification_url' => $this->getOptions()['sandbox'] ?
            'http://api.webhookinbox.com/i/plk1HSHI/in/' :
            route('webhook')
        ]; //Url de notificações
        $bankingBillet = [
            'expire_at' => Carbon::now()->addDays($this->due_days)->format('Y-m-d'), // data de vencimento do titulo
            'message' => $this->billet_message, // mensagem a ser exibida no boleto
            'customer' => $customer,
            // 'discount' => $discount,
            // 'conditional_discount' => $conditional_discount
        ];
        $payment = [
            'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
        ];
        $body = [
            'items' => $items,
            'metadata' => $metadata,
            'payment' => $payment
        ];
        try {
            $api = new Gerencianet($this->getOptions());
            $pay_charge = $api->oneStep([], $body);
            return $pay_charge;
        } catch (GerencianetException $e) {
            return ['error' => true, 'message' => "Code:$e->code. ".json_encode($e->errorDescription)];
        } catch (Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}