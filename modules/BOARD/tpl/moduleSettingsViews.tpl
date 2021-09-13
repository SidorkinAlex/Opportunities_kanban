{if $alert}
<div class="alert alert-success" id="message_alert">
  {$alert}
    {literal}
    <script>
        setTimeout(function (){
            $('#message_alert').hide();
        },5000);
    </script>
    {/literal}
</div>
{/if}
<form action="index.php?module=BOARD&action=saveModuleSettings" method="post">
    <h3 class="module-title-text">{$MOD.LBL_SELECTED_MODULE}</h3>
    <div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item">
             <div class="col-xs-12 col-sm-8 edit-view-field ">
                 <select type="text" name="moduleList[]" id="moduleList" class="selectpicker" data-live-search="true" multiple>
                    {$moduleList}
                 </select>
            </div>
            <!-- [/hide] -->
        </div>
    </div>



    <div class="col-xs-12">
        <button type="submit" class="button ">{$MOD.LBL_SAVE}</button>
    </div>
</form>
<div style="height: 150px;"></div>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="custom/include/lib/bootstrap_select/css/bootstrap-select.min.css">
<link rel="stylesheet" href="modules/BOARD/src/css/include.css">

<!-- Latest compiled and minified JavaScript -->
<script src="custom/include/lib/bootstrap_select/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="custom/include/lib/bootstrap_select/js/i18n/defaults-en_US.min.js"></script>


