<?php

namespace Byg\Admin\Exceptions\Api;

class BaseException extends \Exception
{
    private $report = true;

    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, int $code, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $message
     * 
     * @return static
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param int $code
     * 
     * @return static
     */
    public function setCode(int $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param \Throwable|null $previous
     * 
     * @return static
     */
    public function setPrevious(?\Throwable $previous = null)
    {
        $this->previous = $previous;

        return $this;
    }

    /**
     * @param bool $report
     * 
     * @return static
     */
    public function doReport(bool $report = true)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDoReport()
    {
        return $this->report;
    }
}
