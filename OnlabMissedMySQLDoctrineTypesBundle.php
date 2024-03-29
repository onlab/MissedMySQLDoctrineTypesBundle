<?php
namespace Onlab\MissedMySQLDoctrineTypesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;

/**
 * Main bundle bootstrap and setup class
 * 
 * @author Marcus Fernandez <marcus at onlab dot org>
 */
class OnlabMissedMySQLDoctrineTypesBundle extends Bundle
{
    public function boot()
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getEntityManager();
        
        Type::addType('enum', 'Onlab\MissedMySQLDoctrineTypesBundle\Types\EnumType');
        Type::addType('set',  'Onlab\MissedMySQLDoctrineTypesBundle\Types\SetType');
        
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'enum');
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set',  'set');
    }
}
