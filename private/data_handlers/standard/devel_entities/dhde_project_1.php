<?php
/**
 * Custom script for the project_1 devel entity.
 */

/**
 * Standard function.
 *
 * Make its name match the file-name.
 */
function devel_entities_project_1($args) {
  // Pick which prepared idea to return.
  return dhde_p1_idea_5();
}

/**
 * Demo text.
 */
function dhde_p1_idea_1() {
  $text = <<<EOT

Quick access idea 1.

EOT;

  return datautils_process_markdown($text);
}

/**
 * Quick access idea 2.
 */
function dhde_p1_idea_2() {
  $text = <<<EOT

Quick access idea 2.

EOT;

  return datautils_process_markdown($text);
}

/**
 * Quick access idea 3.
 */
function dhde_p1_idea_3() {
  $text = <<<EOT

Quick access idea 3.

EOT;

  return datautils_process_markdown($text);
}

/**
 * Quick access idea 4.
 */
function dhde_p1_idea_4() {
  $text = <<<EOT

Quick access idea 4.

EOT;

  return datautils_process_markdown($text);
}

/**
 * Quick access idea 5.
 */
function dhde_p1_idea_5() {
  $text = <<<EOT

This is Project 1., an entity-level placeholder project.

It is an entity of type `dynamic`, whose body field is provided by
the `devel_entities` data&nbsp;handler.

There are a couple of blank functions prepared here to help you get started on
something new really quickly.

Grep this string to find the way here.

EOT;

  return datautils_process_markdown($text);
}
