<?php
class DirectoryMakerComponent extends Object
{

    var $_root_dir = '/var/www';

    function setRootDirectory($root = null){
	if(!is_null($root)){
	    $this->_root_dir = $root;
	}
    }

    function createDirectory($dir_name = null){
	$root_dir = '/var/www/upfiles';
	if(is_null($dir_name)){
	    $dir_name = String::uuid();
	}
	if($this->isDirectoryExists($root_dir, $dir_name)){
	    $dir_name = String::uuid();
	    $this->createDirectory($dir_name);
	}else{
	    mkdir($root_dir . '/' . $dir_name);
	    return $dir_name;
	}
    }

    function isDirectoryExists($root = null, $dir_name = null){
	$flag = False;
	$d = dir($root);
	while($fl = $d->read()){
	    $l = $root . '/' . $fl;
	    $din = pathinfo($l);
	    if(is_dir($l) && ($fl != '..' && $fl != '.')){
		if(strval($din['basename']) == $dir_name){
		    $flag = True;
		    break;
		}
	    }
	}
	return $flag;
    }

}
?>