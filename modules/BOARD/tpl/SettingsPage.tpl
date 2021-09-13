<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="custom/include/lib/bootstrap_select/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="custom/include/lib/bootstrap_select/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="custom/include/lib/bootstrap_select/js/i18n/defaults-en_US.min.js"></script>

<ul class="nav nav-tabs" id="myTab">
    {foreach from=$moduleListKanban key=iterations item=moduleName}
    <li  class="{if $activeModule == $moduleName}active{/if} {if in_array($moduleName,$moduleListKanbanHasConfig)} success {/if}"><a href="#{$moduleName}" data-toggle="tab" class="{if in_array($moduleName,$moduleListKanbanHasConfig)} success {/if}">{$moduleName}</a></li>
    {/foreach}
</ul>

<div class="tab-content">
    {foreach from=$moduleListKanban key=iterations item=moduleName}
    <div  class="tab-pane {if $activeModule == $moduleName} active{/if}" id="{$moduleName}">
        <h2>{$moduleName}</h2>

        <form action="index.php?module=BOARD&action=saveSattings" method="post" data-module="{$moduleName}" class="config_module_form">
            <input type="hidden" class="" name="config_module_name" value="{$moduleName}" id="config_module_name">
            <h3 class="module-title-text">{$MOD.SELECT_FIELD_FROM_STAGES}</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-6 edit-view-row-item">
                    <div class="col-xs-12 col-sm-4 label" data-label="">
                        {$MOD.SELECT_FIELD_FROM_STAGES}</div>
                    <div class="col-xs-12 col-sm-8 edit-view-field ">
                        <select name="stages_field" class=" stages_field" id="stages_field" data-modulename="{$moduleName}" >
                            {foreach from=$fieldListFromStages[$moduleName] key=stages_field_iterations item=stages_field_field}
                            <option value="{$stages_field_field.name}" {if $stages_field_field.name == $moduleConfigCollection.$moduleName->stages_field } selected="selected"{/if}>{$stages_field_field.LBL}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- [/hide] -->
                </div>
            </div>
            <h3 class="module-title-text">{$MOD.LBL_CUSTOMIZING_COLUMNS}</h3>
            <ul id="sortable_{$moduleName}" class="sortable-ui sortable list-items-collection">
                {foreach from=$moduleConfigCollection[$moduleName]->stages key='rowNumber' item='list'}
                    <li class="ui-state-default stage-stap-item"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> <b>{if $moduleConfigCollection[$moduleName]->stages_field}{assign var="iterationStagesFieldName" value=$moduleConfigCollection[$moduleName]->stages_field} {assign var="optionName" value=$fieldListFromStages[$moduleName][$iterationStagesFieldName].option}{$APP_LIST_STRINGS[$optionName][$list.name]}{/if}</b>
                            <input type="hidden" class="sort-position" name="stage[{$rowNumber}][sortable]" value="{$rowNumber}" id="stage[{$rowNumber}][sortable]">
                            <input type="hidden" name="stage[{$rowNumber}][name]" value="{$list.name}" id="stage[{$rowNumber}][name]">
                            <span>{$MOD.LBL_SHOW}<input type="checkbox" id="stage[{$rowNumber}][display]" name="stage[{$rowNumber}][display]" {if $list.display == true} checked="checked"{/if}></span>
                            <span>{$MOD.LBL_DISPLAY}<input type="checkbox" id="stage[{$rowNumber}][show]" name="stage[{$rowNumber}][show]" {if $list.show == true} checked="checked"{/if}></span>
                        </div></li>
                {/foreach}
            </ul>
            <h3 class="module-title-text">{$MOD.LBL_CUSTOMIZING_HEADER_FIELDS}</h3>
            <ul id="sortable-field" class="sortable-ui sortable-field">
                {if $moduleConfigCollection[$moduleName]->mainFields}
                    {foreach from=$moduleConfigCollection[$moduleName]->mainFields key='rowMainField' item='mainField'}
                        <li class="ui-state-default">
                            <div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <input type="hidden" class="sort-position" name="mainFields[{$rowMainField}][sort]"
                                       value="{$rowMainField}" id="mainFields[{$rowMainField}][sort]">
                                <select name="mainFields[{$rowMainField}][value]" id="mainFields[{$rowMainField}]">
                                    {foreach from=$listFieldsBen[$moduleName] key='optionFieldsName' item='optionFieldsLbl'}
                                        <option value="{$optionFieldsName}" {if $mainField == $optionFieldsName} selected="selected" {/if}>{$optionFieldsLbl}</option>
                                    {/foreach}
                                </select>
                                <span>
                                <button type="button" class="remove-button">x</button>
                             </span>
                            </div>
                        </li>
                    {/foreach}
                {else}
                    <li class="ui-state-default">
                        <div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            <input type="hidden" class="sort-position" name="mainFields[0][sort]"
                                   value="0" id="mainFields[0][sort]">
                            <select name="mainFields[0][value]" id="mainFields[0]">
                                {foreach from=$listFieldsBen[$moduleName] key='optionFieldsName' item='optionFieldsLbl'}
                                    <option value="{$optionFieldsName}" {if $mainField == $optionFieldsName} selected="selected" {/if}>{$optionFieldsLbl}</option>
                                {/foreach}
                            </select>
                            <span>
                                <button type="button" class="remove-button">x</button>
                             </span>
                        </div>
                    </li>
                {/if}

            </ul>
            <div>
                <button type="button" class="add_field" title="" id="add_field">
                    <span class="suitepicon suitepicon-action-plus"></span><span></span>
                </button>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 edit-view-row-item">
                    <div class="col-xs-12 col-sm-4 label" data-label="LBL_ORDER_BY_FIELD">
                        {$MOD.LBL_ORDER_BY_FIELD}</div>
                    <div class="col-xs-12 col-sm-8 edit-view-field ">
                        <select type="text" name="order_by_field" id="order_by_field_{$moduleName}"  >
                            {foreach from=$orderByFields[$moduleName] key='feild_orderby_value' item='feild_orderby_name'}
                            <option value="{$feild_orderby_value}" {if $feild_orderby_value == $moduleConfigCollection.$moduleName->order_by } selected="selected"{/if}>{$feild_orderby_name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- [/hide] -->
                </div>
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
            <div class="hidden basik-field">
                <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <input type="hidden" class="sort-position add-sort"  value="" id="">
                        <select name="mainFields[][value]" class="add-value">
                            {foreach from=$listFieldsBen[$moduleName] key='optionFieldsName' item='optionFieldsLbl'}
                                <option value="{$optionFieldsName}" >{$optionFieldsLbl}</option>
                            {/foreach}
                        </select>
                    </div>
                </li>
            </div>
        </form>
    </div>
    {/foreach}
</div>
{literal}
<script>

    $(".stages_field").change(function (){
        update_stage_list_settings($(this))
    });
    $(".stages_field").click(function (){
        update_stage_list_settings($(this))
    });
    function update_stage_list_settings(clicked_element){
        var selected_field = clicked_element.val();
        var modulename_selected = clicked_element.data('modulename');
        var option_name = fieldListFromStages[modulename_selected][selected_field]['option'];
        var list_stages_collection = app_list_string[option_name];
        var form = clicked_element.closest(".config_module_form");
        form.find('.stage-stap-item').remove();
        var i=0;
        var li_items = '';
        for (key in list_stages_collection) {
            li_items = li_items + '<li class="ui-state-default  stage-stap-item"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> <b>'  + list_stages_collection[key] + '</b>';
            li_items = li_items + "\n ";
            li_items = li_items + '<input type="hidden" class="sort-position" name="stage[' + i + '][sortable]" value="' + i + '" id="stage[' + i + '][sortable]">';
            li_items = li_items + "\n ";
            li_items = li_items + '<input type="hidden" name="stage[' + i + '][name]" value="' + key + '" id="stage[' + i + '][name]">';
            li_items = li_items + "\n ";
            li_items = li_items + '<span>{/literal}{$MOD.LBL_SHOW}{literal}<input type="checkbox" id="stage[' + i + '][display]" name="stage[' + i + '][display]"  checked="checked"></span>';
            li_items = li_items + "\n ";
            li_items = li_items + '<span>{/literal}{$MOD.LBL_DISPLAY}{literal}<input type="checkbox" id="stage[' + i + '][show]" name="stage[' + i + '][show]"  checked="checked"></span>';
            li_items = li_items + "\n ";
            li_items = li_items + "</div></li>";
            console.log(key + " " + list_stages_collection[key]);
            i++;
        }
        console.log(form.attr("class"));
        form.find(".list-items-collection").append(li_items);
    }
</script>
{/literal}

<div class="hidden" id="basic_stages">
    <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> <b></b>
            <input type="hidden" class="sort-position" name="stage[{$rowNumber}][sortable]" value="{$rowNumber}" id="stage[{$rowNumber}][sortable]">
            <input type="hidden" name="stage[{$rowNumber}][name]" value="{$list.name}" id="stage[{$rowNumber}][name]">
            <span>{$MOD.LBL_SHOW}<input type="checkbox" id="stage[{$rowNumber}][display]" name="stage[{$rowNumber}][display]" {if $list.display == true} checked="checked"{/if}></span>
            <span>{$MOD.LBL_DISPLAY}<input type="checkbox" id="stage[{$rowNumber}][show]" name="stage[{$rowNumber}][show]" {if $list.show == true} checked="checked"{/if}></span>
        </div></li>
</div>





        <script>
            const app_list_string = {$APP_LIST_STRINGS|@json_encode};
            const fieldListFromStages = {$fieldListFromStages|@json_encode};
            {literal}

            let collectionforckick = [] ;
            $(document).ready(function () {
            $('.list-items-collection').each(function (index, el){
                console.log('тест проверка значений');
                console.log($(this).find('.stage-stap-item').length);
                if($(this).find('.stage-stap-item').length === 0 ){
                    collectionforckick[collectionforckick.length]=$(this).closest(".config_module_form").find('.stages_field');
                    console.log($(this).closest(".config_module_form").find('.stages_field'));
                    setTimeout(function (){
                        if(collectionforckick.length != 0) {
                            for (const argumentsKey in collectionforckick) {
                                collectionforckick[argumentsKey].click();
                                delete collectionforckick[argumentsKey];
                            }
                        }
                    },10);
                }
            })

                var test11 = $( ".sortable" ).sortable({
                    beforeStop: function( event, ui ) {
                        $(".sortable .sort-position").each(function (index, el) {
                            console.log($(this));
                            $(this).val(index);
                        });
                    }
                });
                $( ".sortable-field" ).sortable({
                    beforeStop: function( event, ui ) {
                        $(".sortable-field .sort-position").each(function (index, el) {
                            console.log($(this));
                            $(this).val(index);
                        });
                    }
                });
                $( ".sortable" ).disableSelection();

                $('.add_field').click(function () {
                    add_field_in_list($(this));
                });
                $('.remove-button').click(function () {
                    var deleted_el = $(this).parent().parent().parent();
                    deleted_el.remove();
                })
            } );
            function add_field_in_list(buttonJqueryClicked) {
                var form = buttonJqueryClicked.closest(".config_module_form");
                var field = form.find('.basik-field').html();
                var addNumber = form.find(".sortable-field .sort-position").length + 1;
                form.find(".sortable-field").append(field);
                form.find(".sortable-field .add-sort").attr({'name' : 'mainFields[' + addNumber + '][sort]', 'value' : addNumber });
                form.find(".sortable-field .add-sort").removeClass('add-sort');
                form.find(".sortable-field .add-value").attr({'name' : 'mainFields[' + addNumber + '][value]'});
                form.find(".sortable-field .add-value").removeClass('add-value');
            }
            {/literal}
        </script>
{literal}
<style>
    .ui-icon{
        float: left;
    }


    .content .nav-tabs > li.active > a.success {
        background: rgba(0, 95, 0, 0.98);
    }
    .content .nav-tabs > li > a.success {
        background: rgba(34, 177, 34, 0.98);
    }
</style>
{/literal}