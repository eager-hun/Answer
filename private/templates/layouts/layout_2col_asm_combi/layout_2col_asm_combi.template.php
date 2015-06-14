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

  <?php if (!empty($variables['slot_col_1'])): ?>
    <div class="slot column col--1">
      <?php print $variables['slot_col_1']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_col_2'])): ?>
    <div class="slot column col--2">
      <?php print $variables['slot_col_2']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_bottom'])): ?>
    <div class="slot slot--bottom">
      <?php print $variables['slot_bottom']; ?>
    </div>
  <?php endif; ?>

</div>
