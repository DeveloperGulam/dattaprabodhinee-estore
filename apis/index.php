<?php
require_once "config.php";
 
$arr_list = array();
if (array_key_exists('channel', $_GET) && array_key_exists('max_result', $_GET)) {
    $channel = $_GET['channel'];
    $url = "https://www.googleapis.com/youtube/v3/search?channelId=$channel&order=date&part=snippet&type=video&maxResults=". $_GET['max_result'] ."&key=". GOOGLE_API_KEY;
    $arr_list = getYTList($url);
}
?>
<?php
if (!empty($arr_list)) {
    echo '<ul class="video-list">';
    foreach ($arr_list->items as $yt) {
        echo "<li>". $yt->snippet->title ." (". $yt->id->videoId .")</li>";
        echo '<iframe width="420" height="315"
src="https://www.youtube.com/embed/'.$yt->id->videoId.'">
</iframe>';
    }
    echo '</ul>';
 
    if (isset($arr_list->nextPageToken)) {
        echo '<input type="hidden" class="nextpagetoken" value="'. $arr_list->nextPageToken .'" />';
        echo '<div id="loadmore">Load More</div>';
    }
}
?>
<html>
    <head>
        
    </head>
    <body>
        <form method="get">
    <p><input type="text" name="channel" placeholder="Enter Channel ID" value="<?php if(array_key_exists('channel', $_GET)) echo $_GET['channel']; ?>" required></p>
    <p><input type="number" name="max_result" placeholder="Max Results" min="1" max="50" value="<?php if(array_key_exists('max_result', $_GET)) echo $_GET['max_result']; ?>" required></p>
    <p><input type="submit" value="Submit"></p>
</form>
    </body>
    <script>
var httpRequest, nextPageToken;
document.getElementById("loadmore").addEventListener('click', makeRequest);
function makeRequest() {
    httpRequest = new XMLHttpRequest();
    nextPageToken = document.querySelector('.nextpagetoken').value;
    if (!httpRequest) {
        alert('Giving up : Cannot create an XMLHTTP instance');
        return false;
    }
    httpRequest.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            var list = JSON.parse(this.responseText);
            for(var i in list) {
                if(list[i].title != undefined && list[i].id != undefined) {
                    var newElement = document.createElement('li');
                    newElement.innerHTML = '<li>'+ list[i].title +'('+ list[i].id +')</li>';
                    document.querySelector('.video-list').appendChild(newElement);
                }
            }
 
            if(list[list.length-1].nextPageToken != undefined) {
                document.querySelector('.nextpagetoken').value = list[list.length-1].nextPageToken;
            } else {
                var loadmore = document.getElementById("loadmore");
                loadmore.parentNode.removeChild(loadmore);
            }
        }
    };
    httpRequest.open('GET', 'ajax.php?channel=<?php echo $_GET['channel']; ?>&max_result=<?php echo $_GET['max_result']; ?>&nextPageToken='+nextPageToken, true);
    httpRequest.send();
}
</script>
</html>