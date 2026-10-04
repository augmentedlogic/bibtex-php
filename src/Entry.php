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

class Entry
{
    const ARTICLE = 'article';
    const BOOK = 'book';
    const BOOKLET = 'booklet';
    const CONFERENCE = 'conference';
    const INBOOK = 'inbook';
    const INCOLLECTION = 'incollection';
    const INPROCEEDINGS = 'inproceedings';
    const MANUAL = 'manual';
    const MASTERTHESIS = 'masterthesis';
    const MISC = 'misc';
    const PHDTHESIS = 'phdthesis';
    const PROCEEDINGS = 'proceedings';
    const TECHREPORT = 'techreport';
    const UNPUBLISHED = 'unpublished';

    private array $entry = array();

    function __construct(string $entry_type, ?string $entry_key = null)
    {
        $this->entry['entry_type'] = $entry_type;
        $this->entry['entry_key'] = $entry_key;
    }

    //  address: address of the publisher or the institution
    public function setAddress(string $address): Entry
    {
        $this->entry['address'] = $address;
        return $this;
    }

    //  annote: an annotation
    public function setAnnotation(string $annotation): Entry
    {
        $this->entry['annotation'] = $annotation;
        return $this;
    }

    // author: list of authors of the work
    public function setAuthor(string $author): Entry
    {
        $this->entry['author'] = $author;
        return $this;
    }

    // chapter: number of a chapter in a book
    public function setChapter(string $chapter): Entry
    {
        $this->entry['chapter'] = $chapter;
        return $this;
    }

    // edition: edition number of a book
    public function setEdition(string $edition): Entry
    {
        $this->entry['edition'] = $edition;
        return $this;
    }

    // editor: list of editors of a book
    public function setEditor(string $editor): Entry
    {
        $this->entry['editor'] = $editor;
        return $this;
    }

    // howpublished: a publication notice for unusual publications
    public function setHowpublished(string $howpublished): Entry
    {
        $this->entry['howpublished'] = $howpublished;
        return $this;
    }

    // institution: name of the institution that published and/or sponsored the report
    public function setInstitution(string $institution): Entry
    {
        $this->entry['institution'] = $institution;
        return $this;
    }

    // journal: name of the journal or magazine the article was published in
    public function setJournal(string $journal): Entry
    {
        $this->entry['journal'] = $journal;
        return $this;
    }

    // month: the month during the work was published
    public function setMonth(mixed $month): Entry
    {
        $this->entry['month'] = $month;
        return $this;
    }

    // note: notes about the reference
    public function setNote(string $note): Entry
    {
        $this->entry['note'] = $note;
        return $this;
    }

    // number: number of the report or the issue number for a journal article
    public function setNumber(mixed $number): Entry
    {
        $this->entry['number'] = $number;
        return $this;
    }

    // organization: name of the institution that organized or sponsored the conference or that published the manual
    public function setOrganization(string $organization): Entry
    {
        $this->entry['organization'] = $organization;
        return $this;
    }

    // pages: page numbers or a page range
    public function setPage(mixed $page): Entry
    {
        $this->entry['page'] = $page;
        return $this;
    }

    // publisher: name of the publisher
    public function setPublisher(string $publisher): Entry
    {
        $this->entry['publisher'] = $publisher;
        return $this;
    }

    // school: name of the university or degree awarding institution
    public function setSchool(string $school): Entry
    {
        $this->entry['school'] = $school;
        return $this;
    }

    // series: name of the series or set of books
    public function setSeries(string $series): Entry
    {
        $this->entry['series'] = $series;
        return $this;
    }

    // title: title of the work
    public function setTitle(string $title): Entry
    {
        $this->entry['title'] = $title;
        return $this;
    }

    // type: type of the technical report or thesis
    public function setType(string $type): Entry
    {
        $this->entry['type'] = $type;
        return $this;
    }

    // volume: volume number
    public function setVolume(mixed $volume): Entry
    {
        $this->entry['volume'] = $volume;
        return $this;
    }

    // year: year the work was published
    public function setYear(mixed $year): Entry
    {
        $this->entry['year'] = $year;
        return $this;
    }

    // Non-standard keys

    // doi: DOI number (like 10.1038/d41586-018-07848-2)
    public function setDoi(string $doi): Entry
    {
        $this->entry['doi'] = $doi;
        return $this;
    }

    // issn: ISSN number (like 1476-4687)
    public function setIssn(string $issn): Entry
    {
        $this->entry['issn'] = $issn;
        return $this;
    }

    // isbn: ISBN number (like 9780201896831)
    public function setIsbn(mixed $isbn): Entry
    {
        $this->entry['isbn'] = $isbn;
        return $this;
    }

    // url: URL of a web page
    public function setUrl(string $url): Entry
    {
        $this->entry['url'] = $url;
        return $this;
    }

    public function asArray()
    {
        return $this->entry;
    }
}
