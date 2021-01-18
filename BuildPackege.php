<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 06.01.21
 * Time: 22:48
 */
if (!function_exists('print_array')) {
    function print_array($var, $exit = false, $in_file = false)
    {
        if($in_file) ob_start();

        if (!$in_file) echo '<pre>';
        print_r($var);
        if (!$in_file) echo '</pre>' . "\n";
        if ($in_file) $content = ob_get_contents();

        if(isset($GLOBALS['print_array_filename']) AND $GLOBALS['print_array_filename'] != '') {
            $filename = $GLOBALS['print_array_filename'];
        } else {
            $filename = 'print_array.log';
        }
        if ($in_file) {
            $file = fopen("cache/" . $filename, "a+");
            fwrite($file, "\n\n******************************\n");
            fwrite($file, date("Y-m-d H:i:s") . "\n");
            fwrite($file, $content);
            fclose($file);
            empty($file);

            ob_end_clean();
        }

        if ($exit) exit;
    }
}
//include_once 'include/utils.php';
function is_in_str($str,$substr)
{
    $result = strpos ($str, $substr);
    if ($result === FALSE) // если это действительно FALSE, а не ноль, например
        return false;
    else
        return true;
}
function copy_dir($src, $drc)
{
    $dir = opendir($src);

    if (!is_dir($drc)) {
        mkdir($drc, 0777, true);
    }

    while (false !== ($file = readdir($dir))) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copy_dir($src . '/' . $file, $drc . '/' . $file);
            } else {
                copy($src . '/' . $file, $drc . '/' . $file);
            }
        }
    }

    closedir($dir);
}

function zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', DIRECTORY_SEPARATOR, realpath($source));
    $source = str_replace('/', DIRECTORY_SEPARATOR, $source);

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source),
            RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            $file = str_replace('/', DIRECTORY_SEPARATOR, $file);

            if ($file == '.' || $file == '..' || empty($file) || $file == DIRECTORY_SEPARATOR) {
                continue;
            }
            // Ignore "." and ".." folders
            if (in_array(substr($file, strrpos($file, DIRECTORY_SEPARATOR) + 1), array('.', '..'))) {
                continue;
            }

            $file = realpath($file);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            $file = str_replace('/', DIRECTORY_SEPARATOR, $file);

            if (is_dir($file) === true) {
                $d = str_replace($source . DIRECTORY_SEPARATOR, '', $file);
                if (empty($d)) {
                    continue;
                }
                $zip->addEmptyDir($d);
            } elseif (is_file($file) === true) {
                $zip->addFromString(str_replace($source . DIRECTORY_SEPARATOR, '', $file),
                    file_get_contents($file));
            } else {
                // do nothing
            }
        }
    } elseif (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}


class BuildPackege {
    public $packeg_file_array=[];
    public $cornPath = 'build';
    function __construct()
    {
        $this->packeg_file_array = include 'buildConfig.php';
    }

    public function buildPackege(){
        foreach ($this->packeg_file_array as $file_arr){
            $this->copyFileOrDirInBuild($file_arr);
        }
    }

    private function copyFileOrDirInBuild(array $file_arr)
    {
        if(is_dir($file_arr['from'])){
            $this->copyDir($file_arr);
        }
        else {
            $this->copyFile($file_arr);
        }
    }

    private function copyDir(array $file_arr){
        if(is_dir($file_arr['to'])){
            $this->checkAndCreateDir($this->cornPath.'/'.$file_arr['to']);
        }
        copy_dir($file_arr['from'],$this->cornPath.'/'.$file_arr['to']);

    }

    private function checkAndCreateDir($path){
        print_array($path);
        $dir_arr=[];
        $dir_arr=explode('/',$path);
        $pathInFor='';
        foreach ($dir_arr as $dir_step){
            $pathInFor.=$dir_step.'/';

            if(!file_exists($pathInFor)){
               mkdir($pathInFor);
            }
        }
    }

    private function copyFile(array $file_arr){
        $path=explode('/',$this->cornPath.'/'.$file_arr['to']);
        $fileName = array_pop($path);
        $dirNameTo = implode('/', $path);
        $this->checkAndCreateDir($dirNameTo);
        usleep(100);
        if(!copy($file_arr['from'],$this->cornPath.'/'.$file_arr['to'])){
            echo '<br>$file_arr[\'from\']= '. $file_arr['from'] . ' $this->cornPath.\'/\'.$file_arr[\'to\']='. $this->cornPath.'/'.$file_arr['to'];
        }
    }
}

$build= new BuildPackege();
$build->buildPackege();
zip('build/','build/Build.zip');