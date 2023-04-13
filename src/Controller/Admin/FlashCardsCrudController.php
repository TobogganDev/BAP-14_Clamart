<?php

namespace App\Controller\Admin;

use App\Entity\FlashCards;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FlashCardsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FlashCards::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
	        ImageField::new('pictureUrl')
		        ->setUploadDir('public/uploads/flashCards')
		        ->setBasePath('uploads/flashCards')
		        ->setUploadedFileNamePattern('[randomhash].[extension]'),
        ];
    }
    
}
