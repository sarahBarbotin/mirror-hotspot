<div class="col-12 mb-4">
    <h2 class="contact-title">Créez votre Événement!</h2>
</div>

<form class="form-contact contact_form col-12 col-lg-8" action="#" method="post" id="addEventForm" novalidate="novalidate" enctype="multipart/form-data">

    <?php wp_nonce_field('marie', 'lol'); ?>

    <div class="row mb-5">
        <div class="col-12 col-sm-6">
            <label class="d-block">Spot :</label>
            <?php $spotQuery = new WP_Query(['post_type' => 'spot']) ?>
            <select id="spotEvent" name="addEvent[spotEvent]" class="nice-select nc-select w-100">
                <option selected disabled>Choisissez un Spot *</option>
                <?php if ($spotQuery->have_posts()) {
                    while ($spotQuery->have_posts()) {
                        $spotQuery->the_post();
                        echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                    }
                } ?>
            </select>
        </div>
        <div class="col-12 col-sm-6">
            <label class="d-block">Ou</label>
            <a class="btn_1 w-100 text-center" href="<?= get_post_type_archive_link('spot'); ?>/#spotForm" target="_blank">
                Créez votre spot
            </a>
        </div>
    </div>

    <div class="row align-items-items">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">Donnez un nom à votre Événement*</label>
                <input class="form-control" name="addEvent[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom de votre Event'" placeholder='Nom de votre Event'>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12 col-sm-6">
            <div class="form_group">
                <label for="datepicker" class="d-block">Choisissez une date*</label>
                <input id="datepicker" name="addEvent[date]" type="date">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
            <div class="form_group">
                <label for="picture_upload" class="d-block">Photo d'illustration:</label>
                <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="description">Décrivez votre Événement:</label>
                <textarea class="form-control w-100" name="addEvent[description]" id="description" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description de votre Événement'" placeholder='Description de votre Événement'></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 pr-sm-2">
            <label for="levelId" class="d-block">Niveaux acceptés:</label>
            <div class="form-group">
                <select name="addEvent[levelId]" id="levelId" class="nice-select nc-select w-100">
                    <?php $levelTerms = get_terms(['taxonomy' => 'level', 'hide_empty' => false,]); ?>
                    <?php foreach ($levelTerms as $level) {
                        echo '<option value="' . $level->term_id . '">' . $level->name . '</option>';
                    } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
            <label for="discipline" class="d-block">Disciplines:</label>
            <div class="form-group">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <?php $disciplineQuery = get_terms(['taxonomy' => 'event_discipline', 'hide_empty' => false]) ?>
                    <?php foreach ($disciplineQuery as $discipline) {
                        echo '<div class="pr-1">
                        <input type="checkbox" id="discipline-' . $discipline->term_id . '" name="addEvent[discipline][]" value="' . $discipline->name . '">
                        <label for="discipline-' . $discipline->term_id . '">' . $discipline->name . '</label>
                        </div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit button -->
    <div class="form_btn d-flex mt-4">
        <button type="submit" class="btn_1">Créer l'Événement</button>
    </div>
</form>