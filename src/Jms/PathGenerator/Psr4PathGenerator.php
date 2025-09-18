<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Jms\PathGenerator;

use GoetasWebservices\Xsd\XsdToPhp\PathGenerator\PathGeneratorException;
use GoetasWebservices\Xsd\XsdToPhp\PathGenerator\Psr4PathGenerator as Psr4PathGeneratorBase;

class Psr4PathGenerator extends Psr4PathGeneratorBase implements PathGenerator
{
    public function getPath($yaml)
    {
        $ns = key($yaml);

        foreach ($this->namespaces as $namespace => $dir) {
            $pos = strpos($ns, $namespace);

            if ($pos === 0) {
                if (!is_dir($dir) && !$this->makeDirectory($dir)) {
                    throw new PathGeneratorException("Can't create the folder '$dir'");
                }
                $f = trim(strtr(substr($ns, strlen($namespace)), '\\/', '..'), '.');

                return $dir . '/' . $f . '.yml';
            }
        }
        throw new PathGeneratorException("Unable to determine location to save JMS metadata for class '$ns'");
    }
}
