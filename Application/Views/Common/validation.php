
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('app.css', 'components') ?>"> -->
<script src="<?php echo $view['assets']->getUrl('jquery-validation/dist/jquery.validate.min.js', 'js') ?>"></script>

<script type="text/javascript">
$.validator.setDefaults({
	errorElement: "span",
	errorClass: "help-block",
	highlight: function (element, errorClass, validClass) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	errorPlacement: function (error, element) {
		if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
			error.insertAfter(element.parent());
		} else {
			error.insertAfter(element);
		}
	}
});
</script>
