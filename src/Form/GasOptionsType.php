<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GasOptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfLastNotation', DateType::class)
            ->add('lastMeterStatus', NumberType::class)
            ->add('gasPrice', NumberType::class)
            ->add('subscription', NumberType::class)
            ->add('distributionConstant', NumberType::class)
            ->add('distributionVariable', NumberType::class)
            ->add('submit', SubmitType::class);
    }
}