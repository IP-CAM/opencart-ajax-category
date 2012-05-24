<?php

/**
 * OpenCart Ukrainian Community
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@opencart-ua.org so we can send you a copy immediately.
 *
 * @category   OpenCart
 * @package    OCU Ajax Category
 * @copyright  Copyright (c) 2011 Eugene Kuligin by OpenCart Ukrainian Community (http://opencart-ua.org)
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU General Public License, Version 3
 */

?>

<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-category">

      <ul>
        <?php foreach ($categories as $category) { ?>
        <li name="<?php echo $category['category_id']; ?>" <?php echo ($category['category_id'] == $category_id ? 'class="active"' : 'class="passive"'); ?>>
          <?php if ($category['category_id'] == $category_id) { ?>
          <a href="<?php echo $category['href']; ?>" class="active ocu-ajax-category"><?php echo $category['name']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $category['href']; ?>" class="ocu-ajax-category"><?php echo $category['name']; ?></a>
          <?php } ?>
          <?php if ($category['children']) { ?>
          <ul>
            <?php foreach ($category['children'] as $child) { ?>
            <li>
              <?php if ($child['category_id'] == $child_id) { ?>
              <a href="<?php echo $child['href']; ?>" class="active"> - <?php echo $child['name']; ?></a>
              <?php } else { ?>
              <a href="<?php echo $child['href']; ?>"> - <?php echo $child['name']; ?></a>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('.box-category ul > li.passive').mouseenter(function() {
  $('#ocu-ajax-category-layer').remove();
  $(this).prepend($('<div id="ocu-ajax-category-layer">').load('index.php?route=module/ocu_ajax_category/subcategory&category_id=' + $(this).attr('name')));
}).mouseleave(function() {
    $('#ocu-ajax-category-layer').remove();
});
//--></script>
