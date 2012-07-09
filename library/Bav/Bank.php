<?php

/**
 * Copyright (C) 2012  Dennis Lassiter <dennis@lassiter.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 *
 * @author Dennis Lassiter <dennis@lassiter.de>
 * @copyright Copyright (C) 2012 Dennis Lassiter
 */

namespace Bav;

class Bank
{

    /**
     * @var string
     */
    protected $bankId = '';
    /**
     * @var string
     */
    protected $validationType = '';
    /**
     * @var BAV_Validator
     */
    protected $validator;
    /**
     * @var BAV_DataBackend
     */
    protected $dataBackend;
    /**
     * @var Array
     */
    protected $agencies;
    
    /**
     * Do not even think to use new BAV_Bank()!
     * Go and use BAV_DataBackend->getBank($bankID).
     *
     * @param string $bankId
     * @param string $validationType
     */
    public function __construct($bankId, $validationType)
    {
        $this->bankId = $bankId;
        $this->validationType = $validationType;
    }

    /**
     * @return string
     */
    public function getValidationType()
    {
        return $this->validationType;
    }

    /**
     * @return string
     */
    public function getBankId()
    {
        return (string) $this->bankId;
    }

    /**
     * Every bank has one main agency. This agency is not included in getAgencies().
     *
     * @throws BAV_DataBackendException
     * @return Bank\Agency
     */
    public function getMainAgency()
    {
        /* @var $agency Bank\Agency */
        foreach ($this->agencies as $agency) {
            if ($agency->isMainAgency()) return $agency;
        }
    }

    /**
     * A bank may have more agencies.
     *
     * @throws BAV_DataBackendException
     * @return array
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

    /**
     * Use this method to check your bank account.
     *
     * @throws BAV_ValidatorException_NotExists for some reason the validator might not be implemented
     * @param string $account
     * @return bool
     */
    public function isValid($account)
    {
        return $this->getValidator()->isValid($account);
    }

    /**
     * @throws BAV_ValidatorException_NotExists
     * @return BAV_Validator
     */
    public function getValidator()
    {
        if (is_null($this->validator)) {
            $this->validator = Validator::getInstance($this->validationType, $this);
        }
        return $this->validator;
    }
    
    public function addAgency(Bank\Agency $agency)
    {
        $this->agencies[] = $agency;
    }
    
    public function setAgencies($agencies)
    {
        $this->agencies = $agencies;
    }
    
}