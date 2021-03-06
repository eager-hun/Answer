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

  <div id="main-screen">

    <?php if (!empty($variables['slot_header_level'])): ?>
      <div class="page-level page-level--header">
        <div class="page-center">
          <?php print $variables['slot_header_level']; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($variables['slot_header_suffix_level'])): ?>
      <div class="page-level page-level--header-suffix">
        <div class="page-center">
          <?php print $variables['slot_header_suffix_level']; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($variables['slot_main_level']) || !empty($variables['slot_notifications'])): ?>
      <div class="page-level page-level--main">
        <div class="page-center">

          <?php if (!empty($variables['slot_notifications'])): ?>
            <?php print $variables['slot_notifications']; ?>
          <?php endif; ?>

          <?php if (!empty($variables['slot_main_level'])): ?>
            <?php print $variables['slot_main_level']; ?>
          <?php endif; ?>

        </div>
      </div>
    <?php endif; ?>

    <div id="footer-push"></div>
  </div><!-- /#main-screen (Useful for sticky footer.) -->

  <?php if (!empty($variables['slot_footer_level'])): ?>
    <div class="page-level page-level--footer">
      <div class="page-center">
        <?php print $variables['slot_footer_level']; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if (!empty($variables['slot_body_end'])): ?>
    <?php print $variables['slot_body_end']; ?>
  <?php endif; ?>

</body>
