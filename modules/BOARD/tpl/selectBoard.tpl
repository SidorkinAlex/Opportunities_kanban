<div role="tabpanel" class="tab-pane active" id="tab-single-latest-0">
    <div class="box clearfix">
        <div class="row  mobile-carousel ">
            {foreach from=$moduleKanbanList key='row' item='ModuleName'}
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 item-board">
                    <a href="/index.php?module=BOARD&action=index&recipient_module={$ModuleName}">
                        <div class="product-thumb transition ">

                            <div class="caption">
                                <div class="name">
                                    {$APP_LIST_STRINGS.moduleList[$ModuleName]}
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            {/foreach}

        </div>
    </div>
</div>
{literal}
    <style>
        .item-board {
            padding: 10px;
        }
        .product-thumb {
            background: #ccc;
            min-height: 70px;
            padding: 10px;
        }
        .product-thumb:hover {
            background: #ddd;
        }
    </style>
    {/literal}