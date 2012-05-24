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


class ControllerModuleOcuAjaxCategory extends Controller {

    protected function index($setting)
    {
        $this->language->load('module/ocu_ajax_category');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/ocu_ajax_category.css');

        $this->data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string)$this->request->get['path']);
        } else {
            $parts = array();
        }

        if (isset($parts[0])) {
            $this->data['category_id'] = $parts[0];
        } else {
            $this->data['category_id'] = 0;
        }

        if (isset($parts[1])) {
            $this->data['child_id'] = $parts[1];
        } else {
            $this->data['child_id'] = 0;
        }

        $this->load->model('catalog/category');
        $this->load->model('catalog/product');

        $this->data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories(0);

        foreach ($categories as $category) {
            $children_data = array();

            $children = $this->model_catalog_category->getCategories($category['category_id']);

            foreach ($children as $child) {

                $children_data[] = array(
                    'category_id' => $child['category_id'],
                    'name'        => $child['name'],
                    'href'        => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
                );
            }

            $this->data['categories'][] = array(
                'category_id' => $category['category_id'],
                'name'        => $category['name'],
                'children'    => $children_data,
                'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
             );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ocu_ajax_category/index.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/ocu_ajax_category/index.tpl';
        } else {
            $this->template = 'default/template/module/category.tpl';
        }

        $this->render();
    }

    public function subcategory()
    {
        // Load dependencies
        $this->language->load('module/ocu_ajax_category');
        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        // Request parameters
        if (isset($this->request->get['category_id'])) {
            $category_id = (int) $this->request->get['category_id'];
        } else {
            $category_id = 0;
        }

        // Get subcategories
        $this->model_catalog_category->getCategories($category_id);

        $categories = $this->model_catalog_category->getCategories($category_id);

        if ($categories) {
            foreach ($categories as $category) {

                if ($category['image']) {
                    $image = $this->model_tool_image->resize($category['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                $this->data['subcategories'][] = array(
                    'category_id' => $category['category_id'],
                    'name'        => $category['name'],
                    'image'       => $image,
                    'href'        => $this->url->link('product/category', 'path=' . $category_id . '_' . $category['category_id'])
                );
            }
        }

        // Get template
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ocu_ajax_category/popup.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/ocu_ajax_category/popup.tpl';
        } else {
            $this->template = 'default/template/module/ocu_ajax_category/popup.tpl';
        }

        $this->response->setOutput($this->render());
    }
}
?>
