<form action="">


    <div class="container">

        <div class="row">
        <div class="col-sm-8">
        <input type="text" name="keyword" id="keyword"  placeholder="mot clef" />
        <div class="form_button">
            <span>tranche d'âge</span>

            <div class="nicer_select">
                <div class="nicer_option" data-value="tranche1">tranche</div>
                <div class="nicer_option" data-value="tranche2">other tranche</div>
            </div>
            <input type="checkbox" name="level[]" value="tranche1" />
            <input type="checkbox" name="level[]" value="tranche2" />



        </div>
        <div class="form_button">
            <span>niveau</span>
            <div class="nicer_select">
                <div class="nicer_option" data-value="level1">level</div>
                <div class="nicer_option" data-value="level2">other level</div>
            </div>
            <input type="checkbox" name="level[]" value="level1" />
            <input type="checkbox" name="level[]" value="level2" />
        </div>
        <div class="form_button">
            <span>jour</span>
        </div>
        <div class="form_button">
            <span>centre</span>
        </div>

        <button name="search_submit">chercher</button>


    </div>
    </div>
</div>


    <div class="background_color"></div>
</form>
