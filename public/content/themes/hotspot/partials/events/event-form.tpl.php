
  <div class="col-12 mb-4">
    <h2 class="contact-title">Créez votre Event!</h2>
</div>

  <form class="form-contact contact_form" action="#" method="post" id="addEventForm" novalidate="novalidate" enctype="multipart/form-data">

    <?php wp_nonce_field('marie', 'lol'); ?>

        <div class="row">

            <div class="col-sm-12 d-flex">
                <div class="col-sm-2">Spot :</div>
                <div class=" col-sm-12 d-flex justify-content-between">
                    <?php $spotQuery = new WP_Query(['post_type' => 'spot']) ?>
                    <select id="spotEvent" name="addEvent[spotEvent]" class="nice-select nc-select">
                        <option selected disabled>Choisissez un Spot *</option>
                        <?php if ($spotQuery->have_posts()) {
                            while ($spotQuery->have_posts()) {
                                $spotQuery->the_post();
                                echo '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
                            }
                        } ?>
                    </select>
                    
                    </div>
                </div>
            </div>
            <div class="col-sm-12">ou
                    <a class="btn_1" href="<?=get_post_type_archive_link('spot');?>/#spotForm" target="_blank">
                        Créez votre spot
                    </a>
                    </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Donnez un nom à votre Event *</label>
                    <input class="form-control" name="addEvent[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom de votre Event'" placeholder='Nom de votre Event'>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form_group">
                    <label for="datepicker">Choisissez la date de votre Event *</label>
                    <input id="datepicker" name="addEvent[date]" type="date">
                </div>
            </div>
            <div class="col-sm-12 mb-sm-4">
                <div class="form_group">
                    <label for="picture_upload">Choisissez une image pour illustrer votre Event :</label>
                    <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg">
                </div>
            </div>
            <div class="col-sm-12"></div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="description">Décrivez votre Event :</label>
                    <textarea class="form-control w-100" name="addEvent[description]" id="description" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description de votre Event'" placeholder='Description de votre Event'></textarea>
                </div>
            </div>
            <div class="col-sm-12"></div>
            <div class="col-12 col-sm-8 d-sm-flex">
                <div class="col-sm-4 mb-2">Niveaux acceptés : </div>
                <div class="col-sm-8 pr-sm-2 form-group">

                <select name="addEvent[levelId]" id="levelId">
                    <?php $levelTerms = get_terms(['taxonomy' => 'level', 'hide_empty' => false,]); ?>
                    <?php foreach ($levelTerms as $level) {
                        echo '<option value="' . $level->term_id . '">' . $level->name . '</option>';
                    } ?>
                </select>
                </div>
            </div>
            <div class="col-sm-12 d-sm-flex">
                <div class="col-sm-2 mb-2">Disciplines : </div>
                <div class="col-sm-8 pr-sm-2 form-group d-sm-flex flex-wrap">
                    <?php $disciplineQuery = get_terms(['taxonomy' => 'event_discipline', 'hide_empty' => false]) ?>
                    <?php foreach ($disciplineQuery as $discipline) {
                        echo '<div class="col-sm-4">
                        <input type="checkbox" id="discipline-'.$discipline->term_id.'" name="addEvent[discipline][]" value="'.$discipline->name.'">
                        <label for="discipline-'.$discipline->term_id.'">'.$discipline->name.'</label>
                        </div>';
                    } ?>
                </div>
            </div>
            
            <div class="form_btn col-sm-8 d-flex justify-content-center mt-4">
                <button type ="submit" class="btn_1">Créer l'Evenement</button>
            </div>
    </form>
