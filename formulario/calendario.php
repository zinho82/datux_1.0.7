<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Datepicker - Select a Date Range</title>
	<link rel="stylesheet" href="inc/jquery-ui/jquery.ui.all.css">
	<script src="inc/jquery-1.7.1.js"></script>
	<script src="inc/jquery-ui/jquery.ui.core.js"></script>
	<script src="inc/jquery-ui/jquery.ui.widget.js"></script>
	<script src="inc/jquery-ui/jquery.ui.datepicker.js"></script>
	<script src="inc/jquery-ui/jquery.ui.datepicker-es.js"></script>
	<link rel="stylesheet" href="inc/jquery-ui/demos.css">
	<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			buttonImage: "images/calendar.gif",
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>
</head>
<body>

<div class="demo">

<label for="from">From</label>
<input type="text" id="from" name="from"/>
<label for="to">to</label>
<input type="text" id="to" name="to"/>

</div><!-- End demo -->



<div class="demo-description">
<p>Select the date range to search for.</p>
</div><!-- End demo-description -->

</body>
</html>