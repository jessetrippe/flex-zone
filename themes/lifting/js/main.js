jQuery(document).ready(function ($) {
    "use strict";

    $(".comment-form").ajaxForm(function () {
        // Callback message or action here.
    });

    $(".site-main").css("border-top-width",$(".site-header").outerHeight());

    $(".comment-respond").each(function () {

        var postId = $(this).find("[id^='commentform-']").attr('id').replace(/commentform-/, '');
        var postContainer = $("[data-post-id=" + postId + "]");
        var currentWeightSet = postContainer.find(".js-set-settings").text().trim();
        var fullString = currentWeightSet.split("×");
        var unit = [
            "sets",
            "reps",
            "weight"
        ];

        postContainer.find("input[name='comment']").attr("value", currentWeightSet);

        $.each(fullString, function (index, value) {
            if (isNaN(value) || value > 300) {
                value = 0;
            }
            postContainer.find(".js-" + unit[index] + "-trigger").find(".js-value").html(value);
        });
    });
});

jQuery(document).on("click", "#overlay-backdrop", function () {
    "use strict";

    hideOverlay();
    hideActionSheet();
});

jQuery(document).on("click", "[data-dismiss]", function () {
    "use strict";

    var dismissType = "." + jQuery(this).data("dismiss");

    jQuery(this).closest(dismissType).removeClass("is-shown").one("animationend", function (e) {
        jQuery(this).addClass("is-hidden");
    });

    hideOverlay();
});

jQuery(document).on("click", "[data-toggle]", function () {
    "use strict";

    var targetOverlay = jQuery(jQuery(this).data("target"));
    targetOverlay.removeClass("is-hidden").addClass("is-shown");

    if (targetOverlay.hasClass("actionsheet")) {
        targetOverlay.before(jQuery("#overlay-backdrop").addClass("is-shown").fadeIn("fast"));
    }
});

jQuery(document).on("click", "[data-post-id] > [data-toggle='modal']", function () {
    "use strict";

    var targetOverlay = jQuery(jQuery(this).data("target"));
    targetOverlay.one("animationend", function (e) {
        targetOverlay.find("video").get(0).play();
    });
});

jQuery(document).on("click", "[data-post-id] .overlay [data-dismiss='modal']", function () {
    "use strict";

    jQuery(this).closest("[data-post-id]").find("video").get(0).pause();
});

jQuery(document).on("click", ".js-set-options-container button", function () {
    "use strict";

    jQuery(this).addClass("is-setting");
    var currentSet = jQuery(this).find(".js-value").text();
    var setOptionsOverlay = jQuery(this).closest("[data-post-id]").find("[id^='actionsheet-']");
    var setOptionsList = setOptionsOverlay.find(".js-set-options-list-1");

    setOptionsOverlay.removeClass("is-hidden").addClass("is-shown");
    setOptionsList.find("button").remove();
    setOptionsList.find(".webkit-overflow-scroll-bug").addClass("is-hidden");

    if (jQuery(this).hasClass("js-weight-trigger")) {

        var item = 0;
        while (item <= 300) {
            setOptionsList.append("<button class='p-3 w-100 border-bottom border-silver' data-dismiss='actionsheet'>" + item + "</button>");

            if (item == currentSet) {
                setOptionsList.find("button").last().addClass("is-set");
            }

            if (item < 30) {
                item = parseFloat(item) + parseFloat(2.5);
            } else {
                item = parseFloat(item) + parseFloat(5);
            }
        }
    } else {
        var item = 0;
        while (item <= 20) {
            setOptionsList.append("<button class='p-3 w-100 border-bottom border-silver' data-dismiss='actionsheet'>" + item + "</button>");

            if (item == currentSet) {
                setOptionsList.find("button").last().addClass("is-set");
            }

            item += 1;
        }
    }

    setOptionsList.scrollTop(0);
    setOptionsList.scrollTop( setOptionsList.find("button.is-set").position().top - 70);

});

jQuery(document).on("click", ".js-set-options-list-1 button", function () {
    "use strict";

    var setOptionsContainer = jQuery(this).closest("[data-post-id]").find(".js-set-options-container");
    setOptionsContainer.find("button.is-setting").removeClass("is-setting").find(".js-value").text(jQuery(this).text());

    var setSets = setOptionsContainer.find(".js-sets-trigger .js-value").text();
    var setReps = setOptionsContainer.find(".js-reps-trigger .js-value").text();
    var setWeight = setOptionsContainer.find(".js-weight-trigger .js-value").text();
    var completeSet = setSets + "×" + setReps + "×" + setWeight;

    jQuery(this).addClass("is-set").siblings(".is-set").removeClass("is-set");
    jQuery(this).closest("[data-post-id]").find("input[name='comment']").attr("value", completeSet);
    jQuery(this).closest("[data-post-id]").find(".js-set-settings").html(completeSet);

    setTimeout(function () {
        jQuery(this).closest("[data-post-id]").find("[id^='actionsheet-']").removeClass("is-shown");
        jQuery(".js-set-options-list-1 .webkit-overflow-scroll-bug").removeClass("is-hidden");
        jQuery(".js-set-options-list-1 button").remove();
    }, 250);

    var submitData = function () {
        if (!jQuery("body").hasClass("js-is-submitting")) {
            setOptionsContainer.closest("[data-post-id]").find(".comment-respond input[type='submit']").trigger("click");
            jQuery("body").addClass("js-is-submitting");
            setTimeout(function () {
                jQuery("body").removeClass("js-is-submitting");
            }, 15000);
        } else {
            setTimeout(submitData, 1000);
        }
    };

    submitData();
});

function hideActionSheet() {
    "use strict";

    jQuery(".actionsheet.is-shown").removeClass("is-shown").one("animationend", function (e) {
        jQuery(this).addClass("is-hidden");
    });
}

function hideOverlay() {
    "use strict";

    jQuery("#overlay-backdrop").fadeOut("fast", function () {
        jQuery("body").append(jQuery("#overlay-backdrop"));
    });
}
