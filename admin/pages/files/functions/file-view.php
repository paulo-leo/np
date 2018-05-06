<?php
include("../../../../core/conn.php");
np_libs("../../../../core/libs/");

if(isset($_GET['view-audio'])){
$id = $_GET['view-audio'];
$audio = np_obj("SELECT * FROM ".NP."files WHERE ID = {$id}");	
if($audio){
echo "<div class='card white padding' style='min-height:130px; width:300px'>
       <p>{$audio->file_title}</p>
       <audio class='center' id='audio' src='".NP_URL."/{$audio->file_url}' preload='auto' autoplay loop>
       <p>Seu navegador não suporta o elemento audio </p>
      </audio>
	  <div>
	  <span id='view-midia-status'></span>
	  <div class='progress light-gray animate-left' id='view-midia-progress'>
      <div class='indeterminate orange'></div>
    </div>
     <button class='btn' onclick=\"document.getElementById('audio').play(); document.getElementById('view-midia-progress').style.display='block'\"><i class='material-icons'>play_arrow</i></button>
     <button class='btn' onclick=\"document.getElementById('audio').pause(); document.getElementById('view-midia-progress').style.display='none'\"><i class='material-icons'>pause</i></button>
     <button class='btn' onclick=\"document.getElementById('audio').volume+=0.1\"><i class='material-icons'>volume_up</i></button>
    <button class='btn' onclick=\"document.getElementById('audio').volume-=0.1\"><i class='material-icons'>volume_off</i></button>
    </div>
	 </div>";
	 
}

}

?>