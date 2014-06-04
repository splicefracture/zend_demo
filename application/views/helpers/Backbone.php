<?php

class Zend_View_Helper_Backbone {
        
    function partialTemplate( $view, $partial, $keys, $id="" ){

    	$data = $keys;
    	array_walk($data,function(&$item){
    		$item = "<%= ".$item." %>";
    	});

    	$data = array_combine($keys,$data);

        $templ = $view->partial($partial, $data);

        $idstr = !empty($id) ? "id='".$id."'" : "";
        return "<script type='text/template>' ".$idstr.">".$templ."</script>";

    }
}
