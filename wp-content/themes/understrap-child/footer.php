<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php
echo do_shortcode('[persp-footer]');
wp_footer();
?>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <!-- Bootstrap JS -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	    <!-- Slick Slider JS -->
	    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

	    <script type="text/javascript">

		// Slider Landingpage

      $(document).ready(function(){
        $('.landingpage_slider').slick({
          slidesToShow: 1,
          autoplay: true,
          infinite: true,
          autoplaySpeed: 4000,
          arrows: false,
          fade: true,
          speed: 550
        });
      });

      // Quote Slider Landingpage

      $(document).ready(function(){
        $('.quotes_landingpage_slider').slick({
          slidesToShow: 1,
          autoplay: true,
          dots: true,
          arrows: false,
          infinite: true,
          pauseOnDotsHover: true,
          autoplaySpeed: 7000,
          speed: 600
        });
      });


      //sticky sidebar
      
      var element = ".sticky_sidebar";
      var target = 0.3; // vh / 100
      var duration = 500; // time in ms to reach target

      var posLast = 0;
      var activeInterpolation = false;
      var interpolator = null;

      HermiteInterpolator = function(data) {
        // inverse matrix multiplication
        this.coef = [ 2*data[0] - 2*data[1] + data[2] + data[3],
                -3*data[0] + 3*data[1] - 2*data[2] - data[3],
                data[2],
                data[0]];

        this.startTime = Date.now();
      };
      HermiteInterpolator.prototype.Eval = function(t) {
        return ((this.coef[0]*t + this.coef[1])*t + this.coef[2])*t + this.coef[3]; // horner's method
      };
      HermiteInterpolator.prototype.DEval = function(t) {
        return (3*this.coef[0]*t + 2*this.coef[1])*t + this.coef[2];
      };
      HermiteInterpolator.prototype.Progress = function() {
        return Math.min(1, (Date.now() - this.startTime) / duration);
      };
      HermiteInterpolator.prototype.Run = function() {
        var progress = this.Progress();
        $(element).css("top", this.Eval(progress) + $(window).height()*target);

        if (progress == 1) {
          activeInterpolation = false;
        }
        else {
          setTimeout("interpolator.Run()", 10);
        }
      };

      $(window).scroll(function() {
        if ($(window).width() < 565) {
          return;
        }

        var posCurrent = $(window).scrollTop();
        $(element).css("margin-top", -posCurrent);
        
        if (activeInterpolation) {
          var progress = interpolator.Progress();
          // stitch old and new polynomial together
          interpolator = new HermiteInterpolator([interpolator.Eval(progress), posCurrent, interpolator.DEval(progress), 0]);
        }
        else {
          activeInterpolation = true;
          interpolator = new HermiteInterpolator([posLast, posCurrent, 0, 0]);
          interpolator.Run();
        }

        posLast = posCurrent;
      });


      // Original code from http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
      // Rewritten version
      // By @mathias, @cheeaun and @jdalton

      (function(doc) {

        var addEvent = 'addEventListener',
            type = 'gesturestart',
            qsa = 'querySelectorAll',
            scales = [1, 1],
            meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

        function fix() {
          meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
          doc.removeEventListener(type, fix, true);
        }

        if ((meta = meta[meta.length - 1]) && addEvent in doc) {
          fix();
          scales = [.25, 1.6];
          doc[addEvent](type, fix, true);
        }

      }(document));


      // image resize in slider and header image 

      resize_header_image = function() {
        var parent = $('.page-header-img');
        var child = $('.page-header-img img');

        if (!parent.length || !child.length){
          return;
        }

        var img_ratio = child.width() / child.height();
        var parent_ratio = parent.width() / parent.height();

        if (parent_ratio > img_ratio) {
            child.css({
              'height': 'auto',
              'width': '100%',
              'margin-left': 0 + 'px'
            });
        }
        else {
            var margin = (child.width() - parent.width()) / 2;
            child.css({
              'height': '100%',
              'width': 'auto',
              'margin-left': -margin + 'px'
            });
        }    
      }

      // terrible ugly hack! don't show ANYBODY!
      $(document).ready(function(){resize_header_image();setTimeout("resize_header_image()", 0);});
      $(window).resize(resize_header_image);


    </script>

</body>

</html>
