<form action="index.php?module=BORD_OPPORTUNITIES&action=saveSattings" method="post">
        <ul id="sortable">
            {foreach from=$config.stages key='rowNumber' item='list'}
            <li class="ui-state-default"><div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> {$list.lbl}
                    <input type="hidden" class="sort-position" name="stage[{$rowNumber}][sortable]" value="{$rowNumber}" id="stage[{$rowNumber}][sortable]">
                    <input type="hidden" name="stage[{$rowNumber}][name]" value="{$list.name}" id="stage[{$rowNumber}][name]">
                    <span>{$MOD.LBL_SHOW}<input type="checkbox" id="stage[{$rowNumber}][display]" name="stage[{$rowNumber}][display]" {if $list.display == true} checked="checked"{/if}></span>
                    <span>{$MOD.LBL_DISPLAY}<input type="checkbox" id="stage[{$rowNumber}][show]" name="stage[{$rowNumber}][show]" {if $list.show == true} checked="checked"{/if}></span>
                </div></li>
            {/foreach}
        </ul>
    <button type="submit">{$MOD.LBL_SAVE}</button>
</form>


        <script>
            {literal}
            $(document).ready(function () {

                $( "#sortable" ).sortable({
                    beforeStop: function( event, ui ) {
                        $(".sort-position").each(function (index, el) {
                            console.log($(this));
                            $(this).val(index);
                        });
                    }
                });
                $( "#sortable" ).disableSelection();
            } );
            {/literal}
        </script>
{literal}
<style>
    .ui-icon{
        float: left;
    }
</style>
{/literal}