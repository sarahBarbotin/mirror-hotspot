<?php

namespace Hotspot\CustomTaxonomy;


class Departement extends CoreTaxonomy
{
    protected $customPostTypes = ['spot', 'surfer-profile'];
    protected $label = 'Departement';
    protected $identifier = 'departement';

}
