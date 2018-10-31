<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Adobe\AxpConnector\Block;

/**
 * Product block.
 *
 * @api
 */
class Product extends Base
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Adobe\AxpConnector\Helper\Data $helper
     * @param array $data
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Adobe\AxpConnector\Helper\Data $helper,
        array $data,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context, $helper, $data);
        $this->registry = $registry;
        $this->helper = $helper;
    }

    /**
     * Product datalayer.
     *
     * @return array
     */
    public function datalayerProduct()
    {
        return $this->helper->productViewedPushData($this->getCurrentProduct());
    }

    /**
     * Json product data layer.
     *
     * @return string
     */
    public function datalayerProductJson()
    {
        $datalayerProd = $this->datalayerProduct();
        return $this->helper->jsonify($datalayerProd);
    }

    /**
     * Getter for current product.
     *
     * @return mixed
     */
    protected function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }
}
