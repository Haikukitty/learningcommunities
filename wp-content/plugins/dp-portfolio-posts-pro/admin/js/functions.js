// JavaScript Document
/*jQuery.selectCategories = function selectCategories(){
	alert('Here...');
	
}*/

jQuery(document).ready(function() {
    jQuery('.et_dp_post_type').live('click', function() {
		if (jQuery(this).is(':checked')) {
            //alert('checked');
			jQuery('.et_dp_'+jQuery(this).val()).attr("checked" , true);
        }
		else
			jQuery('.et_dp_'+jQuery(this).val()).attr("checked" , false);
    });

});