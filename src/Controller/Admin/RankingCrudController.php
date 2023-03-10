<?php

namespace App\Controller\Admin;

use App\Entity\Ranking;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RankingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ranking::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
