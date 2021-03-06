<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Adobe\AxpConnector\Block\Adminhtml\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Adobe\AxpConnector\Helper\Data;

/**
 * Class ProvisionButton
 *
 * @package Adobe\AxpConnector\Block\Adminhtml\Config
 */
class ProvisionButton extends Field
{
    /**
     * @var string
     */
    protected $_template = 'Adobe_AxpConnector::provision_button.phtml';

    /**
     * @var Data
     */
    private $helper;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param Data $helper
     *
     */
    public function __construct(
        Context $context,
        Data $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * Remove scope label
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  AbstractElement $element
     * @return string
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('adobe_axpconnector/config/provision');
    }

    /**
     * Return if the config values have been saved
     *
     * @return boolean
     */
    public function isConfigSaved()
    {
        $isValid = 0;
        if ($this->helper->getOrgID() !== null &&
            $this->helper->getClientID() !== null &&
            $this->helper->getClientSecret() !== null &&
            $this->helper->getJWT() !== null
        ) {
            $isValid = 1;
        }

        return $isValid;
    }

    /**
     * Generate button html
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getButtonHtml()
    {
        $disabled = $this->isConfigSaved() ? '' : 'disabled';
        $button = $this->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Button::class
        )->setData([
            'id' => 'provision_button',
            'label' => __('Create Launch Property')
        ])->setDisabled($disabled);
        return $button->toHtml();
    }
}
