require('jquery');
var _browserWidth = window.innerWidth;

var aboutMap = {
    showMap: function(locations) {
        var t = locations;
        locations = t;
        var e = document.getElementById("map");
        if ("undefined" != typeof e && null != e) {
            var i, n, s = new google.maps.Map(document.getElementById("map"), {
                zoom: 3.5,
                disableDefaultUI: !0,
                draggable: !1,
                scrollwheel: !1,
                center: new google.maps.LatLng(57.220946, 13.8236),
                styles: [{
                    elementType: "geometry",
                    stylers: [{
                        color: "#f5f5f5"
                    }]
                }, {
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off"
                    }]
                }, {
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#125976"
                    }]
                }, {
                    elementType: "labels.text.stroke",
                    stylers: [{
                        color: "#f5f5f5"
                    }]
                }, {
                    featureType: "administrative.country",
                    elementType: "geometry",
                    stylers: [{
                        color: "#e5e5e5"
                    }]
                }, {
                    featureType: "landscape",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#f2f2f2"
                    }, {
                        visibility: "on"
                    }]
                }, {
                    featureType: "poi",
                    elementType: "geometry",
                    stylers: [{
                        color: "#eeeeee"
                    }]
                }, {
                    featureType: "poi",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#757575"
                    }]
                }, {
                    featureType: "poi.park",
                    elementType: "geometry",
                    stylers: [{
                        color: "#e5e5e5"
                    }]
                }, {
                    featureType: "poi.park",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#9e9e9e"
                    }]
                }, {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{
                        color: "#ffffff"
                    }, {
                        visibility: "on"
                    }]
                }, {
                    featureType: "road.highway",
                    stylers: [{
                        visibility: "on"
                    }]
                }, {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{
                        color: "#fcfcfc"
                    }, {
                        visibility: "on"
                    }]
                }, {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [{
                        color: "#c9c9c9"
                    }]
                }, {
                    featureType: "water",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#dde6e8"
                    }]
                }, {
                    featureType: "water",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#9e9e9e"
                    }]
                }]
            }),
            o = new google.maps.InfoWindow,
            r = new google.maps.LatLngBounds;
            for (n = 0; n < locations.length; n++) {
                var a = locations[n][3].toString();
                i = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[n][1], locations[n][2]),
                    label: {
                        text: a,
                        color: "white"
                    },
                    map: s,
                    icon: "/assets/images/map-pin-color.png"
                }), r.extend(i.getPosition()), google.maps.event.addListener(i, "click", function(t, e) {
                    return function() {
                        o.setContent(locations[e][0]), o.open(s, t)
                    }
                }(i, n))
            }
            // s.fitBounds(r)
        }
    },
    init: function(l) {
        null != document.getElementById("map") && this.showMap(l)
    }
};

function initPlaceholderEffect(){
  (function() {
    [].slice.call(document.querySelectorAll( 'input.input__field--style' ) ).forEach( function( inputEl ) {
      if( inputEl.value.trim() !== '' ) {
        addInputClass(inputEl);
      } else {
        removeInputClass(inputEl);
      }
      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
      inputEl.addEventListener( 'change', onInputChange );

      if (document.activeElement === inputEl) {
        addInputClass(inputEl);
      }

      hasAutofilled();
    });

    function hasAutofilled() {
      setTimeout(() => {
        if (navigator.userAgent.toLowerCase().indexOf('firefox') === -1) {
          addMultipleInputClass('input.input__field--style:-webkit-autofill');
        }
      }, 500);
    }

    function onInputFocus( ev ) {
      addInputClass(ev.target);
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        removeInputClass(ev.target);
      }
    }

    function onInputChange( ev ) {
      addMultipleInputClass('input.input__field--style');
    }

    function addMultipleInputClass( targetClass ) {
      document.querySelectorAll(targetClass).forEach((inputEl) => {
        if( inputEl.value.trim() !== '' ) {
          addInputClass(inputEl);
        }
      });
    };

    function addInputClass( inputEl ) {
      inputEl.parentNode.classList.add('input--filled');
    };

    function removeInputClass( inputEl ) {
      inputEl.parentNode.classList.remove('input--filled');
    };
  })();
}

function initFancybox(){
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
}

module.exports = {
    _browserWidth, aboutMap, initPlaceholderEffect, initFancybox
};
