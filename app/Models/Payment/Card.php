<?php

namespace App\Http\Controllers\Payment;

use Exception;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class Card extends General
{
    public $credit_card_message = 'teste\nteste\nteste\nteste';

    /**
     * Create new payment with credit card
     * 
     * Data format:
     * $item = ['name','amount','value']
     * $customer = ['name','cpf','phone_number','email','birth']
     * $billingAddress = ['street','number','neighborhood','zipcode','city','state']
     *
     * @param String $paymentToken
     * @param Array $items
     * @param Array $customer
     * @param Array $billingAddress
     * @param Int $installments
     * @return Array
     */
    public function newPayment(String $paymentToken, array $items, array $customer, array $billingAddress, Int $installments = 1): array
    {
        // Not Used
        // $discount = [
        //     'type' => 'currency',
        //     'value' => 599
        // ];

        $metadata = [
            'notification_url' => $this->getOptions()['sandbox'] ?
            'http://api.webhookinbox.com/i/plk1HSHI/in/' :
            route('webhook')
        ]; //Url de notificações

        $credit_card = [
            'customer' => $customer,
            'installments' => $installments, // número de parcelas em que o pagamento deve ser dividido
            // 'discount' => $discount,
            'billing_address' => $billingAddress,
            'payment_token' => $paymentToken,
            'message' => $this->credit_card_message
        ];
        $payment = [
            'credit_card' => $credit_card // forma de pagamento (credit_card = cartão)
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