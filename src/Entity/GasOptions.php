<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GasOptionsRepository")
 */
class GasOptions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfLastNotation;

    /**
     * @ORM\Column(type="integer")
     */
	private $lastMeterStatus;

    /**
     * @ORM\Column(type="decimal", scale=5)
     */
	private $gasPrice;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
	private $subscription;

	//ilość dni
	/**
     * @ORM\Column(type="decimal", scale=2)
     */
	private $distributionConstant;

	//przesył gazu
    /**
     * @ORM\Column(type="decimal", scale=5)
     */
	private $distributionVariable;


	public function getId()
	{
		return $this->id;
	}

	//dateOfLastNotation

	public function getDateOfLastNotation()
	{
		return $this->dateOfLastNotation;
	}

	public function setDateOfLastNotation($dateOfLastNotation)
	{
		$this->dateOfLastNotation = $dateOfLastNotation;
	}

		public function getFormatDate()
	{
		return $this->dateOfLastNotation->format('Y-m-d');
	}

	//lastMeterStatus
	public function getLastMeterStatus()
	{
		return $this->lastMeterStatus;
	}

	public function setLastMeterStatus($lastMeterStatus)
	{
		$this->lastMeterStatus = $lastMeterStatus;
	}

	//gasPrice
	public function getGasPrice()
	{
		return $this->gasPrice;
	}

	public function setGasPrice($gasPrice)
	{
		$this->gasPrice = $gasPrice;
	}

	//subscription
	public function getSubscription()
	{
		return $this->subscription;
	}

	public function setSubscription($subscription)
	{
		$this->subscription = $subscription;
	}

	//distributionConstant
	public function getDistributionConstant()
	{
		return $this->distributionConstant;
	}

	public function setDistributionConstant($distributionConstant)
	{
		$this->distributionConstant = $distributionConstant;
	}

	//distributionVariable
	public function getDistributionVariable()
	{
		return $this->distributionVariable;
	}

	public function setDistributionVariable($distributionVariable)
	{
		$this->distributionVariable = $distributionVariable;
	}
}