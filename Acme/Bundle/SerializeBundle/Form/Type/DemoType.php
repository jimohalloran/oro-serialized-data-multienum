<?php
/**
 *
 *
 * @package    wing-crm
 * @author     Jim O'Halloran <jim.ohalloran@incore.com.au>
 * @copyright  (c) 2019 InCore
 */


namespace Acme\Bundle\SerializeBundle\Form\Type;

use Acme\Bundle\SerializeBundle\Entity\Demo;
use Oro\Bundle\EntityExtendBundle\Form\Type\EnumSelectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Wing\Bundle\CommonBundle\Entity\ExtruderType;

/**
 * Form type definition for extruder type add/edit form.
 *
 * @package Wing\Bundle\CommonBundle\Form
 */
class DemoType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'acme.serialize.demo.name.label',
                ]
            )
            ->add(
                'letters',
                EnumSelectType::class,
                [
                    'required' => false,
                    'label' => 'acme.serialize.demo.letters.label',
                    'enum_code' => 'acme_enum',
                    'multiple' => true,
                    'expanded' => true,
                    'is_dynamic_field' => true,
                ]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demo::class,
        ]);
    }

    public function getName()
    {
        return 'demo';
    }
}
