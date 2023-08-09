<?php
declare(strict_types=1);

namespace Meraki\TLS;
use Meraki\TLS\DistinguishedName;
use Meraki\TLS\Key;

final class Certificate
{
	public function __construct()
	{

	}

	public static function generate(DistinguishedName $dn): self
	{
		if (!($dn instanceof DistinguishedName)) {
			$dn = new DistinguishedName($dn);
		}
	}

	public static function load(string $file): self
	{

	}

	public function associateKey(Key $key): self
	{

	}
}
