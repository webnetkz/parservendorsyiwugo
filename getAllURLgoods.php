<?php
    // require_once 'db.php';


    // $id = $_GET['id'];
    // $sql = 'SELECT res FROM urls WHERE id = '.$id;
    // $res = $pdo->query($sql);
    // $res = $res->fetch(PDO::FETCH_ASSOC);

    // $id = $id + 1;

        $url = $res['res'];
        $url = 'https://en.yiwugo.com/shopdetail/1/588152_1.html';

    
    
        $javascript_loop = 0; $timeout = 3;



        $url = str_replace( "&amp;", "&", urldecode(trim($url)) );
    
        $cookie = tempnam ("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ch, CURLOPT_ENCODING, "" );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_MAXREDIRS, 99 );
        $content = curl_exec( $ch );
        $response = curl_getinfo( $ch );
        curl_close ( $ch );
    
        if ($response['http_code'] == 301 || $response['http_code'] == 302) {
            ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    
            if ( $headers = get_headers($response['url']) ) {
                foreach( $headers as $value ) {
                    if ( substr( strtolower($value), 0, 9 ) == "location:" )
                        return get_url( trim( substr( $value, 9, strlen($value) ) ) );
                }
            }
        }
    



        if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
            echo '<script>document.location.href = "getEmails.php?id='.$id.'"</script>';
            return get_url( $value[1], $javascript_loop+1 );
        } else {
            
            $res = stristr($content, '<ul class="index_pro_one fontbluelink">');
            $res = stristr($res, '<div class="bord_list_page">', true);

            preg_match_all('=//en.yiwugo.com/product/detail/(.*).html=', $res, $out);
            echo '<pre>';
            var_dump($out[0]);

        }