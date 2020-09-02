<link rel="stylesheet" href="custom/include/lib/jkanban/jkanban.min.css" />
<script src="custom/include/lib/jkanban/jkanban.min.js"></script>
<div id="myKanban"></div>
{*<button id="addDefault">Add "Default" board</button>*}
{*<br />*}
{*<button id="addToDo">Add element in "To Do" Board</button>*}
{*<br />*}
{*<button id="removeBoard">Remove "Done" Board</button>*}
{*<br />*}
{*<button id="removeElement">Remove "My Task Test"</button>*}
<!-- Большие модальное окно -->
<a class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" id="test_button">test modal</a>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-body">

        </div>
    </div>
</div>

<script>
    {literal}
    $('#test_button').click(function () {
        loadmodalbody();

    });

    function loadmodalbody() {
        $.ajax({
            url: 'index.php?module=Opportunities&action=quickDetail&record=16395f63-ff01-5574-8bba-5f37f130e00b',
            method: 'post',
            dataType: 'html',
            //data: {text: 'Текст'},
            success: function(data){
                $('#modal-body').html(data);
            }
        });
    }
    {/literal}
    var configBord = {$bordConfig|@json_encode};
    var stages={$STAGES};
    var countOpp={$countOpp};
    {literal}
    var bordsData=[];
    var counter=0;
    for (var key in stages) {

        bordsData[counter]={
            'id': "_" + key.replace(/\s+/g, ''),
            'title': stages[key],
            'test-name':key,
            'class': key.replace(/\s+/g, ''),
            'item': []
        };
        counter++;

        console.log(stages[key]);
        console.log(key);
    }
    const bordValue=bordsData;
    console.log(bordsData);


    var KanbanTest = new jKanban({
        element: "#myKanban",
        gutter: "1px",
        widthBoard: "250px",
        dragBoards: false,
        itemHandleOptions:{
            enabled: true,
        },
        click: function(el) {
            console.log("Trigger on all items click!");
        },
        dropEl: function(el, target, source, sibling){
            console.log(target.parentElement.getAttribute('data-id'));
            console.log(el, target, source, sibling)
        },
        buttonClick: function(el, boardId) {
            console.log(el);
            console.log(boardId);
            // create a form to enter element
            var formItem = document.createElement("form");
            formItem.setAttribute("class", "itemform");
            formItem.innerHTML =
                '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="CancelBtn" class="btn btn-default btn-xs pull-right">Cancel</button></div>';

            KanbanTest.addForm(boardId, formItem);
            formItem.addEventListener("submit", function(e) {
                e.preventDefault();
                var text = e.target[0].value;
                KanbanTest.addElement(boardId, {
                    title: text
                });
                formItem.parentNode.removeChild(formItem);
            });
            document.getElementById("CancelBtn").onclick = function() {
                formItem.parentNode.removeChild(formItem);
            };
        },
        addItemButton: false,
        boards: bordValue
    });






    $(document).ready(function () {
        if(countOpp < 100){
            getAllStage();
        }
        if(countOpp >= 100 && countOpp < 1000 ){
            console.log('getDataFromStage');
            getDataFromStage();
        }
    });

    function getDataFromStage() {
        console.log(configBord['stages']);
        for (index = 0; index < configBord['stages'].length; ++index) {
            console.log(configBord['stages'][index]);
            if(configBord['stages'][index]['show']) {
                console.log('index.php?module=BORD_OPPORTUNITIES&action=getData&where[]=' + configBord.stages[index]['name'] + '&to_pdf=true');
                ajax_request('index.php?module=BORD_OPPORTUNITIES&action=getData&where[]=' + configBord.stages[index]['name'] + '&to_pdf=true', 'JSON', '', 'setItems');
            }
        }
    }

    function getAllStage() {
        ajax_request('index.php?module=BORD_OPPORTUNITIES&action=getData&to_pdf=true','JSON','','setItems');
    }
    function setItems(data) {
        console.log(data);
        for (var key in data) {
            for (index = 0; index < data[key].length; ++index) {
                console.log(data[key][index]);
                KanbanTest.addElement("_" + key.replace(/\s+/g, ''),{
                    title:"<p>"+data[key][index]['opportunities_name']+"</p>",
                    idopp:data[key][index]['id'],
                });
            }
        }

    }
    function ajax_request(url,dataType,urlParams,functionName) {
        $.ajax({
            url: url,         /* Куда пойдет запрос */
            method: 'post',             /* Метод передачи (post или get) */
            dataType: dataType,          /* Тип данных в ответе (xml, json, script, html). */
            data: urlParams,     /* Параметры передаваемые в запросе. */
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                if(functionName == 'setItems'){
                    setItems(data);
                }
            }
        });

    }

</script>
    <style>
        #myKanban{
        {/literal}
            height: {$bordConfig.kanban.myKanbanHeight}px;
            overflow-y: {$bordConfig.kanban.myKanbanOverflowY};
            overflow-x: {$bordConfig.kanban.myKanbanOverflowX};
        {literal}
        }
        .kanban-drag{
        {/literal}
            height: {$bordConfig.kanban.kanbandragHeight}px;
            overflow-y: scroll;
        {literal}
        }
        .drag_handler{
            float: none;
        }
    </style>
{/literal}