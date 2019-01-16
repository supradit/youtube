<?php
//echo phpinfo();
?>
<?php
$youtubeUrl =  "https://www.youtube.com/watch?v=Ko2JcxecV2E";
$content = json_encode ($file = shell_exec("youtube-dl.exe $youtubeUrl "));
$input_string =$content;
$regex_pattern = "/Destination:(.*.mp4)/";
$boolean = preg_match($regex_pattern, $input_string, $matches_out);
$extracted_string=$matches_out[0];
$file =explode(': ',$extracted_string,2)[1];

// Quick check to verify that the file exists
if( !file_exists($file) ) die("File not found");
// Force the download
header("Content-Disposition: attachment; filename=\"$file\"" );
header("Content-Length: " . filesize($file));
header("Content-Type: application/octet-stream;");

readfile($file);
?>
