<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
</head>
<body>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
			<link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css" type="text/css" />
  			<link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap-datetimepicker.min.css" type="text/css" />
  			<script src="<?php echo base_url(); ?>/public/js/bootstrap.js"/></script>
			<script src="<?php echo base_url(); ?>/public/js/bootstrap-datetimepicker.min.js"></script>
			<div class="well">
			  <div id="datetimepicker1" class="input-append date">
			    <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
			    <span class="add-on">
			      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
			      </i>
			    </span>
			  </div>
			</div>
			<script type="text/javascript">
			  $(function() {
			    $('#datetimepicker1').datetimepicker({
			      language: 'pt-BR'
			    });
			  });
			</script>
</body>
</html>