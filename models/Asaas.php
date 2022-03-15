<?php
class Asaas extends model
{
    public function addClient($data)
    {
        return $this->curlHandler('post', '/api/v3/customers', $data);
    }

    public function updateClient($data, $id)
    {
        return $this->curlHandler('post', '/api/v3/customers/' . $id, $data);
    }

    public function getClientById($id)
    {
        return $this->curlHandler('get', '/api/v3/customers/' . $id, null);
    }

    public function deleteClientById($id)
    {
        return $this->curlHandler('delete', '/api/v3/customers/' . $id, null);
    }

    public function createPayment($data)
    {
        return $this->curlHandler('post', '/api/v3/payments', $data);
    }

    public function createSubcription($data)
    {
        return $this->curlHandler('post', '/api/v3/subscriptions', $data);
    }



    private function curlHandler($method, $endpoint, $data = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, BASE_API_ASAAS . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        switch ($method) {
            case 'get':
                break;
            case 'post':
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'delete':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . APIKEY_ASAAS . ""
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        return $response;
    }

    public static function Status($text)
    {
        /**
         * @param $text
         * - Recebe o status de pagamento e retorna em português
         */
        $res = '';
        switch ($text) {
            case 'PENDING':
                $res = 'Aguardando pagamento';
                break;
            case 'RECEIVED':
                $res = 'Recebida (saldo já creditado na conta)';
                break;
            case 'CONFIRMED':
                $res = 'Pagamento confirmado (saldo ainda não creditado)';
                break;
            case 'OVERDUE':
                $res = 'Vencida';
                break;
            case 'REFUNDED':
                $res = 'Estornada';
                break;
            case 'RECEIVED_IN_CASH':
                $res = 'Recebida em dinheiro (não gera saldo na conta)';
                break;
            case 'REFUND_REQUESTED':
                $res = 'Estorno Solicitado';
                break;
            case 'CHARGEBACK_REQUESTED':
                $res = 'Recebido chargeback';
                break;
            case 'CHARGEBACK_DISPUTE':
                $res = 'Em disputa de chargeback (caso sejam apresentados documentos para contestação)';
                break;
            case 'AWAITING_CHARGEBACK_REVERSAL':
                $res = 'Disputa vencida, aguardando repasse da adquirente';
                break;
            case 'DUNNING_REQUESTED':
                $res = 'Em processo de negativação';
                break;
            case 'DUNNING_RECEIVED':
                $res = 'Recuperada';
                break;
            case 'AWAITING_RISK_ANALYSIS':
                $res = 'Pagamento em análise';
                break;
        }

        return $res;
    }
}
