<?php 
$this->load->helper('html');
foreach ($faces as $face_item): ?>

<h2>
	<?php echo $face_item['id'] ?>
</h2>

<?php 
$image_properties = array(
		'src' => 'resources/img/'.$face_item['path'],
		'alt' => 'Face',
		'class' => 'post_images',
		'title' => 'Face',
);

echo img($image_properties);
?>
<div id="main">
	<?php echo $face_item['code'] ?>
</div>

<?php endforeach ?>