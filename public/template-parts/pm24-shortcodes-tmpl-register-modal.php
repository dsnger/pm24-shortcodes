<?php

/**
 * Die Datei beinhaltet das Template für das Registrierungsformular in einem Modal/Popup
 *
 *
 * @link projektmanagement24.de
 * @since 1.0.0
 * @version 1.0.1
 *
 * @package pm24_shortcodes
 * @subpackage pm24_shortcodes/public/template-parts
 * @author Daniel Sänger <webmaster@daniel-saenger.de>
 *  * 
 * 
 * 
 */

//Digiprodukt-ID wird hier übergeben
global $lead_magnet_id;

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<!-- This is the modal -->
<div id="pm24_RegisterModal" pm24sc-modal>
  <div class="pm24sc-modal-dialog pm24sc-modal-body">
    <button class="pm24sc-modal-close-default" type="button" pm24sc-close></button>
    <p class="pm24sc-margin-remove-bottom">Noch nicht registriert?</p>
    <h2 class="pm24sc-modal-title pm24sc-text-bold pm24sc-margin-remove-top">Jetzt eintragen und Zugang zu Projektmanagement24 erhalten.</h2>
    <form id="ktv2-form-212756" class="pm24sc-form-stacked" accept-charset="UTF-8" method="post" action="https://www.klick-tipp.com/api/subscriber/signin.html">

      <input type="hidden" name="apikey" value="4xo9zf4iz8z55a6" />
      <input type="hidden" name="fields[fieldDigit]" value="" />
      <input type="hidden" id="FormField_126727" name="fields[field126727]" value="<?= $lead_magnet_id ?>" />

      <div class="pm24sc-margin">
        <div class="pm24sc-inline pm24sc-width-expand">
          <span class="pm24sc-form-icon" pm24sc-icon="icon: user"></span>
          <input type="text" name="fields[fieldFirstName]" class="pm24sc-input pm24sc-form-large" placeholder="Name" required/>
        </div>
      </div>
      <div class="pm24sc-margin">
        <div class="pm24sc-inline pm24sc-width-expand">
          <span class="pm24sc-form-icon" pm24sc-icon="icon: mail"></span>
          <input type="email" name="email" class="pm24sc-input pm24sc-form-large" placeholder="E-Mail" required/>
        </div>
      </div>
      <div class="pm24sc-margin">
        <div class="pm24sc-inline pm24sc-width-expand">
          <button type="submit" name="FormSubmit" class="pm24sc-button pm24sc-button-success pm24sc-button-large" style="">KOSTENFREIER ZUGANG</button>
        </div>
      </div>

    </form>
    <p class="pm24sc-text-bold">Bereits registriert? Dann hier <a href="#">einloggen!</a></p>

  </div>
</div>