<?
$course=Course::model()->find("id = '".$model->seriesno."'");
$lessonno=($model->lessonno);
$nextlesson=$lessonno+1;
$prevlesson=$lessonno-1;
$prev= Lesson::model()->find("seriesno = '".$model->seriesno."' AND lessonno='".$prevlesson."'");
$next= Lesson::model()->find("seriesno = '".$model->seriesno."' AND lessonno='".$nextlesson."'");
$this->pageTitle=$model->title." | ".$course->title." | "."Dave Conservatoire";
$this->extraDesc="A set of listening resources called - ".$model->title.". ";
$this->extraKeywords=$model->title.", ".$course->title.", ";

?>
<h2 class="playlisttitle"><?=$model->title;?> - (<?=$course->title;?>, Part <?=$model->lessonno?>)</h2>
<table style="font-size: small">
	<tr>
		<td style="width:470px"><? if(isset($prev)){ echo "Previous Lesson:";}?> <a href="/lesson/<?=$prev->urltitle;?>"><?=$prev->title;?></a></td>
		<td style="width:470px; text-align: right"><? if(isset($next)){ echo "Next Lesson:";}?> <a href="/lesson/<?=$next->urltitle;?>"><?=$next->title;?></a></td>
	</tr>
</table>
<noscript>
	<div>
        <p>Unfortunately your browser does not hava JavaScript capabilities which are required to exploit full functionality of our site. This could be the result of two possible scenarios:</p>
        <ol>
            <li>You are using an old web browser, in which case you should upgrade it to a newer version. We recommend the latest version of <a href="http://www.getfirefox.com">Firefox</a>.</li>
            <li>You have disabled JavaScript in you browser, in which case you will have to enable it to properly use our site. <a href="http://www.google.com/support/bin/answer.py?answer=23852">Learn how to enable JavaScript</a>.</li>
        </ol>
    </div>
</noscript>
  
 <div style="margin: 10px auto; display: block; text-align: center">
<div id="player" >Loading…</div>

</div>


 
  
<div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="coda-slider-1">
	
<? $playlistitems= PlaylistItem::model()->findAll("relid = '".$model->id."' ORDER BY sort");

foreach($playlistitems as $playlistitem):
?>
	 	<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title"><?=$playlistitem->title;?></h2>
				<p><?=$playlistitem->text;?> </p>
				<p>&nbsp;</p>
				<p><small>Credit: <a href="http://www.youtube.com/<?=$playlistitem->credit;?>" target="_blank"><?=$playlistitem->credit;?></a></small></p>
			</div>
		</div>
<?	 
endforeach;
?> 	 

		 
	 	</div><!-- .coda-slider -->
	 	<div style="clear:both"></div>
	 	
	 		<!-- Begin Slider JavaScript -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/style/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/style/js/jquery.coda-slider-2.0.js"></script>
		 <script type="text/javascript">
			$().ready(function() {
				$('#coda-slider-1').codaSlider();
			});
		 </script>
	<!-- End Slider JavaScript -->
	
		        <script type="text/javascript">
    
      var tag = document.createElement('script');
      tag.src = "http://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: myVids[1],
          playerVars: { 'autoplay': 1, 'showinfo': 0, 'rel': 0 },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

    
    var myVids=["empty" <? foreach ($playlistitems as $playlistitem){ echo ', "'.$playlistitem->youtubeid.'"';}?>];
      /*
       * Change out the video that is playing
       */
      
      // Update a particular HTML element with a new value

      // Loads the selected video into the player.
      function loadVideo(videoID) {
        
        if(player) {
          player.loadVideoById(videoID);
        }
      }
      
      // This function is called when an error is thrown by the player
      function onPlayerError(errorCode) {
       
      }
      
        function onPlayerStateChange(event){
        if (event.data==YT.PlayerState.ENDED){
        
        $('#coda-nav-right-1 a').trigger('click');
        
        }
         }
      
      // This function is automatically called by the player once it loads
      function onPlayerReady(playerId) {
        ytplayer = document.getElementById("ytPlayer");
        ytplayer.addEventListener("onError", "onPlayerError");
        ytplayer.addEventListener("onStateChange", "onChange");
      }
      
    </script>
    
    


