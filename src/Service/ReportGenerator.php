<?php

namespace App\Service;

use App\Entity\GasOptions;
use Doctrine\ORM\EntityManagerInterface;

class ReportGenerator
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getOptions()
    {
        $GasOptions = $this->em->getRepository(GasOptions::class)->findAll();
        $options = $GasOptions[0];
        return $options;
    }

    public function setDataForReport($formData)
    {
        $options = $this->getOptions();
        $formData->setDateOfLastNotation($options->getDateOfLastNotation());
        $formData->setLastMeterStatus($options->getLastMeterStatus());
        $interval = date_diff($formData->getDateOfLastNotation(), $formData->getDateOfPresentNotation());
        $days = $interval->format('%a');
        $months = $interval->format('%m');
        $m3 = $formData->getPresentMeterStatus() - $formData->getLastMeterStatus();
        $kwh = $m3 * 11.244;
        $fullGasPrice = $options->getGasPrice() * $kwh;
        $subscribtionPrice =  $options->getSubscription() * $months;
        $priceForTimeDistribution = $options->getDistributionConstant() / 30 * $days;
        $priceForVolDistribution = $options->getDistributionVariable() * $kwh;
        $amount = ($fullGasPrice + $subscribtionPrice + $priceForTimeDistribution + $priceForVolDistribution); 
        $fullAmount = $amount + $amount * 0.23;
        $formData->setAmount($fullAmount);
        $days > 0 ? $averageM3 = $m3/$days : $averageM3 = 0;
        $days > 0 ? $averageKWh = $kwh/$days : $averageKWh = 0;
        $formData->setAverageM3($averageM3);
        $formData->setAverageKWh($averageKWh);

        return $formData;
    }

    public function actualizeOptions($formData)
    {
        $options = $this->getOptions();
        $options->setDateOfLastNotation($formData->getDateOfPresentNotation());
        $options->setLastMeterStatus($formData->getPresentMeterStatus());
        $this->em->persist($options);
        $this->em->flush();
    }

    public function editDataInReport($data)
    {
        $options = $this->getOptions();
        $interval = date_diff($data->getDateOfLastNotation(), $data->getDateOfPresentNotation());
        $days = $interval->format('%a');
        $months = $interval->format('%m');
        $m3 = $data->getPresentMeterStatus() - $data->getLastMeterStatus();
        $kwh = $m3 * 11.244;
        $fullGasPrice = $options->getGasPrice() * $kwh;
        $subscribtionPrice =  $options->getSubscription() * $months;
        $priceForTimeDistribution = $options->getDistributionConstant() / 30 * $days;
        $priceForVolDistribution = $options->getDistributionVariable() * $kwh;
        $amount = ($fullGasPrice + $subscribtionPrice + $priceForTimeDistribution + $priceForVolDistribution); 
        $fullAmount = $amount + $amount * 0.23;
        $data->setAmount($fullAmount);
        $days > 0 ? $averageM3 = $m3/$days : $averageM3 = 0;
        $days > 0 ? $averageKWh = $kwh/$days : $averageKWh = 0;
        $data->setAverageM3($averageM3);
        $data->setAverageKWh($averageKWh);

        return $data;
    }
}