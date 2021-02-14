<?php

namespace NeutronStars\Service\Form;

class FormBuilder
{
    private string $formHTML;
    private array $values;
    private array $errors;

    public function __construct(array $values = [], array $errors = [], string $action = '', string $method = 'POST', bool $csrf = true)
    {
        $this->formHTML = '<form action="' . $action . '" method="' . $method . '">';
        $this->values = $values;
        $this->errors = $errors;
        $this->addCSRF($csrf);
    }

    protected function addCSRF(bool $csrf): void
    {
        if (!$csrf) {
            return;
        }
        if (!empty($this->errors['__token-csrf'])) {
            $this->formHTML .= '<div class="form-error">'.$this->errors['__token-csrf'].'</div>';
            return;
        }
        $this->formHTML .= '<input name="__token-csrf" type="hidden" value="' . $this->createTokenCSRF() . '" />';
    }

    public function addLabel(string $name, string $for): self
    {
        $this->formHTML .= '<label for="' . $for . '">' . $name . '</label>';
        return $this;
    }

    public function addInput(string $id, string $name, string $type = 'text', string $placeholder = ''): self
    {
        $this->addError($name);
        $this->formHTML .= '<input id="' . $id . '" name="' . $name . '" type="' . $type . '" placeholder="' . $placeholder . '" value="' . $this->getValue($name) . '" />';
        return $this;
    }

    public function addTextarea(string $id, string $name, string $placeholder = '', string $rows = '5', string $cols = ''): self
    {
        $this->addError($name);
        $this->formHTML .= '<textarea id="' . $id . '" name="' . $name . '" placeholder="' . $placeholder . '" rows="' . $rows . '" cols="' . $cols . '">' . $this->getValue($name) . '</textarea>';
        return $this;
    }

    public function addSelect(string $id, string $name, array $options): self
    {
        $this->addError($name);
        $this->formHTML .= '<select id="' . $id . '" name="' . $name . '">';
        foreach ($options as $key => $val) {
            $this->formHTML .= '<option value="' . $key . '" ' . ($key == $this->getValue($name) ? 'selected' : '') . '>' . $val . '</option>';
        }
        $this->formHTML .= '</select>';
        return $this;
    }

    public function addSubmit(string $name, string $value): self
    {
        $this->formHTML .= '<input type="submit" name=' . $name . '" value="' . $value . '" />';
        return $this;
    }

    private function addError(string $key): void
    {
        if (!empty($this->errors[$key])) {
            $this->formHTML .= '<span class="error">' . $this->errors[$key] . '</span>';
        }
    }

    private function getValue(string $key): string
    {
        return !empty($this->values[$key]) ? $this->values[$key] : '';
    }

    protected function createTokenCSRF(): string
    {
        $_SESSION['_token_csrf'] = md5(uniqid().mt_rand());
        return $this->getTokenCSRF();
    }

    protected function getTokenCSRF(): ?string
    {
        return $_SESSION['_token_csrf'] ?? null;
    }

    public function __toString(): string
    {
        return $this->formHTML . '</form>';
    }
}
