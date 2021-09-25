jQuery(document).ready(function ($) {
	$('#home_submit_button').click(function() {
        var data = {
        	'fname': $('input[name="fname"]').val(),
			'lname': $('input[name="lname"]').val(), 
			'email': $('input[name="email"]').val(), 
			'story': $('textarea[name="story"]').val(), 
			'storytile': $('textarea[name="storytile"]').val(), 
			'checkbox': $('input[name="checkbox"]').val(), 
			'topic': $('input[name="topic"]').val(), 
			'phonenumber': $('input[name="phonenumber"]').val(),
			'radio': $('input[name="radio"]').val(), 
			'radios': $('input[name="radios"]').val(), 
			'zipcode': $('input[name="zipcode"]').val(),
			'base64_img': $('input[name="base64_img"]').val(),
			'tags': $('input[name="tags"]').val(),
            'action': 't311_submissions'
        };
        console.log(data);
        $.ajax({
            url: admin_ajax_url,
            type: 'POST',
            data: data,             
            success: function(response) {
        		console.log(response);
            }
        })
    })
})