<?php

namespace Hotspot\Controllers;


use Hotspot\Models\SurferEventModel;
use WP_Query;

class SpotController extends CoreController
{


    public function home()
    {
        $this->show('views/spot-form.view');
    }

}

