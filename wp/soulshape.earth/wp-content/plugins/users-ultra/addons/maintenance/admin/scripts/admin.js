jQuery(document).ready(function($) {
	
	
	
	jQuery("body").on("click", ".uultra-do-integrity-checks", function(e) {
		
		
		e.preventDefault();		
		
		doIt=confirm(mant_confirmation);
		  
		if(doIt)
		 {
		 
			
					jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: {"action": "uulra_do_integrity_checks"},
									
									success: function(data){							
																
				
										jQuery("#uultra-integritycheck-results").html(data);						
										
										
										}
								});
								
								
		}
					return false;
				});
				
		
		
		jQuery("body").on("click", ".uultra-do-transient-cleanning", function(e) {
		
		
				e.preventDefault();				
					
				jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {"action": "delete_uultra_transtient"},
									
							success: function(data){							
																
				
									jQuery("#uultra-transientcleanning-results").html(data);						
										
										
										}
							});
								
								
		
					return false;
		});
		
		jQuery("body").on("click", ".uultra-do-stats-cleanning", function(e) {
		
		
				e.preventDefault();				
					
				jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {"action": "delete_uultra_stats"},
									
							success: function(data){							
																
				
									jQuery("#uultra-stastscleanning-results").html(data);						
										
										
										}
							});
								
								
		
					return false;
		});
		
		jQuery("body").on("click", ".uultra-do-reviews-cleanning", function(e) {
		
		
				e.preventDefault();				
					
				jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {"action": "delete_uultra_reviews"},
									
							success: function(data){							
																
				
									jQuery("#uultra-reviewscleanning-results").html(data);						
										
										
										}
							});
								
								
		
					return false;
		});
				
				
	
	
	
});