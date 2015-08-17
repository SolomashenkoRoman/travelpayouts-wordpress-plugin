<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 13.08.15
 * Time: 11:21
 */

class TPDirectFlightsRouteShortcodeModel extends TPShortcodesChacheModel{

    public function get_data($args = array())
    {
        // TODO: Implement get_data() method.
        $defaults = array( 'origin' => false, 'destination' => false, 'departure_at' => false, 'return_at' => false,
            'currency' => 'RUB', 'title' => '' );
        extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );
        $current_day = date("d",time());
        $current_month = date("m");

        $attr =  array( 'origin' => $origin, 'destination' => $destination,
            'departure_at' => date('Y-m'), 'return_at' => date('Y-m'),
            'currency' => $this->typeCurrency() );

        $attr_one =  array( 'origin' => $origin, 'destination' => $destination,
            'departure_at' => date('Y-m', mktime(0, 0, 0, $current_month + 1, 1, date("Y"))),
            'return_at' => date('Y-m', mktime(0, 0, 0, $current_month + 1, 1, date("Y"))),
            'currency' => $this->typeCurrency()  );

        $attr_two =  array( 'origin' => $origin, 'destination' => $destination,
            'departure_at' => date('Y-m', mktime(0, 0, 0, $current_month + 2, 1, date("Y"))),
            'return_at' => date('Y-m', mktime(0, 0, 0, $current_month + 2, 1, date("Y"))),
            'currency' => $this->typeCurrency()  );
        $attr_three =  array( 'origin' => $origin, 'destination' => $destination,
            'departure_at' => date('Y-m', mktime(0, 0, 0, $current_month + 3, 1, date("Y"))),
            'return_at' => date('Y-m', mktime(0, 0, 0, $current_month + 3, 1, date("Y"))),
            'currency' => $this->typeCurrency() );

        if($this->cacheSecund()) {
            if (false === ($return = get_transient($this->cacheKey('tpDirectFlightsRouteShortcodes',
                    $origin.$destination)))) {
                $return = array();
                if($current_day < 20){
                    $return_null = TPPlugin::$TPRequestApi->get_direct($attr);
                    if($return_null)
                        array_push($return, $return_null[$destination][0]);
                    $return_one = TPPlugin::$TPRequestApi->get_direct($attr_one);
                    if($return_one)
                        array_push($return, $return_one[$destination][0]);
                    $return_two = TPPlugin::$TPRequestApi->get_direct($attr_two);
                    if($return_two)
                        array_push($return, $return_two[$destination][0]);
                }else{
                    $return_null = TPPlugin::$TPRequestApi->get_direct($attr);
                    if($return_null)
                        array_push($return, $return_null[$destination][0]);
                    $return_one = TPPlugin::$TPRequestApi->get_direct($attr_one);
                    if($return_one)
                        array_push($return, $return_one[$destination][0]);
                    $return_two = TPPlugin::$TPRequestApi->get_direct($attr_two);
                    if($return_two)
                        array_push($return, $return_two[$destination][0]);
                    $return_three = TPPlugin::$TPRequestApi->get_direct($attr_three);
                    if($return_three)
                        array_push($return, $return_three[$destination][0]);
                }
                if( ! $return )
                    return false;
                set_transient( $this->cacheKey('tpDirectFlightsRouteShortcodes',
                    $origin.$destination) , $return, $this->cacheSecund());
            }
        }else{
            $return = array();
            if($current_day < 20){
                $return_null = TPPlugin::$TPRequestApi->get_direct($attr);

                if($return_null)
                    array_push($return, $return_null[$destination][0]);
                $return_one = TPPlugin::$TPRequestApi->get_direct($attr_one);
                if($return_one)
                    array_push($return, $return_one[$destination][0]);
                $return_two = TPPlugin::$TPRequestApi->get_direct($attr_two);
                if($return_two)
                    array_push($return, $return_two[$destination][0]);
            }else{
                $return_null = TPPlugin::$TPRequestApi->get_direct($attr);
                if($return_null)
                    array_push($return, $return_null[$destination][0]);
                $return_one = TPPlugin::$TPRequestApi->get_direct($attr_one);
                if($return_one)
                    array_push($return, $return_one[$destination][0]);
                $return_two = TPPlugin::$TPRequestApi->get_direct($attr_two);
                if($return_two)
                    array_push($return, $return_two[$destination][0]);
                $return_three = TPPlugin::$TPRequestApi->get_direct($attr_three);
                if($return_three)
                    array_push($return, $return_three[$destination][0]);
            }
            if( ! $return )
                return false;
        }
        return array('rows' => $return, 'type' => 7, 'origin' => $origin,
            'destination' => $destination, 'title' => $title);
    }
}