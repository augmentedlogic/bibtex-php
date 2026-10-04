# bibtex-php

Bibtex writer for php

## Changelog

v0.1 

* all keys implemented
* options for quote and curly encapsulation
* escape special characters

## Installation
 
```
composer require augmentedlogic/bibtex
```

## Usage

```php

use \com\augmentedlogic\bibtex\BibtexWriter;
use \com\augmentedlogic\bibtex\Entry;
 
$bw = new BibtexWriter();
 
$entry = new Entry("article", "johndoe2026");
$entry->setTitle("A random title of a paper dealing with something")
      ->setAuthor("John Doe")
      ->setJournal("Nature")
      ->setYear(2026)
      ->setMonth("august");

// for this entry, we automatically generate a bibtex key 
$entry2 = new Entry("misc");
$entry2->setTitle("A document showing escaping the journal name")
       ->setAuthor("Jane Doe")
       ->setJournal("Biology & Physics")
       ->setYear(2026)
       ->setMonth(8)
       ->setUrl("https://www.misalignedmag.com/article/whatever");
  
$bw->add($entry);
$bw->add($entry2);
 
// encapsulate upper case letters in {}, default: false
// $bw->preserveUpper();
 
$bw->render();

// return the output as a string
print $bw->asString();
 
// write the output to a file
// $bw->write("out.bib");
 

// another example, this time using quote-encapsulated values 
$bw2 = new BibtexWriter();
$bw2->add($entry);
$bw2->add($entry2);
$bw2->useQuotes();
$bw2->render();
print $bw2->asString();


```

Full list of avaliable keys:

```php

    public function setAddress(string $address): Entry
    public function setAnnotation(string $annotation): Entry
    public function setAuthor(string $author): Entry
    public function setChapter(string $chapter): Entry
    public function setEdition(string $edition): Entry
    public function setEditor(string $editor): Entry
    public function setHowpublished(string $howpublished): Entry
    public function setInstitution(string $institution): Entry
    public function setJournal(string $journal): Entry
    public function setMonth(mixed $month): Entry
    public function setNote(string $note): Entry
    public function setNumber(mixed $number): Entry
    public function setOrganization(string $organization): Entry
    public function setPage(mixed $page): Entry
    public function setPublisher(string $publisher): Entry
    public function setSchool(string $school): Entry
    public function setSeries(string $series): Entry
    public function setTitle(string $title): Entry
    public function setType(string $type): Entry
    public function setVolume(mixed $volume): Entry
    public function setYear(mixed $year): Entry
    public function setDoi(string $doi): Entry
    public function setIssn(string $issn): Entry
    public function setIsbn(mixed $isbn): Entry
    public function setUrl(string $url): Entry

```
