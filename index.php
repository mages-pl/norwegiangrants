<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
  AOS.init();
</script>
</head>
<body>
    <aside>
        <h1>#1 Lorem ipsum</h1>
        <h4>dolor sit amet</h4>
        <h3>Google Material Design</h3>
    </aside>
    <input type="checkbox" id="menu-toggle" />
    <label id="trigger" for="menu-toggle"></label>
    <label id="burger" for="menu-toggle"></label>
    <ul id="menu">
        <li><img src="https://ncn.gov.pl/sites/default/files/obrazki/logo/logo_norweskie_eog.png" style="max-width: 100%;max-width: 200px;margin: auto;"></li>
        <li><a href="#">Cel i zasady działania</a></li>
        <li><a href="#">Skorzystaj z funduszy</a></li>
        <li><a href="#">Zapoznaj się z funuszami</a></li>
        <li><a href="#">Kontakt</a></li>
    </ul>
    <!-- content -->
    <section>
        <div class="header">
            <a href="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            <img src="https://ncn.gov.pl/sites/default/files/obrazki/logo/logo_norweskie_eog.png" style="max-width: 100%;
filter: invert(1);
max-height: 100px;
align-content: center;
justify-content: center;
display: flex;
position: relative;
flex-flow: column;
justify-content: center;
align-content: center;
max-width: 200px;
margin: auto;">
</a>
            <h1> News </h1>
        </div>
        <div class="line"></div>
        <div id="content">

        <?php
include './vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

//$client = new Client();
class WebCrawler
{
    public $data;
    public $newsy;
    public $newsy_tytuly;
    public $newsy_linki;
    public $newsy_daty;

    public function getOffers($url, $selector, $type, $properties)
    {
        $this->data = [];
        foreach ($properties as  $key => $property) {
            $this->props = $property;
            $crawler = (new Client())->request('GET', $url);
            $this->att = $type[$key];
            $crawler->filter($selector[$key])->each(function ($node) {
                if ($this->att != null) {
                    $this->data[] = trim($node->attr($this->att));
                } else {
                    $this->data[] = trim($node->text());
                }
            });
        }
        return $this->data;
    }
 
}


$pobierzNewsy = new WebCrawler();
$url = "https://www.eog.gov.pl/umbraco/surface/FiltersSurface/getPartialLista?id=235520&hashUrl=domyslne%3D1&typeOfDate=Data+ostatniej+publikacji&partialName=MIRListaFiltrowana&ctResultPagesAlias=MIRWiadomosc%2CMIRNaboryWnioskow%2CMIRWydarzenie%2CMIRKonferencjeSzkolenia&lang=pl";

 $pobierzNewsy->newsy_tytuly =  $pobierzNewsy->getOffers($url, ["li h3"], [null], ["tytul"]);
 $pobierzNewsy->newsy_linki =  $pobierzNewsy->getOffers($url, ["li h3 a"], ['href'], ["link"]);
 $pobierzNewsy->newsy_daty =  $pobierzNewsy->getOffers($url, ["li time"], [null], ["time"]);

foreach($pobierzNewsy as $key => $o) {
           @$pobierzNewsy->newsy_tytuly['tytul'][$key] = $o;
       }
       foreach($pobierzNewsy->newsy_linki as $key => $o) {
           @$pobierzNewsy->newsy_linki['link'][$key] = $o;
       }
       foreach($pobierzNewsy->newsy_daty as $key => $o) {
           @$pobierzNewsy->newsy_daty['time'][$key] = $o;
       }
 
       
foreach($pobierzNewsy->newsy_tytuly as $key => $n) {
  
    if (isset($pobierzNewsy->newsy_daty[$key])) {
    ?>
        <!-- data-aos="fade-up" -->
<div class="object" >
                <div class="date"> <span class="material-icons">
add_alert
</span> </div>
                <div class="circle"></div>
                <div class="context">
                    <?php
 
   
                    ?>
                    
                    <div><?php echo $pobierzNewsy->newsy_daty[$key]; ?></div>
                    <h2>
                        <a href="https://www.eog.gov.pl<?php echo $pobierzNewsy->newsy_linki[$key]?>" target="_blank">
                        <?php  echo $n; ?>
                    </a>
                    </h2>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi doloribus ad neque laudantium
                        sequi
                        atque officiis quaerat iusto impedit saepe tempora inventore, unde dolore sit aut velit quia
                        adipisci
                        nam.
                    </p>
                </div>
            </div>
    <?php
    }
}
// echo crawlerUrl("https://www.eog.gov.pl/umbraco/surface/FiltersSurface/getPartialLista?id=235520&hashUrl=domyslne%3D1&typeOfDate=Data+ostatniej+publikacji&partialName=MIRListaFiltrowana&ctResultPagesAlias=MIRWiadomosc%2CMIRNaboryWnioskow%2CMIRWydarzenie%2CMIRKonferencjeSzkolenia&lang=pl");
?>
        </div>
        
    </section>
        <div class="logo" style="position: fixed;right: 0;width: 12%;bottom: 0;z-index: 99;">
        <img src="https://lh3.googleusercontent.com/proxy/DzZv2-bvgcz2TUh3pZcVTZ0eViSLbAY0P3jTf6B4RjIkQs1phfHIRZFtHnr6KQQoxhB0Xa-gWa8YLZABJhMZSNcGHw"
            style="max-width: 100%;">
    </div>
<!-- <footer>
            <img src="http://zscku.pl/images/logo_zscku.svg">
        </footer> -->
</body>

</html>

 