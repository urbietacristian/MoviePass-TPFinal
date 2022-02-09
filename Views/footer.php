</div>
<footer> 
    <div class="center">
		<h6 class="heading">MoviePass</h6> 
		<nav>
			<ul class="nospace inline pushright uppercase">
				<a href="<?php echo $_SESSION['home']; ?>">Home</a>
                <a href="<?php echo FRONT_ROOT; ?>Movie/showPolitica">Politica privacidad</a>
			</ul>
		</nav>
	</div>
	<div class="wrapper row5">
		<div id="copyright" class="hoc clear"> 
			<p align="center">Copyright &copy; <?php echo date('Y'); ?> - MoviePass - UTN</p>
		</div>
	</div>
</footer>
<button onclick="topFunction()" id="top" title="Go to top">Top</button>

<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="<?php echo JS_PATH ?>jquery.min.js"></script>
<script src="<?php echo JS_PATH ?>jquery.backtotop.js"></script>
<!-- <script src="<?php echo JS_PATH ?>jquery.mobilemenu.js"></script> -->