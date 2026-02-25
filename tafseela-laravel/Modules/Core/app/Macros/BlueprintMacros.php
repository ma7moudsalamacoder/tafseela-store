<?php

namespace Modules\Core\Macros;

use Illuminate\Database\Schema\Blueprint;

class BlueprintMacros
{
    public static function register(): void
    {
        Blueprint::macro('auditions', function (): void {
            $this->unsignedBigInteger('created_by_id')->nullable();
            $this->unsignedBigInteger('updated_by_id')->nullable();
            $this->unsignedBigInteger('deleted_by_id')->nullable();
        });
    }
}

