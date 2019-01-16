<?php
    include "class/YTDownloader.php";
    if(isset($_GET['q'])){
        $yt = new YTDownloader();
        $youtube_id = $yt->extractId($_GET['q']);
        $url = 'https://video.genyoutube.net/'.$youtube_id;
        $links = $yt->getDownloadLinks($youtube_id);
        //var_dump($links);
        for($i=0;$i<count($links['dl']);$i++){
            $title = $links['info']['Title'];
            $type = $links['dl'][$i]['type'];
            $url = $links['dl'][$i]['url'];
            $itag = $links['dl'][$i]['itag'];
            $format = $yt->getItag($itag);
            if($i == 0){
                echo '<img src="'.$links['info']['Thumbnail'].'" width="20%"><br>';
                echo $links['info']['Title'].' ('.gmdate("i:s", $links['info']['Duration']).' นาที)<br>';
            }
            $videoFileName = strtolower(str_replace(' ', '_', $title)).$format;
            $fileName = $yt->clean_name(preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName)));
            echo ' <a href="'.$url.'?title='.$fileName.'" download="'.$fileName.'">'.$type.'</a> || ';
        }
    }
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>YouTube Download</title>
</head>
<body>
<hr>
    <form method="GET">
        <div>
            Youtube URL: <input type="search" id="q" name="q" placeholder="URL">
        </div>
        <input type="submit" value="Fetch">
    </form>
<hr>
</body>
</html>
