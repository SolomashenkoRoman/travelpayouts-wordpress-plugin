<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 20.08.15
 * Time: 0:25
 */

class TPWizardModel extends TPOptionModel{
    public function __construct()
    {
        parent::__construct();
    }
    public function create_option()
    {
        // TODO: Implement create_option() method.
        register_setting(
            'TPWizard',
            KPDPlUGIN_OPTION_NAME,
            array(&$this,'save_option')
        );
        $field = new TPFieldWizard();
        add_settings_section( 'tp_settings_wizard_id', '', '', 'tp_settings_wizard' );
        add_settings_field('tp_wizard_td', '', array(&$field ,'TPFieldWizard'),
            'tp_settings_wizard', 'tp_settings_wizard_id' );
    }


}