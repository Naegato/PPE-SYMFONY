<?php

namespace App\Form;

use App\Entity\Residence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResidenceModifyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('city')
            ->add('zip_code')
            ->add('country')
//            ->add('inventory_file', FileType::class, ['data_class' => null,'required' => false])
//            ->add('image', FileType::class, ['data_class' => null,'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Residence::class,
        ]);
    }
}


//#[ORM\Column(type: 'string', length: 255)]
//    private $name;
//
//    #[ORM\Column(type: 'string', length: 255)]
//    private $address;
//
//    #[ORM\Column(type: 'string', length: 255)]
//    private $city;
//
//    #[ORM\Column(type: 'string', length: 45)]
//    private $zip_code;
//
//    #[ORM\Column(type: 'string', length: 255)]
//    private $country;
//
//    #[ORM\Column(type: 'string', length: 255)]
//    private $inventory_file;
//
//    #[ORM\ManyToOne(targetEntity: User::class)]
//    #[ORM\JoinColumn(nullable: false)]
//    private $owner;
//
//    #[ORM\ManyToOne(targetEntity: User::class)]
//    #[ORM\JoinColumn(nullable: false)]
//    private $representative;
//
//    #[ORM\Column(type: 'text')]
//    private $image;