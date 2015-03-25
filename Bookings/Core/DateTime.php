<?php

namespace Bookings\Core;

class DateTime extends \DateTime 
{

	public function toEs()
	{
		return $this->format('c');
	}

    public function apiFormat()
    {
        return $this->toEs();
    }

}