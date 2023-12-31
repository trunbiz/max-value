"use strict";
setTimeout(function(){
        (function($) {
            "use strict";
            // Single Search Select
            $(".js-example-basic-single").select2({
                placeholder: "Select Site",
                allowClear: true          
            });

            $(".selectSite").select2({
                placeholder: "Website",
                allowClear: true          
            });

            $(".chooseStatus").select2({
                placeholder: "Status",
                allowClear: true          
            });
            $(".js-example-disabled-results").select2();

            // Multi Select
            $(".js-example-basic-multiple").select2();

            // With Placeholder
            $(".js-example-placeholder-multiple").select2({
                placeholder: "Select Your Name"
            });

            //Limited Numbers
            $(".js-example-basic-multiple-limit").select2({
                maximumSelectionLength: 2
            });

            //RTL Suppoort
            $(".js-example-rtl").select2({
                dir: "rtl"
            });
            // Responsive width Search Select
            $(".js-example-basic-hide-search").select2({
                minimumResultsForSearch: Infinity
            });
            $(".js-example-disabled").select2({
                disabled: true
            });
            $(".js-programmatic-enable").on("click", function() {
                $(".js-example-disabled").prop("disabled", false);
            });
            $(".js-programmatic-disable").on("click", function() {
                $(".js-example-disabled").prop("disabled", true);
            });
        })(jQuery);
    }
    ,350);