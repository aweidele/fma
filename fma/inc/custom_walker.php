<?php
class FMA_Custom_Walker extends Walker_Nav_Menu {

	var $menu_id = 0;
	var $menu_items = array();
 
	function __construct($id = 0){
		$this->menu_id = $id;
		$this->menu_items[] = $id;
	}
 
	function start_el( &$output, $item, $depth, $args ) {
		if( !empty($this->menu_items) && !in_array($item->ID, $this->menu_items) && !in_array($item->menu_item_parent, $this->menu_items)){
			return false;
		}
 
		if(!in_array($item->ID, $this->menu_items)){
			$this->menu_items[] = $item->ID;
		}
 
		parent::start_el($output, $item, $depth, $args);
	}
 
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if( !empty($this->menu_items) && !in_array($item->ID, $this->menu_items) && !in_array($item->menu_item_parent, $this->menu_items)){
    			return false;
    		}
    		parent::end_el($output, $item, $depth, $args);
	}
 
	function start_lvl( &$output, $depth = 0, $args = array() ) {}
 
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

}
?>