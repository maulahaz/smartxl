<script type="text/javascript">
	//----------Select Form action from dropdown
	$('#btnPrintPDF').on('click', function(e){
		e.preventDefault();
		$.ajax({
	        url: myBaseURL+'cdo/make_pdf',
	        type: 'POST',
	        data: {
	            month: month
	        },
	        return false;
	    });
	}); 

</script>