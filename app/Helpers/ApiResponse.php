<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * @var string $status
     */
    public string $status;

    /**
     * @var string $title
     */
    public string $title = '';

    /**
     * @var string $message
     */
    public string $message = '';

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param array $message
     * @return $this
     */
    public function setMessage(array $message)
    {
        $this->message = $this->prepareMessage($message);

        return $this;
    }

    /**
     * convert array massage to string
     * 
     * @param array $errors
     * @return string 
     */
    private function prepareMessage(array $errors)
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
