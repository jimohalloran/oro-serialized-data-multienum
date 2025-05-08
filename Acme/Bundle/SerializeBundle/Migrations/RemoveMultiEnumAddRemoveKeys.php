<?php

declare(strict_types=1);

namespace Acme\Bundle\SerializeBundle\Migrations;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManagerInterface;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityConfigBundle\Entity\EntityConfigModel;
use Oro\Bundle\EntityConfigBundle\Entity\FieldConfigModel;
use Oro\Bundle\EntityConfigBundle\Entity\Repository\FieldConfigModelRepository;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Wing\Bundle\CommonBundle\Migrations\SchemaMigrationAbstract;

class RemoveMultiEnumAddRemoveKeys extends SchemaMigrationAbstract
{
    public function __construct(
        protected Registry $doctrine,
    ) { }

    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        $em = $this->doctrine->getManagerForClass(FieldConfigModel::class);
        /** @var FieldConfigModelRepository $fieldRepo */
        $fieldRepo = $em->getRepository(FieldConfigModel::class);

        /** @var FieldConfigModel[] $columns */
        $columns = $fieldRepo->createQueryBuilder('f')
            ->where('f.type = :type')
            ->setParameter('type', 'multiEnum')
            ->getQuery()
            ->getResult();

        foreach ($columns as $column) {
            /** @var EntityConfigModel $entity */
            $entity = $column->getEntity();
            // Don't messs with anything in the Oro namespace!
            if (substr($entity->getClassName(), 0, 2) !== 'Oro') {
                $extend = $entity->toArray('extend');
                if (isset($extend['schema']['addremove'][$column->getFieldName()])) {
                    unset($extend['schema']['addremove'][$column->getFieldName()]);
                    $entity->fromArray('extend', $extend);
                    $em->persist($entity);
                }
            }
        }

        $em->flush();
    }
}
