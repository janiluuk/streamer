<?
$reg = "region" . $region . "_style";
$type = $channel->$reg;



if ($type == "3") {
  $this->renderPartial("_region_image_selector", array("channel" => $channel, "region" => $region), false, true);

}

if ($type == "2") {
  $this->renderPartial("_region_text_editor", array("channel" => $channel, "region" => $region), false, true);

}




