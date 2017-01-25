<?php
require 'instagram.class.php';
$instagram = new Instagram('1400166c1723424c80c16a3496b1baf1');
$popular = $instagram->getPopularMedia();
foreach ($popular->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}
?>