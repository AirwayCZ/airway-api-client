<?php
declare(strict_types=1);

namespace Airway\Partner\Client\TokenStorage;

use Airway\Partner\Client\Exception\StorageException;
use Airway\Partner\Client\TokenStorage;

class FileTokenStorage implements TokenStorage
{
    private $path;
    private $data;

    public function __construct(
        $path = __DIR__ . '/../../storage/accessToken.json'
    )
    {
        $this->path = $path;
    }

    public function getExpiresIn(): \DateTimeInterface
    {
        return (new \DateTime())
            ->setTimestamp(
                $this->getFileMTime() + $this->get('expires_in')
            );
    }

    public function getAccessToken(): string
    {
        return $this->get('access_token');
    }

    public function isValid(): bool
    {
        try {
            $diff = time() - $this->getFileMTime();
            return $diff < $this->get('expires_in');
        } catch (StorageException $exception) {
            return false;
        }
    }

    private function getFileMTime(): int
    {
        $time = @filemtime($this->path);
        if(false === $time) {
            throw new StorageException(
                "It's not possible to get modification time of `{$this->path}`."
            );
        }
        return $time;
    }

    private function get(string $key)
    {
        if(!isset($this->data)) {
            $content = @file_get_contents($this->path); // @ intentionally to omit error
            if(false === $content) {
                throw new StorageException(
                    "It was not possible to read `{$this->path}`."
                );
            }
            $this->data = json_decode($content, true);
        }
        if(!array_key_exists($key, $this->data)) {
            throw new StorageException(
                "Key `{$key}` does not exists in storage data."
            );
        }
        return $this->data[$key];
    }

    public function store(array $data): void
    {
        $result = @file_put_contents(
            $this->path,
            json_encode($data)
        );
        $this->data = $data;
        if(false === $result) {
            throw new StorageException(
                "It was not possible to write storage file: `{$this->path}`."
            );
        }
    }
}
