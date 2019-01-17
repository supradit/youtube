<?php
include "class/YTDownloader.php";

//set_time_limit(0); //ตั้งให้ไม่มี time limit รันไปจนกว่าจะจบ
//ignore_user_abort(1); //สั่งให้รันต่อแม้ว่าจะปิด Browser ไปแล้วก็ตาม
//error_reporting(0); //to Hide All Errors:
//ini_set('display_errors', 1); //to Hide All Errors:
//error_reporting(E_ALL); //to Show All Errors:
//ini_set('display_errors', 1); //to Show All Errors:

if($_GET['q'] == ""){
    echo 'ไม่มีข้อมูล กรุณาติดต่อ ...';
}
else{
    $url = parse_url($_GET['q']);
    parse_str($url['query'], $q);
    $playlistId = $q['list'];

    $yt = new YTDownloader();
    if($playlistId == ""){
        $youtube_id = $yt->extractId($_GET['q']);
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
            echo ' <a href="'.$url.'?title='.$fileName.'" download="'.$fileName.'">'.$type.'</a>';
            if($i != count($links['dl'])-1){
                echo ' || ';
            }
        }
    }
    else{
        $url = parse_url($_GET['q']);
        parse_str($url['query'], $q);
        $playlistId = $q['list'];
        //Get Youtube's Json
        $pagination = "";
        $input = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $playlistId . "&key=AIzaSyBEfUHT2pTNUiAm4L_jOddo5eggAccsaWg&pageToken='.$pagination.'");
        $result = json_decode($input, true);
        $next = ceil($result['pageInfo']['totalResults'] / 5);
        for ($loop = 0; $loop < $next; $loop++) {
            $input = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $playlistId . "&key=AIzaSyBEfUHT2pTNUiAm4L_jOddo5eggAccsaWg&pageToken='.$pagination.'");
            $result = json_decode($input, true);
            $pagination = $result['nextPageToken'];
            $sum = count($result);
            $yt = new YTDownloader();
            for ($i = 0; $i < $sum; $i++) {
                $youtube_id = $result['items'][$i]['snippet']['resourceId']['videoId'];
                $links = $yt->getDownloadLinks($youtube_id);
                //var_dump($links);
                for($ii=0;$ii<count($links['dl']);$ii++){
                    $title = $links['info']['Title'];
                    $type = $links['dl'][$ii]['type'];
                    $url = $links['dl'][$ii]['url'];
                    $itag = $links['dl'][$ii]['itag'];
                    $format = $yt->getItag($itag);
                    if($ii == 0){
                        echo '<br><br><img src="'.$links['info']['Thumbnail'].'" width="5%"><br>';
                        echo $links['info']['Title'].' ('.gmdate("i:s", $links['info']['Duration']).' นาที)<br>';
                    }
                    $videoFileName = strtolower(str_replace(' ', '_', $title)).$format;
                    $fileName = $yt->clean_name(preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName)));
                    echo ' <a href="'.$url.'?title='.$fileName.'" download="'.$fileName.'">'.$type.'</a>';
                    if($ii != count($links['dl'])-1){
                        echo ' || ';
                    }
                }
            }
        }
    }
}
?>