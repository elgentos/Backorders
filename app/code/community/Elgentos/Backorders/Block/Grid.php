<?php

class Elgentos_Backorders_Block_Grid extends Parcelshipper_Paazl_Block_Sales_Order_Grid {

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        // add 'main_table' to filter index to let the query know which increment_id it should take when filtering on increment_id in the grid
        $this->_columns['real_order_id']['filter_index'] = 'main_table.increment_id';
    }

}