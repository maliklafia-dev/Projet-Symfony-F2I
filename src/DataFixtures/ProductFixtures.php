<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private const NB_PRODUCTS = 20;
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $entity = new Product;
            $entity->setName("Product $i");
            $entity->setPrice(mt_rand(1, 999));
            $entity->setDescription("Description product $i");
            $entity->setQuantity(mt_rand(0, 10));
            $entity->setImage('image.jpg');
            $manager->persist($entity);
        }
        // $product = new Product();

        $manager->flush();
    }
}
