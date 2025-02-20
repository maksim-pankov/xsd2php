<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\XML\XSDReader\Schema\Item;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;
use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;

interface NamingStrategy
{
    public function getTypeName(Type $type);

    public function getAnonymousTypeName(Type $type, $parentName);

    public function getItemName(Item $item);

    //@todo introduce common type for attributes and elements
    public function getPropertyName($item);

    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string;
}
