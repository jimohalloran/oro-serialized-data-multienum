<?php

namespace Acme\Bundle\SerializeBundle\Migrations\Data\ORM;

use Oro\Bundle\EntityExtendBundle\Migration\Fixture\AbstractEnumFixture;

/**
 * Load acme demo enum data.
 */
class LoadDemoEnumData extends AbstractEnumFixture
{
    #[\Override]
    protected function getData(): array
    {
        return [
            'alpha' => 'Alpha',
            'bravo' => 'Bravo',
            'charlie' => 'Charlie',
            'delta' => 'Delta',
            'echo' => 'Echo',
            'foxtrot' => 'Foxtrot',
            'golf' => 'Golf',
            'india' => 'India',
        ];
    }

    #[\Override]
    protected function getDefaultValue(): string
    {
        return 'alpha';
    }

    #[\Override]
    protected function getEnumCode(): string
    {
        return 'acme_enum';
    }
}
