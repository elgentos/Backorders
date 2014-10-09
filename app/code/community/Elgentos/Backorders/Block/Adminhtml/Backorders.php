<?php
class Elgentos_Backorders_Block_Adminhtml_Backorders
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'elgentos_backorders_adminhtml';
        $this->_controller = 'backorders';
        $this->_headerText = Mage::helper('elgentos_backorders')
            ->__('Backorders');
    }

    public function getCreateUrl()
    {
        return '#';
    }
}