<?php
/**
 * Copyright (c) 2011 by Bluz PHP Team
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Bluz\Ldap\Entries;

class Entry
{

    /**
     * Fields
     *
     * @var array
     */
    public $fields;

    /**
     * Construct
     *
     * @param array $fields
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Search field value
     *
     * @param string $searchname
     * @param bool $strict
     * @return array
     */
    public function search($searchname, $strict = false)
    {
        $results = array();
        $this->_recursiveSearch($this->fields, $searchname, $results, $strict);
        return $results;
    }

    /**
     * Recursively search items
     *
     * @param $fields
     * @param $searchname
     * @param $results
     * @param $strict
     *
     * @internal param \Bluz\Ldap\Entries\unknown_type $fieldname
     */
    private function _recursiveSearch($fields, $searchname, &$results, $strict)
    {
        foreach ($fields as $key => $field) {
            if (!$strict) {
                if (false !== strpos($key, $searchname)) {
                    $results[] = $field;
                }
            } elseif ($key === $searchname) {
                $results[] = $field;
            }
            if (is_array($field)) {
                $this->_recursiveSearch($field, $searchname, $results, $strict);
            }
        }
    }

}