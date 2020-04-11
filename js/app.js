(function($){
	"use strict";
	$().ready(function(){
		// Datepiker: Format Date Time
        $('#time-picker').datetimepicker({
            format: 'LT'
        });
        $('#date-picker').datetimepicker( {
			format: 'DD/MM/YYYY'
        });
        /*Carousel testimonials*/          
		$('#testimonial').owlCarousel({
			animateOut: 'fadeOutDown',
			animateIn: 'fadeInDown',
			items:1,
			loop:true,
			margin:10,
			//nav: true,
			autoplay:true,
			autoplayTimeout:4000,
			autoplayHoverPause:true
		});
        /*Carousel team*/ 
		$('#team-box').owlCarousel({
			loop:true,
			margin:30,
			autoplay:true,
			autoplayTimeout:2000,
			autoplayHoverPause:true,
			responsive:{
				0:{
					items:1,
				},
				769:{
					items:3,
				}
			}
		});
		//Send message, from contact form.
		$('#contact-send').validator().on('submit', function(event){
			if (event.isDefaultPrevented()){
		  	}else{
		    	event.preventDefault(); // Stop browser loading
		        var url = "php/contact.php";
		        $(".btn-submit").html("SENDING...");
		        $.ajax({
		        	type: "POST",
		        	url: url,
		        	data: $(this).serialize(),
		        	success: function (data){
		        		var messageAlert = 'alert-' + data.info.type;
	                    var messageText = data.info.message;
	                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
	                    if(data.info.type == "success"){
	                    	$('#contact-send').find('.messages').html(alertBox);
	                    	$('#contact-send')[0].reset();	                    	
		                	$(".btn-submit").addClass("disabled");
	                    }else{
	                    	$('#contact-send').find('.messages').html(alertBox);
	                    }
		                $(".btn-submit").html("SUBMIT");
		            }
		        });
  			}
	    });
		//Send reservation, from reservation form.
		$('#reservation-send').validator().on('submit', function(event){
			if (event.isDefaultPrevented()){
		  	}else{
		    	event.preventDefault(); // Stop browser loading
		        var url = "php/reservation.php";
		        $(".btn-submit").html("SENDING...");
		        $.ajax({
		        	type: "POST",
		        	url: url,
		        	data: $(this).serialize(),
		        	success: function (data){
		        		var messageAlert = 'alert-' + data.info.type;
	                    var messageText = data.info.message;
	                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
	                    if(data.info.type == "success"){
	                    	$('#reservation-send').find('.messages').html(alertBox);
	                    	$('#reservation-send')[0].reset();	                    	
		                	$(".btn-submit").addClass("disabled");
	                    }else{
	                    	$('#reservation-send').find('.messages').html(alertBox);
	                    }
		                $(".btn-submit").html("SUBMIT");
		            }
		        });
  			}
	    });
		//Send subscribe, from subscribe form.
		$('#subscribe-send').on('submit', function(event){
			if (event.isDefaultPrevented()){
		  	}else{
		    	event.preventDefault(); // Stop browser loading
		        var url = "php/mailchimp.php";
		        $(".btn-submited").html("SENDING...");
		        $.ajax({
		        	type: "POST",
		        	url: url,
		        	data: $(this).serialize(),
		        	success: function (data){
		        		var messageAlert = 'alert-subscribe-' + data.info.type;
	                    var messageText = data.info.message;
	                    var alertBox = '<div class="alert ' + messageAlert + '">' + messageText + '</div>';
	                    if(data.info.type == "ok"){
	                    	$('#subscribe-send').find('.messages').html(alertBox);
	                    	$('#subscribe-send')[0].reset();	    
	                    }else{
	                    	$('#subscribe-send').find('.messages').html(alertBox);
	                    }
		                $(".btn-submited").html("SUBMIT");
		            }
		        });
  			}
	    });
	});
})(jQuery);