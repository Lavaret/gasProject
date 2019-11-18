<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GasReportRepository")
 */
class GasReport
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
     * @ORM\Column(type="date")
     */
	private $dateOfPresentNotation;

    /**
     * @ORM\Column(type="integer")
     */
	private $presentMeterStatus;

    /**
     * @ORM\Column(type="integer")
     */
	private $lastMeterStatus;

    /**
     * @ORM\Column(type="integer")
     */
	private $averageM3;

    /**
     * @ORM\Column(type="integer")
     */
	private $averageKWh;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
	private $amount;

	private $days;

	private $months;

	public function getId()
	{
		return $this->id;
	}

	public function setDays($days)
	{
		$this->days = $days;
	}

	public function getDays()
	{
		return $this->days;
	}

	public function setMonths($months)
	{
		$this->months = $months;
	}

	public function getMonths()
	{
		return $this->months;
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

	public function getLastDateFormat()
	{
		return $this->dateOfLastNotation->format('Y-m-d');
	}

	//dateOfPresentNotation
	public function getDateOfPresentNotation()
	{
		return $this->dateOfPresentNotation;
	}

	public function setDateOfPresentNotation($dateOfPresentNotation)
	{
		$this->dateOfPresentNotation = $dateOfPresentNotation;
	}

		public function getPresentDateFormat()
	{
		return $this->dateOfPresentNotation->format('Y-m-d');
	}


	//presentMeterStatus
	public function getpresentMeterStatus()
	{
		return $this->presentMeterStatus;
	}

	public function setpresentMeterStatus($presentMeterStatus)
	{
		$this->presentMeterStatus = $presentMeterStatus;
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

	//m3
	public function getAverageM3()
	{
		return $this->averageM3;
	}

	public function setAverageM3($averageM3)
	{
		$this->averageM3 = $averageM3;
	}

	//kwH
	public function getAverageKWh()
	{
		return $this->averageKWh;
	}

	public function setAverageKWh($averageKWh)
	{
		$this->averageKWh = $averageKWh;
	}

	//amount
	public function getAmount()
	{
		return $this->amount;
	}

	public function setAmount($amount)
	{
		$this->amount = $amount;
	}
}