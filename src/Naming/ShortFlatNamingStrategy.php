<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;

class ShortFlatNamingStrategy  extends ShortNamingStrategy
{
    

    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string {
        return $parentClass->getNamespace() . '\\' . $parentClass->getName();
    }

    public function getAnonymousTypeNameForYaml(Type $type, string $typeNamespace, $parentClass, $parentName): string {
        $res = $parentClass . DIRECTORY_SEPARATOR . $this->getAnonymousTypeName($type, $parentName);
        return $res;
    }

    public function getAnonymousTypeName(Type $type, $parentName)
    {
        return $this->classify($parentName) . 'AType';
    }
}
