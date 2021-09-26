jQuery(document).ready(function ($) {
	$('#home_submit_button').click(function() {
		if ($("#tn-form").valid()) {
			var file_data = $('#photo')[0].files[0];
			var form_data = new FormData();
			form_data.append('action', 't311_submissions');           
		    form_data.append('file', $('#photo')[0].files[0]);
		    form_data.append('fname', $('input[name="fname"]').val() );
		    form_data.append('lname', $('input[name="lname"]').val() );
			form_data.append('email', $('input[name="email"]').val() );
			form_data.append('story', $('textarea[name="story"]').val() );
			form_data.append('storytile', $('textarea[name="storytile"]').val() );
			form_data.append('checkbox', $('input[name="checkbox"]').val() );
			form_data.append('topic', $('input[name="topic"]').val() );
			form_data.append('phonenumber', $('input[name="phonenumber"]').val() );
			form_data.append('radio', $('input[name="radio"]').val() );
			form_data.append('radios', $('input[name="radios"]').val() );
			form_data.append('zipcode', $('input[name="zipcode"]').val() );
			form_data.append('tags', $('input[name="tags"]').val() );
	        
		    jQuery.ajax({
		        type: 'POST',
		        url: admin_ajax_url,
		        data: form_data, 
		        processData: false,
		        contentType: false,
		        success: function(data, textStatus, XMLHttpRequest) {
		            console.log(data);
		        },
		        error: function(MLHttpRequest, textStatus, errorThrown) {
		            console.log(errorThrown);
		        }

		    });
		}
    })

	if ($("#tn-form").length > 0) {
	    $("#tn-form").validate({
	    	rules: {
	    		email: {
	    			required: true,
	    			email: true
	    		},
	    		fname: "required",
	    		lname: "required",
	    		story: "required",
	    		storytile: "required",
	    		checkbox: "required"
	    	},
	    	messages: {
	    		email: "Please enter a valid email address",
	    		fname: "Please enter your firstname",
	    		lname: "Please enter your lastname",
	    		story: "Please enter your story",
	    		storytile: "Please enter title your story",
	    		checkbox: "Please check",
	    	},
	    });
	}

	$(document).on("click","span.filter-tag",function(e){
		let tag_filter = $(this).attr('filter'); console.log(tag_filter)
		$(".single_news_popup").fadeOut();
		$("body").removeClass("no_scroll");
		$('.single_story_holder').hide();
		var checkcout = 0;
		$('.single_story_holder').each(function() { 
			if ($(this).attr('tag')!=='' && $(this).attr('tag').includes(tag_filter)) {
				checkcout++;
				$(this).show();
			}
		})
	});
})