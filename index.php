<?php
        function readFolderContent( $folder )
        {
            $folder = rtrim( $folder, DIRECTORY_SEPARATOR );

            if ( !is_dir( $folder ) )
            {
                throw new Exception( 'This is not a directory: ' . $folder );
            }

            $directoryHandle = opendir( $folder );

            if ( !$directoryHandle )
            {
                throw new Exception( 'Cannot open directory: ' . $folder );
            }

            $availableFiles = array();

            while ( ( $file = readdir( $directoryHandle ) ) !== false )
            {
                if ( $file != '.' && $file != '..' )
                {
                    $file = $folder . DIRECTORY_SEPARATOR . $file;

                    $availableFiles[] = $file;
                }
            }

            closedir( $directoryHandle );

            return $availableFiles;
        }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sprite Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="build/css/stitches-0.5.18-min.css">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="build/js/modernizr-2.0.6.min.js"></script>

    <script src="src/stitches.js"></script>
    <script src="src/file.js"></script>
    <script src="src/icons.js"></script>
    <script src="src/icon.js"></script>
    <script src="src/tmpl.js"></script>
    <script src="src/page.js"></script>

    <script>
      var serverImages = []
      <?php
        $folder ="your-folder";
        $files_array = readFolderContent($folder);
        for($i = 0; $i < count($files_array); ++$i) {
            $file_name = "lalal";
            $imagedata = file_get_contents( $files_array[$i] );
            $base64 = base64_encode( $imagedata );
            $src = 'data:image/png;base64,' . $base64;
      ?>
            var base64blob = "<?php echo $base64; ?>"
            var src = 'data:image/png;base64,'+ base64blob;
            var imageData = {
              "name" : "<?php echo $file_name; ?>",
              "src"  : src
            }
            serverImages.push(imageData);

      <?php
        }
      ?>
    </script>

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Spriter</a>
          <!--
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
            </ul>
          </div>--><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div id="serverImages" style="display: none;">
      </div>
      <h1>Spriter</h1>
      <p>Arrastra todos los iconos que quieras incluir en el sprite</p>
      <p>
      <a href="http://www.w3.org/html/logo/">
        <img height="50" title="HTML5 Powered with CSS3 / Styling, Graphics, 3D & Effects, Semantics, and Offline & Storage" alt="HTML5 Powered with CSS3 / Styling, Graphics, 3D & Effects, Semantics, and Offline & Storage" src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-graphics-semantics-storage.png">
      </a>
      </p>
      <div id="stitches"></div>

      <script>
      jQuery(document).ready(function ($) {

          var $stitches = $("#stitches");
          var config = {
              jsdir: "build/js"
              ,prefix: "lbicon"
              ,serverImages: serverImages
            }
          Stitches.init($stitches, config);

      });
      </script>

      <h3>Acerca de Spriter</h3>
      <p>Spriter es un fork de este proyecto <a href="https://github.com/draeton/stitches">https://github.com/draeton/stitches</a></p>
      <p>Mediante HTML5 Canvas y javascript genera en el navegador un sprite en <a href="http://en.wikipedia.org/wiki/Data_URI_scheme">base 64</a> y su css correspondiente.</p>
      <p>Este fork esta modificado para cubrir mis necesidades concretas.</p>
    </div> <!-- /container -->

  </body>
</html>
