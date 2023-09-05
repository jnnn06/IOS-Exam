<?php ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Navigations</h1>
    <div id="displayDiv"></div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(function(){
    $.ajax({
        type: 'POST',
        url: 'getNavigation.php',
        data: {},
        dataType: 'json',
        success: function(response) {
            // generate the navigation set/list to id displayDiv element
            data = response;
            var navigationBuild = buildNavigation(data);
            $('#displayDiv').html(navigationBuild);
        }
    });

    // build navigation
    function buildNavigation(data) {
        var navigation = '<ul>';
        for (var id in data) {
            var item = data[id];
            navigation += '<li>' + item.label;
            if (!$.isEmptyObject(item.subs)) {
                navigation += buildNavigation(item.subs);
            }
            navigation += '</li>';
        }
        navigation += '</ul>';

        return navigation;
    }
});
</script>

