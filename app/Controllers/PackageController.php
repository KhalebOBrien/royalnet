<?php

use App\Services\Package;

require_once 'app/Services/Package.php';

class PackageController
{
	public $package;
	public function __construct()
	{
		$this->package = new Package();
	}

	/**
	 * This function is used to fetch all packages from the database
	 * @return boolean
	 */
	public function getAll()
	{
		return $this->package->fetchAllPackages();
	}

    public function getPackage($id)
    {
        return $this->package->fetchPackageById($id);
    }
}

?>