<?php

namespace Bav;

interface BackendInterface
{
    
    public function getBank($bankID);
    public function bankExists($bankID);
    public function getAllBanks();
    public function getMainAgency(Bank $bank);
    public function getAgencies(Bank $bank);
    
}