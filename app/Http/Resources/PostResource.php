<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $postTranslations = $this->getPostTranslations();
        return [
            'id' => $this->id,
            'post_translations' => $postTranslations
        ];
    }

    /**
     * @return array
     */
    public function getPostTranslations(): array
    {
        $postTranslations = [];
        $postTranslationsData = $this->postTranslations
            ->groupBy('language.locale');

        foreach ($postTranslationsData as $lang => $postTranslation) {
            $postTranslations[$lang] = PostTranslationsResource::make($postTranslation->first());
        }
        return $postTranslations;
    }
}
