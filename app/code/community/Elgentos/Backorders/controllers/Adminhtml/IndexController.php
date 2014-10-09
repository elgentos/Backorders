<?php

class Elgentos_Backorders_Adminhtml_IndexController
    extends Mage_Adminhtml_Controller_Action
{

    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page, we will see a grid of all
     * certificates currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $backordersBlocks = $this->getLayout()
            ->createBlock('elgentos_backorders_adminhtml/backorders');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($backordersBlocks)
            ->renderLayout();
    }

}