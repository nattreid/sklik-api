<?php

declare(strict_types=1);

namespace NAttreid\SklikApi\Hooks;

use Nette\SmartObject;

/**
 * Class SklikApiConfig
 *
 * @property int $retargetingId
 * @property int $registrationId
 * @property int $conversionId
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApiConfig
{
	use SmartObject;

	/** @var int */
	private $retargetingId;

	/** @var int */
	private $registrationId;

	/** @var int */
	private $conversionId;

	public function getRetargetingId(): ?int
	{
		return $this->retargetingId;
	}

	public function setRetargetingId(?int $retargetingId)
	{
		$this->retargetingId = $retargetingId;
	}

	public function getRegistrationId(): ?int
	{
		return $this->registrationId;
	}

	public function setRegistrationId(?int $registrationId)
	{
		$this->registrationId = $registrationId;
	}

	public function getConversionId(): ?int
	{
		return $this->conversionId;
	}

	public function setConversionId(?int $conversionId)
	{
		$this->conversionId = $conversionId;
	}
}