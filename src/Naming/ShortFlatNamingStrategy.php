<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use GoetasWebservices\Xsd\XsdToPhp\Php\Structure\PHPClass;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;

class ShortFlatNamingStrategy  extends ShortNamingStrategy
{
    private array $knownAnonymousTypeNames = [];

    public function getAnonymousTypeNamespace(PHPClass $class, PHPClass $parentClass): string {
        return $parentClass->getNamespace() . '\\' . $parentClass->getName();
    }

    public function getAnonymousTypeNameForYaml(Type $type, string $typeNamespace, $parentClass, $parentName): string {
        $res = $typeNamespace . '\\' . $this->getAnonymousTypeName($type, $parentName);

        if (array_key_exists($res, $this->knownAnonymousTypeNames)) {
            $this->knownAnonymousTypeNames[$res] += 1;
            $newName = $parentName . "_" . $this->knownAnonymousTypeNames[$res];
            $res = $typeNamespace . '\\' . $this->getAnonymousTypeName($type, $newName);
            return $res;
        }

        $this->knownAnonymousTypeNames[$res] = 1;
        return $res;
    }

    public function getAnonymousTypeName(Type $type, $parentName)
    {
        return $this->classify($parentName) . 'AType';
    }
}
