<a href="#" onclick="mymodal();" class="button">Modal</a>

	<div class="tiny reveal" id="exampleModal1" data-reveal>
    	<div class="row">
		    <div class="large-12 columns auth-plain">
		    <h3>Oops!</h3>
		      <div class="signup-panel left-solid text-center">
		         <h3>Please contact us.</h3>
		         <h5><u><a href="http://abcprintf.com/" target="_blank">abcprintf.com</a></u></h5>
		      </div>
		    </div>
		    </div>
    	<button class="close-button" data-close aria-label="Close modal" type="button">
    		<span aria-hidden="true">&times;</span>
    	</button>
    </div>

<script>
	function mymodal(){
		$.ajax("remote.php").done(function(data) {
			$("#exampleModal1").html(data).foundation("open");
		});
	}
</script>