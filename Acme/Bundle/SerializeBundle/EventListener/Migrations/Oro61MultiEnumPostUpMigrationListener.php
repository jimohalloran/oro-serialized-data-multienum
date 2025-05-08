<?php

namespace Acme\Bundle\SerializeBundle\EventListener\Migrations;

use Acme\Bundle\SerializeBundle\Migrations\RemoveMultiEnumAddRemoveKeys;
use Oro\Bundle\MigrationBundle\Event\PostMigrationEvent;

class Oro61MultiEnumPostUpMigrationListener
{
    public function __construct(
        protected RemoveMultiEnumAddRemoveKeys $migration
    ) { }

    /**
     * POST UP event handler
     */
    public function onPostUp(PostMigrationEvent $event)
    {
        $event->addMigration(
            $this->migration
        );
    }

}
