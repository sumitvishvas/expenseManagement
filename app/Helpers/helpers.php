<?php
function getModelById($modal,$id){

$modal = "\App\Models\\".$modal;

$result = $modal::find($id);

if($result!=null){

    return $result;

    }else{

        return new $modal;

    }

}

?>