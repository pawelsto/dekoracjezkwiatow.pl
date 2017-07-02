<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kwiaciarnia Gardenia - Urszula Brzoza</title>
  <link rel="stylesheet" href="css/app.css?v=3"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png?v=1">
  <link rel="icon" type="image/png" href="favicon-32x32.png?v=1" sizes="32x32">
  <link rel="icon" type="image/png" href="favicon-16x16.png?v=1" sizes="16x16">
  <link rel="manifest" href="manifest.json?v=1">
  <link rel="mask-icon" href="safari-pinned-tab.svg?v=1" color="#7d6161">
  <link rel="shortcut icon" href="favicon.ico?v=1">
  <meta name="theme-color" content="#ffffff">

  <script src="https://use.typekit.net/lgm5nxq.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>

<body>
<div class="head-1 font-m">
  <div class="logo italic">
    <div class="border">
      <div class="company green">Kwiaciarnia Gardenia</div>
      <div class="name">Urszula Brzoza</div>
    </div>
  </div>
  <div class="phone">tel. 504 275 335</div>
  <div class="mail green">kontakt@dekoracjezkwiatow.pl</div>
</div>
<div class="slideshow">
  <img src="img/slides/slide00_1920x200.jpg"/>
</div>
<div class="gallery">
  <div class="container">
      <?php
      require '../vendor/autoload.php';
      $params = parse_ini_file("./conf/params.ini");
      $gallery_names = array(
              377024756031567 => "Kompozycje żywe",
              377025309364845 => "Kompozycje sztuczne",
              377023606031682 => "Florystyka funeralna",
              377023452698364 => "Dekoracje stołów",
              377388322661877 => "Ślubne",
              377022596031783 => "Dekoracje kościołów",
              377023319365044 => "Samochody",
              377024479364928 => "Stroiki świąteczne"
      );

      $album_id = htmlspecialchars($_GET["album_id"]);

      echo '<div class="font-l italic title">'.$gallery_names[$album_id].'</div>';
      echo '<div class="images">';

      $fb = new \Facebook\Facebook([
          'app_id' => $params['app_id'],
          'app_secret' => $params['app_secret'],
          'default_graph_version' => 'v2.9',
          'default_access_token' => $params['app_token']
      ]);

      try {
          $response = $fb->get('/'.$album_id.'/photos?fields=name,images');
      } catch(\Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Wystąpił problem z załadowaniem zdjęć, proszę spróbuj później.';
          exit;
      } catch(\Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Wystąpił problem z załadowaniem zdjęć, proszę spróbuj później.';
          exit;
      }

      $photos = $response->getGraphEdge();
      do {
        foreach ($photos as $photo) {
            $largePhoto = $photo->getField("images")[0]["source"];
            $smallPhoto = $photo->getField("images")[7]["source"];
            echo '<a href="'.$largePhoto.'" data-lightbox="$album_id"><img src="'.$smallPhoto.'"/></a>';
        }
      } while ($photos = $fb->next($photos));

      echo '</div>';
      ?>
    <a href="index.html" class="back font-m">❮ Powrót</a>
  </div>
</div>
<div id="kontakt" class="contact">
  <div class="address">
    <div class="mail green border font-m">kontakt@dekoracjezkwiatow.pl</div>
    <div class="phone-mobile border font-l">tel. 504 275 335</div>
    <div class="phone-home font-l">tel. 41 30 17 017</div>

    <div class="font-m">
      <div class="company-name">FHU Gardenia</div>
      <div class="company-address">Urszula Brzoza</div>

      <div>Brzeziny, <br/>ul. Chęcińska 176A</div>
      <div class="company-alias">(Delikatesy Centrum)</div>
    </div>
  </div>
  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10095.423724280266!2d20.59386!3d50.759705!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8c102220e7c6c567!2sDelikatesy+Centrum!5e0!3m2!1spl!2spl!4v1492107498754" width="320" height="240" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js"></script>
</body>
</html>
