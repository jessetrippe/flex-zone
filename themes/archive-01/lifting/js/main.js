jQuery(document).ready(function ($) {
    "use strict";

    $(".comment-form").ajaxForm(function () {
        // Callback message or action here.
    });

    $(".comment-respond").each(function () {
        jQuery(this).addClass("is-hidden");
        var setOptionsContainer = jQuery(this).prev(".js-set-options-container");
        var currentWeightSet = setOptionsContainer.text().trim();
        var fullString = currentWeightSet.split("×");
        var unit = [
            "sets",
            "reps",
            "weight"
        ];

        $(this).find("input[name='comment']").attr("value", currentWeightSet);

        $.each(fullString, function (index, value) {

            if (isNaN(value) || value > 300) {
                value = 0;
            }

            setOptionsContainer.find("button").first().clone().appendTo(setOptionsContainer).addClass("js-" + unit[index] + "-trigger").find(".js-unit").html(unit[index]).next(".js-value").html(value);
        });
        setOptionsContainer.find("button").first().remove();
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

jQuery(document).on("click", ".exercises > [data-toggle='modal']", function () {
    "use strict";

    var targetOverlay = jQuery(jQuery(this).data("target"));
    targetOverlay.one("animationend", function (e) {
        targetOverlay.find("video").get(0).play();
    });
});

jQuery(document).on("click", ".exercises .overlay [data-dismiss='modal']", function () {
    "use strict";

    jQuery(this).closest(".exercises").find("video").get(0).pause();
});

jQuery(document).on("click", ".js-set-options-container button", function () {
    "use strict";

    var currentSet = jQuery(this).find(".js-value").text();
    var setOptionsOverlay = jQuery(this).closest(".exercises").find("[id^='actionsheet-']");
    var setOptionsList = setOptionsOverlay.find(".js-set-options-list-1");

    setOptionsOverlay.removeClass("is-hidden").addClass("is-shown");
    setOptionsList.html("");

    if (jQuery(this).hasClass("js-weight-trigger")) {
        var weightAmount = jQuery(this).find(".js-value").text();
        var item = 0;

        while (item < 30) {

            jQuery(this).closest("button").clone().removeAttr("data-toggle").removeAttr("data-target").attr("data-dismiss", "actionsheet").appendTo(setOptionsList).removeClass("is-set").find(".js-value").html(item);
            item = parseFloat(item) + parseFloat(2.5);
        }

        while (item < 300) {
            jQuery(this).closest("button").clone().removeAttr("data-toggle").removeAttr("data-target").attr("data-dismiss", "actionsheet").appendTo(setOptionsList).removeClass("is-set").find(".js-value").html(item);
            item = parseFloat(item) + parseFloat(5);
        }

        setOptionsList.find(".js-value:contains(" + weightAmount + ")").filter(function () {
            return jQuery(this).text() === weightAmount;
        }).closest("button").addClass("is-set");

    } else {

        jQuery(this).clone().removeAttr("data-toggle").removeAttr("data-target").attr("data-dismiss", "actionsheet").appendTo(setOptionsList).addClass("is-set");

        var i = 0;
        for (i = currentSet - 1; i > 0; i -= 1) {
            jQuery(this).closest("button").clone().removeAttr("data-toggle").removeAttr("data-target").attr("data-dismiss", "actionsheet").prependTo(setOptionsList).removeClass("is-set").find(".js-value").html(i);
        }
        currentSet++;
        for (i = currentSet; i < 21; i += 1) {
            jQuery(this).closest("button").clone().removeAttr("data-toggle").removeAttr("data-target").attr("data-dismiss", "actionsheet").appendTo(setOptionsList).removeClass("is-set").find(".js-value").html(i);
        }
    }

    setOptionsList.find(".js-unit").remove();
    setOptionsList.find(".js-value").addClass("mx-auto");
});

jQuery(document).on("click", ".js-set-options-list-1 button", function () {
    "use strict";

    var setOptionsContainer = jQuery(this).closest(".exercises").find(".js-set-options-container");

    jQuery("button.is-set").removeClass("is-set");

    var $this = jQuery(this);

    $this.addClass("is-set");

    if ($this.hasClass("js-sets-trigger")) {
        setOptionsContainer.find(".js-sets-trigger .js-value").text($this.find(".js-value").text());
    } else if ($this.hasClass("js-reps-trigger")) {
        setOptionsContainer.find(".js-reps-trigger .js-value").text($this.find(".js-value").text());
    } else if ($this.hasClass("js-weight-trigger")) {
        setOptionsContainer.find(".js-weight-trigger .js-value").text($this.find(".js-value").text());
    }

    var setSets = setOptionsContainer.find(".js-sets-trigger .js-value").text();
    var setReps = setOptionsContainer.find(".js-reps-trigger .js-value").text();
    var setWeight = setOptionsContainer.find(".js-weight-trigger .js-value").text();
    var completeSet = setSets + "×" + setReps + "×" + setWeight;

    jQuery(this).closest(".exercises").find("input[name='comment']").attr("value", completeSet);
    jQuery(this).closest(".exercises").find(".js-set-settings").html(completeSet);

    setTimeout(function () {
        jQuery(this).closest(".exercises").find("[id^='actionsheet-']").removeClass("is-shown");
        jQuery("button.is-set").removeClass("is-set");
        jQuery(".js-set-options-list").html("");
    }, 250);

    var submitData = function () {
        if (!jQuery("body").hasClass("js-is-submitting")) {
            setOptionsContainer.next(".comment-respond").find("input[type='submit']").trigger("click");
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
