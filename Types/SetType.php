<?php
namespace Onlab\MissedMySQLDoctrineTypesBundle\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;

/**
 * Set MySQL implementation
 * 
 * @author Marcus Fernandez <marcus at onlab dot org>
 */
class SetType extends Type
{
    public function getName()
    {
        return "set";
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'SET(' . $this->getSQLSetDeclarationValues($fieldDeclaration['values']) . ')';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $values = array();
        
        $individualValue = strtok($value, ',');
        while ($individualValue !== false) {
            $values[] = $individualValue;
            $individualValue = strtok(',');
        }
        
        return $values;
    }
    
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return implode(',', $value);
    }

    public function getBindingType()
    {
        return \PDO::PARAM_STR;
    }
    
    protected function getSQLSetDeclarationValues(array $values)
    {
        return "'" . implode("','", $values) . "'";
    }
}