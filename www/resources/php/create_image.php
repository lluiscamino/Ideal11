<?php
/**
 * Generates and uploads LineUp image
 * @param int $id Line up id
 * @param array $players Players positions array
 * @param string $kit Kit image
 * @return string Path of the generated image
 */
function createFieldImage(int $id, array $players, string $kit): string
{
    $field = imagecreatefrompng(ROOT . '/resources/images/field-bg2.png');
    $colourPlayerNames = imagecolorallocate($field, 72, 70, 70);
    $kitRes = imagecreatefrompng($kit);
    foreach ($players as $player) {
        imagecopymerge_alpha($field, $kitRes, (int) $player['w'], (int) $player['h'], 0, 0, 60, 60, 100);
        imagettftext($field, 9, 0, intval((int) $player['w'] + 30 - (strlen($player['player'])*imagefontwidth(2))/2), (int) $player['h']+68, $colourPlayerNames, ROOT . '/resources/fonts/Roboto-Regular.ttf', $player['player']);
    }
    $imagePath = 'resources/images/lineups/' . $id . '.png';
    imagepng( $field , ROOT . '/' . $imagePath);
    imagedestroy($field);
    return $imagePath;
}

/**
 * PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
 * by Sina Salek
 *
 * Bugfix by Ralph Voigt (bug which causes it
 * to work only for $src_x = $src_y = 0.
 * Also, inverting opacity is not necessary.)
 * 08-JAN-2011
 */
function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

        // copying relevant section from watermark to the cut resource
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

        // insert cut resource to destination image
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}