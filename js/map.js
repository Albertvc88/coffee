(function($){
	"use strict";
    function myMap() {
        var infowindow = new google.maps.InfoWindow({
            content:"1234 Whimsy Lane <br> Stamp City NY 8878 <br> United States <br> Chalfont, PA 18814"
        });
        var mapProp = {
            center:new google.maps.LatLng(41.6556891,-0.8775525),
            zoom:15,
            scrollwheel: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var place = new google.maps.LatLng(41.6556891,-0.8775525);
        var marker = new google.maps.Marker({
            position: place,
            title: "Cafe Gourmet",
            map: map,   
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }	
	$().ready(function(){
		myMap();
	});
})(jQuery);