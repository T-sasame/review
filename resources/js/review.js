(function($, window) {
    $(function() {
        $("#rev_title").focusout(function () {
            var title = $("#rev_title").val();
            if (title == '') {
                $("#error_title").text("タイトルを入力してください");
            } else {
                $("#error_title").text('');
            }
        });

        if (!$("input[name='genre']").is(':checked')) {
          $("#error_genre").text("ジャンルを入力してください");
        }
        $("input[name='genre']").focusout(function () {
            if ($("input[name='genre']").is(':checked')) {
                $("#error_genre").text('');
            }
        });

        if (!$("input[name='hard']").is(':checked')) {
          $("#error_hard").text("ハードを入力してください");
        }
        $("input[name='hard']").focusout(function () {
            if ($("input[name='hard']").is(':checked')) {
                $("#error_hard").text('');
            }
        });

        $("#rev_score").focusout(function () {
            var score = $("#rev_score").val();
            if (score == '') {
                $("#error_score").text("半角数字の0~100で入力してください");
            } else {
                $("#error_score").text('');
            }
        });

        $("#rev_review").focusout(function () {
            var review = $("#rev_review").val();
            if (review == '') {
                $("#error_review").text("レビューを入力してください");
            } else {
                $("#error_review").text('');
            }
        });
    });
})(jQuery, window);
