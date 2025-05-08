<?php
/**
 *
 *
 * @package    wing-crm
 * @author     Jim O'Halloran <jim.ohalloran@incore.com.au>
 * @copyright  (c) 2019 InCore
 */


namespace Acme\Bundle\SerializeBundle\Controller;

use Acme\Bundle\SerializeBundle\Entity\Demo;
use Acme\Bundle\SerializeBundle\Form\Type\DemoType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Oro\Bundle\UIBundle\Route\Router;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use Wing\Bundle\CommonBundle\Entity\ExtruderType;
use Wing\Bundle\CommonBundle\Form\Type\ExtruderTypeType;

/**
 * Controller for extruder type CRUD
 */
#[Route("/demo")]
class DemoController extends AbstractController
{
    public function __construct(
        protected UpdateHandlerFacade $updateHandler,
        protected TranslatorInterface $translator,
    ) {
    }


    #[Route("/", name: "acme_demo_index")]
    #[Template]
    #[Acl(id: 'acme_demo_view', type: 'entity', class: Demo::class, permission: 'VIEW')]
    public function indexAction()
    {
        return [];
    }


    #[Route("/{id}", name: "acme_demo_view", requirements: ['id' => "\d+"])]
    #[Template]
    #[AclAncestor('acme_demo_view')]
    public function viewAction(Demo $entity)
    {
        return ['entity' => $entity];
    }


    #[Route("/create", name: "acme_demo_create")]
    #[Template('@AcmeSerialize/demo/update.html.twig')]
    #[Acl(id: 'acme_demo_create', type: 'entity', class: Demo::class, permission: 'CREATE')]
    public function createAction()
    {
        return $this->update(new Demo());
    }


    #[Route("/edit/{id}", name: "acme_demo_update", requirements: ['id' => "\d+"])]
    #[Template('@AcmeSerialize/demo/update.html.twig')]
    #[Acl(id: 'acme_demo_update', type: 'entity', class: Demo::class, permission: 'EDIT')]
    public function editAction(Demo $entity)
    {
        return $this->update($entity);
    }

    private function update(Demo $entity): array|RedirectResponse
    {
        return $this->updateHandler->update(
            $entity,
            $this->createForm(DemoType::class, $entity),
            $this->translator->trans('acme.demo.Demo.saved')
        );
    }
}
