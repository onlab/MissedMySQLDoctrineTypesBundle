<?php

namespace Onlab\MissedMySQLDoctrineTypesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;

class OnlabMissedMySQLDoctrineTypesBundle extends Bundle
{
    public function boot()
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getEntityManager();
        
        Type::addType('enum', 'Rocket\ProcurementBundle\Types\EnumType');
        Type::addType('set',  'Rocket\ProcurementBundle\Types\SetType');
        
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'enum');
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set',  'set');
    }
}
