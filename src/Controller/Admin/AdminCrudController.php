<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Form\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_SUPER_ADMIN')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username'),
            PasswordField::new('password')
                ->setHtmlAttribute('autocomplete', 'false')
                ->onlyWhenCreating(),
            EmailField::new('email'),
            ArrayField::new('roles')
                ->onlyOnIndex(),
            BooleanField::new('isVerified'),
        ];
    }
}
