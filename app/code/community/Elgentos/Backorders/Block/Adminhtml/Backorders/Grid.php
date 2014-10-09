<?php
class Elgentos_Backorders_Block_Adminhtml_Backorders_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which collection to use to display in the grid.
         */
        $collection = Mage::getResourceModel(
            'sales/order_item_collection'
        );
        $collection->addAttributeToSort('created_at','desc');
        //$collection->addAttributeToFilter('created_at',array('from'=>'2014-06-23'));
        $this->setCollection($collection);
        $select = $collection->getSelect();
        $select->joinLeft(array('order'=>$collection->getTable('sales/order')), 'main_table.order_id=order.entity_id', array('order_increment_id'=>'order.increment_id','customer_firstname'=>'order.customer_firstname','customer_lastname'=>'order.customer_lastname'));
        $select->columns(array('customer_name'=>new Zend_Db_Expr('CONCAT(customer_firstname," ",customer_lastname)')));
        $select->where('order.state != "canceled"');
        $select->where('main_table.qty_ordered != qty_shipped');
        $select->where('main_table.created_at > "2014-06-23"');

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
            return $this->getUrl('adminhtml/sales_order/view', array('order_id' => $row->getOrderId()));
        }
        return false;
    }

    protected function _prepareColumns()
    {
        /**
         * Here, we'll define which columns to display in the grid.
         */
        $this->addColumn('item_id', array(
            'header' => $this->_getHelper()->__('Item ID'),
            'type' => 'number',
            'index' => 'item_id',
        ));

        $this->addColumn('order_increment_id', array(
            'header' => $this->_getHelper()->__('Order ID'),
            'type' => 'number',
            'index' => 'order_increment_id',
        ));

        $this->addColumn('customer', array(
            'header' => $this->_getHelper()->__('Customer'),
            'type' => 'text',
            'index' => 'customer_name',
        ));

        $this->addColumn('sku', array(
            'header' => $this->_getHelper()->__('SKU'),
            'type' => 'text',
            'index' => 'sku',
        ));

        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name',
        ));

        $this->addColumn('qty_ordered', array(
            'header' => $this->_getHelper()->__('Qty Ordered'),
            'type' => 'number',
            'index' => 'qty_ordered',
        ));

        $this->addColumn('qty_shipped', array(
            'header' => $this->_getHelper()->__('Qty Shipped'),
            'type' => 'number',
            'index' => 'qty_shipped',
        ));

        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('elgentos_backorders');
    }
}