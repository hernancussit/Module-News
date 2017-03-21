<h2><?php echo get_lang('check_permissions');?></h2>

<a href="home.php?m=news&p=admin_news" style="margin-top:17px" class="btn btn-default pull-right"><?php echo get_lang('go_back');?></a>
<br/>

<?php

// Permissions check

// Check if the file "modules/news/config.php" is writable
$value = 'modules/news/config.php';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}
// Check if the folder "modules/news/data/" is writable
$value = 'modules/news/data/';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}
// Check if the file "modules/news/data/listings.xml" is writable
$value = 'modules/news/data/listings.xml';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}
// Check if the folder "modules/news/uploads" is writable
$value = 'modules/news/uploads';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}
// Check if the folder "modules/news/uploaded_images" is writable
$value = 'modules/news/uploaded_images';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}
// Check if the folder "modules/news/thumbnails" is writable
$value = 'modules/news/thumbnails';
if ( !is_writable($value) ) {
	echo "<h3>".$value." : <span class='failure'>".get_lang('write_permission_required')."</span></h3>";
	$failed = true;
}
else {
	echo "<h3>".$value." : <span class='success'>".get_lang('OK')."</span></h3>";
}

if ( $failed ) {
	echo "<br /><br /><h3>".get_lang('fix_permission')."</h3><p><a href='?m=news&p=admin_news&page=permissions'>".get_lang('refresh')."</a></p>";
} else {
	echo "<br /><br /><h3>".get_lang('OK_permission')."</h3>";
}

?>