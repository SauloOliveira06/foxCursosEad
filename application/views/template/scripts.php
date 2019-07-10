
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo base_url(); ?>public/js/jquery-3.2.1.min.js"></script>

	<script src="<?php echo base_url(); ?>public/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/stellar.js"></script>
	<!--<script src="<?php //echo base_url(); ?>public/js/countdown.js"></script> -->
	<script src="<?php echo base_url(); ?>public/vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="<?php echo base_url(); ?>public/vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/owl-carousel-thumb.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo base_url(); ?>public/vendors/counter-up/jquery.counterup.js"></script>
	<script src="<?php echo base_url(); ?>public/js/mail-script.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="<?php echo base_url(); ?>public/js/gmaps.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/theme.js"></script>

	<?php if(isset($scripts)){
		foreach ($scripts as $script_name){
			$src = base_url() . "public/js/" . $script_name; ?>
			<script src="<?=$src?>"> </script>
		<?php }
	} ?>

</body>

</html>