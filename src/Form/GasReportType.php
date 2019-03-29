<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GasReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfPresentNotation', DateType::class, array(
            	'data' => new \DateTime("now"),
            	'label' => false
            ))
            ->add('presentMeterStatus', NumberType::class, array(
            	'label' => false,
            	'attr' => [
            		'placeholder' => 'Bierzący stan licznika'
            	]
            ))
            ->add('submit', SubmitType::class);
    }
}