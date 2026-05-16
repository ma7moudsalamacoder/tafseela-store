<?php

namespace Modules\Core\Services;

use Illuminate\Support\Collection;
use Modules\Core\Models\SiteSetting;

class SettingsManager
{
    /**
     * Get a setting value by key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $setting = SiteSetting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Create or update a setting.
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
     */
    public function all(): Collection
    {
        return SiteSetting::all();
    }

    /**
     * Delete a setting by key.
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
     */
    public function has(string $key): bool
    {
        return SiteSetting::where('key', $key)->exists();
    }

    /**
     * Bulk update settings.
     *
     * @param  array<string, mixed>  $settings
     */
    public function bulkSet(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Get the Arabic dialect synonym map.
     *
     * @param  string|null  $word  If provided, returns synonyms only for that word.
     * @return array<string, list<string>>|list<string>
     */
    public function getSynonyms(?string $word = null): array
    {
        $map = config('core.synonyms', []);

        if ($word === null) {
            return $map;
        }

        return $map[$word] ?? [];
    }

    /**
     * Expand a word with its Arabic dialect synonyms.
     *
     * Returns the original word plus all known synonyms, deduplicated.
     *
     * @return list<string>
     */
    public function expandWithSynonyms(string $word): array
    {
        $synonyms = $this->getSynonyms($word);

        return array_values(array_unique([$word, ...$synonyms]));
    }
}
