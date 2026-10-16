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

    public function update(int $id, array $fields): bool
    {
        if (!file_exists($this->file)) {
            return false;
        }

        $data = json_decode(file_get_contents($this->file), true);

        foreach ($data['contacts'] as &$c) {
            if ((int) $c['id'] === $id) {
                $c = array_merge($c, $fields);
                unset($c); // referme la référence laissée par le foreach

                file_put_contents(
                    $this->file,
                    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
                return true;
            }
        }
        unset($c);

        return false;
    }
}