<?php
//Imagem do post
function the_image($id=null, $style=null, $class=null){
if(!is_array($id)){
global $postQueryObject;
$image = $postQueryObject->post_image;

if($image != "0"){
	$image2 = np_one(NP."files", "file_name", "$image");
	echo "<img class='{$class}' style='{$style}' src='".NP_URL."/content/uploads/{$image2}' />";
}else{
	echo "<img class='{$class}' style='{$style}' src='".NP_URL."/uploads/system/post.jpg'/>";
}
  }else{
	 $image = $id['post_image'];
	 if($image != "0"){
	 $image2 = np_one(NP."files", "file_name", "$image");
	 echo "<img class='{$class}' style='{$style}' src='".NP_URL."/content/uploads/{$image2}' />";
}else{
	echo "<img class='{$class}' style='{$style}' src='".NP_URL."/content/uploads/system/post.jpg'/>";
 }
   }
     }

?>