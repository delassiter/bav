<?php

namespace Bav;

interface BackendInterface
{
    
    public function getBank($bankID);
    public function bankExists($bankID);
    public function getAllBanks();
    
}