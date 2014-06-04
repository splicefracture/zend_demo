<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {

        $this->_helper->layout->setLayout('layout');
    }

    public function restaurantsAction()
    {
        
        $this->_helper->layout->disableLayout();

        $restaurants = RestaurantQuery::create()
                ->joinWith('Restaurant.Cuisine')
                ->orderById('desc')
                ->find();

        $items = array();

        foreach($restaurants as $row){
            $id = $row->getId();
            $cuisine_name = $row->getCuisine()->getName();
            $name = $row->getName();

            $items[]  = array( "id"=>$id,"name"=>$name, "cuisine"=>$cuisine_name );
        }

        $this->view->data = json_encode($items);
    }
}

