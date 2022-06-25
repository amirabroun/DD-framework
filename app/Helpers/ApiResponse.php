<?php

namespace App\Helpers;

class ApiResponse
{
    public int $status;
    public string $title;
    public string|array $message;
    public array $data;
    public string $pagination;

    private const RESPONE = [
        200 => 'success',
        404 => 'error',
    ];

    /**
     * @param $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

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
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    private function getTypeResponse(int $status)
    {
        return $this::RESPONE[$status];
    }

    /**
     * @param $object
     * @param $description
     * @param array|null $parametersArray
     */
    public function setShortDescription($object, $description)
    {
        $explodedMessage = explode(":", $description);
        $message = $explodedMessage[0];
        if (isset($explodedMessage[1])) {
            $message = $explodedMessage[1];
        }
        $this->setMessage($message);

        $index = get_class($object);
        $this->message[$index] = $description;
    }

    public function sweetAlert()
    {
        responseJson([
            'status' => $this->status,
            'confirmButtonText' => $this->confirmButtonText ?? 'متوجه شدم!',
            'message' => [
                'title' => $this->title,
                'text' =>  $this->prepareErrorFormForSweetAlert($this->message),
                'type' => $this->getTypeResponse($this->status),
            ]
        ]);
    }

    /**
     * @param array $errors
     *
     * @return string $rules // this is string ready for sweet alert
     */
    public function prepareErrorFormForSweetAlert(array|string $errors)
    {
        if (is_string($errors))
            return $errors;

        $ruleAttributes = attributesTranslate('rule');
        $rules = '';

        foreach ($errors as $keyI => $i) {
            $cleanError = $errors[$keyI];

            foreach ($cleanError as $input => $error) {
                foreach ($ruleAttributes as $keyRuleAttributes => $rule) {

                    if ($keyRuleAttributes == $error) {
                        $rules .= translate($input) . "\t" . ': ' . ' ' . $rule;
                    }
                }
            }
        }

        return $rules;
    }
}
