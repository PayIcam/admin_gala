<div class="whole_form">
    <form action="add_db.php" method="post">
        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">Prénom</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom" />
        </div>
        <br/>

        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">Nom</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom" />
        </div>
        <br/>

        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">Mail</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="mail" />
        </div>
        <br/>

        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">Téléphone</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="tel" />
        </div>
        <br/>


        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">N° de bracelet</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="bracelet" />
        </div>
        <br/>

        <div class='col-md-3'>
            <label for="promo">Promo :</label><br />
            <select class="form-control" name="promo" id="promo">
                <option> 120 </option>
                <option> 119 </option>
                <option> 118 </option>
                <option> 121 </option>
                <option> 122 </option>
                <option> 2018 </option>
                <option> 2019 </option>
                <option> 2020 </option>
                <option> 2021 </option>
                <option> 2022 </option>
                <option> Ingénieur </option>
                <option> FC </option>
                <option> Permanent </option>
                <option> 117 </option>
                <option> Parent </option>
            </select>

            <label for="creneau">Créneau :</label><br />
            <select class="form-control" name="creneau" id="creneau">
                <option value="21h-21h45"> 21h-21h35 </option>
                <option value="21h45-22h30"> 21h50-22h25 </option>
                <option value="22h30-23h"> 22h40-23h10 </option>
            </select>

            <label for="paiement">Paiement :</label><br />
            <select class="form-control" name="paiement" id="paiement">
                <option> PayIcam </option>
                <option> Pumpkin </option>
                <option> gratuit </option>
                <option> cash </option>
                <option> cb </option>
            </select>

            <label for="tickets">Tickets boissons :</label><br />
            <select class="form-control" name="tickets" id="tickets">
                <option> 10 </option>
                <option> 20 </option>
                <option> 30 </option>
            </select>

        </div>

        Options Supplémentaires : <br />
        <input type="radio" name="dîner" value=1 id="dîner" /> <label for="dîner"> Dîner <br /> </label>
        <input type="radio" name="conférence" value=1 id="conférence" /> <label for="conférence"> Conférence <br /> </label>

        <input type=hidden name="is_icam" value=1 />

    <div class="col-md-5">
        <?php if(isset($_POST['fromicam'])){echo '<input type="hidden" name="fromicam" value=1 />';}?> <input type="submit" class="btn btn-primary" value="Enregistrer"/>
    </div>

    </form>
</div>