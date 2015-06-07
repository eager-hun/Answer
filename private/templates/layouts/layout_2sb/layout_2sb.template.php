<?php
/**
 * @file
 * php_template.
 */
?>

<div <?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['main_content'])): ?>
    <div class="grid-item column main_content">
      <?php print $variables['main_content']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['sidebar_1'])): ?>
    <div class="grid-item column sidebar sidebar_1">
      <?php print $variables['sidebar_1']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['sidebar_2'])): ?>
    <div class="grid-item column sidebar sidebar_2">
      <?php print $variables['sidebar_2']; ?>
    </div>
  <?php endif; ?>

</div>
