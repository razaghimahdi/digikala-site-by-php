<?php


class mellat
{


    private $client;
    private $namespace;
    private $terminalId;
    private $userName;
    private $userPassword;
    private $orderId;
    private $amount;
    private $localDate;
    private $localTime;
    private $additionalData;
    private $callBackUrl;
    private $payerId;


    public function __construct($notIncludeNusoap = null)
    {

        $this->namespace = 'http://interfaces.core.sw.bps.com/';
        $this->terminalId = '1989204';
        $this->userName = 'clic18';
        $this->userPassword = '45704044';
        $this->pardakht = 'no';
        if ($notIncludeNusoap == null) {
            include('nusoap/nusoap.php');
        }


    }//construct


    public function bpPay($mablagh)
    {


        $this->client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $this->orderId = time();
        $this->localDate = date('Ymd');
        $this->localTime = date('His');
        $this->additionalData = '';
        $this->callBackUrl = 'http://www.program-learning.com/mellat/test2.php';
        $this->payerId = 0;

        $params = array(
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $this->orderId,
            'amount' => $mablagh,
            'localDate' => $this->localDate,
            'localTime' => $this->localTime,
            'additionalData' => $this->additionalData,
            'callBackUrl' => $this->callBackUrl,
            'payerId' => $this->payerId
        );

        $res = $this->client->call('bpPayRequest', $params, $this->namespace);
        //echo $res;
        $result = explode(',', $res);

       if ($result[0] == 0) {
           return $result[1];
       }


    }//bpPay


    public function bpVerify($SaleOrderId, $SaleReferenceId)
    {


        $this->pardakht = 'no';
        $this->client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $this->orderId = time();

        $params = array(
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $this->orderId,
            'saleOrderId' => $SaleOrderId,
            'saleReferenceId' => $SaleReferenceId

        );

        $verify = $this->client->call('bpVerifyRequest', $params, $this->namespace);
		
		//print_r($verify);
        //echo 'verify:'.$verify.'<br>';

        if ($verify == '0') {

            $settle = $this->client->call('bpSettleRequest', $params, $this->namespace);
            //echo 'settleaval:'.$settle.'<br>';
            if ($settle == 0) {
                $this->pardakht = 'yes';
            }//if
            else {
            }//else

        }//if

        if ($verify != '0' and $verify != '') {

            $inquiry = $this->client->call('bpInquiryRequest', $params, $this->namespace);
            //echo 'inquiry:'.$inquiry.'<br>';

            if ($inquiry == 0) {

                $settle = $this->client->call('bpSettleRequest', $params, $this->namespace);
                //echo 'settledovom:'.$settle.'<br>';

                if ($settle == 0 or $settle == 45) {
                    $this->pardakht = 'yes';
                }//if
                else {
                }//else

            }//if


            else {

                $reverse = $this->client->call('bpReversalRequest', $params, $this->namespace);
                echo 'reverse:' . $reverse . '<br>';

            }//else


        }//if


        return $this->pardakht;


    }//bpVerify


}//mellat


?>