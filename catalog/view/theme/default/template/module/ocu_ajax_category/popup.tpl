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

 *
 * @category   OpenCart
 * @package    OCU Ajax Category
 * @copyright  Copyright (c) 2011 Eugene Lifescale by OpenCart Ukrainian Community (http://opencart-ukraine.tumblr.com)
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU General Public License, Version 3
 */

?>

<?php if (isset($subcategories)) { ?>
  <div class="sub-container">
    <div class="header">
      &raquo; <?php echo $this->language->get('text_subcategories'); ?>
    </div>
    <?php foreach($subcategories as $category) { ?>
        <div class="body" style="width:<?php echo $this->config->get('config_image_product_width') + 10; ?>px">
          <a href="<?php echo $category['href']; ?>">
              <div class="image"><img src="<?php echo $category['image']; ?>" /></div>
              <div class="name"><?php echo $category['name']; ?></div>
          </a>
        </div>
    <?php } ?>
  </div>
<?php } ?>
