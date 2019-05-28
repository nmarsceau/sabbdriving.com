<?php

function display_copyright_notice($initial_year) {
  // error checking and input sanitization
  if (!isset($initial_year)) return '';
  $initial_year = intval($initial_year);
  if ($initial_year == 0) return '';

  // data initialization
  $notice_constructor = array('&copy;&nbsp;');
  $current_year = intval((new DateTime())->format('Y'));

  // construct the copyright notice
  if ($initial_year < $current_year) array_push($notice_constructor, $initial_year.'-');
  array_push($notice_constructor, $current_year);

  // return
  return implode('', $notice_constructor);
}

?>