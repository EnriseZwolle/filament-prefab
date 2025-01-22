<?php

namespace App\Actions;

class MapBlocksToSearchable
{
    /**
     * Block data cannot contain non-keyword values such as booleans.
     *
     * @param  mixed  $blockData
     * @return array
     */
    public function handle(mixed $blockData): array
    {
        if (! is_array($blockData)) {
            return [];
        }

        foreach ($blockData as $blockKey => $blockValue) {
            if (is_array($blockValue)) {
                foreach ($blockValue['data'] as $field => $value) {
                    if (! is_null($value)) {
                        if (is_array($value)) {
                            $value = $this->mapArrayToString($value);
                        } elseif(is_bool($value)) {
                            // Map booleans to 1 or 0, `(string) $value` returns '1' or '' (empty string)
                            $value = $value ? '1' : '0';
                        } else {
                            $value = (string) $value;
                        }

                        $blockData[$blockKey]['data'][$field] = $value;
                    }
                }
            }
        }

        return $blockData;
    }

    protected function mapArrayToString(array $items): array
    {
        foreach ($items as $nestedKey => $nestedValue) {
            if (is_array($nestedValue)) {
                $items[$nestedKey] = $this->mapArrayToString($nestedValue);
            } else {
                $items[$nestedKey] = (string) $nestedValue;
            }
        }

        return $items;
    }
}
