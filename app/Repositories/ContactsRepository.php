<?php

namespace Repositories;

class ContactsRepository
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function all(): array
    {
        if (!file_exists($this->file)) {
            return [];
        }
        $data = json_decode(file_get_contents($this->file), true);
        return $data['contacts'] ?? [];
    }

    public function find(int $id): ?array
    {
        foreach ($this->all() as $contact) {
            if ($contact['id'] === $id) {
                return $contact;
            }
        }
        return null;
    }
}