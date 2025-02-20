<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;

class ShortFlatNamingStrategy  extends ShortNamingStrategy
{
    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string {
        return $parentClass->getNamespace();
    }
}
