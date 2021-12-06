<?php

namespace Hotspot\CustomTaxonomy;


class CoreTaxonomy
{

    protected $identifier;
    protected $label;
    protected $customPostTypes = [];
    protected $hierarchical = false;

    public function __construct()
    {

        register_taxonomy(
            $this->identifier,   // identifiant de la taxonomy
            $this->customPostTypes,   // la taxonomy level peut s'appliquer sur le CPT surfer-profile
            [
                'show_in_rest' => true, // la taxonomy est accessible en mode API ; nécessaire pour l'éditeur de bloc (Gutemberg)
                'label' => $this->label,
                'hierarchical' => $this->hierarchical, // les compétences ne gèrent de "compétences enfants"
                'public' => true // la taxonomy est administrable depuis le backoffice de wp
            ]
        );

    }
}
