<?php

/*
 * Copyright 2005 - 2020 Centreon (https://www.centreon.com/)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * For more information : contact@centreon.com
 *
 */
declare(strict_types=1);

namespace Centreon\Domain\Monitoring;

/**
 * Class representing a record of a resource status in the repository.
 *
 * @package Centreon\Domain\Monitoring
 */
class ResourceStatus
{
    // Groups for serilizing
    public const SERIALIZER_GROUP_MAIN = 'resource_status_main';

    public const SEVERITY_HIGH = 1;
    public const SEVERITY_MEDIUM = 2;
    public const SEVERITY_LOW = 3;
    public const SEVERITY_PENDING = 3;
    public const SEVERITY_OK = 5;

    /**
     * @var int|null
     */
    private $code;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     * @return \Centreon\Domain\Monitoring\ResourceStatus
     */
    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name ? _($this->name) : $this->name;
    }

    /**
     * @param string|null $name
     * @return \Centreon\Domain\Monitoring\ResourceStatus
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get status severity code from status name
     *
     * @return int
     */
    public function getSeverityCode(): int
    {
        $severity = self::SEVERITY_PENDING;

        switch ($this->name) {
            case 'OK':
            case 'UP':
                $severity = self::SEVERITY_OK;
                break;
            case 'UNKNOWN':
            case 'UNREACHABLE':
                $severity = self::SEVERITY_LOW;
                break;
            case 'WARNING':
                $severity = self::SEVERITY_MEDIUM;
                break;
            case 'CRITICAL':
            case 'DOWN':
                $severity = self::SEVERITY_HIGH;
                break;
        }

        return $severity;
    }
}
