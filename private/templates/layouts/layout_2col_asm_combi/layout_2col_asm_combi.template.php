<?php
/**
 * @file
 * php_template.
 */
?>

<div <?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['slot_top'])): ?>
    <div class="slot slot--top">
      <?php print $variables['slot_top']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_right_top'])): ?>
    <div class="slot slot--right_top col--right">
      <?php print $variables['slot_right_top']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_left'])): ?>
    <div class="slot slot--left col--left">
      <?php print $variables['slot_left']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_right_bottom'])): ?>
    <div class="slot slot--right_bottom col--right">
      <?php print $variables['slot_right_bottom']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_bottom'])): ?>
    <div class="slot slot--bottom">
      <?php print $variables['slot_bottom']; ?>
    </div>
  <?php endif; ?>

</div>
