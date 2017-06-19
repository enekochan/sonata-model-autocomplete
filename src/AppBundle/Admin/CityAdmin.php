<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CityAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
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
                'status',
                'choice',
                array(
                    'label' => 'admin.label.status',
                    'choices' => array(
                        0 => 'Disabled',
                        1 => 'Enabled',
                    ),
                    'required' => true,
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
                'status',
                'doctrine_orm_string',
                array(
                    'label' => 'admin.label.status',
                ),
                'choice',
                array(
                    'choices' => array(
                        0 => 'Disabled',
                        1 => 'Enabled',
                    ),
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
            ->add(
                'status',
                'choice',
                array(
                    'label' => 'admin.label.status',
                    'choices' => array(
                        0 => 'Disabled',
                        1 => 'Enabled',
                    ),
                )
            )
        ;
    }
}
