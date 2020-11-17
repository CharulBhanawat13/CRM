<?php
class DateFilter
{
    function prepareQuery($column,$query) {
        $fromDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        if(!empty($fromDate) && !empty($endDate)){
            $query .= " and ".$column." between '".$fromDate."' and '".$endDate."' ";
        }
        $query .= " ORDER BY ".$column." DESC";
        return $query;
    }
   }
?>