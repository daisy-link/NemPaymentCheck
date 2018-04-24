<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace Plugin\NemPaymentCheck\Exception;

class ExtensionRequiredException extends SystemRequirementNotMetException
{
    /**
     * @param string $extension
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($extension, $code = 0, \Exception $previous = null)
    {
        $message = sprintf('%s extension is required.', $extension);
        parent::__construct($message, $code, $previous);
    }
}
