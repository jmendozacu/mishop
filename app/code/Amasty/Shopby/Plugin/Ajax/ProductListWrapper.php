<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2019 Amasty (https://www.amasty.com)
 * @package Amasty_Shopby
 */


namespace Amasty\Shopby\Plugin\Ajax;

/**
 * Class ProductListWrapper
 * @package Amasty\Shopby\Plugin\Ajax
 * @codingStandardsIgnoreFile
 */
class ProductListWrapper
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
    }

    /**
     * @param \Magento\Framework\View\Element\Template $subject
     * @param $result
     * @return string
     */
    public function afterToHtml(\Magento\Framework\View\Element\Template $subject, $result)
    {
        if ($subject->getNameInLayout() !== 'category.products.list'
            && $subject->getNameInLayout() !== 'search_result_list'
            && strpos($subject->getNameInLayout(), 'product\productslist') !== false // do not wrap widget block
        ) {
            return $result;
        }

        if ($this->request->getParam('is_scroll')) {
            return $result;
        }

        return
            '<div id="amasty-shopby-product-list">'
            . $result
            . '</div>';
    }
}