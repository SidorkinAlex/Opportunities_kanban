<form action="index.php?module=BOARD_OPPORTUNITIES&action=saveSattings" method="post">
    <h3 class="module-title-text">{$MOD.LBL_CUSTOMIZING_COLUMNS}</h3>
        <ul id="sortable" class="sortable-ui">
            {foreach from=$config.stages key='rowNumber' item='list'}
                <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> <b>{$list.lbl}</b>
                    <input type="hidden" class="sort-position" name="stage[{$rowNumber}][sortable]" value="{$rowNumber}" id="stage[{$rowNumber}][sortable]">
                    <input type="hidden" name="stage[{$rowNumber}][name]" value="{$list.name}" id="stage[{$rowNumber}][name]">
                    <span>{$MOD.LBL_SHOW}<input type="checkbox" id="stage[{$rowNumber}][display]" name="stage[{$rowNumber}][display]" {if $list.display == true} checked="checked"{/if}></span>
                    <span>{$MOD.LBL_DISPLAY}<input type="checkbox" id="stage[{$rowNumber}][show]" name="stage[{$rowNumber}][show]" {if $list.show == true} checked="checked"{/if}></span>
                </div></li>
            {/foreach}
        </ul>
    <h3 class="module-title-text">{$MOD.LBL_CUSTOMIZING_HEADER_FIELDS}</h3>
    <ul id="sortable-field" class="sortable-ui">
    {foreach from=$config.mainFields key='rowMainField' item='mainField'}
        <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                <input type="hidden" class="sort-position" name="mainFields[{$rowMainField}][sort]" value="{$rowMainField}" id="mainFields[{$rowMainField}][sort]">
                <select name="mainFields[{$rowMainField}][value]" id="mainFields[{$rowMainField}]">
                    {foreach from=$optionFilds key='optionFildsName' item='optionFildsLbl'}
                        <option value="{$optionFildsName}" {if $mainField == $optionFildsName} selected="selected" {/if}>{$optionFildsLbl}</option>
                    {/foreach}
                </select>
                <span>
                    <button type="button" class="remove-button">x</button>
                </span>
            </div>
        </li>
    {/foreach}
    </ul>
    <div>
        <button type="button" class="add_field" title="" id="add_field">
            <span class="suitepicon suitepicon-action-plus"></span><span></span>
        </button>
    </div>

    <div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_OPPORTUNITY_NAME">
                {$MOD.LBL_BOARD_COLUMN_HEIGHT}</div>
            <div class="col-xs-12 col-sm-8 edit-view-field ">
                <input type="text" name="kanbandragHeight" id="kanbandragHeight" size="30" maxlength="50" value="{if $config.kanban.kanbandragHeight}{$config.kanban.kanbandragHeight}{else}450{/if}"> px
            </div>
            <!-- [/hide] -->
        </div>
    </div>
<div class="col-xs-12">
    <button type="submit">{$MOD.LBL_SAVE}</button>
</div>
</form>
<div class="hidden" id="basik-field">
    <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
            <input type="hidden" class="sort-position add-sort"  value="" id="">
            <select name="mainFields[][value]" class="add-value">
                {foreach from=$optionFilds key='optionFildsName' item='optionFildsLbl'}
                    <option value="{$optionFildsName}" >{$optionFildsLbl}</option>
                {/foreach}
            </select>
        </div>
    </li>
</div>


        <script>
            {literal}
            $(document).ready(function () {

                $( "#sortable" ).sortable({
                    beforeStop: function( event, ui ) {
                        $("#sortable .sort-position").each(function (index, el) {
                            console.log($(this));
                            $(this).val(index);
                        });
                    }
                });
                $( "#sortable-field" ).sortable({
                    beforeStop: function( event, ui ) {
                        $("#sortable-field .sort-position").each(function (index, el) {
                            console.log($(this));
                            $(this).val(index);
                        });
                    }
                });
                $( "#sortable" ).disableSelection();

                $('#add_field').click(function () {
                    add_field_in_list();
                });
                $('.remove-button').click(function () {
                    var deleted_el = $(this).parent().parent().parent();
                    deleted_el.remove();
                })
            } );
            function add_field_in_list() {
                var field = $('#basik-field').html();
                var addNumber = $("#sortable-field .sort-position").length + 1;
                $("#sortable-field").append(field);
                $("#sortable-field .add-sort").attr({'name' : 'mainFields[' + addNumber + '][sort]', 'value' : addNumber });
                $("#sortable-field .add-sort").removeClass('add-sort');
                $("#sortable-field .add-value").attr({'name' : 'mainFields[' + addNumber + '][value]'});
                $("#sortable-field .add-value").removeClass('add-value');
            }
            {/literal}
        </script>
{literal}
<style>
    .ui-icon{
        float: left;
    }
</style>
{/literal}