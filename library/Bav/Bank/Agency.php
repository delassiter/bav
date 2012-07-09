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
 * @package Bank
 * @author Dennis Lassiter <dennis@lassiter.de>
 * @copyright Copyright (C) 2012 Dennis Lassiter
 */

namespace Bav\Bank;

class Agency
{

    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var \Bav\Bank
     */
    protected $bank;

    /**
     * @var string
     */
    protected $bic = '';

    /**
     * @var string
     */
    protected $city = '';

    /**
     * @var string
     */
    protected $pan = '';

    /**
     * @var string
     */
    protected $postcode = '';

    /**
     * @var string
     */
    protected $shortTerm = '';

    /**
     * @var string
     */
    protected $name = '';
    
    protected $isMain = false;

    /**
     * Don't create this object directly. Use BAV_Bank->getMainAgency()
     * or BAV_Bank->getAgencies().
     *
     * @param int $id
     * @param string $name
     * @param string $shortTerm
     * @param string $city
     * @param string $postcode
     * @param string $bic might be empty
     * @param string $pan might be empty
     */
    public function __construct($id, $name, $shortTerm, $city, $postcode, $bic = '', $pan = '', $isMain = false)
    {
        $this->id = (int) $id;
        $this->bic = $bic;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->name = $name;
        $this->shortTerm = $shortTerm;
        $this->pan = $pan;
        $this->isMain = $isMain;
    }

    /**
     * @return bool
     */
    public function isMainAgency()
    {
        return $this->isMain;
    }

    /**
     * @return \Bav\Bank
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortTerm()
    {
        return $this->shortTerm;
    }

    /**
     * @return bool
     */
    public function hasPan()
    {
        return !empty($this->pan);
    }

    /**
     * @return bool
     */
    public function hasBic()
    {
        return !empty($this->bic);
    }

    /**
     * @throws \Bank\Exception\UndefinedAttributeException
     * @return string
     */
    public function getPan()
    {
        if (!$this->hasPAN()) {
            throw new \Bank\Exception\UndefinedAttributeException($this, 'pan');
        }
        return $this->pan;
    }

    /**
     * @throws \Bank\Exception\UndefinedAttributeException
     * @return string
     */
    public function getBic()
    {
        if (!$this->hasBIC()) {
            throw new \Bank\Exception\UndefinedAttributeException($this, 'bic');
        }
        return $this->bic;
    }

}