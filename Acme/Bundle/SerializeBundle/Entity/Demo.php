<?php
/**
 *
 *
 * @package    wing-crm
 * @author     Jim O'Halloran <jim.ohalloran@incore.com.au>
 * @copyright  (c) 2019 InCore
 */


namespace Acme\Bundle\SerializeBundle\Entity;

use Acme\Bundle\SerializeBundle\Entity\Repository\DemoRepository;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;

/**
 * Demonstration Entity
 */
#[ORM\Entity(repositoryClass: DemoRepository::class)]
#[ORM\Table(name: 'acme_demo')]
#[Config(
    routeName: 'acme_demo_index',
    routeView: 'acme_demo_view',
    routeUpdate: 'acme_demo_update',
    defaultValues: [
        'entity' => ['icon' => 'fa-calendar-day'],
        'workflow' => ['show_step_in_grid' => false],
        'dataaudit' => ['auditable' => true],
        'security' => [
            'type' => 'ACL',
            'permissions' => 'All',
            'group_name' => '',
            'category' => 'wing',
        ],
        'form' => [
            'form_type' => 'Acme\Bundle\SerializeBundle\Form\Type\DemoType',
            'grid_name' => 'demo-entity-grid'
        ],
        'grid' => [
            'default' => 'demo-entity-grid',
            'context' => 'demo-entity-grid',
        ],
    ]
)]
class Demo implements DatesAwareInterface, \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface
{
    use \Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
    use DatesAwareTrait;

    /**
     * @var integer
     */
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;

    /**
     * @var ?string
     */
    #[ORM\Column(name: 'name', type: 'string', length: 100, nullable: false)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    protected $name;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Demo
    {
        $this->name = $name;
        return $this;
    }


    #[\Override]
    public function __toString(): string
    {
        return $this->getName();
    }


    public function __construct()
    {
    }

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
        }

        $this->cloneExtendEntityStorage();
    }
}
