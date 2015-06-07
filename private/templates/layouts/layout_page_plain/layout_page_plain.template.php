<?php
/**
 * @file
 * php_template.
 */
?>

<body<?php print $variables['wrapper_attributes']; ?>>

  <?php if (!empty($variables['slot_body_start'])): ?>
    <?php print $variables['slot_body_start']; ?>
  <?php endif; ?>

  <?php if (!empty($variables['slot_page_content'])): ?>
    <div class="page-content">
      <?php print $variables['slot_page_content']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_body_end'])): ?>
    <?php print $variables['slot_body_end']; ?>
  <?php endif; ?>

</body>
