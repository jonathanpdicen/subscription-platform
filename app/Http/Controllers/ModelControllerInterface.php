<?php

namespace App\Http\Controllers;

interface ModelControllerInterface
{
    public function modelClass(): string;

    public function resourceClass(): string;

    public function allowedFilters(): array;

    public function allowedIncludes(): array;

    public function allowedSorts(): array;

    public function shouldPaginate(): bool;

    public function defaultSorts(): array;
}