<?php
global $post;
$layout_type = get_field("layout_type");
if($layout_type=="page"){
	get_template_part("page");
}
else{
	get_template_part("single");
}