<?php
namespace Onlab\MissedMySQLDoctrineTypesBundle\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Enum MySQL implementation
 * 
 * @author Marcus Fernandez <marcus at onlab dot org>
 */
class EnumType extends Type
{
    public function getName()
    {
        return "enum";
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'ENUM(' . $this->getSQLEnumDeclarationValues($fieldDeclaration['value']) . ')';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function getBindingType()
    {
        return \PDO::PARAM_STR;
    }
    
    protected function getSQLEnumDeclarationValues(array $values)
    {
        return "'" . implode("','", $values) . "'";
    }
}