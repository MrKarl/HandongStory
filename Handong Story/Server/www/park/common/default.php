<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    date_default_timezone_set('Asia/Seoul');

    function isDev(){
        return true;

        if (preg_match('/abc/i', $_SERVER['SERVER_NAME']) ) {  
            return false;
        }	
        else {
            return true;
        }
    }

    function get_pdo() {
        if (isDev()) {  
            return get_pdo_dev();
        }	
        else {
            return get_pdo_dist();
        }
    }

    function get_pdo_dev() {/*{{{*/
        static $pdo = null;

        if ($pdo) {
            return $pdo;
        }
        $host = '127.0.0.1';
        $port = '3306';
        $dbname = 'pjt_storyboxmanager';
        $user = 'root';
        $password = 'gozldshsh';

        $pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8', $user, $password);

        $stmt = $pdo->prepare("SET TIME_ZONE='Asia/Seoul';");
        $stmt->execute();	

        $stmt = $pdo->prepare("SET NAMES 'UTF8';");
        $stmt->execute();

        return $pdo;
    }/*}}}*/

    function get_pdo_dist() {/*{{{*/
        static $pdo = null;

        if ($pdo) {
            return $pdo;
        }
        $host = '127.0.0.1';
        $port = '3306';
        $dbname = 'pjt_storyboxmanager';
        $user = 'root';
        $password = 'gozldshsh';

        $pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8', $user, $password);

        $stmt = $pdo->prepare("SET TIME_ZONE='Asia/Seoul';");
        $stmt->execute();	

        $stmt = $pdo->prepare("SET NAMES 'UTF8';");
        $stmt->execute();

        return $pdo;
    }/*}}}*/	

    function trimHttp($string) {
            if(strstr($string, 'https://') != FALSE) {
                    $string = preg_replace('/^https:\/\//i',"", $string );
            } else if(strstr($string, 'http://') != FALSE) {
                    $string = preg_replace('/^http:\/\//i',"", $string );
            }
            return $string;
    }

    function jsonResultMessageStr($resultStr, $resultAry = NULL){
        if($resultAry == null){
            return "{\"result\":\"$resultStr\"}";
        }
        
        $additionalStr = '';
        foreach ($resultAry as $key => $value) {
            $additionalStr .= ",\"$key\":\"$value\"";
        }
        return "{\"result\":\"$resultStr\"$additionalStr}";
    }
    function jsonErrorMessageStr($errorStr, $resultAry = NULL){
        if($resultAry == null){
            return "{\"error\":\"$errorStr\"}";
        }
        
        $additionalStr = '';
        foreach ($resultAry as $key => $value) {
            $additionalStr .= ",\"$key\":\"$value\"";
        }
        return "{\"error\":\"$errorStr\"$additionalStr}";
    }

    function xmlResultMessageStr($errorStr){
        return "<result>$errorStr</result>";
    }

    function exitWithError($exitNumber, $errorStr){
        $pdoObj = get_pdo();
        if ( $pdoObj->inTransaction() ) {
            $pdoObj->rollBack();
//                echo jsonResultMessageStr("[[DB_ERROR]]");
        }
        echo $errorStr;
        exit($exitNumber);
    }

    function show404Error(){
        header("HTTP/1.0 404 Not Found");
        exit(-404);
    }

    function d_datetime($ref,$Y,$m,$d,$H,$i,$s){
        list($day,$time) = preg_split("/ /", $ref);
        list($Y_ref,$m_ref,$d_ref) = preg_split("/-/", $day);
        list($H_ref,$i_ref,$s_ref) = preg_split("/:/", $time);
//            list($day,$time) = split(" ",$ref);
//            list($Y_ref,$m_ref,$d_ref) = split("-",$day);
//            list($H_ref,$i_ref,$s_ref) = split(":",$time);
        $d_day = date( "Y-m-d H:i:s", mktime( $H_ref+$H, $i_ref+$i, $s_ref+$s, $m_ref+$m, $d_ref+$d, $Y_ref+$Y));
        Return $d_day;
    }

    function splitDatetime($ref,$stStr){
        list($day,$time) = preg_split("/ /", $ref);
        list($Y_ref,$m_ref,$d_ref) = preg_split("/-/", $day);
        list($H_ref,$i_ref,$s_ref) = preg_split("/:/", $time);

        $returnStr = null;
        if($stStr == 'Y'){
            $returnStr = $Y_ref;
        }
        else if($stStr == 'm'){
            $returnStr = $m_ref;
        }
        else if($stStr == 'd'){
            $returnStr = $d_ref;
        }
        else if($stStr == 'H'){
            $returnStr = $H_ref;
        }
        else if($stStr == 'i'){
            $returnStr = $i_ref;
        }
        else if($stStr == 's'){
            $returnStr = $s_ref;
        }

        return $returnStr;
    }

    function dateNow($noSpace = false){
        if($noSpace){
            return date( "Ymd_His", time());
        }
        else{
            return date( "Y-m-d H:i:s", time());
        }
    }
    
    function isToday($time) {
        return (strtotime($time) === strtotime('today'));
    }
    function isPast($time){
        return (strtotime($time) < time());
    }
    function isFuture($time){
        return (strtotime($time) > time());
    }

    /**
    * Generatting CSV formatted string from an array.
    * By Sergey Gurevich.
    */
    function array_to_scv($array, $header_row = true, $col_sep = ",", $row_sep = "\n", $qut = '"')
    {
            if (!is_array($array) or !is_array($array[0])) return false;

            $output = "";
            //Header row.
            if ($header_row)
            {
                    foreach ($array[0] as $key => $val)
                    {
                            //Escaping quotes.
                            $key = str_replace($qut, "$qut$qut", $key);
                            $output .= "$col_sep$qut$key$qut";
                    }
                    $output = substr($output, 1)."\n";
            }
            //Data rows.
            foreach ($array as $key => $val)
            {
                    $tmp = '';
                    foreach ($val as $cell_key => $cell_val)
                    {
                            //Escaping quotes.
                            $cell_val = str_replace($qut, "$qut$qut", $cell_val);
                            $tmp .= "$col_sep$qut$cell_val$qut";
                    }
                    $output .= substr($tmp, 1).$row_sep;
            }

            return $output;
    }
    
    function send_data_for_xml($url, $post_data, $contentType = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($contentType != null){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        $postResult = null;
        $i = 0;
        while(true){
            $postResult = curl_exec($ch);
            if(curl_errno($ch) && $i < 5){
                error_log("send_data_for_xml (nth:$i) : ".curl_error($ch));
                $i++;
            }
            else{
                if(curl_errno($ch)){
                    error_log("send_data_for_xml (nth:$i) : ".curl_error($ch));
                }
                break;
            }
        }
        curl_close ($ch);
        return $postResult;
    }

    function send_data($url, $post_data, $contentType = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 240);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        if($contentType != null){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        $postResult = curl_exec($ch);
        curl_close ($ch);
        return $postResult;
    }
    
    function send_data_ob($url, $post_data, $contentType = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        if($contentType != null){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        ob_start();
        $postResult = curl_exec($ch);
        $buffer = ob_get_contents();
        ob_end_clean();
        curl_close ($ch);
        return $buffer;
    }

    function fetch_page($url, $param, $cookies, $referer_url, $contentType = null){
        if(strlen(trim($referer_url)) == 0) $referer_url= $url; 
            $curlsession = curl_init ();
            curl_setopt ($curlsession, CURLOPT_URL, "$url");
            curl_setopt ($curlsession, CURLOPT_POST, 1);
            curl_setopt ($curlsession, CURLOPT_POSTFIELDS, "$param");
            curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60);
        if($cookies && $cookies!=""){
            curl_setopt ($curlsession, CURLOPT_COOKIE, "$cookies");
        }
        if($contentType != null){
            curl_setopt ($curlsession, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        curl_setopt ($curlsession, CURLOPT_HEADER, 0);
        curl_setopt ($curlsession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt ($curlsession, CURLOPT_REFERER, "$referer_url");
        ob_start();
        $res = curl_exec ($curlsession);
        $buffer = ob_get_contents();
        ob_end_clean();
        if (!$buffer) {
            $returnVal = "Curl Fetch Error : ".curl_error($curlsession);
        }
        else{
            $returnVal = $buffer;
        } 
        curl_close($curlsession); 
        return $returnVal;
    }
    
    function fetch_page_ssl($url, $param, $cookies, $referer_url, $contentType = null){
        $ch = curl_init();
        if($contentType != null){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        curl_setopt ($ch, CURLOPT_URL,$url); //접속할 URL 주소
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
        // default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
        curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $param); // Post 값 Get 방식처럼적는다.
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60); // TimeOut 값
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
    
    function numberStrWith8LeadingZeros($numStr, $prefixStr = null, $postfixStr = null){
//        $numStr = (int)$numStr + 10000;
        $numStr = (int)$numStr;
        $string = "%s%08d%s";
        return sprintf($string, $prefixStr, $numStr, $postfixStr);
    }
    function numberStrWith2LeadingZeros($numStr, $prefixStr = null, $postfixStr = null){
        $string = "%s%02d%s";
        return sprintf($string, $prefixStr, $numStr, $postfixStr);
    }
    
    function curl_request_async($url, $params, $type='POST'){
        foreach ($params as $key => &$val){
            if (is_array($val)){
                $val = implode(',', $val);
            }
            $post_params[] = $key.'='.urlencode($val);
        }
        $post_string = implode('&', $post_params);

        $parts=parse_url($url);

        if ($parts['scheme'] == 'http'){
            $fp = fsockopen($parts['host'], isset($parts['port'])?$parts['port']:80, $errno, $errstr, 180);
        }
        else if ($parts['scheme'] == 'https'){
            $fp = fsockopen("ssl://" . $parts['host'], isset($parts['port'])?$parts['port']:443, $errno, $errstr, 180);
        }

        // Data goes in the path for a GET request
        if('GET' == $type){
            $parts['path'] .= '?'.$post_string;
        }

        $out = "$type ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Content-Length: ".strlen($post_string)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        // Data goes in the request body for a POST request
        if ('POST' == $type && isset($post_string)){
            $out.= $post_string;
        }

        $rt = fwrite($fp, $out);
        fclose($fp);
        
        return array("out" => $out, "result" => $rt);
    }
    function curl_post_async($uri, $params){
        $command = "curl ";
        foreach ($params as $key => &$val)
            $command .= "-F '$key=$val' ";
        $command .= "$uri -s > /dev/null 2>&1 &";
        passthru($command);
    }
    
?>
