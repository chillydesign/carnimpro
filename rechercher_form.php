<form action="">

<?php

$age_tranches = search_form_ages();
$levels = search_form_levels();
$disciplines = search_form_discplines();
$locations = search_form_locations();

?>

    <div class="container">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" name="keyword" id="keyword"  placeholder="mot clef" />
                <div class="form_button">
                    <span>tranche d'âge</span>

                    <div class="nicer_select">
                        <?php foreach ($age_tranches as $age) : ?>
                            <div class="nicer_option" data-value="<?php echo $age; ?>"><?php echo $age; ?></div>
                        <?php endforeach; ?>
                    </div>


                    <?php foreach ($age_tranches as $age) : ?>
                            <input type="checkbox" name="age[]" value="<?php echo $age; ?>" />
                    <?php endforeach; ?>

                </div>
                <div class="form_button" id="level_button">
                    <span>niveau</span>
                    <div class="nicer_select">
                        <?php foreach ($levels as $level) : ?>
                            <div class="nicer_option" data-value="<?php echo $level; ?>"><?php echo $level; ?></div>
                        <?php endforeach; ?>

                    </div>
                    <?php foreach ($levels as $level) : ?>
                        <input type="checkbox" name="level[]" value="<?php echo $level; ?>" />
                    <?php endforeach; ?>
                </div>

                <div class="form_button" id="discipline_button">
                    <span>discipline</span>
                    <div class="nicer_select">
                        <?php foreach ($disciplines as $discipline) : ?>
                            <div class="nicer_option" data-value="<?php echo $discipline; ?>"><?php echo $discipline; ?></div>
                        <?php endforeach; ?>

                    </div>
                    <?php foreach ($disciplines as $discipline) : ?>
                        <input type="checkbox" name="discipline[]" value="<?php echo $discipline; ?>" />
                    <?php endforeach; ?>
                </div>



                <div class="form_button" id="day_button">
                    <span>jour</span>
                    <div class="nicer_select">
                        <div class="nicer_option"  data-value="1">lundi</div>
                        <div class="nicer_option"  data-value="2">mardi</div>
                        <div class="nicer_option"  data-value="3">mercredi</div>
                        <div class="nicer_option"  data-value="4">jeudi</div>
                        <div class="nicer_option"  data-value="5">vendredi</div>
                        <div class="nicer_option"  data-value="6">samedi</div>
                        <div class="nicer_option"  data-value="0">dimanche</div>
                    </div>
                    <input type="checkbox" name="jour[]" value="1" />
                    <input type="checkbox" name="jour[]" value="2" />
                    <input type="checkbox" name="jour[]" value="3" />
                    <input type="checkbox" name="jour[]" value="4" />
                    <input type="checkbox" name="jour[]" value="5" />
                    <input type="checkbox" name="jour[]" value="6" />
                    <input type="checkbox" name="jour[]" value="0" />

                </div>
                <div class="form_button">
                    <span>centre</span>
                    <div class="nicer_select">

                        <?php foreach ($locations as $location) : ?>
                            <div class="nicer_option" data-value="<?php echo $location; ?>"><?php echo $location; ?></div>
                        <?php endforeach; ?>


                    </div>

                        <?php foreach ($locations as $location) : ?>
                        <input type="checkbox" name="location[]" value="<?php echo $location; ?>" />
                    <?php endforeach; ?>



                </div>

                <button id="search_submit" name="search_submit">chercher</button>


            </div>
        </div>
    </div>


    <div class="background_color"></div>
</form>
