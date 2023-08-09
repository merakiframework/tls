<?php
declare(strict_types=1);

namespace Meraki\TLS;

final class DistinguishedName
{
	public function __construct(public string $commonName)
	{

	}

	public function __toString()
	{
		$dn = '';

		$dn .= "/CN={$this->commonName}";

		return $dn;
	}
}
