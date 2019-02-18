$(function () {
    $("#remove").click(function () {
        var arr = [];

        $(".removeBox").each(function () {
            if ($(this).is(":checked"))
                arr.push($(this).val());
        });

        $.ajax({
            url: "remove.php",
            type: "POST",
            data: {
                id: arr
            },
            success:function(result){
                alert("Clients Removed!");
                location.reload();
            }
        });
    });


    $("#checkall").click(function () {
        $(".removeBox").each(function () {
            var box = $(this);

            if (box.is(":checked"))
                box.attr("checked", false);
            else
                box.attr("checked", true);
        });
    });
});