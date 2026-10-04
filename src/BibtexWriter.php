<?php

/**
 * Copyright (c) 2026 Wolfgang Hauptfleisch <dev@augmentedlogic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace com\augmentedlogic\bibtex;

class BibtexWriter
{
    private $entries = array();
    private $quotes = false;
    private $capital = false;
    private $out = null;

    private $escape = array(
        array('&', '\&'),
        array('%', '\%'),
        array('$', '$'),
        array('#', '\#'),
        array('_', '\_'),
        array('{', '\{'),
        array('}', '\}')
    );

    public function add($entry)
    {
        $this->entries[] = $entry;
        return $this;
    }

    private function iterate($str)
    {
        $vsplit = mb_str_split($str);
        foreach ($vsplit as $i => $char) {
            if (ctype_upper($char) == true) {
                $vsplit[$i] = '{' . $char . '}';
            }
        }
        return implode($vsplit);
    }

    private function makeKey($e)
    {
        $year_append = '';
        $title_append = strtolower(substr(preg_replace('/[^a-zA-Z0-9]+/', '', $e['title']), 0, 8));
        if (isset($e['year'])) {
            $year_append = $e['year'];
        }
        return strtolower(substr(preg_replace('/[^a-zA-Z0-9]+/', '', $e['author']), 0, 16)) . $year_append . $title_append;
    }

    private function doEscape($value)
    {
        foreach ($this->escape as $esc) {
            $value = str_replace($esc[0], $esc[1], $value);
        }
        if ($this->quotes) {
            $value = str_replace('"', '{"}', $value);
        }
        return $value;
    }

    public function useQuotes()
    {
        $this->quotes = true;
        return $this;
    }

    public function preserveUpper()
    {
        $this->capital = true;
        return $this;
    }

    public function render()
    {
        $output = array();

        // TODO: key

        foreach ($this->entries as $entry) {
            $e = $entry->asArray();
            if ($e['entry_key'] == null) {
                $e['entry_key'] = $this->makeKey($e);
            }

            $output[] = '@' . $e['entry_type'] . '{' . $e['entry_key'] . ',';
            unset($e['entry_type']);
            unset($e['entry_key']);
            $k_count = 1;
            $target = count($e);
            foreach ($e as $k => $v) {
                $comma = ',';
                if ($k_count == $target) {
                    $comma = '';
                }

                $is_url = false;
                if ($k == 'howpublished' || $k == 'url') {
                    $v = '\url{' . $v . '}';
                    $is_url = true;
                }

                if (is_int($v) == false) {
                    if ($is_url == false) {
                        $v = $this->doEscape($v);
                        if ($this->capital == true) {
                            $v = $this->iterate($v);
                        }
                    }

                    if ($this->quotes == true) {
                        $output[] = '  ' . $k . ' = "' . $v . '"' . $comma;
                    } else {
                        $output[] = '  ' . $k . ' = {' . $v . '}' . $comma;
                    }
                } else {
                    $output[] = '  ' . $k . ' = ' . $v . $comma;
                }

                $k_count++;
            }
            $output[] = "}\n";
        }

        $this->out = implode("\n", $output);
        return $this;
    }

    public function asString()
    {
        return $this->out . "\n";
    }

    public function write($outfile)
    {
        $f = fopen($outfile, 'w') or die('Unable to open file!');
        fwrite($f, $this->out . "\n");
        fclose($f);
    }
}
