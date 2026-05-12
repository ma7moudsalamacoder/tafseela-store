<?php

namespace Modules\Core\Services;

use Illuminate\Support\Collection;
use Modules\Core\Models\SiteSetting;

class SettingsManager
{
    /**
     * Get a setting value by key.
     *
     * @param  string  $key
     * @param  mixed|null  $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $setting = SiteSetting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Create or update a setting.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return SiteSetting
     */
    public function set(string $key, mixed $value): SiteSetting
    {
        return SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get all site settings.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return SiteSetting::all();
    }

    /**
     * Delete a setting by key.
     *
     * @param  string  $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        $setting = SiteSetting::where('key', $key)->first();

        if ($setting) {
            return $setting->delete();
        }

        return false;
    }

    /**
     * Check if a setting exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return SiteSetting::where('key', $key)->exists();
    }

    /**
     * Bulk update settings.
     *
     * @param  array<string, mixed>  $settings
     * @return void
     */
    public function bulkSet(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
    }
}
