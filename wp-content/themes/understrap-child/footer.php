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


        var lastPos = 0;
        var currentPos = 0;
        var element = ".sticky_sidebar";


        $(window).scroll(function() {
          lastPos = currentPos;
          currentPos = $(window).scrollTop();

          if ($(window).width() < 576) {
            $(element).css('top', 'initial');
            return;

          }

          var top = parseFloat($(element).css("top"));
          $(element)
            .stop()
            .css("top", (top - (currentPos - lastPos)).toString() + "px")
            .animate({top: "30vh"}, {duration: 300, specialEasing: {height: "easeOutExpo"}});

        });


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
