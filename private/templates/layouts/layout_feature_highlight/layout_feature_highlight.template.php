<?php
/**
 * @file
 * php_template.
 */
?>

<div <?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['slot_image'])): ?>
    <div class="slot slot--image">
      <?php print $variables['slot_image']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_title']) || !empty($variables['slot_text'])): ?>
    <div class="cta__texts">

      <?php if (!empty($variables['slot_title'])): ?>
        <div class="slot slot--title">
          <?php print $variables['slot_title']; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($variables['slot_text'])): ?>
        <div class="slot slot--text">
          <?php print $variables['slot_text']; ?>
        </div>
      <?php endif; ?>

    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_button'])): ?>
    <div class="slot slot--button">
      <div class="flex-pos">
        <?php print $variables['slot_button']; ?>
      </div>
    </div>
  <?php endif; ?>

</div>
