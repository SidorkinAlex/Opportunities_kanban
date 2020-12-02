# Opportunities Kanban board from SuiteCRM

[Github](https://github.com/SidorkinAlex/Opportunities_kanban) | 
[Ru](#Кабан-доска-сделок-для-SuiteCRM) |
[En](#Opportunities-Kanban-board-from-SuiteCRM)

[install](#install)

## install

## Quick start
Several quick start options are available:
### License
Take me to [pookie](#pookie)
Is published under the AGPLv3 license.


# Кабан доска сделок для SuiteCRM
[Github](https://github.com/SidorkinAlex/Opportunities_kanban) | 
[Ru](#Кабан-доска-сделок-для-SuiteCRM) |
[En](#Opportunities-Kanban-board-from-SuiteCRM)

[Установка](#Установка)

## Установка

Перед установкой необходимо сделать резервную копию файлов системы!

В пакете содержится файл custom/modules/Opportunities/controller.php если у вас в проектк существует данный файл, то его необходимо удалить из пакета вставив в сувой файл custom/modules/Opportunities/controller.php сразу после строк ```class CustomOpportunitiesController extends SugarController
{
```
следующий код:
``` php
public function action_quickDetail(){
         $this->view = 'detail';
     }
```


1 вариант

Для установки необходимо скачать последную версию плагина по ссылке https://github.com/SidorkinAlex/Opportunities_kanban/releases/download/1.00/Opportunities_kanban.zip

Далее в SuiteCRM открыть Загрузчик модулей (Администрирование -> Загрузчик модулей)

Загрузить архив с пакетом

Нажать кнопку установить.

2 вариант:

скачать склогировать проект(```git clone https://github.com/SidorkinAlex/Opportunities_kanban.git```) или скачать его зип архивом.

Скопировать папки проекта в корень SuiteCRM

## Натройка
После установки пакета переходим в модуль Opportunities Board

попадаем на станицу настройки канбан доски
![страница ннастройки](http://web-seedteam.ru/wp-content/uploads/2020/12/%D0%A1%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0-%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B5%D0%BA-1024x479.png)

### Сustomizing columns
Настойка колонок для канбан доски


Для натройки нужной последовательности колонок выставьте нужную вам последовательность сверху вних (будет преобразована в последовательность слева на право)
 ![настройка колонок](http://web-seedteam.ru/wp-content/uploads/2020/12/Страница-настроек-колонок.png)

 установите галочку в чекбоксе display colum для отображениия колонки на канбандоске
 
 установите галочку в чекбоксе display opportunity что бы в колонке выводилиь записи ( не рекомендуется ставить в финальных колонках завершено с успехом и отменено)
 