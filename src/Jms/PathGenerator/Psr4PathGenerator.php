<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Jms\PathGenerator;

use GoetasWebservices\Xsd\XsdToPhp\PathGenerator\PathGeneratorException;
use GoetasWebservices\Xsd\XsdToPhp\PathGenerator\Psr4PathGenerator as Psr4PathGeneratorBase;

class Psr4PathGenerator extends Psr4PathGeneratorBase implements PathGenerator
{
    private array $usedFileNames = [];

    public function getPath($yaml)
    {
        $ns = key($yaml);

        foreach ($this->namespaces as $namespace => $dir) {
            $pos = strpos($ns, $namespace);

            if ($pos === 0) {
                if (!is_dir($dir) && !$this->makeDirectory($dir)) {
                    throw new PathGeneratorException("Can't create the folder '$dir'");
                }

                $typeName = end(explode('\\', str_replace('/', '\\' , $ns)));
                $fileName = $typeName;

                $res = $dir . '/' . $fileName . '.yml';

                $usedFileNames = $this->usedFileNames[$namespace] ?? [];

                if (array_key_exists($res, $usedFileNames)) {
                    $usedFileNames[$res] += 1;
                    $fileName = $typeName . "_" . $usedFileNames[$res];
                    $res = $dir . '/' . $fileName . '.yml';
                } else {
                    $usedFileNames[$res] = 1;
                }

                $this->usedFileNames[$namespace] = $usedFileNames;
                return $res;
            }
        }
        throw new PathGeneratorException("Unable to determine location to save JMS metadata for class '$ns'");
    }
}
