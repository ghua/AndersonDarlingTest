<?php

namespace AndersonDarlingTest;

/**
 * Class TooLessDataException
 *
 * @package AndersonDarlingTest
 *
 * @author  Semyon Velichko <semyon@velichko.net>
 */
class TooLessDataException extends \InvalidArgumentException
{
    protected $message = 'Sample array size needs to be more than five.';
}
