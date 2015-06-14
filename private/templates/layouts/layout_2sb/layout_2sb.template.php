<?php
/**
 * @file
 * php_template.
 */
?>

<div <?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['main_content'])): ?>
    <div class="g__item column col--main">
      <?php print $variables['main_content']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['sidebar_1'])): ?>
    <div class="g__item column col--sidebar col--sb_1">
      <?php print $variables['sidebar_1']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['sidebar_2'])): ?>
    <div class="g__item column col--sidebar col--sb_2">
      <?php print $variables['sidebar_2']; ?>
    </div>
  <?php endif; ?>

</div>
