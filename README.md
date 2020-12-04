# Opportunities Kanban board from SuiteCRM

[Github](https://github.com/SidorkinAlex/Opportunities_kanban) | 
[Ru](#Кабан-доска-сделок-для-SuiteCRM) |
[En](#Opportunities-Kanban-board-from-SuiteCRM)

![image](http://web-seedteam.ru/wp-content/uploads/2020/12/Снимок-экрана-от-2020-12-04-18-12-29.png)
![image](http://web-seedteam.ru/wp-content/uploads/2020/12/Снимок-экрана-от-2020-12-04-18-38-51.png)


## Installation

Before installation, you must make a backup copy of the system files!

The package contains the file custom/modules/Opportunities/controller.php, if this file exists in your project, then it must be removed from the package by inserting the custom / modules / Opportunities / controller.php file into the suva file immediately after the lines 

```
 class CustomOpportunitiesController extends SugarController
{
```

following code:

``` php
public function action_quickDetail () {
         $ this-> view = 'detail';
     }
```


Option 1

To install, you need to download the latest version of the plugin from the link https://github.com/SidorkinAlex/Opportunities_kanban/releases/download/1.00/Opportunities_kanban.zip

Then in SuiteCRM open the Module Loader (Administration -> Module Loader)

Download package archive

Click the install button.

Option 2:

download sclog the project (``` git clone https://github.com/SidorkinAlex/Opportunities_kanban.git```) or download it in a zip archive.

Copy project folders to SuiteCRM root

## Setting
After installing the package, go to the Opportunities Board module

we get to the Kanban board settings page
![settings page](http://web-seedteam.ru/wp-content/uploads/2020/12/%D0%A1%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0-%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B5%D0%BA-1024x479.png)

### Customizing columns
Configuring speakers for a kanban board


To set the desired column sequence, set the sequence you need from top to bottom (will be converted to a sequence from left to right)
 ![column settings](http://web-seedteam.ru/wp-content/uploads/2020/12/%D0%A1%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0-%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B5%D0%BA-%D0%BA%D0%BE%D0%BB%D0%BE%D0%BD%D0%BE%D0%BA.png)

 check the display colum checkbox to display the column on kanbandosk
 
 check the display opportunity checkbox to display the record in the column (it is not recommended to check completed with success and canceled in the final columns)
 
 
 ### Customizing header fields
 Setting the fields that will be displayed in the card lining, if there are several fields, then they will be separated by the symbol -
 ![setting the titles of the cards](http://web-seedteam.ru/wp-content/uploads/2020/12/screenshot-0.0.0.0-2020.12.04-18_00_14.png)
 
 
### Board column height

   Specifies the height of the board on the page
![board height](http://web-seedteam.ru/wp-content/uploads/2020/12/screenshot-0.0.0.0-2020.12.04-18_06_18.png)

### License
MIT


# Кабан доска сделок для SuiteCRM
[Github](https://github.com/SidorkinAlex/Opportunities_kanban) | 
[Ru](#Кабан-доска-сделок-для-SuiteCRM) |
[En](#Opportunities-Kanban-board-from-SuiteCRM)

[Установка](#Установка)

## Установка

Перед установкой необходимо сделать резервную копию файлов системы!

В пакете содержится файл custom/modules/Opportunities/controller.php если у вас в проектк существует данный файл, то его необходимо удалить из пакета вставив в сувой файл custom/modules/Opportunities/controller.php сразу после строк 

```class CustomOpportunitiesController extends SugarController
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
 
 
 ### Сustomizing header fields
 Настройка полей которые будут выводиться в залоговке карточки, если полей несколько то они будут разделены символом  -
 ![настройка заголовков карточек](http://web-seedteam.ru/wp-content/uploads/2020/12/screenshot-0.0.0.0-2020.12.04-18_00_14.png)
 
 
### Board column height

   Определяет высоту доски на странице
![высота доски](http://web-seedteam.ru/wp-content/uploads/2020/12/screenshot-0.0.0.0-2020.12.04-18_06_18.png)
