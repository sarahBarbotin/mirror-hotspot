<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <h2 class="contact-title">Créez votre Event!</h2>
            </div>
            <div class="col-lg-12">
                <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Donnez un nom à votre Event :</label>
                                <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom de votre Event'" placeholder='Nom de votre Event'>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form_group">
                                <label for="datepicker_1">Choisissez la date de votre Event :</label>
                                <input id="datepicker_1" placeholder="Choisir une date">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-sm-4">
                            <div class="form_group">
                                <label for="image">Choisissez une image pour illustrer votre Event :</label>
                                <input type="file" id="image" placeholder="Importez une image">
                            </div>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="description">Décrivez votre Event :</label>
                                <textarea class="form-control w-100" name="description" id="description" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description de votre Event'" placeholder='Description de votre Event'></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="col-12 col-sm-8 d-sm-flex">
                            <div class="col-sm-4 mb-2">Niveaux acceptés : </div>
                            <div class="col-sm-8 pr-sm-2 form-group">
                                <div>
                                    <input type="checkbox" id="debutant" name="debutant">
                                    <label for="debutant">Débutant</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="intermediaire" name="intermediaire">
                                    <label for="intermediaire">Intermédiaire</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="expert" name="expert">
                                    <label for="expert">Expert</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 d-sm-flex">
                            <div class="col-sm-2 mb-2">Disciplines : </div>
                            <div class="col-sm-8 pr-sm-2 form-group d-sm-flex flex-wrap">
                                <div class="col-sm-4">
                                    <input type="checkbox" id="libre" name="libre">
                                    <label for="libre">Libre</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="checkbox" id="surf" name="surf">
                                    <label for="surf">Surf</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="checkbox" id="paddle" name="paddle">
                                    <label for="paddle">Paddle</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="checkbox" id="wake" name="wake">
                                    <label for="wake">Wake</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 d-flex">
                            <div class="col-sm-2">Spot :</div>
                            <div class=" col-sm-8 d-flex justify-content-between">
                                <select id="spot" class="nice-select nc-select">
                                    <option selected disabled>Choisissez un Spot</option>
                                    <option value="1">Nice</option>
                                    <option value="2">Aix-en-Provence</option>
                                    <option value="3">Moscou</option>
                                </select>
                                <div>ou</div>
                                <button class="btn_1">Créez votre Spot</button>
                            </div>
                        </div>
                        <div class="form_btn col-sm-8 d-flex justify-content-center mt-4">
                            <button class="btn_1">Créer l'Event</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>