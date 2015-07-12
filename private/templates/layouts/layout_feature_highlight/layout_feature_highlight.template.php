<?php
/**
 * @file
 * php_template.
 */
?>

<div<?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['slot_image'])): ?>
    <div class="fh__image slot slot--image">
      <?php print $variables['slot_image']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_title']) || !empty($variables['slot_text'])): ?>
    <div class="fh__text">

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
    <div class="fh__actions slot slot--button">
      <?php print $variables['slot_button']; ?>
    </div>
  <?php endif; ?>

</div>
