<?php

namespace Hotspot;

class CustomFields
{
    public function __construct()
    {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_61af254616998',
                'title' => 'Event',
                'fields' => array(
                    array(
                        'key' => 'field_61af2550c76b3',
                        'label' => 'Date',
                        'name' => 'date',
                        'type' => 'date_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'display_format' => 'd/m/Y',
                        'return_format' => 'd/m/Y',
                        'first_day' => 1,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'event',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            acf_add_local_field_group(array(
                'key' => 'group_61af242f393e3',
                'title' => 'Spot',
                'fields' => array(
                    array(
                        'key' => 'field_61af2438632b6',
                        'label' => 'City',
                        'name' => 'city',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_61af2445632b7',
                        'label' => 'Zipcode',
                        'name' => 'zipcode',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'Spot zipcode',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_61af2499632b8',
                        'label' => 'Latitude',
                        'name' => 'latitude',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'Spot latitude',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_61af24d1632b9',
                        'label' => 'Longitude',
                        'name' => 'longitude',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'Spot longitude',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'spot',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            acf_add_local_field_group(array(
                'key' => 'group_61af21494bd69',
                'title' => 'Surfer Profile',
                'fields' => array(
                    array(
                        'key' => 'field_61af2290f08c8',
                        'label' => 'City',
                        'name' => 'city',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'your city',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => 64,
                    ),
                    array(
                        'key' => 'field_61af2314f08c9',
                        'label' => 'Level',
                        'name' => 'level',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 0,
                        'placeholder' => 'your level',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => 3,
                        'step' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'surfer-profile',
                        ),
                    ),
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'surfer-profile',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            endif;		
    }
}

