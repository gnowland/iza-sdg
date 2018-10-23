<?php
  /**
   * IZA SDG Shortcode Content
   * 
   * @package   IzaSdg
   * @author    Gifford Nowland <hi@giffordnowland.com>
   * @since     1.0.0
   * @return    string HTML
   */


  $content = get_option('iza_sdg')['content'];
  $content = wpautop($content);
  $content = str_replace('<h2>', '%s<h2>', $content);
  $content = explode('%s', $content);
  $content = array_values(array_filter($content));

  $img_src = dirname ( __FILE__ ) . '/src/img/';
  $colors = ['#ee3349','#cf8e2d','#279b49','#c7243a','#ef4f3b','#0bc0e1','#fdb716','#9f1d4a','#f3733c','#df1783','#f99d3c','#ce8d2c','#4b7940','#0f97d4','#60bb4b','#06578b','#1f386a'];
?>
<div id="iza-sdg-app" style="opacity: 0;">
  <?= file_get_contents($img_src . 'iza-sdg.svg'); ?>
  <div id="sdg-info" data-visible="0">
    <div id="sdg-info-0" data-color="#ffffff">
      <?= $content[0] ?>
      <?= file_get_contents($img_src . 'sdg-wordmark.svg'); ?>
    </div>
    <?php foreach($colors as $number => $color) : ?>
      <?php $number = $number + 1; ?>
      <div id="sdg-info-<?= $number ?>" data-color="<?= $color ?>">
        <?= file_get_contents($img_src . 'icon-' . $number . '.svg'); ?>
        <?= $content[$number] ?>
      </div>
    <?php endforeach ?>
  </div>
  <div id="sdg-instructions">
    <p><small>Click the sustainability circle to see how Zinc supports each goal!</small></p>
  </div>
</div>
