<?php

class Elgentos_Backorders_Model_Observer {

    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->joinLeft(array('shipment'=>$collection->getTable('sales/shipment')), 'main_table.entity_id=shipment.order_id', array('shipment_id'=>'shipment.entity_id'));
        $select->joinLeft(array('shipment_items'=>$collection->getTable('sales/shipment_item')), 'shipment.entity_id=shipment_items.parent_id', array('items_shipped'=>new Zend_Db_Expr('COUNT(shipment_items.entity_id)')));
        $select->joinLeft(array('order_items'=>$collection->getTable('sales/order_item')), 'main_table.entity_id=order_items.order_id', array('order_items'=>new Zend_Db_Expr('COUNT(order_items.item_id)')));
        $select->columns(array('amount_shipped_of_total'=>new Zend_Db_Expr('CONCAT(COUNT(shipment_items.entity_id)," / ",COUNT(order_items.item_id))')));
        $select->group('main_table.entity_id');
    }

}
