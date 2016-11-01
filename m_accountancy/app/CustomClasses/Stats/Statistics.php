<?php
namespace App\CustomClasses\Stats;

 class Statistics
{
     private $labels;
     private $datasets;

     public function __construct($labels = null,$datesets = null)
     {
         $this->labels = $labels;
         $this->datasets = $datesets;
     }

     public function setLabels($label)
     {
         if(is_array($label)){
             $this->labels = $label;
         }else{
             $this->labels[] = $label;
         }
     }

     public function setDatasets($datasets)
     {
         if(is_array($datasets)){
             $this->datasets = $datasets;
         }else{
             $this->datasets[] = $datasets;
         }
     }

     public function getLabels()
     {
         return $this->labels;
     }

     public function getDatasets()
     {
         return $this->datasets;
     }

     public function toArray()
     {
         $statisticArray = array(
             'labels' => $this->labels,
             'datasets' => $this->datasets
         );
         return $statisticArray;
     }
 }