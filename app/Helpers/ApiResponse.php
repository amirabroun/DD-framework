<?php

namespace App\Helpers;

class ApiResponse
{

    /**
     * @var int $status
     */
    public int $status;

    /**
     * @var string $title
     */
    public string $title = '';

    /**
     * @var string $message
     */
    public string $message = '';

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(array $message)
    {
        $this->message = $this->prepareMessage($message);

        return $this;
    }

    /**
     * @param array $errors
     *
     * @return string 
     */
    public function prepareMessage(array $errors)
    {
        $ruleAttributes = ruleAttributes();
        $rules = '';

        foreach ($errors as $keyI => $i) {
            $cleanError = $errors[$keyI];

            foreach ($cleanError as $error) {
                foreach ($ruleAttributes as $keyRuleAttributes => $rule) {
                    if ($keyRuleAttributes == $error) {
                        $rules .= $rule;
                    }
                }
            }
        }

        return $rules;
    }
}
