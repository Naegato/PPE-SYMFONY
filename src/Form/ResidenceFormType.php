<?php

namespace App\Form;

use App\Entity\Residence;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResidenceFormType extends AbstractType
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $owners = $this->userRepository->findUserByRoles('["ROLE_ADMINISTRATOR"]');

        $ownerChoice = [];

        foreach ($owners as $owner) {
            $ownerChoice[$owner->getName()] = $owner;
        }

        $representatives = $this->userRepository->findUserByRoles('["ROLE_REPRESENTATIVE"]');

        $representativeChoice = [];

        foreach ($representatives as $representative) {
            $representativeChoice[$representative->getName()] = $representative;
        }

        $builder
            ->add('owner', ChoiceType::class, [
                'choices'  => $ownerChoice,
            ])
            ->add('representative', ChoiceType::class, [
                'choices'  => $representativeChoice,
            ])
            ->add('name')
            ->add('address')
            ->add('city')
            ->add('zip_code')
            ->add('country')
            ->add('inventory_file_form', FileType::class, ['required' => false])
            ->add('image_form', FileType::class, ['required' => false])
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