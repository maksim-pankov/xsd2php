<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;

class ShortFlatNamingStrategy  extends ShortNamingStrategy
{
    private array $knownAnonymousTypeNames = [];

    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string {
        return $parentClass->getNamespace();
    }

    public function getAnonymousTypeNameForYaml(Type $type, string $typeNamespace, $parentClass, $parentName): string {
        $name = $this->getAnonymousTypeName($type, $parentName);
        return $typeNamespace . '\\' . $name;
    }

    public function getAnonymousTypeName(Type $type, $parentName)
    {
        $res = $this->classify($parentName) . 'AType';
        if (array_key_exists($res, $this->knownAnonymousTypeNames)) {
            $this->knownAnonymousTypeNames[$res] += 1;
            $counter = $this->knownAnonymousTypeNames[$res];
            $newName = $parentName . "_" . str($counter);
            $res = $this->classify($newName) . 'AType';
            return $res;
        }

        $this->knownAnonymousTypeNames[$res] = 1;
        return $res;
    }
}
