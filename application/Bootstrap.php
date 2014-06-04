<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initPropel()
    {
        require_once '/usr/share/php/propel/Propel.php';
        $opts = $this->getOptions();
        Propel::init($opts['propelConfig']);

        return Propel::getConnection();
    }

}

