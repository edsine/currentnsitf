<?php
/**
 * Remita wallaet creation and payment class
 *
 * @author Nuruddeen Mijinyawa
 * project NAVSA
 */
//namespace navsa;

require_once 'database.php';

class RemitaCon extends Database
{
    public static function remGet($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function getTimeStamp()
    {
//        $dateTime = new DateTime();
        $date = date('Y-m-d');
        $time = date('H:i:s');
        return $date . "T" . $time .'+000000';
    }

    public static function getHeader($requestId)
    {
        $apikey=" TklUREExMjM0fE5JVERB";
        $apiToken="RGlxVEZUNlJSUHZZVXZVa1VaRmtCOXh3NXh5OUQ2N3BoTW1iVGlvbW9WUT0=";
        $merchantId ="1509371036019";
        
        $hashString = $apikey . $requestId . $apiToken;
        $apiHash = hash('sha512', $hashString);
        $headers = array(
            'Content-Type: application/json',
            'API_KEY:' . $apikey,
            'REQUEST_ID:' . $requestId,
            'REQUEST_TS:' . RemitaCon::getTimeStamp(),
            'API_DETAILS_HASH:' . $apiHash,
            'MERCHANT_ID:' . $merchantId
        );
        return $headers;
    }

  

    public static function remPost($url, $headers, $data)
    {
        try{
            $ch = curl_init();
            $repos_params_json = json_encode($data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $repos_params_json);
            $result = curl_exec($ch);
            curl_close($ch);
            $baseResponse = json_decode($result, BaseResponse::class);
            return $baseResponse;
        }catch (Exception $e){
            echo "An Error Occur While Connecting to Remita Service";
        }
       

    }

   
}
