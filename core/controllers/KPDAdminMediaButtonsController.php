<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 12.08.15
 * Time: 15:30
 */

abstract class KPDAdminMediaButtonsController extends KPDBaseController{
    public function __construct(){
        add_action('media_buttons', array( &$this, 'action'));
    }
    abstract public function action($args = array());
    abstract public function render();
}