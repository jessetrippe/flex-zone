jQuery( document ).on('turbolinks:load', function() {

    "use strict";

    jQuery(".comment-form").ajaxForm(function () {
        // Callback message or action here.
    });

    jQuery("[id^='commentform-']").each(function () {

        var postId = jQuery(this).attr('id').replace(/commentform-/, '');
        var postContainer = jQuery("#post-" + postId);
        var completeCurrentSet = jQuery("#settings-" + postId).text().trim();
        var fullString = completeCurrentSet.split("×");
        var unit = [
            "sets",
            "reps",
            "weight"
        ];

        jQuery("#comment-" + postId).attr("value", completeCurrentSet);

        jQuery.each(fullString, function (index, value) {
            if (isNaN(value) || value > 300) {
                value = 0;
            }
            jQuery("[data-settings-type='" + unit[index] + "'][data-display-value][data-post-id='" + postId + "']").html(value);
        });
    });
});

jQuery(document).on("click", "[data-dismiss]", function () {
    "use strict";

    var dismissType = "." + jQuery(this).data("dismiss");

    jQuery(this).closest(dismissType).removeClass("is-shown").one("animationend", function (e) {
        jQuery(this).addClass("is-hidden");
    });
    if (!jQuery(".modal.is-shown").length) {
        jQuery("body").css("overflow-y","visible");
    }
});

jQuery(document).on("click", "[data-toggle]", function () {
    "use strict";

    var targetOverlay = jQuery(jQuery(this).data("target"));
    targetOverlay.removeClass("is-hidden").addClass("is-shown");
    jQuery("body").css("overflow-y","hidden");
});

jQuery(document).on("click", "[id^='post-']", function () {
    "use strict";

    var postId = jQuery(this).attr('id').replace(/post-/, '');
    var targetOverlay = jQuery(jQuery(this).data("target"));
    targetOverlay.one("animationend", function (e) {
        jQuery("#video-" + postId).get(0).play();
    });
});

jQuery(document).on("click", "[id^='close-modal-']", function () {
    "use strict";

    var postId = jQuery(this).attr('id').replace(/close-modal-/, '');
    jQuery("#video-" + postId).get(0).pause();
});

jQuery(document).on("click", "[id^='settings-sets-'], [id^='settings-reps-'], [id^='settings-weight-']", function () {
    "use strict";

    var settingsType = jQuery(this).attr("data-settings-type");
    var postId = jQuery(this).attr('id').replace("settings-" + settingsType + "-", '');
    var currentSetting = jQuery("[data-settings-type='" + settingsType + "'][data-display-value][data-post-id='" + postId + "']").html();
    var setOptionsOverlay = jQuery("#modal-settings-" + postId);
    var setOptionsList = jQuery("#modal-settings-list-" + postId);

    setOptionsOverlay.removeClass("is-hidden").addClass("is-shown");
    setOptionsList.find("button").remove();
    jQuery("#overflow-scroll-bug-" + postId).addClass("is-hidden");

    if (settingsType == "weight") {

        var item = 0;
        while (item <= 300) {
            setOptionsList.append("<button class='p-3 w-100 border-bottom border-silver' id='settings-set-" + item + "' data-dismiss='modal' data-corresponding-post-id='" + postId + "' data-settings-type=" + settingsType + ">" + item + "</button>");

            if (item == currentSetting) {
                setOptionsList.find("[data-settings-type]").last().addClass("is-set");
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
            setOptionsList.append("<button class='p-3 w-100 border-bottom border-silver' id='settings-set-" + item + "' data-dismiss='modal' data-corresponding-post-id='" + postId + "' data-settings-type=" + settingsType + ">" + item + "</button>");

            if (item == currentSetting) {
                setOptionsList.find("[data-settings-type]").last().addClass("is-set");
            }

            item += 1;
        }
    }

    setOptionsList.scrollTop(0);
    setOptionsList.scrollTop( setOptionsList.find("[data-settings-type].is-set").position().top - 70);

});

jQuery(document).on("click", "[id^='settings-set-']", function () {
    "use strict";

    var postId = jQuery(this).attr("data-corresponding-post-id");
    var settingsType = jQuery(this).attr("data-settings-type");

    jQuery("[data-settings-type='" + settingsType + "'][data-display-value][data-post-id='" + postId + "']").text(jQuery(this).text());

    var setSets = jQuery("[data-settings-type='sets'][data-display-value][data-post-id='" + postId + "']").html();
    var setReps = jQuery("[data-settings-type='reps'][data-display-value][data-post-id='" + postId + "']").html();
    var setWeight = jQuery("[data-settings-type='weight'][data-display-value][data-post-id='" + postId + "']").html();
    var completeCurrentSet = setSets + "×" + setReps + "×" + setWeight;

    jQuery(this).addClass("is-set").siblings(".is-set").removeClass("is-set");
    jQuery("#comment-" + postId).attr("value", completeCurrentSet);
    jQuery("#settings-" + postId).html(completeCurrentSet);

    setTimeout(function () {
        jQuery("#modal-settings-" + postId).removeClass("is-shown");
        jQuery("#overflow-scroll-bug-" + postId).removeClass("is-hidden");
        jQuery("#modal-settings-list-" + postId).find("[id^='settings-set-']").remove();
    }, 250);

    var submitData = function () {
        if (!jQuery("body").hasClass("js-is-submitting")) {
            jQuery("#commentform-" + postId).find("input[type='submit']").trigger("click");
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
