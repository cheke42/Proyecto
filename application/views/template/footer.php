<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/select2-es.js'); ?>"></script>
<script>
	$('select').select2();
	$(document).ready(function(){
    $('#tabladt').DataTable();

});
</script>
</body>
</html>