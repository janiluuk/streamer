--TEST--
ffmpeg getFrameResampled test
--SKIPIF--
<?php 
function_exists("imagecreatetruecolor") or die("skip function imagecreatetruecolor unavailable");
require_once '../../ffmpeg_movie.php';
require_once '../../ffmpeg_frame.php';
require_once '../../ffmpeg_animated_gif.php';
$ignore_demo_files = true;
$dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require_once $dir.'/examples/example-config.php';
$tmp_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_PATH.'tmp/';
?>
--FILE--
<?php
$frame = 70;
$mov = new PHPVideoToolkit_movie($dir.'/examples/to-be-processed/cat.mpeg', false, $tmp_dir);
$img = sprintf("%s/test-%04d.png", $tmp_dir, $frame);

$ff_frame = $mov->getFrame($frame);
if ($ff_frame) {
    $ff_frame->resize(360, 460);
    $gd_image = $ff_frame->toGDImage();
    if ($gd_image) {
        imagepng($gd_image, $img);
        imagedestroy($gd_image);
        // generate md5 of file (NOTE: different versions of ffmpeg may produce different
        // md5 hashes since resampling has been changed slightly due to a fix. Need to
        // use EXPECTREX to test for both md5 possibilities.
        printf("ffmpeg getFrameResampled(): md5 = %s\n", md5(file_get_contents($img)));
       unlink($img);
    }
}
?>
--EXPECT--
ffmpeg getFrameResampled(): md5 = 6670321cfc5ea8ac08d6523f77b5aace
