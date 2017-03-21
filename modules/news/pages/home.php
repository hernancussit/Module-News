<?php
// News Lister
// http://www.netartmedia.net/newslister
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
// Released under the MIT license

if(!defined('IN_SCRIPT_ADMIN')) {
	echo '<h3>'.get_lang('no_access').'</h3>';
	//log shit here
}
else{

$ini_array = parse_ini_file("modules/news/config.php",true);

if(isset($_POST["proceed_delete"])&&trim($_POST["proceed_delete"])!="")
{
	if(isset($_POST["delete_listings"])&&sizeof($_POST["delete_listings"])>0)
	{
		$delete_listings=$_POST["delete_listings"];
		$xml = simplexml_load_file($this->data_file);

		$i=-1;
		$str = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
		<listings>";
		foreach($xml->children() as $child)
		{
			$i++;
			  if(in_array($i, $delete_listings)) 
			  {
					continue;
				
			  }
			  else
			  {
					$str = $str.$child->asXML();
			  }
		}
		$str = $str."
		</listings>";
		
		
		$xml->asXML("modules/news/data/listings_".time().".xml");
	
		$fh = fopen($this->data_file, 'w') or die("Error: Can't update the data  file");
		fwrite($fh, $str);
		fclose($fh);
	}
}
?>
<script>
$(function(){
	var offsetX = 20;
	var offsetY = -200;
	$('a.hover').hover(function(e){	
		var href = $(this).attr('href');
		$('<img id="largeImage" src="' + href + '" alt="image" />')
			.css({'top':e.pageY + offsetY,'left':e.pageX + offsetX})
			.appendTo('body');
	}, function(){
		$('#largeImage').remove();
	});
	$('a.hover').mousemove(function(e){
		$('#largeImage').css({'top':e.pageY + offsetY,'left':e.pageX + offsetX});
	});
	$('a.hover').click(function(e){
		e.preventDefault();
	});
});

function ValidateSubmit(form)
{
	if(confirm("<?php echo get_lang('sure_to_delete');?>"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<h2><?php echo get_lang('manage_listings');?></h2>

<div class="container">

	<br/>
	
	<div class="col-md-3 pull-right no-right-padding">
		<div class="db-wrap"  onclick="javascript:LoadPage('permissions')" onmouseover="javascript:OverDB(this, 3)" onmouseout="javascript:OutDB(this)">
			
			<a href="home.php?m=news&p=admin_news&page=permissions">
				<img src="modules/news/images/permissions.png" class="pull-left arrow-img"/>
				<span class="pull-left"><?php echo get_lang('check_permissions');?></span>
			 
			</a>
			
			<div class="clearfix"></div>
		
						
			<div class="back-color-3" style="position:absolute;bottom:0px;left:0px;width:100%;height:7px"></div>
		</div>
	</div>
		
	<div class="col-md-3 pull-right no-right-padding">
		<div class="db-wrap"  onclick="javascript:LoadPage('settings')" onmouseover="javascript:OverDB(this, 5)" onmouseout="javascript:OutDB(this)">
			
			<a href="home.php?m=news&p=admin_news&page=settings">
				<img src="modules/news/images/settings.png" class="pull-left arrow-img"/>
				<span class="pull-left"><?php echo get_lang('config_options');?></span>
			 
			</a>
			
			<div class="clearfix"></div>
		
						
			<div class="back-color-5" style="position:absolute;bottom:0px;left:0px;width:100%;height:7px"></div>
		</div>
	</div>
	
	<div class="col-md-3 pull-right no-right-padding">
		<div class="db-wrap"  onclick="javascript:LoadPage('add')" onmouseover="javascript:OverDB(this, 4)" onmouseout="javascript:OutDB(this)">
			
			<a href="home.php?m=news&p=admin_news&page=add">
				<img src="modules/news/images/arrow.png" class="pull-left arrow-img"/>
				<span class="pull-left"><?php echo get_lang('add_new_listing');?></span>
			 
			</a>
			
			<div class="clearfix"></div>
		
						
			<div class="back-color-4" style="position:absolute;bottom:0px;left:0px;width:100%;height:7px"></div>
		</div>
	</div>
	
	
	<div class="clearfix"></div>
	<form class="no-margin" action="home.php?m=news&p=admin_news" method="post" onsubmit="return ValidateSubmit(this)">
	<input type="hidden" name="proceed_delete" value="1"/>
	<input type="hidden" name="page" value="home"/>
	
	<h3 class="no-margin"><?php echo get_lang('your_current_listings');?></h3>
	<br/>
	<div class="table-responsive table-wrap">
		<table class="table table-striped">
		  <thead>
			<tr>
			
			  <th width="80"><?php echo get_lang('edit');?></th>
			  <th width="80"><?php echo get_lang('date');?></th>
			 
			  <th width="140"><?php echo get_lang('images');?></th>
			  <th width="180"><?php echo get_lang('title');?></th>
			  <th><?php echo get_lang('description');?></th>
			
			  <th width="80"><?php echo get_lang('delete');?></th>
			</tr>
		  </thead>
      <tbody>
	  <?php
	    $listings = simplexml_load_file($this->data_file);
		$i=0;
		foreach ($listings->listing as $listing)
		{
			?>
			<tr>
				<td><a href="home.php?m=news&p=admin_news&page=edit&id=<?php echo $i;?>"><img src="modules/news/images/edit-icon.gif"/></a></td>
				<td><?php echo date($ini_array["website"]["date_format"],intval($listing->time));?></td>
				<td>
				<?php
				$image_ids = explode(",",$listing->images);
				$has_image=false;
				foreach($image_ids as $image_id)
				{
					if(file_exists("modules/news/thumbnails/".$image_id.".jpg"))
					{
						echo "<a href=\"modules/news/uploaded_images/".$image_id.".jpg\" class=\"hover\"><img src=\"modules/news/thumbnails/".$image_id.".jpg\" class=\"admin-preview-thumbnail\"/></a>";
						$has_image=true;
					}
					
				}
				
				if(!$has_image)
				{
					?>
					<img src="modules/news/images/no_pic.gif" width="50" class="admin-preview-thumbnail"/>
					<?php				
				}
				
				?>
				</td>
				<td><?php echo strip_tags(html_entity_decode($listing->title));?></td>
				<td><?php echo $this->text_words(strip_tags(html_entity_decode($listing->description)),30);?></td>
				
				<td><input type="checkbox" value="<?php echo $i;?>" name="delete_listings[]"/></td>
				
			</tr>
			<?php
			$i++;
		}
	  
	  ?>
     
      </tbody>
    </table>
  </div>
  <br/>
  <button type="submit" class="btn btn-primary pull-right"><?php echo get_lang('delete');?></button>
  
  </form>
  <div class="clearfix"></div>
  <br/>
  
  


</div>	

<script>

function LoadPage(x)
{
	document.location.href="home.php?m=news&p=admin_news&page="+x;
}

function OverDB(element, x)
{
	element.className = "db-wrap back-color-"+x;
}

function OutDB(element)
{
	element.className = "db-wrap";
}

$("#a1").mouseover(function(){
  $("#ul1").addClass("open").removeClass("closed")
})
</script>

<?php
}
?>