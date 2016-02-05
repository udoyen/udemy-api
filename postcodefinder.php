<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {}

    .marginTop {
      margin-top: 30px
    }

    #wrapper {
      background-image: url('img/background.jpeg');
      width: 100%;
      background-size: cover;
      text-align: center;
    }

    .myRow {
      padding-top: 100px;
    }

    .myFont {
      color: #ffffff;
    }

    .content h1 {
      font-size: 400%;
    }

    .greyBackground {
      background-color: darkgrey;
      padding: 20px;
      border-radius: 20px;
    }

    .content p {
      font-size: 200%;
      color: #804E36;
    }

    #fail, #fail2 {
      margin-top: 10px;
      margin-bottom: 10px;
    }

    #success {
      margin-top: 10px;
      display: none;
    }

    .marginTop {}
  </style>
  <link rel="stylesheet" href="apis/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="apis/css/main.css">

  <script src="apis/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

  <div class="container" id="wrapper">
    <div class="row myRow">
      <div class="content col-md-6 col-md-offset-3 myFont greyBackground">

        <h1 class="marginTop">Postcode Finder</h1>

        <p>Enter any address to find the postcode.</p>

        <form class="marginTop" method="get">
          <div class="form-group">
            <input class="form-control" placeholder="Eg. 63 Fake Street, Faketown" type="text" name="address" id="address">
          </div>
          <!-- <div class="form-group">
            <input class="form-control" placeholder="" type="text">
          </div> -->
          <input id="findMyPostcode" class="btn btn-success btn-lg marginTop" type="submit" value="Find My Postcode">
        </form>
        <div id="success" class="alert alert-success">Success!</div>
        <div id="fail" class="alert alert-danger">Could not find postcode for that city. Please try again!</div>
        <div id="fail2" class="alert alert-danger">Could not connect to server</div>
      </div>
    </div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
  </script>

  <script src="apis/js/vendor/bootstrap.min.js"></script>

  <script src="apis/js/main.js"></script>
  <script type="text/javascript">
    $("#wrapper").css("height", $(window).height());


    $("#findMyPostcode").click(function(event) {

      var result = 0;

      $('.alert').hide();

      event.preventDefault();

      $.ajax({
        type: "GET",
        url: "https://maps.googleapis.com/maps/api/geocode/xml?address=" + encodeURIComponent($('#address').val()) + "&key=AIzaSyCQhtuWSKzZJfAkrL8CjHbZPdKElosykMw",
        dataType: "xml",
        success: processXML,
        error: error
      });

      function error(){
        $('#fail2').fadeIn();
      }

      function processXML(xml) {
        $(xml).find("address_component").each(function() {

          if ($(this).find("type").text() == "postal_code") {

            $("#success").html("The postcode you need is: " + $(this).find('long_name').text()).fadeIn();

            var result = 1;

          }

          if (result == 0) {

            $("#fail").fadeIn();

          }

        });

      }


    });
  </script>

  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
    (function(b, o, i, l, e, r) {
      b.GoogleAnalyticsObject = l;
      b[l] || (b[l] =
        function() {
          (b[l].q = b[l].q || []).push(arguments)
        });
      b[l].l = +new Date;
      e = o.createElement(i);
      r = o.getElementsByTagName(i)[0];
      e.src = '//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
  </script>
</body>

</html>
