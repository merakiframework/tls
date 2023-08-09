<?php

declare(strict_types=1);

namespace Meraki\TLS;
use Meraki\TLS\DistinguishedName;
use RuntimeException;

final class Config
{
	public $supportedVersions = [];
	public bool $verifyPeers = true;
	public bool $allowSelfSignedCertificates = false;
	public array $certificates = [];
	public bool $autoCreateMissingCertificates = true;

	public function __construct(public string $certificatesDirectory)
	{

	}

	public static function create(string $certificatesDirectory): self
	{
		return new self($certificatesDirectory);
	}

	public function supportsMinimumVersion(string $version): self
	{
		$copy = clone $this;
		$copy->supportedVersions = $version;

		return $copy;
	}

	public function verifyPeers(bool $verify = true): self
	{
		$copy = clone $this;
		$copy->verifyPeers = $verify;

		return $copy;
	}

	public function allowSelfSignedCertificates(bool $allow = true): self
	{
		$copy = clone $this;
		$copy->allowSelfSignedCertificates = $allow;

		return $copy;
	}

	public function addHost(string $host, string $certFile, string $keyFile): self
	{
		$copy = clone $this;
		$copy->certificates = array_merge($this->certificates, [
			$host => [
				'certificate' => "{$this->certificatesDirectory}/$certFile",
				'key' => "{$this->certificatesDirectory}/$keyFile"
			]
		]);

		return $copy;
	}

	public function hasCertificateFor(string $host): bool
	{
		return array_key_exists($host, $this->certificates);
	}

	public function autoCreateMissingCertificates(bool $autoCreate): self
	{
		$copy = clone $this;
		$copy->autoCreateMissingCertificates = $autoCreate;

		return $copy;
	}

	public function getCertificateFor(string $host): string
	{
		if (isset($this->certificates[$host]['certificate'])) {
			return $this->certificates[$host]['certificate'];
		}

		throw new RuntimeException("TLS certificate is missing for: $host");
	}

	public function getKeyFor(string $host): string
	{
		if (isset($this->certificates[$host]['key'])) {
			return $this->certificates[$host]['key'];
		}

		throw new RuntimeException("TLS key is missing for: $host");
	}

	public function useProvider(string $provider): self
	{

	}
}
