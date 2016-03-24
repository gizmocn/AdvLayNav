<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\AdvLayNav\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class ProcessLayoutRenderElementObserver
 */
class ProcessLayoutRenderElementObserver implements ObserverInterface
{
    /**
     * Surrounds the content of the blocks category.products.list and catalog.leftnav with span elements to find them
     * later in the DOM.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $name = $observer->getElementName();
        if ($name === 'category.products.list' || $name === 'catalog.leftnav') {
            /** @var \Magento\Framework\DataObject $transport */
            $transport = $observer->getTransport();
            $output = $transport->getData('output');
            $output = sprintf(
                '<span id="advlaynav_%1$s_before"></span>%2$s<span id="advlaynav_%1$s_after"></span>',
                $name,
                $output
            );
            $transport->setData('output', $output);
        }
    }
}