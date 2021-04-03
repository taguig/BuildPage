<?php

/**
 *
 * @author 2019
 *        
 */
interface IbuildView
{
    public function getView ();
    public function getCss();
    public function getJs();
    public function getBody ();
    public function getAllview();
    public function getFont();
    public function addStyleParent($Style);
    public function getAtrributStyle();
    public function GetValueStyleParent ($propriter);
    public function updateStyleView();
    public function getParentView();
    public function  addParent (&$parent);
    public function  getValueAtrribueStyle($prop);
}

