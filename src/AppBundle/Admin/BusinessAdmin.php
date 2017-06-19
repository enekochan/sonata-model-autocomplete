<?php

namespace AppBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Business;
use AppBundle\Entity\City;

class BusinessAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $this->setTemplate('edit', 'SonataAdminBundle:CRUD:edit.html.twig');

        /** @var $business \AppBundle\Entity\Business */
        $business = $this->getSubject();

        $formMapper
            ->add(
                'name',
                'text',
                array(
                    'label' => 'admin.label.name',
                    'required' => true,
                )
            )
            ->add(
                'city',
                ModelAutocompleteType::class,
                array(
                    'label' => 'admin.label.city',
                    'required' => true,
                    'multiple' => false,
                    'property' => 'name',
                    'callback' => function ($admin, $property, $value) {
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            ->andWhere($queryBuilder->getRootAlias() . '.status = :status')
                            ->setParameter('status', City::STATUS_ENABLED)
                        ;
                        $datagrid->setValue($property, null, $value);
                    },
                )
            )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add(
                'name',
                null,
                array(
                    'label' => 'admin.label.name',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'admin.label.city',
                ),
                null,
                array(
                    'class' => 'AppBundle\Entity\City',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->andWhere('c.status = ' . City::STATUS_ENABLED)
                            ->orderBy('c.name', 'ASC');
                    },
                )
            )
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add(
                'name',
                null,
                array(
                    'label' => 'admin.label.name',
                )
            )
            ->add('city',
                null,
                array(
                    'label' => 'admin.label.city',
                )
            )
        ;
    }
}
