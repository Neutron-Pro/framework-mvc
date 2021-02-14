<?php
namespace NeutronStars\Entity;

abstract class UserInterface
{
    private bool $connected = false;

    final public function isConnected(): bool
    {
        return $this->connected;
    }

    public abstract function getRoles(): array;

    final public function setConnected(bool $connected): void
    {
        $this->connected = $connected;
    }

    final public function hasRoles(string ...$roles): bool {
        foreach ($this->getRoles() as $role) {
            if (in_array($role, $roles)) {
                return true;
            }
        }
        return false;
    }
}
