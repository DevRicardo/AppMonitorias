<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
	<ul class="nav navbar-nav">
		<li><a href="{{ url(config('laraadmin.adminRoute')) }}">Dashboard</a></li>

		@role("MONITOR")
			@include('la.layouts.partials.menu_roles.menu_monitor')
		@endrole

	
	</ul>

</div><!-- /.navbar-collapse -->

