<?

$images = Image::model()->getAllImages();

foreach ((array)$images as $image) {
  $items[] = array('image' => "http://citystream.tv" . $image, 'label' => basename($image), 'caption' => '');

}

$this->widget('bootstrap.widgets.TbCarousel', array(
						    'items'=>$items,
  )); ?>