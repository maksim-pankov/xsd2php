<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;

class ShortFlatNamingStrategy  extends ShortNamingStrategy
{
    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string {
        return $parentClass->getNamespace();
    }

    public function getAnonymousTypeNameForYaml(Type $type, string $typeNamespace, $parentClass, $parentName): string {
        $name = $this->getAnonymousTypeName($type, $parentName);
        return $typeNamespace . '\\' . $name;
    }
}
