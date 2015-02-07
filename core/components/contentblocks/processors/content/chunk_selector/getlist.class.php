<?php
/**
 * Gets a list of chunks
 */
class ContentChunkSelectorGetListProcessor extends modProcessor {
    public function process()
    {
        $fieldId = (int)$this->getProperty('field', 0);

        $field = $this->modx->getObject('cbField', array('input' => 'chunk_selector', 'id' => $fieldId));
        if (!$field) {
            return $this->failure($this->modx->lexicon('contentblocks.error.no_valid_field'));
        }

        $c = $this->modx->newQuery('modChunk');
        $c->sortby('name', 'ASC');

        $categories = (string)$field->get('available_categories');
        if (!empty($categories)) {
            $categories = explode(',', $categories);
            $c->where(array('category:IN' => $categories));
        }

        $chunks = $field->get('available_chunks');
        $chunks = explode(',', $chunks);
        foreach ($chunks as $ch) {
            if (is_numeric($ch) && $ch > 0) $c->orCondition(array('id' => $ch));
            elseif (!empty($ch)) $c->orCondition(array('name' => $ch));
        }

        $results = array();
        $collection = $this->modx->getCollection('modChunk', $c);
        foreach ($collection as $chunk) {
            $results[] = $chunk->get(array('id', 'name', 'description', 'properties'));
        }

        if (empty($results)) {
            return $this->failure($this->modx->lexicon('contentblocks.error.no_chunks'));
        }

        return $this->outputArray($results);
    }
}
return 'ContentChunkSelectorGetListProcessor';
