<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>YouTube Playlist Download</title>
<!--    <script src="class/jquery.min.js"></script>-->
<!--    <script type="text/javascript">-->
<!--        $(function(){-->
<!--            $('#submitjson').click(function(){-->
<!--                var q = $('#qjson').val();-->
<!--                $.get(-->
<!--                    "downloadjson.php",-->
<!--                    { q: q },-->
<!--                    function(data) {-->
<!--                        var parsedJson = $.parseJSON(data);-->
<!--                        console.log(parsedJson)-->
<!--                        $('#showTitle').html(parsedJson);-->
<!--                        Single File-->
<!--                        $('#showTitle').html(parsedJson.info.title);-->
<!--                        $('#showThumbnail').html(parsedJson.info.thumbnail);-->
<!--                        $('#showTime').html(parsedJson.info.time);-->
<!--                        $('#showFileName').html(parsedJson.info.filename);-->
<!--                        Loop File-->
<!--                        $.each(data, function (index, value) {-->
<!--                            var parsedJson = $.parseJSON(value);-->
<!--                            console.log(parsedJson.info.title);-->
<!--                        });-->
<!--                    }-->
<!--                );-->
<!--            });-->
<!--        });-->
<!--    </script>-->
</head>
<body>
<hr>
<form method="get" action="download.php">
    <div>
        Youtube URL: <input type="search" id="q" name="q" placeholder="URL">
    </div>
    <input type="submit" id="submit" value="Fetch">
</form>
<!--<hr><br>-->
<!--<div>-->
<!--    Youtube URL: <input type="search" id="qjson" name="q" placeholder="URL">-->
<!--</div>-->
<!--<input type="submit" id="submitjson" value="Fetch">-->
<!--<hr><br>-->
<!--<div id="showTitle"></div>-->
<!--<div id="showThumbnail"></div>-->
<!--<div id="showTime"></div>-->
<!--<div id="showFileName"></div>-->

</body>
</html>
